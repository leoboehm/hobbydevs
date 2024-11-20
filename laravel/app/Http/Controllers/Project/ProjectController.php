<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function postProject(Request $request)
    {
        // Create the project
        Project::create([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'skills' => json_encode($request->skills),
            'salary_range' => $request->salaryRange,
            'start_date' => $request->startDate,
            'end_date' => $request->endDate
        ]);

        // Return success message
        return response()->json(['message' => 'Project published successfully'], 201);;
    }
}
