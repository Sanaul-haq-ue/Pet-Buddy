<?php

namespace App\Http\Controllers\backEnd;

use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function productCategoryIndex(Request $request)
    {
        $query = ProductCategory::query();

        $status = $request->input('status', '1'); // Default to Active (1)

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $ProductCategories = $query->get();

        return view(
            'backEnd.pages.product.productCategory',
            compact('ProductCategories')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'productCategory_name' => 'required|string|max:255|unique:product_categories,productCategory_name',
            'status' => 'required|in:0,1',
        ], [
            'productCategory_name.required' => 'Product category name is required.',
            'productCategory_name.unique' => 'This product category name already exists.',
            'status.required' => 'Status is required.',
        ]);

        $category = new ProductCategory();
        $category->productCategory_name = $request->productCategory_name;
        $category->status = $request->status;

        if ($category->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Product category saved successfully.'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Failed to save product category.'
        ], 500);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:product_categories,id',
            'productCategory_name' => 'required|string|max:255|unique:product_categories,productCategory_name,' . $request->id,
            'status' => 'required|in:0,1',
        ], [
            'productCategory_name.required' => 'Product category name is required.',
            'productCategory_name.unique' => 'This product category name already exists.',
            'status.required' => 'Status is required.',
        ]);

        $category = ProductCategory::findOrFail($request->id);
        $category->productCategory_name = $request->productCategory_name;
        $category->status = $request->status;

        if ($category->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Product category updated successfully.'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Failed to update product category.'
        ], 500);
    }

    public function destroy($id)
    {
        $category = ProductCategory::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Product category not found.'
            ], 404);
        }

        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product category deleted successfully.'
        ]);
    }
}

