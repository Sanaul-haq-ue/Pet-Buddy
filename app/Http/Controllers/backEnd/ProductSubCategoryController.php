<?php

namespace App\Http\Controllers\backEnd;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use Illuminate\Http\Request;

class ProductSubCategoryController extends Controller
{
    public function productSubCategoryIndex(Request $request)
    {
        $query = ProductSubCategory::with('productCategory');

        $status = $request->input('status', '1');

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $ProductSubCategories = $query->get();
        $productCategories = ProductCategory::where('status', 1)->get();

        return view(
            'backEnd.pages.product.productSubCategory',
            compact('ProductSubCategories', 'productCategories')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'productSubCategory_name' => 'required|string|max:255|unique:product_sub_categories,productSubCategory_name',
            'productCategory_id'      => 'required|exists:product_categories,id',
            'status'                  => 'required|in:0,1',
        ], [
            'productSubCategory_name.required' => 'Product sub-category name is required.',
            'productSubCategory_name.unique'   => 'This sub-category name already exists.',
            'productCategory_id.required'      => 'Please select a category.',
            'productCategory_id.exists'        => 'Selected category is invalid.',
            'status.required'                  => 'Status is required.',
        ]);

        $subCategory = new ProductSubCategory();
        $subCategory->productSubCategory_name = $request->productSubCategory_name;
        $subCategory->productCategory_id      = $request->productCategory_id;
        $subCategory->status                  = $request->status;

        if ($subCategory->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Product sub-category saved successfully.',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Failed to save product sub-category.',
        ], 500);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id'                      => 'required|exists:product_sub_categories,id',
            'productSubCategory_name' => 'required|string|max:255|unique:product_sub_categories,productSubCategory_name,' . $request->id,
            'productCategory_id'      => 'required|exists:product_categories,id',
            'status'                  => 'required|in:0,1',
        ], [
            'productSubCategory_name.required' => 'Product sub-category name is required.',
            'productSubCategory_name.unique'   => 'This sub-category name already exists.',
            'productCategory_id.required'      => 'Please select a category.',
            'productCategory_id.exists'        => 'Selected category is invalid.',
            'status.required'                  => 'Status is required.',
        ]);

        $subCategory = ProductSubCategory::findOrFail($request->id);
        $subCategory->productSubCategory_name = $request->productSubCategory_name;
        $subCategory->productCategory_id      = $request->productCategory_id;
        $subCategory->status                  = $request->status;

        if ($subCategory->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Product sub-category updated successfully.',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Failed to update product sub-category.',
        ], 500);
    }

    public function destroy($id)
    {
        $subCategory = ProductSubCategory::find($id);

        if (!$subCategory) {
            return response()->json([
                'success' => false,
                'message' => 'Product sub-category not found.',
            ], 404);
        }

        $subCategory->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product sub-category deleted successfully.',
        ]);
    }
}
