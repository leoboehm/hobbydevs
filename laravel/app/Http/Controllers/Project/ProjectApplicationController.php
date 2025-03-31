<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;

class ProjectApplicationController extends Controller
{
    public function postApplication(Request $request)
    {
        $validatedData = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'skills' => 'required|array',
            'availability' => 'required|string',
            'pastExperience' => 'required|string',
            'motivation' => 'required|string',
            'contactInfo' => 'required|string',
        ]);

        $application = Application::create([
            'first_name' => $validatedData['firstName'],
            'last_name' => $validatedData['lastName'],
            'skills' => json_encode($validatedData['skills']), // Als JSON speichern
            'availability' => $validatedData['availability'],
            'past_experience' => $validatedData['pastExperience'],
            'motivation' => $validatedData['motivation'],
            'contact_info' => $validatedData['contactInfo'],
        ]);

        return response()->json($application, 201);
    }
    //added this function to get all applications linked to the user
    public function getSentApplications(Request $request)
{
    $user = Auth::user();  // Get the authenticated user

    // Fetch all applications that are linked to this user
    $applications = Application::where('user_id', $user->id)->get();

    return response()->json($applications);
}

public function getReceivedApplications(Request $request)
{
    $user = $request->user(); // logged-in user (project owner)

    // Get applications where the project belongs to the current user
    $applications = \App\Models\Application::with(['user', 'project'])
        ->whereHas('project', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->orderBy('created_at', 'desc')
        ->get();

    return response()->json($applications);
}


}