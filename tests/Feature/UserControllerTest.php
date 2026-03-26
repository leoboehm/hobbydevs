<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_registers_a_new_user_successfully()
    {
        $response = $this->postJson('/api/user', [
            'email' => 'test@example.com',
            'firstname' => 'John',
            'lastname' => 'Doe',
            'password' => 'securePassword123',
            'type' => 'user',
            'username' => 'johndoe',
        ]);

        $response->assertStatus(201)
            ->assertJson(['message' => 'User registered successfully']);

        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
            'firstname' => 'John',
            'lastname' => 'Doe',
            'type' => 'user',
            'username' => 'johndoe',
        ]);

        $this->assertTrue(Hash::check('securePassword123', User::first()->password));
    }

    /** @test */
    public function it_does_not_allow_duplicate_email_registration()
    {
        User::factory()->create([
            'email' => 'duplicate@example.com',
        ]);

        $response = $this->postJson('/api/user', [
            'email' => 'duplicate@example.com',
            'firstname' => 'Jane',
            'lastname' => 'Smith',
            'password' => 'anotherPassword456',
            'type' => 'admin',
            'username' => 'janesmith',
        ]);

        $response->assertStatus(400)
            ->assertJson(['message' => 'Email is already in use']);
    }

    /** @test */
    public function user_can_update_all_fields_successfully()
    {
        $user = User::factory()->create([
            'rating' => 3.5,
        ]);

        Sanctum::actingAs($user);

        $payload = [
            'id' => $user->id,
            'firstname' => 'Jane',
            'lastname' => 'Doe',
            'username' => 'janedoe',
            'skills' => ['PHP', 'Laravel'],
            'experience' => '5 years',
            'bio' => 'Backend developer',
            'rating' => 4.2,
            'interests' => 'Open Source',
        ];

        $response = $this->putJson('/api/user', $payload);

        $response->assertStatus(200);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'firstname' => 'Jane',
            'lastname' => 'Doe',
            'username' => 'janedoe',
            'experience' => '5 years',
            'bio' => 'Backend developer',
            'rating' => 4.2,
            'interests' => 'Open Source',
        ]);
    }

    /** @test */
    public function user_update_applies_fallbacks_for_optional_fields()
    {
        $user = User::factory()->create([
            'experience' => 'Old experience',
            'bio' => 'Old bio',
            'rating' => 2.0,
            'interests' => 'Old interests',
        ]);

        Sanctum::actingAs($user);

        $payload = [
            'id' => $user->id,
            'firstname' => 'Updated',
            'lastname' => 'User',
            'username' => 'updateduser',
            // optional fields intentionally omitted
        ];

        $this->putJson('/api/user', $payload)->assertStatus(200);

        $user->refresh();

        $this->assertEquals('', $user->experience);
        $this->assertEquals('', $user->bio);
        $this->assertEquals(2.0, $user->rating); // fallback to old value
        $this->assertEquals('', $user->interests);
    }

    /** @test */
    public function user_update_fails_validation_when_required_fields_are_missing()
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $response = $this->putJson('/api/user', [
            'id' => $user->id,
            'firstname' => '',
            'lastname' => '',
            'username' => '',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors([
                'firstname',
                'lastname',
                'username',
            ]);
    }

    /** @test */
    public function get_developer_list_returns_only_developers_with_decoded_skills()
    {
        User::factory()->create([
            'type' => 'Developer',
            'skills' => json_encode(['PHP', 'Laravel']),
        ]);

        User::factory()->create([
            'type' => 'Customer',
        ]);

        User::factory()->create([
            'type' => 'Developer',
            'skills' => '',
        ]);

        $response = $this->getJson('/api/developers');

        $response->assertStatus(200);
        $response->assertJsonCount(2);

        $response->assertJsonFragment([
            'skills' => ['PHP', 'Laravel'],
        ]);

        $response->assertJsonFragment([
            'skills' => [],
        ]);
    }

    /** @test */
    public function get_developer_by_id_returns_decoded_skills()
    {
        $developer = User::factory()->create([
            'type' => 'Developer',
            'skills' => json_encode(['Vue', 'React']),
        ]);

        $response = $this->getJson("/api/user/{$developer->id}");

        $response->assertStatus(200)
            ->assertJsonFragment([
                'skills' => ['Vue', 'React'],
            ]);
    }

    /** @test */
    public function get_developer_by_id_returns_404_when_user_not_found()
    {
        $response = $this->getJson('/api/user/999999');

        $response->assertStatus(404)
            ->assertJson([
                'message' => 'User not found',
            ]);
    }
}