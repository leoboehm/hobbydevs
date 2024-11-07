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
        // Validate the request
        // validateRequestData($request);

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
        return response()->json(['message' => 'User registered successfully'], 201);;
    }

    private function validateRequestData(Request $request){
        $request->validate([
            'type' => 'required|string|max:255',
            'username' => 'required|string|min:3|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
    }
}
