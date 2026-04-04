<?php

namespace App\Http\Controllers\backEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServiceManagementController extends Controller
{
    public function serviceManagement()
    {
        return view('backEnd.serviceManagement');
    }
}
