<?php

namespace App\Http\Controllers\backEnd;

use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\ProductUnit;
use App\Models\ProductBrand;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use App\Models\Species;
use App\Models\Breed;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function productIndex()
    {
        $products = Product::with(['brand', 'category', 'subCategory'])->get();
        $species = Species::all()->keyBy('id');
        $categories = ProductCategory::where('status', 1)->get();
        $brands = ProductBrand::where('status', 1)->get();

        return view(
            'backEnd.pages.product.product',
            compact('products', 'species', 'categories', 'brands')
        );
    }

    public function productAdd()
    {
        $units = ProductUnit::where('status', 1)->get();
        $brands = ProductBrand::where('status', 1)->get();
        $categories = ProductCategory::where('status', 1)->get();
        $subCategories = ProductSubCategory::where('status', 1)->get();
        $species = Species::where('status', 1)->get();
        $breeds = Breed::where('status', 1)->get();

        return view(
            'backEnd.pages.product.addProduct',
            compact('units', 'brands', 'categories', 'subCategories', 'species', 'breeds')
        );
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|string|max:255',
            'brand_id' => 'required|exists:product_brands,id',
            'category_id' => 'required|exists:product_categories,id',
            'sub_category_id' => 'nullable|exists:product_sub_categories,id',
            'description' => 'nullable|string',
            'species_ids' => 'nullable|array',
            'species_ids.*' => 'exists:species,id',
            'regular_price' => 'nullable|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'buying_price' => 'nullable|numeric|min:0',
            'unit' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'sku_id' => 'nullable|string|unique:products,sku_id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'is_visible' => 'nullable|in:0,1',
            'detail_title' => 'nullable|array',
            'detail_title.*' => 'nullable|string|max:255',
            'detail_description' => 'nullable|array',
            'detail_description.*' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            $productData = $request->only([
                'product_name',
                'brand_id',
                'category_id',
                'sub_category_id',
                'description',
                'regular_price',
                'selling_price',
                'buying_price',
                'unit',
                'quantity',
                'sku_id',
            ]);

            $productData['is_visible'] = $request->input('is_visible', 0);
            $productData['species_ids'] = $request->input('species_ids', []);

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = 'product_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('backAssets/upload/Product');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }
                $file->move($destinationPath, $filename);
                $productData['image'] = 'backAssets/upload/Product/' . $filename;
            }

            $productData['slug'] = 'product-' . uniqid();

            $product = Product::create($productData);

            $detailTitles = $request->input('detail_title', []);
            $detailDescriptions = $request->input('detail_description', []);

            if (is_array($detailTitles)) {
                foreach ($detailTitles as $index => $title) {
                    if ($title !== null && trim($title) !== '') {
                        $product->details()->create([
                            'title' => $title,
                            'description' => $detailDescriptions[$index] ?? null,
                        ]);
                    }
                }
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Product saved successfully.'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Product save failed: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong.'
            ], 500);
        }
    }


    public function productEdit($slug)
    {
        $product = Product::with('details')->where('slug', $slug)->firstOrFail();
        $brands = ProductBrand::where('status', 1)->get();
        $categories = ProductCategory::where('status', 1)->get();
        $subCategories = ProductSubCategory::where('status', 1)->get();
        $species = Species::where('status', 1)->get();
        $breeds = Breed::where('status', 1)->get();

        return view(
            'backEnd.pages.product.editProduct',
            compact('product', 'brands', 'categories', 'subCategories', 'species', 'breeds')
        );
    }

    public function productUpdate(Request $request, $slug)
    {
        $product = Product::with('details')->where('slug', $slug)->firstOrFail();

        $validator = Validator::make($request->all(), [
            'product_name'          => 'required|string|max:255',
            'brand_id'              => 'required|exists:product_brands,id',
            'category_id'           => 'required|exists:product_categories,id',
            'sub_category_id'       => 'nullable|exists:product_sub_categories,id',
            'description'           => 'nullable|string',
            'species_ids'           => 'nullable|array',
            'species_ids.*'         => 'exists:species,id',
            'regular_price'         => 'nullable|numeric|min:0',
            'selling_price'         => 'required|numeric|min:0',
            'buying_price'          => 'nullable|numeric|min:0',
            'unit'                  => 'required|string|max:255',
            'quantity'              => 'required|integer|min:0',
            'sku_id'                => 'nullable|string|unique:products,sku_id,' . $product->id,
            'image'                 => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'is_visible'            => 'nullable|in:0,1',
            'detail_id'             => 'nullable|array',
            'detail_id.*'           => 'nullable|integer',
            'detail_title'          => 'nullable|array',
            'detail_title.*'        => 'nullable|string|max:255',
            'detail_description'    => 'nullable|array',
            'detail_description.*'  => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            // --- Core product fields ---
            $productData = $request->only([
                'product_name',
                'brand_id',
                'category_id',
                'sub_category_id',
                'description',
                'regular_price',
                'selling_price',
                'buying_price',
                'unit',
                'quantity',
                'sku_id',
            ]);

            $productData['is_visible'] = $request->input('is_visible', 0);
            $productData['species_ids'] = $request->input('species_ids', []);

            // --- Image handling ---
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($product->image && file_exists(public_path($product->image))) {
                    unlink(public_path($product->image));
                }

                $file            = $request->file('image');
                $filename        = 'product_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('backAssets/upload/Product');

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                $file->move($destinationPath, $filename);
                $productData['image'] = 'backAssets/upload/Product/' . $filename;
            }

            $product->update($productData);

            // --- Details sync ---
            $submittedIds    = array_filter($request->input('detail_id', []), fn($v) => !empty($v));
            $detailTitles    = $request->input('detail_title', []);
            $detailDescs     = $request->input('detail_description', []);

            // Delete rows that were removed from the form
            $product->details()
                ->whereNotIn('id', $submittedIds)
                ->delete();

            // Update existing rows / insert new rows
            foreach ($detailTitles as $index => $title) {
                if (empty(trim($title ?? ''))) {
                    continue;
                }

                $detailId = $submittedIds[$index] ?? null;

                if ($detailId) {
                    // Update existing detail
                    $product->details()->where('id', $detailId)->update([
                        'title'       => $title,
                        'description' => $detailDescs[$index] ?? null,
                    ]);
                } else {
                    // New detail row
                    $product->details()->create([
                        'title'       => $title,
                        'description' => $detailDescs[$index] ?? null,
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => 'Product updated successfully.'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Product update failed: ' . $e->getMessage());

            return response()->json([
                'status'  => false,
                'message' => 'Something went wrong.'
            ], 500);
        }
    }



    public function productDelete($slug)
    {
        try {
            $product = Product::where('slug', $slug)->firstOrFail();

            // Delete image if exists
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }

            // Delete related details first
            $product->details()->delete();

            // Delete product
            $product->delete();

            return response()->json([
                'status'  => true,
                'message' => 'Product deleted successfully.'
            ]);
        } catch (\Exception $e) {
            \Log::error('Product delete failed: ' . $e->getMessage());

            return response()->json([
                'status'  => false,
                'message' => 'Something went wrong.'
            ], 500);
        }
    }
}
