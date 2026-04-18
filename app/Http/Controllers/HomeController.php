<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::where('status', 1)->get();
        return view('frontEnd.home',[
            'services' => $services
        ]);
    }
}
