<?php

namespace App\Http\Controllers;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $siteSetting = SiteSetting::first();

        return view('frontEnd.contact',compact('siteSetting'));
    }
}
