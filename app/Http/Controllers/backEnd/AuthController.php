<?php

namespace App\Http\Controllers\backEnd;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('backEnd.auth.login');
    }

    public function loginSubmit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Step 1: Check email
        $admin = Admin::where('email', $request->email)->first();

        if (!$admin) {
            return back()->withErrors([
                'email' => 'Email not found'
            ])->withInput();
        }

        // Step 2: Check password
        if (!Hash::check($request->password, $admin->password)) {
            return back()->withErrors([
                'password' => 'Incorrect password'
            ])->withInput();
        }

        // Step 3: Success
        session(['admin' => $admin->id]);

        return redirect()->route('dashboard');
    }

    public function logout()
    {
        session()->forget('admin');
        return redirect()->route('admin.login');
    }
}
