<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Service;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::where('is_visible', 1)->get();
        $services = Service::where('is_published', 1)->get();
        $siteSetting = SiteSetting::first();
        return view('frontEnd.home',[
            'services' => $services,
            'products' => $products,
            'siteSetting' => $siteSetting
        ]);
    }
}
