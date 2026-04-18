<?php

namespace App\Http\Controllers\backEnd;

use App\Http\Controllers\Controller;
use App\Models\Breed;
use App\Models\Category;
use App\Models\Company;
use App\Models\District;
use App\Models\PetSize;
use App\Models\Service;
use App\Models\ServiceAvailability;
use App\Models\ServicePricing;
use App\Models\ServicePricingRule;
use App\Models\Species;
use App\Models\Union;
use App\Models\Upazila;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Symfony\Component\Finder\Iterator\SizeRangeFilterIterator;

class ServiceMController extends Controller
{
    public function serviceManagement()
    {
        $categories = Category::paginate(6);
        $services = Service::paginate(9);

        return view('backEnd.pages.companyService.serviceManagement', compact('categories', 'services'));
    }


    public function saveCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'status' => 'required|in:0,1',
        ]);

        $category = Category::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Category saved successfully!',
            'category' => $category,
        ]);
    }

    public function updateCategory(Request $request)
    {
        $category = Category::FindorFail($request->category_id);

        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $request->category_id,
            'status' => 'required|in:0,1',
        ]);

        $categoryData = [
            'name' => $request->name,
            'status' => $request->status,
        ];

        $category->update($categoryData);

        // Return a JSON response indicating success
        return response()->json([
            'success' => true,
            'message' => 'Category saved successfully!',
        ]);
    }







    public function addService()
    {
        $categories = Category::where('status', 1)->get();
        $species = Species::where('status', 1)->get();
        $companies = Company::where('status', 1)->get();
        $districts = District::all();
        $upazilas = Upazila::all();
        $sizes = PetSize::all();
        $breeds = Breed::all();

        return view(
            'backEnd.pages.companyService.storeervices',
            compact('categories', 'species', 'companies', 'districts', 'upazilas', 'sizes', 'breeds')
        );
    }

    public function editService($id)
    {
        $categories = Category::where('status', 1)->get();
        $species = Species::where('status', 1)->get();
        $companies = Company::where('status', 1)->get();
        $districts = District::all();
        $upazilas = Upazila::all();
        $sizes = PetSize::all();
        $breeds = Breed::all();
        $service = Service::findOrFail($id);
        $servicePricings = ServicePricing::where('service_id', $id)->get();
        $serviceAvailability = ServiceAvailability::where('service_id', $id)->first();
        $serviceRules = ServicePricingRule::whereIn('service_pricing_id', $servicePricings->pluck('id'))->get();

        return view(
            'backEnd.pages.companyService.editservices',
            compact('categories', 'species', 'companies', 'districts', 'upazilas', 'sizes', 'breeds', 'service', 'servicePricings', 'serviceAvailability', 'serviceRules')
        );
    }

    public function saveService(Request $request)
    {

        $request->merge([
            'pricing_types' => collect($request->pricing_types)->map(function ($pricing) {

                if (!empty($pricing['rules'])) {

                    $pricing['rules'] = collect($pricing['rules'])->map(function ($rule) {

                        $rule['species_id'] = $rule['species_id'] ?: null;
                        $rule['breed_id']   = $rule['breed_id'] ?: null;
                        $rule['size_id']    = $rule['size_id'] ?: null;

                        return $rule;
                    })->toArray();
                }

                return $pricing;
            })->toArray()
        ]);

        /* =========================
        VALIDATION
        ========================= */
        $validator = Validator::make($request->all(), [

            /* =========================
            SERVICE
            ========================= */
            'name' => 'required|string|max:255',
            'service_type' => 'required|in:Appointments,Duration,Package',

            'district_id' => 'required|exists:districts,id',
            'upazila_id' => 'required|exists:upazilas,id',
            'union_id' => 'required|exists:unions,id',

            'category_id' => 'required|exists:categories,id',
            'company_id' => 'required|exists:companies,id',

            'location' => 'required|string|max:255',
            'description' => 'nullable|string',

            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',

            /* =========================
            PRICING TYPES
            ========================= */
            'pricing_types' => 'required|array|min:1',

            // TYPE (Duration only)
            'pricing_types.*.type' => 'nullable|in:Hourly,Daily,Weekly,Session,Package',

            // DEFAULT PRICE (only if no rules)
            'pricing_types.*.price' => [
                'nullable',
                'numeric',
                'required_without:pricing_types.*.rules'
            ],

            'pricing_types.*.sale_price' => 'nullable|numeric|lte:pricing_types.*.price',

            /* =========================
            PACKAGE FIELDS
            ========================= */
            'pricing_types.*.qty' => 'nullable|numeric|min:1',
            'pricing_types.*.time' => 'nullable|string|max:100',
            'pricing_types.*.label' => 'nullable|string|max:100',

            /* =========================
            RULES
            ========================= */
            'pricing_types.*.rules' => 'nullable|array',

            'pricing_types.*.rules.*.species_id' => 'nullable|exists:species,id',
            'pricing_types.*.rules.*.breed_id' => 'nullable|exists:breeds,id',
            'pricing_types.*.rules.*.size_id' => 'nullable|exists:pet_sizes,id',

            'pricing_types.*.rules.*.price' => 'required|numeric|min:0',
            'pricing_types.*.rules.*.sale_price' => 'nullable|numeric|lte:pricing_types.*.rules.*.price',

            /* =========================
            SCHEDULE
            ========================= */
            'day_of_week' => 'required|array|min:1',
            'day_of_week.*' => 'in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',

            'start_time' => 'required',
            'end_time' => 'required',

            // off_dates comes as string from flatpickr
            'off_dates' => 'nullable|string',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        DB::beginTransaction();

        try {

            $start = date('H:i:s', strtotime($request->start_time));
            $end   = date('H:i:s', strtotime($request->end_time));

            /* =========================
            SAVE SERVICE
            ========================= */

            $slug = Str::slug($request->name);
            for ($i = 1; Service::where('slug', $slug)->exists(); $i++) {
                $slug = Str::slug($request->name) . '-' . $i;
            }

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = 'service_' . time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('backAssets/images/services'), $imageName);
                $imagePath = 'backAssets/images/services/' . $imageName;
            }


            $service = Service::create([
                'name' => $request->name,
                'service_type' => $request->service_type,
                'slug' => $slug,
                'district_id' => $request->district_id ?? null,
                'upazila_id' => $request->upazila_id ?? null,
                'union_id' => $request->union_id ?? null,
                'description' => $request->description ?? null,
                'category_id' => $request->category_id ?? null,
                'company_id' => $request->company_id ?? null,
                'location' => $request->location ?? null,
                'image' => $imagePath ?? null,
            ]);

            /* =========================
            SAVE PRICINGS
            ========================= */
            foreach ($request->pricing_types as $pricing) {

                $pricingModel = ServicePricing::create([
                    'service_id' => $service->id,
                    'pricing_type' => $pricing['type'] ?? null,
                    'price' => $pricing['price'] ?? null,
                    'sale_price' => $pricing['sale_price'] ?? null,

                    // package fields
                    'qty' => $pricing['qty'] ?? null,
                    'time' => $pricing['time'] ?? null,
                    'label' => $pricing['label'] ?? null,
                ]);

                /* =========================
                SAVE RULES
                ========================= */
                if (!empty($pricing['rules'])) {

                    foreach ($pricing['rules'] as $rule) {

                        ServicePricingRule::create([
                            'service_pricing_id' => $pricingModel->id,
                            'species_id' => $rule['species_id'] ?? 0,
                            'breed_id' => $rule['breed_id'] ?? 0,
                            'size_id' => $rule['size_id'] ?? 0,
                            'price' => $rule['price'],
                            'sale_price' => $rule['sale_price'] ?? null,
                        ]);
                    }
                }
            }

            /* =========================
            SAVE SCHEDULE
            ========================= */

            // Convert array → comma string
            $days = implode(',', $request->day_of_week);

            // Clean off_dates (remove spaces)
            $offDates = $request->off_dates
                ? implode(',', array_map('trim', explode(',', $request->off_dates)))
                : null;

            ServiceAvailability::create([
                'service_id' => $service->id,

                'day_of_week' => $days,          // Monday,Tuesday,Friday
                'start_time' => $start,
                'end_time' => $end,

                'off_dates' => $offDates,        // 2026-04-18,2026-04-20
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Service created successfully!'
            ]);
        } catch (\Exception $e) {

            DB::rollback();

            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function updateService(Request $request, $id)
    {

        $service = Service::findOrFail($id);

        /* =========================
       NORMALIZE RULE DATA
    ========================= */
        $request->merge([
            'pricing_types' => collect($request->pricing_types)->map(function ($pricing) {

                if (!empty($pricing['rules'])) {

                    $pricing['rules'] = collect($pricing['rules'])->map(function ($rule) {

                        $rule['species_id'] = $rule['species_id'] ?: null;
                        $rule['breed_id']   = $rule['breed_id'] ?: null;
                        $rule['size_id']    = $rule['size_id'] ?: null;

                        return $rule;
                    })->toArray();
                }

                return $pricing;
            })->toArray()
        ]);

        /* =========================
       VALIDATION
    ========================= */
        $validator = Validator::make($request->all(), [

            'name' => 'required|string|max:255',
            'service_type' => 'required|in:Appointments,Duration,Package',

            'district_id' => 'required|exists:districts,id',
            'upazila_id' => 'required|exists:upazilas,id',
            'union_id' => 'required|exists:unions,id',

            'category_id' => 'required|exists:categories,id',
            'company_id' => 'required|exists:companies,id',

            'location' => 'required|string|max:255',
            'description' => 'nullable|string',

            // 🔥 image optional on update
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'pricing_types' => 'required|array|min:1',

            'pricing_types.*.type' => 'nullable|in:Hourly,Daily,Weekly,Session,Package',

            'pricing_types.*.price' => [
                'nullable',
                'numeric',
                'required_without:pricing_types.*.rules'
            ],

            'pricing_types.*.sale_price' => 'nullable|numeric|lte:pricing_types.*.price',

            'pricing_types.*.qty' => 'nullable|numeric|min:1',
            'pricing_types.*.time' => 'nullable|string|max:100',
            'pricing_types.*.label' => 'nullable|string|max:100',

            'pricing_types.*.rules' => 'nullable|array',

            'pricing_types.*.rules.*.species_id' => 'nullable|exists:species,id',
            'pricing_types.*.rules.*.breed_id' => 'nullable|exists:breeds,id',
            'pricing_types.*.rules.*.size_id' => 'nullable|exists:pet_sizes,id',

            'pricing_types.*.rules.*.price' => 'required|numeric|min:0',
            'pricing_types.*.rules.*.sale_price' => 'nullable|numeric|lte:pricing_types.*.rules.*.price',

            'day_of_week' => 'required|array|min:1',
            'day_of_week.*' => 'in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',

            'start_time' => 'required',
            'end_time' => 'required',

            'off_dates' => 'nullable|string',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        DB::beginTransaction();

        try {

            /* =========================
           TIME FORMAT
        ========================= */
            $start = date('H:i:s', strtotime($request->start_time));
            $end   = date('H:i:s', strtotime($request->end_time));

            /* =========================
           SLUG (🔥 FIXED)
        ========================= */
            $slug = Str::slug($request->name);

            $originalSlug = $slug;
            $counter = 1;

            while (
                Service::where('slug', $slug)
                ->where('id', '!=', $service->id)
                ->exists()
            ) {
                $slug = $originalSlug . '-' . $counter++;
            }

            /* =========================
           IMAGE UPDATE
        ========================= */
            if ($request->hasFile('image')) {

                // delete old image
                if ($service->image && file_exists(public_path($service->image))) {
                    unlink(public_path($service->image));
                }

                $image = $request->file('image');
                $imageName = 'service_' . time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('backAssets/images/services'), $imageName);

                $service->image = 'backAssets/images/services/' . $imageName;
            }

            /* =========================
           UPDATE SERVICE
        ========================= */
            $service->update([
                'name' => $request->name,
                'service_type' => $request->service_type,
                'slug' => $slug, // 🔥 UPDATED
                'district_id' => $request->district_id,
                'upazila_id' => $request->upazila_id,
                'union_id' => $request->union_id,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'company_id' => $request->company_id,
                'location' => $request->location,
                'status' => $request->status,
            ]);

            /* =========================
           DELETE OLD PRICING
        ========================= */
            $existingPricingIds = [];

            foreach ($request->pricing_types as $pricing) {

                // =========================
                // UPDATE OR CREATE PRICING
                // =========================
                $pricingModel = ServicePricing::updateOrCreate(
                    [
                        'id' => $pricing['id'] ?? null,
                        'service_id' => $service->id
                    ],
                    [
                        'pricing_type' => $pricing['type'] ?? null,
                        'price' => $pricing['price'] ?? null,
                        'sale_price' => $pricing['sale_price'] ?? null,
                        'qty' => $pricing['qty'] ?? null,
                        'time' => $pricing['time'] ?? null,
                        'label' => $pricing['label'] ?? null,
                    ]
                );

                $existingPricingIds[] = $pricingModel->id;

                // =========================
                // RULES
                // =========================
                $existingRuleIds = [];

                if (!empty($pricing['rules'])) {

                    foreach ($pricing['rules'] as $rule) {

                        $ruleModel = ServicePricingRule::updateOrCreate(
                            [
                                'id' => $rule['id'] ?? null,
                                'service_pricing_id' => $pricingModel->id
                            ],
                            [
                                'species_id' => $rule['species_id'] ?? null,
                                'breed_id' => $rule['breed_id'] ?? null,
                                'size_id' => $rule['size_id'] ?? null,
                                'price' => $rule['price'],
                                'sale_price' => $rule['sale_price'] ?? null,
                            ]
                        );

                        $existingRuleIds[] = $ruleModel->id;
                    }
                }

                // =========================
                // DELETE REMOVED RULES
                // =========================
                $pricingModel->rules()
                    ->whereNotIn('id', $existingRuleIds)
                    ->delete();
            }

            // =========================
            // DELETE REMOVED PRICINGS
            // =========================
            $service->pricings()
                ->whereNotIn('id', $existingPricingIds)
                ->delete();

            /* =========================
           UPDATE SCHEDULE
        ========================= */
            $days = implode(',', $request->day_of_week);

            $offDates = $request->off_dates
                ? implode(',', array_map('trim', explode(',', $request->off_dates)))
                : null;

            ServiceAvailability::updateOrCreate(
                ['service_id' => $service->id],
                [
                    'day_of_week' => $days,
                    'start_time' => $start,
                    'end_time' => $end,
                    'off_dates' => $offDates,
                ]
            );

            DB::commit();

            return response()->json([
                'message' => 'Service updated successfully!'
            ]);
        } catch (\Exception $e) {

            DB::rollback();

            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getUpazilas($district_id)
    {
        return Upazila::where('district_id', $district_id)
            ->select('id', 'name')
            ->get();
    }

    public function getUnions($upazila_id)
    {
        return Union::where('upazilla_id', $upazila_id)
            ->select('id', 'name')
            ->get();
    }

    public function getBreeds($species_id)
    {
        return Breed::where('species_id', $species_id)
            ->select('id', 'breed_name')
            ->get();
    }

    public function getSizes($breed_id)
    {
        return PetSize::where('breed_id', $breed_id)
            ->select('id', 'name')
            ->get();
    }
}
