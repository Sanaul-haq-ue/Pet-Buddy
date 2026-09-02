<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserAuthController extends Controller
{
    public function loginSubmit(Request $request)
    {
        if(auth()->check()) {
            return redirect()->route('user.dashboard');
        }

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $credentials = $request->only('email', 'password');

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'errors' => [
                    'email' => ['User not found!']
                ]
            ], 401);
        }

        if ($user->status == 0) {
            return response()->json([
                'success' => false,
                'errors' => ['email' => ['Your account has been blocked. Please contact our support team.']]
            ], 401);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'errors' => [
                    'password' => ['Password is incorrect.']
                ]
            ], 401);
        }

        // Login the user
        Auth::login($user);

        return response()->json([
            'success' => true,
            'message' => 'Login successful!',
            'redirect' => route('user.dashboard')
        ]);
    }

    public function registerSubmit(Request $request)
    {
        if (auth()->check()) {
            return redirect()->route('user.dashboard');
        }

        // Format mobile FIRST
        $mobile = trim($request->mobile);

        if (strpos($mobile, '+') === 0) {
            $mobile = substr($mobile, 1);
        }

        if (strpos($mobile, '880') === 0) {
            // ok
        } elseif (strpos($mobile, '0') === 0) {
            $mobile = '88' . substr($mobile, 1);
        } else {
            $mobile = '880' . $mobile;
        }

        $request->merge(['mobile' => $mobile]);

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'mobile' => ['required', 'regex:/^8801[3-9]\d{8}$/', 'unique:users,mobile'],
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'password' => Hash::make($request->password),
                'status' => 1,
            ]);

            Auth::login($user);
            $request->session()->regenerate();

            return response()->json([
                'success' => true,
                'message' => 'Registration successful! Welcome to Pet Buddy.',
                'redirect' => route('user.dashboard')
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again.'
            ], 500);
        }
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}