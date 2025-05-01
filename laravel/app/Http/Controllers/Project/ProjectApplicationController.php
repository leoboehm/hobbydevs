<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;


class ProjectApplicationController extends Controller
{
    private const REQUIRED_STRING = 'required|string';
    
    public function postApplication(Request $request)
    {
        $validatedData = $request->validate([
            'firstName' => self::REQUIRED_STRING . '|max:255',
            'lastName' => self::REQUIRED_STRING . '|max:255',
            'skills' => 'required|array',
            'availability' => self::REQUIRED_STRING,
            'pastExperience' => self::REQUIRED_STRING,
            'motivation' => self::REQUIRED_STRING,
            'contactInfo' => self::REQUIRED_STRING,
        ]);

        $application = Application::create([
            'first_name' => $validatedData['firstName'],
            'last_name' => $validatedData['lastName'],
            'skills' => json_encode($validatedData['skills']), // Als JSON speichern
            'availability' => $validatedData['availability'],
            'past_experience' => $validatedData['pastExperience'],
            'motivation' => $validatedData['motivation'],
            'contact_info' => $validatedData['contactInfo'],
            'user_id'         => Auth::id(),
        ]);

        return response()->json($application, 201);
    }
    public function getSentApplications(Request $request)
{
    $user = Auth::user();
    $applications = Application::where('user_id', $user->id)->get();
    return response()->json($applications);
}

public function getReceivedApplications(Request $request)
{
    $user = Auth::user();
    $applications = Application::with('project')
        ->whereHas('project', function ($query) use ($user) {
            $query->where('owner_id', $user->id);
        })
        ->get();
    return response()->json($applications);
}
}