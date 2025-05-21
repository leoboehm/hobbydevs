<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;


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
            'user_id' => $request->id,
            'project_id' => $request->project_id,
        ]);

        return response()->json($application, 201);
    }
    public function getSentApplications(string $userId)
    {
        $applications = Application::where('user_id', $userId)->get();
        return response()->json($applications);
    }

    public function getReceivedApplications(string $userId)
    {
        $applications = Application::with('project')->whereHas('project', function ($query) use ($userId) {
            $query->where('owner_id', $userId);
        })->get();
        return response()->json($applications);
    }
}

