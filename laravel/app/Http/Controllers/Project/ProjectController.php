<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'skills' => json_encode($request->skills),
            'salary_range' => $request->salaryRange,
            'duration' => $request->duration,
            'start_date' => $request->startDate,
            'deadline' => $request->deadline,
            'application_start_date' => $request->applicationStartDate,
            'application_deadline' => $request->applicationDeadline,
            'owner_id' => auth()->id(),
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
        //
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
