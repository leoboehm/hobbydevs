<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update($validated);


        return response()->json($user);
    }

    public function getDeveloperList(Request $request){
        $developers = User::where('type', 'Developer')->get();
        return response()->json($developers);
    }
    public function getDeveloperById(Request $request, string $id){
        $developer = User::find($id);
        
        // Check if the user exists
        if (!$developer) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($developer);
    }
}
