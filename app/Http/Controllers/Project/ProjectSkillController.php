<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Skill;

class ProjectSkillController extends Controller
{
    /**
     * Route: GET /skill
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Skill::all());
    }

    /**
     * POST: /skill
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }

    /**
     * GET: /skill/{id}
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * PUT: /skill/{id}
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    }

    /**
     * DELETE: /skill/{id}
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    }
}
