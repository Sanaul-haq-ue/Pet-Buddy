<?php

namespace App\Http\Controllers\backEnd;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Company;
use App\Models\District;
use App\Models\Service;
use App\Models\Species;
use App\Models\Union;
use App\Models\Upazila;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceMController extends Controller
{
    public function serviceManagement()
    {
        $categories = Category::paginate(3);
        return view('backEnd.pages.companyService.serviceManagement', compact('categories'));
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

        return view(
            'backEnd.pages.companyService.createServices',
            compact('categories', 'species', 'companies', 'districts', 'upazilas')
        );
    }

    public function saveService(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'service_name'  => 'required|string|max:255',
            'S_description' => 'required|string',

            'category_id' => 'required|array',
            'category_id.*' => 'exists:categories,id',

            'species_id' => 'nullable|array',
            'species_id.*' => 'exists:species,id',

            'company_id'    => 'nullable|exists:companies,id',
            'district_id'   => 'nullable|exists:districts,id',
            'upazila_id'    => 'nullable|exists:upazilas,id',
            'union_id'      => 'nullable|exists:unions,id',
            'location'      => 'nullable|string|max:255',
            'base_price'    => 'nullable|numeric|min:0',
            'timing'        => 'nullable|in:Hourly,Daily',
            'offer_price'   => 'nullable|numeric|min:0',
            'capacity'      => 'nullable|integer|min:1',
            'cover_image'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Handle cover image upload
        $coverImagePath = null;

        if ($request->hasFile('cover_image')) {

            $file = $request->file('cover_image');

            // unique filename
            $filename = 'service_' . uniqid() . '.' . $file->getClientOriginalExtension();

            // destination path (public folder)
            $destinationPath = public_path('backAssets/upload/serviceImage');

            // create folder if not exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // move file
            $file->move($destinationPath, $filename);

            // save path for DB
            $coverImagePath = 'backAssets/upload/serviceImage/' . $filename;
        }



        $slugBase = $request->service_name;

        if (!$slugBase) {
            return response()->json([
                'success' => false,
                'message' => 'Service name is required for slug generation'
            ], 422);
        }

        $slug = Str::slug($slugBase) . '-' . uniqid();

        // Create a new service
        $service = Service::create([
            'service_name'  => $request->service_name,
            'slug'          => $slug,
            'S_description' => $request->S_description,
            'category_id'   => json_encode($request->category_id),
            'species_id'    => json_encode($request->species_id),
            'company_id'    => $request->company_id   ?: null,
            'district_id'   => $request->district_id  ?: null,
            'upazila_id'    => $request->upazila_id   ?: null,
            'union_id'      => $request->union_id      ?: null,
            'location'      => $request->location,
            'base_price'    => $request->base_price,
            'timing'        => $request->timing ?? 'Hourly',
            'offer_price'   => $request->offer_price  ?: null,
            'capacity'      => $request->capacity,
            'cover_image'   => $coverImagePath,
            'is_published'  => $request->has('is_published') ? 1 : 0,
        ]);

        // Return a JSON response indicating success
        return response()->json([
            'success' => true,
            'message' => 'Service saved successfully!',
            'service' => $service,
        ]);
    }

    public function upazilasByDistrict($district_id)
    {
        $upazilas = Upazila::where('district_id', $district_id)
            ->orderBy('name')
            ->get(['id', 'name']);

        return response()->json($upazilas);
    }

    public function unionsByUpazila($upazila_id)
    {
        $unions = Union::where('upazilla_id', $upazila_id)
            ->orderBy('name')
            ->get(['id', 'name']);

        return response()->json($unions);
    }
}
