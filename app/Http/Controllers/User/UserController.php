<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // POST: /user
    public function add(Request $request)
    {
        if (User::emailExists($request->email)) {
            return response()->json(['message' => 'Email is already in use'], 400);
        }

        User::create([
            'email' => $request->email,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'password' => $request->password,
            'type' => $request->type,
            'username' => $request->username,
        ]);

        return response()->json(['message' => 'User registered successfully'], 201);
    }

    // PUT: /user
    public function update(Request $request)
    {
        $user = User::find($request->id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $validated = $request->validate([
            "firstname" => "required|string|max:255",
            "lastname" => "required|string|max:255",
            "username" => "required|string|max:255",
        ]);

        $user->updateProfile([
            ...$validated,
            'skills' => $request->skills,
            'experience' => $request->experience,
            'bio' => $request->bio,
            'rating' => $request->rating,
            'interests' => $request->interests
        ]);

        return response()->json($user);
    }

    // GET: /user/{id}
    public function getUserById(Request $request, string $id)
    {
        $developer = User::find($id);

        // Check if the user exists
        if (!$developer) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($developer);
    }

    // GET: /developers
    public function getDeveloperList(Request $request)
    {
        $developers = User::where('type', 'Developer')->get();

        return response()->json($developers);
    }
}
