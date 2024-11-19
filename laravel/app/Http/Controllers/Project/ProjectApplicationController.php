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
}