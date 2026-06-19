<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Species;
use App\Models\ProductCategory;
use App\Models\ProductBrand;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::where('is_visible', 1);

        // Species
        if ($request->filled('species')) {
            $products->where(function ($query) use ($request) {
                foreach ($request->species as $id) {
                    $query->orWhereJsonContains('species_ids', (string) $id);
                }
            });
        }

        // Category
        if ($request->filled('category')) {
            $products->whereIn('category_id', $request->category);
        }

        // Brand
        if ($request->filled('brand')) {
            $products->whereIn('brand_id', $request->brand);
        }

        // SORT
        if ($request->sort == 'low_high') {
            $products->orderBy('selling_price', 'asc');
        } elseif ($request->sort == 'high_low') {
            $products->orderBy('selling_price', 'desc');
        }

        // PAGINATION SIZE
        $perPage = $request->show ?? 12;

        $products = $products->paginate($perPage)->withQueryString();
        $species = Species::where('status', 1)->get();
        $categories = ProductCategory::where('status', 1)->get();
        $brands = ProductBrand::where('status', 1)->get();

        return view('frontEnd.shop', compact(
            'products',
            'species',
            'categories',
            'brands'
        ));
    }


    public function singlePage($slug)
    {
        $product = Product::where('slug', $slug)
            ->where('is_visible', 1)
            ->firstOrFail();

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_visible', 1)
            ->latest()
            ->take(8)
            ->get();

        return view('frontEnd.singlePage', compact('product', 'relatedProducts'));
    }
}
