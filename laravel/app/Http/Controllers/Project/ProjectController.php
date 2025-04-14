<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Route: GET /project
     * Display a listing of projects.
     */
    public function index()
    {
        $projects = Project::all();

        return response()->json($projects);
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

        return response()->json($project);
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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'skills' => 'required|array',
            'salary_range' => 'required|string',
            'duration' => 'required|string',
            'start_date' => 'required|date',
            'deadline' => 'required|date',
            'application_start_date' => 'required|date',
            'application_deadline' => 'required|date',
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
    
}   
