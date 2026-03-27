<?php

namespace App\Http\Controllers\backEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view('backEnd.dashboard');
    }

    public function appointment(){
        return view('backEnd.appointment');
    }

    public function customer(){
        return view('backEnd.customer');
    }

    public function inventory(){
        return view('backEnd.inventory');
    }

}
