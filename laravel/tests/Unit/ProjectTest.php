<?php

namespace Tests\Unit;

use App\Models\Project;
use App\Models\Application;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;

use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_create_a_project_with_valid_data()
    {
        $user = User::factory()->create(); // create user

        // create project
        $project = Project::factory()->create([
            'owner_id' => $user->id,
        ]);

        // return true if database has the correct data
        $this->assertDatabaseHas('projects', [
            'id' => $project->id,
            'owner_id' => $user->id,
            'title' => $project->title,
        ]);
    }

    public function test_it_uses_mass_assignment_correctly()
    {
        $user = User::factory()->create(); // create user

        $data = [
            'owner_id' => $user->id,
            'title' => 'Test Project',
            'description' => 'This is a test description.',
            'category' => 'Web Development',
            'skills' => json_encode(['PHP', 'Vue.js']),
            'salary_range' => '30-50k',
            'duration' => '6 months',
            'start_date' => now()->addWeek(),
            'deadline' => now()->addMonths(2),
            'application_start_date' => now()->subDays(10),
            'application_deadline' => now()->addDays(20),
        ];

        $project = Project::create($data); // create project with assigned data

        $this->assertEquals('Test Project', $project->title); // return true if title is set correctly
        $this->assertEquals('Web Development', $project->category); // return true if category is set correctly
    }
    
    /** @test */
    public function it_casts_date_attributes_to_datetime()
    {
        $user = User::factory()->create();
        $project = Project::factory()->create([
            'owner_id' => $user->id,
            'start_date' => now(),
            'deadline' => now()->addDays(10),
            'application_start_date' => now()->subWeek(),
            'application_deadline' => now()->addWeek(),
        ]);

        $this->assertInstanceOf(Carbon::class, $project->start_date);
        $this->assertInstanceOf(Carbon::class, $project->deadline);
        $this->assertInstanceOf(Carbon::class, $project->application_start_date);
        $this->assertInstanceOf(Carbon::class, $project->application_deadline);
    }

    /** @test */
    public function it_has_many_applications()
    {
        $user = User::factory()->create();
        $project = Project::factory()->create([
            'owner_id' => $user->id,
        ]);
        Application::factory()->count(3)->create(['project_id' => $project->id]);

        $this->assertInstanceOf(Application::class, $project->applications->first());
        $this->assertCount(3, $project->applications);
    }

    /** @test */
    public function it_belongs_to_an_owner()
    {
        $user = User::factory()->create();
        $project = Project::factory()->create(['owner_id' => $user->id]);

        $this->assertEquals($user->id, $project->owner_id);
    }
}