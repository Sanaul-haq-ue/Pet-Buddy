<?php

namespace App\Http\Controllers\backEnd;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Company;
use Illuminate\Http\Request;

class ConpanyController extends Controller
{
    public function company(Request $request)
    {
        $query = Company::query();
        
        $status = $request->input('status', '1'); // Default to Active

        if ($status !== 'all') {
            $query->where('status', $status);
        }
        
        $companies = $query->paginate(7)->appends($request->query());
        $categories = Category::all();
        $services = Category::pluck('name', 'id');

        // Calculate service usage counts
        $allCompanies = Company::all();
        $serviceCounts = [];
        foreach ($categories as $category) {
            $serviceCounts[$category->id] = 0;
        }

        foreach ($allCompanies as $comp) {
            $compServices = json_decode($comp->services, true);
            if (is_array($compServices)) {
                foreach ($compServices as $sId) {
                    if (isset($serviceCounts[$sId])) {
                        $serviceCounts[$sId]++;
                    }
                }
            }
        }

        return view(
            'backEnd.pages.companyService.company',
            compact('companies', 'categories', 'services', 'serviceCounts')
        );
    }

    public function saveCompany(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'brand_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'business_card' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'services' => 'nullable|array',
            'status' => 'required|boolean',
            'address' => 'nullable|string',
            'location' => 'nullable|string',
            'phone1' => 'required|string|max:20',
            'phone2' => 'nullable|string|max:20',
            'email' => 'required|email|max:255|unique:companies,email',
        ]);

        $company = new Company();
        $company->company_name = $request->company_name;
        $company->status = $request->status;
        $company->email = $request->email;
        $company->address = $request->address;
        $company->location = $request->location;
        $company->phone1 = $request->phone1;
        $company->phone2 = $request->phone2;

        if ($request->hasFile('brand_logo')) {
            $image = $request->file('brand_logo');
            $imageName = time() . '_logo.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('backAssets/upload/Company Image');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $image->move($destinationPath, $imageName);
            $company->brand_logo = 'backAssets/upload/Company Image/' . $imageName;
        }

        if ($request->hasFile('business_card')) {
            $image = $request->file('business_card');
            $imageName = time() . '_card.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('backAssets/upload/Company Image');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $image->move($destinationPath, $imageName);
            $company->business_card = 'backAssets/upload/Company Image/' . $imageName;
        }

        if ($request->has('services')) {
            $company->services = json_encode($request->services);
        }

        if ($company->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Company created successfully.'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Failed to create company.'
        ], 500);
    }

    
    public function updateCompany(Request $request)
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id',
            'company_name' => 'required|string|max:255',
            'brand_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'business_card' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'services' => 'nullable|array',
            'status' => 'required|boolean',
            'address' => 'nullable|string',
            'location' => 'nullable|string',
            'phone1' => 'required|string|max:20',
            'phone2' => 'nullable|string|max:20',
            'email' => 'required|email|max:255|unique:companies,email,' . $request->company_id,
        ]);

        $company = Company::findOrFail($request->company_id);
        $company->company_name = $request->company_name;
        $company->status = $request->status;
        $company->email = $request->email;
        $company->address = $request->address;
        $company->location = $request->location;
        $company->phone1 = $request->phone1;
        $company->phone2 = $request->phone2;

        if ($request->hasFile('brand_logo')) {
            // Delete old image if needed
            if ($company->brand_logo && file_exists(public_path($company->brand_logo))) {
                unlink(public_path($company->brand_logo));
            }
            $image = $request->file('brand_logo');
            $imageName = time() . '_logo.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('backAssets/upload/Company Image');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $image->move($destinationPath, $imageName);
            $company->brand_logo = 'backAssets/upload/Company Image/' . $imageName;
        }

        if ($request->hasFile('business_card')) {
            // Delete old image if needed
            if ($company->business_card && file_exists(public_path($company->business_card))) {
                unlink(public_path($company->business_card));
            }
            $image = $request->file('business_card');
            $imageName = time() . '_card.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('backAssets/upload/Company Image');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $image->move($destinationPath, $imageName);
            $company->business_card = 'backAssets/upload/Company Image/' . $imageName;
        }

        if ($request->has('services')) {
            $company->services = json_encode($request->services);
        } else {
            $company->services = null;
        }

        if ($company->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Company updated successfully.'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Failed to update company.'
        ], 500);
    }
}
