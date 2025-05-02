<?php

namespace Tests\Unit;

use App\Models\Application;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApplicationTest extends TestCase
{
    use RefreshDatabase;

    protected function validApplicationData($overrides = [])
    {
        $user = User::factory()->create();
        $project = Project::factory()->create([
            'owner_id' => $user->id,
        ]);

        return array_merge([
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'skills' => json_encode(['Laravel', 'Vue.js']),
            'availability' => 'Part-time',
            'past_experience' => 'Worked on multiple web applications.',
            'motivation' => 'I am passionate about web development.',
            'contact_info' => 'jane@example.com',
            'user_id' => $user->id,
            'project_id' => $project->id,
            'status' => 'pending',
        ], $overrides);
    }

    public function test_application_can_be_created_with_valid_data()
    {
        $data = $this->validApplicationData();

        $application = Application::create($data);

        $this->assertDatabaseHas('applications', [
            'id' => $application->id,
            'first_name' => 'Jane',
            'status' => 'pending',
        ]);
    }

    public function test_application_belongs_to_user_and_project()
    {
        $data = $this->validApplicationData();
        $application = Application::create($data);

        $this->assertInstanceOf(User::class, $application->user);
        $this->assertInstanceOf(Project::class, $application->project);
    }
}
