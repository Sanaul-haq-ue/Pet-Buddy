<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserDashbaord extends Controller
{
    public function dashboard()
    {
        return view('frontEnd.dashboard');
    }
}
