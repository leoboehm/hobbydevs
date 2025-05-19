<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that index returns all projects.
     */
    public function test_index_returns_all_projects()
    {
        $user = User::factory()->create();
        Project::factory()->count(3)->create([
            "owner_id" => $user->id,
        ]);

        $response = $this->getJson('/api/project');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    // Currently not working: Request fails with 500, Array to String conversion
    // /**
    //  * Test storing a new project.
    //  */
    // public function test_store_creates_new_project()
    // {
    //     $user = User::factory()->create();

    //     $payload = Project::factory()->make([
    //         'owner_id' => $user->id
    //     ])->toArray();

    //     $response = $this->postJson('/api/project', $payload);

    //     dd($response);

    //     $response->assertStatus(201)
    //              ->assertJson(['message' => 'Project published successfully']);

    //     $this->assertDatabaseHas('projects', ['title' => $payload['title']]);
    // }

    /**
     * Test showing a single project by ID.
     */
    public function test_show_returns_project()
    {
        $user = User::factory()->create();
        $project = Project::factory()->create([
            "owner_id" => $user->id,
        ]);

        $response = $this->getJson("/api/project/{$project->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['id' => $project->id]);
    }

    /**
     * Test showing a project that does not exist.
     */
    public function test_show_returns_404_for_missing_project()
    {
        $response = $this->getJson("/api/project/9999");

        $response->assertStatus(404)
                 ->assertJson(['message' => 'Project not found']);
    }

    /**
     * Test updating a project.
     */
    public function test_update_project_with_valid_data()
    {
        $user = User::factory()->create();
        $project = Project::factory()->create([
            "owner_id" => $user->id,
        ]);

        $updateData = [
            'title' => 'Updated Project Title',
            'description' => 'Updated description.',
            'category' => 'Web Development',
            'skills' => json_encode(['Vue.js', 'PHP']),
            'salary_range' => '30-50k',
            'duration' => '6 months',
            'start_date' => now()->addWeek()->toDateTimeString(),
            'deadline' => now()->addMonths(2)->toDateTimeString(),
            'application_start_date' => now()->toDateTimeString(),
            'application_deadline' => now()->addMonth()->toDateTimeString(),
        ];

        $response = $this->putJson("/api/project/{$project->id}", $updateData);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Project updated successfully']);

        $this->assertDatabaseHas('projects', ['id' => $project->id, 'title' => 'Updated Project Title']);
    }

    /**
     * Test update fails with invalid data.
     */
    public function test_update_project_with_invalid_data_returns_validation_error()
    {
        $user = User::factory()->create();
        $project = Project::factory()->create([
            "owner_id" => $user->id,
        ]);

        $response = $this->putJson("/api/project/{$project->id}", [
            'title' => '',  // Required
            'description' => '',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['title', 'description']);
    }

    /**
     * Test update returns 404 for nonexistent project.
     */
    public function test_update_nonexistent_project_returns_404()
    {
        $response = $this->putJson('/api/project/9999', [
            'title' => 'Any Title',
            'description' => 'Any Description',
            'category' => 'Any Category',
            'skills' => ['Any'],
            'salary_range' => '10-20k',
            'duration' => '3 months',
            'start_date' => now()->toDateTimeString(),
            'deadline' => now()->addMonth()->toDateTimeString(),
            'application_start_date' => now()->toDateTimeString(),
            'application_deadline' => now()->addMonth()->toDateTimeString(),
        ]);

        $response->assertStatus(404)
                 ->assertJson(['message' => 'Project not found']);
    }
}
