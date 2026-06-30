<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::where('is_visible', 1)->get();
        $services = Service::where('status', 1)->get();
        return view('frontEnd.home',[
            'services' => $services,
            'products' => $products
        ]);
    }
}
