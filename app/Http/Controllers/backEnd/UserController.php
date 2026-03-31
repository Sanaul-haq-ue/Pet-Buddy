<?php

namespace App\Http\Controllers\backEnd;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function customer()
    {
        return view('backEnd.customer', [
            'users' => User::paginate(10)
        ]);
    }
}
