<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // POST: /login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // attempt login with provided credentials
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return response()->json(['message' => 'Login successful!'], 200);
        }

        return response()->json(['message' => 'Login failed. No user found with these credentials.'], 401);
    }

    // POST: /logout
    public function logout(Request $request)
    {
        // end current session
        Auth::guard('web')->logout();
    
        // invalidate session and generate new CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return response()->json(['message' => 'Logout successful.'], 200);
    }
}
