<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // POST: /user
    public function add(Request $request)
    {
        // Check if email is already in use
        if (User::where('email', $request->email)->exists()) {
            return response()->json(['message' => 'Email is already in use'], 400);
        }

        // Create user
        User::create([
            'email' => $request->email,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'password' => Hash::make($request->password),
            'type' => $request->type,
            'username' => $request->username,
        ]);

        return response()->json(['message' => 'User registered successfully'], 201);
    }

    // PUT: /user
    public function update(Request $request)
    {
        $user = User::find($request->id);

        $validated = $request->validate([
            "firstname" => "required|string|max:255",
            "lastname" => "required|string|max:255",
            "username" => "required|string|max:255",
        ]);

        $user->update([
            "firstname" => $validated['firstname'],
            'lastname' => $validated['lastname'],
            'username' => $validated['username'],
            'skills' => json_encode($request->skills),
            'experience' => $request->experience ?: '',
            'bio' => $request->bio ?: '',
            'rating' => $request->rating ?: $user->rating,
            'interests' => $request->interests ?: ''
        ]);

        return response()->json($user);
    }

    // GET: /developers
    public function getDeveloperList(Request $request)
    {
        $developers = User::where('type', 'Developer')->get();

        $developersList = [];

        foreach ($developers as $developer) {
            array_push($developersList, $this->decodeSkills($developer));
        }

        return response()->json($developersList);
    }

    // GET: /developers/{id}
    public function getDeveloperById(Request $request, string $id)
    {
        $developer = User::find($id);

        // Check if the user exists
        if (!$developer) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($this->decodeSkills($developer));
    }

    private function decodeSkills($userData)
    {
        $userData->skills = json_decode($userData->skills, true) ?: [];
        return $userData;
    }
}
