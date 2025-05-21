<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;

class ProjectController extends Controller
{
    private const REQUIRED_STRING = 'required|string';
    private const REQUIRED_DATE = 'required|date';

    /**
     * Route: GET /project
     * Display a listing of projects.
     */
    public function index()
    {
        $projects = Project::all();

        $projectsList = [];

        foreach ($projects as $project) {
            array_push($projectsList, $this->decodeSkills($project));
        }

        return response()->json($projectsList);
    }

    /**
     * Route: POST /project
     * Store a newly created project in storage.
     */
    public function store(Request $request)
    {
        Project::create([
            'owner_id' => $request->id,
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'skills' => json_encode($request->skills),
            'salary_range' => $request->salary_range,
            'duration' => $request->duration,
            'start_date' => $request->start_date,
            'deadline' => $request->deadline,
            'application_start_date' => $request->application_start_date,
            'application_deadline' => $request->application_deadline,
        ]);

        return response()->json(['message' => 'Project published successfully'], 201);
    }

    /**
     * Route: GET /project/{id}
     * Return project by ID
     */
    public function show(string $id)
    {
        $project = Project::find($id);

        // Check if the project exists
        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }

        return response()->json($this->decodeSkills($project));
    }

    /**
     * Route: PUT/PATCH /project/{id}
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $project = Project::find($id);
    
        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }
    
        $validated = $request->validate([
            'title' => self::REQUIRED_STRING . '|max:255',
            'description' => self::REQUIRED_STRING,
            'category' => self::REQUIRED_STRING,
            'skills' => self::REQUIRED_STRING,
            'salary_range' => self::REQUIRED_STRING,
            'duration' => self::REQUIRED_STRING,
            'start_date' => self::REQUIRED_DATE,
            'deadline' => self::REQUIRED_DATE,
            'application_start_date' => self::REQUIRED_DATE,
            'application_deadline' => self::REQUIRED_DATE,
        ]);
    
        $project->update($validated);
    
        return response()->json(['message' => 'Project updated successfully'], 200);
    }
    
    
    /**
     * Route: DELETE /project/{id}
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    private function decodeSkills($projectData) {
        $projectData->skills = json_decode($projectData->skills, true) ?: [];
        return $projectData;
    }
}
