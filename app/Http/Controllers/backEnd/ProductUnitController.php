<?php

namespace App\Http\Controllers\backEnd;

use App\Models\ProductUnit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductUnitController extends Controller
{
    public function productUnitIndex(Request $request)
    {
        $query = ProductUnit::query();

        $status = $request->input('status', '1'); // Default to Active (1)

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $ProductUnits = $query->get();

        return view(
            'backEnd.pages.product.productUnit',
            compact('ProductUnits')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'productUnit_name' => 'required|string|max:255|unique:product_units,productUnit_name',
            'status' => 'required|in:0,1',
        ], [
            'productUnit_name.required' => 'Product unit name is required.',
            'productUnit_name.unique' => 'This product unit name already exists.',
            'status.required' => 'Status is required.',
        ]);

        $unit = new ProductUnit();
        $unit->productUnit_name = $request->productUnit_name;
        $unit->status = $request->status;

        if ($unit->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Product unit saved successfully.'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Failed to save product unit.'
        ], 500);
    }

    public function update(Request $request)
    {
        $request->validate([
            'productUnit_name' => 'required|string|max:255|unique:product_units,productUnit_name,' . $request->id,
            'status' => 'required|in:0,1',
        ], [
            'productUnit_name.required' => 'Product unit name is required.',
            'productUnit_name.unique' => 'This product unit name already exists.',
            'status.required' => 'Status is required.',
        ]);

        $unit = ProductUnit::findOrFail($request->id);
        $unit->productUnit_name = $request->productUnit_name;
        $unit->status = $request->status;

        if ($unit->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Product unit updated successfully.'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Failed to update product unit.'
        ], 500);
    }

    public function destroy($id)
    {
        $unit = ProductUnit::find($id);

        if (!$unit) {
            return response()->json([
                'success' => false,
                'message' => 'Product unit not found.'
            ], 404);
        }

        $unit->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product unit deleted successfully.'
        ]);
    }
}
