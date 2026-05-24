<?php

namespace App\Http\Controllers\backEnd;

use App\Models\ProductBrand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductBrandController extends Controller
{
    public function productBrandIndex(Request $request)
    {
        $query = ProductBrand::query();

        $status = $request->input('status', '1'); // Default to Active (1)

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $ProductBrands = $query->get();

        return view(
            'backEnd.pages.product.productBrand',
            compact('ProductBrands')
        );
    }



    public function store(Request $request)
    {
        $request->validate([
            'productBrand_name' => 'required|string|max:255|unique:product_brands,productBrand_name',
            'status' => 'required|in:0,1',
        ], [
            'productBrand_name.required' => 'Product brand name is required.',
            'productBrand_name.unique' => 'This product brand name already exists.',
            'status.required' => 'Status is required.',
        ]);

        $brand = new ProductBrand();
        $brand->productBrand_name = $request->productBrand_name;
        $brand->status = $request->status;

        if ($brand->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Product brand saved successfully.'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Failed to save product brand.'
        ], 500);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:product_brands,id',
            'productBrand_name' => 'required|string|max:255|unique:product_brands,productBrand_name,' . $request->id,
            'status' => 'required|in:0,1',
        ], [
            'productBrand_name.required' => 'Product brand name is required.',
            'productBrand_name.unique' => 'This product brand name already exists.',
            'status.required' => 'Status is required.',
        ]);

        $brand = ProductBrand::findOrFail($request->id);
        $brand->productBrand_name = $request->productBrand_name;
        $brand->status = $request->status;

        if ($brand->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Product brand updated successfully.'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Failed to update product brand.'
        ], 500);
    }

    public function destroy($id)
    {
        $brand = ProductBrand::find($id);

        if (!$brand) {
            return response()->json([
                'success' => false,
                'message' => 'Product brand not found.'
            ], 404);
        }

        $brand->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product brand deleted successfully.'
        ]);
    }
}
