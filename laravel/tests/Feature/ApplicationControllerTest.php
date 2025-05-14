<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Project;
use App\Models\Application;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApplicationControllerTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function user_can_post_application()
    {
        $user = User::factory()->create();
        $project = Project::factory()->create([
            "owner_id" => $user->id,
        ]);

        $this->actingAs($user);

        $payload = [
            'firstName' => 'Max',
            'lastName' => 'Mustermann',
            'skills' => ['PHP', 'Laravel'],
            'availability' => 'Full-time',
            'pastExperience' => '2 years of web development',
            'motivation' => 'Looking for new challenges',
            'contactInfo' => 'max@example.com',
            'id' => $user->id,
            'project_id' => $project->id,
        ];

        $response = $this->postJson('/api/apply', $payload);

        $response->assertStatus(201);
        $this->assertDatabaseHas('applications', [
            'first_name' => 'Max',
            'last_name' => 'Mustermann',
            'user_id' => $user->id,
        ]);
    }

    /** @test */
    public function post_application_requires_all_fields()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->postJson('/api/apply', []);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors([
            'firstName', 'lastName', 'skills', 'availability', 'pastExperience', 'motivation', 'contactInfo'
        ]);
    }

    /** @test */
    public function user_can_see_their_sent_applications()
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $project = Project::factory()->create([
            'owner_id' => $user->id,
        ]);

        $this->actingAs($user);

        // This one belongs to the current user
        Application::create([
            'first_name' => 'Anna',
            'last_name' => 'Test',
            'skills' => json_encode(['Vue.js']),
            'availability' => 'Part-time',
            'past_experience' => 'Worked on frontends',
            'motivation' => 'Learning opportunity',
            'contact_info' => 'anna@example.com',
            'user_id' => $user->id,
            'project_id' => $project->id,
        ]);

        // Belongs to another user
        Application::create([
            'first_name' => 'Tom',
            'last_name' => 'Other',
            'skills' => json_encode(['React']),
            'availability' => 'Full-time',
            'past_experience' => '5 years React',
            'motivation' => 'Interested in project',
            'contact_info' => 'tom@example.com',
            'user_id' => $otherUser->id,
            'project_id' => $project->id,
        ]);

        $response = $this->getJson('/api/sent-applications/' . $user->id);
        $response->assertStatus(200);
        $response->assertJsonCount(1);
        $response->assertJsonFragment(['first_name' => 'Anna']);
    }

    /** @test */
    public function project_owner_can_see_received_applications()
    {
        $owner = User::factory()->create();
        $applicant = User::factory()->create();

        $project = Project::factory()->create([
            'owner_id' => $owner->id,
        ]);

        Application::create([
            'first_name' => 'Lisa',
            'last_name' => 'Applicant',
            'skills' => json_encode(['Python']),
            'availability' => 'Remote only',
            'past_experience' => 'Data science background',
            'motivation' => 'Wants to apply skills',
            'contact_info' => 'lisa@example.com',
            'user_id' => $applicant->id,
            'project_id' => $project->id,
        ]);

        $this->actingAs($owner);

        $response = $this->getJson('/api/received-applications/' . $owner->id);
        $response->assertStatus(200);
        $response->assertJsonFragment(['first_name' => 'Lisa']);
    }
}
