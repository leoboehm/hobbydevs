<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_registers_a_new_user_successfully()
    {
        $response = $this->postJson('/api/register', [
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

        $response = $this->postJson('/api/register', [
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
}
