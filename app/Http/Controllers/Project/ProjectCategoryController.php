<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;

class ProjectCategoryController extends Controller
{
    /**
     * Route: GET /category
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Category::all());
    }

    /**
     * POST: /category
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }

    /**
     * GET /category/{id}
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * PUT /category/{id}
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    }

    /**
     * DELETE /category/{id}
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    }
}
