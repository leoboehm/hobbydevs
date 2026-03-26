<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;


class ProjectApplicationController extends Controller
{
    // POST: /apply
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

        $application = Application::createApplication([
            ...$validatedData,
            'user_id' => $request->id,
            'project_id' => $request->project_id,
        ]);

        return response()->json($application, 201);
    }

    // GET: /sent-applications/{userId}
    public function getSentApplications(string $userId)
    {
        $applications = Application::findByUserId($userId);
        return response()->json($applications);
    }

    // GET /received-applications/{userId}
    public function getReceivedApplications(string $userId)
    {
        $applications = Application::findByOwnerId($userId);
        return response()->json($applications);
    }
}

