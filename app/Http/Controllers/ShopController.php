<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Species;
use App\Models\ProductCategory;
use App\Models\ProductBrand;
use App\Models\Shipping;
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

        // Shippings
        $shippings = Shipping::where('status', 1)->get();


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

        return view(
            'frontEnd.shop',
            compact('products', 'species', 'categories', 'brands', 'shippings')
        );
    }


    public function singlePage($slug)
    {
        $product = Product::where('slug', $slug)
            ->where('is_visible', 1)
            ->firstOrFail();

        // Shippings
        $shippings = Shipping::where('status', 1)->get();

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_visible', 1)
            ->latest()
            ->take(8)
            ->get();

        return view('frontEnd.singlePage', compact('product', 'relatedProducts','shippings'));
    }

    public function addToCart(Request $request)
    {
        try {
            $request->validate([
                'slug'     => 'required|string',
                'quantity' => 'required|integer|min:1|max:100',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => collect($e->errors())->first()[0],
            ], 422);
        }

        $slug     = $request->input('slug');
        $quantity = (int) $request->input('quantity', 1);

        // ── Always get price from DB, never trust frontend ──
        $product = Product::where('slug', $slug)
            ->where('is_visible', 1)
            ->firstOrFail();

        $cart = session()->get('cart', []);

        if (isset($cart[$slug])) {
            $cart[$slug]['quantity'] += $quantity;
        } else {
            $cart[$slug] = [
                'slug'       => $slug,
                'product_id' => $product->id,
                'name'       => $product->product_name,  // ← correct field
                'price'      => (float) $product->selling_price,
                'image'      => $product->image,
                'quantity'   => $quantity,
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'cart'    => array_values($cart),
        ]);
    }

    public function updateCart(Request $request)
    {
        try {
            $request->validate([
                'slug'     => 'required|string',
                'quantity' => 'required|integer|min:1|max:100',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => collect($e->errors())->first()[0],
            ], 422);
        }

        $slug     = $request->input('slug');
        $quantity = (int) $request->input('quantity');

        $cart = session()->get('cart', []);

        if (isset($cart[$slug])) {
            $cart[$slug]['quantity'] = $quantity;
            session()->put('cart', $cart);
        }

        return response()->json([
            'success' => true,
            'cart'    => array_values($cart),
        ]);
    }

    public function removeFromCart(Request $request)
    {
        $request->validate([
            'slug' => 'required|string',
        ]);

        $slug = $request->input('slug');
        $cart = session()->get('cart', []);

        if (isset($cart[$slug])) {
            unset($cart[$slug]);
            session()->put('cart', $cart);
        }

        return response()->json([
            'success' => true,
            'cart'    => array_values($cart),
        ]);
    }

    public function clearCart()
    {
        session()->forget('cart');

        return response()->json([
            'success' => true
        ]);
    }
}
