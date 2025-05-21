<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function update(Request $request)
    {
        $user = User::find($request->id);
        
        $validated = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'skills' => '',
            'experience' => '',
            'bio' => '',
            'rating' => '',
            'interests' => ''
        ]);

        $user->update([
            "firstname" => $request->firstname,
            'lastname' => $request->lastname,
            'username' => $request->username,
            'skills' => json_encode($request->skills),
            'experience' => $request->experience,
            'bio' => $request->bio,
            'rating' => $request->rating,
            'interests' => $request->interests
        ]);

        return response()->json($user);
    }

    public function getDeveloperList(Request $request)
    {
        $developers = User::where('type', 'Developer')->get();
        
        $developersList = [];

        foreach ($developers as $developer) {
            array_push($developersList, $this->decodeSkills($developer));
        }

        return response()->json($developersList);
    }
    
    public function getDeveloperById(Request $request, string $id)
    {
        $developer = User::find($id);

        // Check if the user exists
        if (!$developer) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($this->decodeSkills($developer));
    }
    
    private function decodeSkills($userData) {
        $userData->skills = json_decode($userData->skills, true);
        return $userData;
    }
}
