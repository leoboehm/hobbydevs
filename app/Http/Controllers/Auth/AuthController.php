<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return response()->json(['message' => 'Login successful!'], 200);
        }

        return response()->json(['message' => 'Login failed. Wrong credentials'], 401);
    }

    public function logout(Request $request)
    {
        // Aktuelle Sitzung des Nutzers beenden
        Auth::guard('web')->logout();
    
        // Session invalidieren und CSRF-Token neu generieren
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return response()->json(['message' => 'Logout successful.'], 200);
    }
}
