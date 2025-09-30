<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    public function register(Request $request)
    {
        // Check if the email is already in use
        if (User::where('email', $request->email)->exists()) {
            return response()->json(['message' => 'Email is already in use'], 400);
        }

        // Create the user
        User::create([
            'email' => $request->email,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'password' => Hash::make($request->password),
            'type' => $request->type,
            'username' => $request->username,
        ]);

        // Return success message
        return response()->json(['message' => 'User registered successfully'], 201);
    }
}
