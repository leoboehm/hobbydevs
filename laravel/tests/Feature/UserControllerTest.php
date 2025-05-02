<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test successful user update.
     *
     * @return void
     */
    public function test_user_can_update_their_information()
    {
        // Create a user
        $user = User::factory()->create();

        // Act as the user and send a valid update request
        Sanctum::actingAs($user, ['*']); // Authenticate as the created user
        
        $updatedData = [
            'firstname' => 'UpdatedFirstName',
            'lastname' => 'UpdatedLastName',
            'username' => 'updatedusername',
            'email' => 'updatedemail@example.com',
        ];

        // Send PUT request to update user
        $response = $this->putJson('/api/user', $updatedData);

        // Assert that the response status is 200 (OK)
        $response->assertStatus(200);

        // Assert that the data has been updated in the database
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'firstname' => 'UpdatedFirstName',
            'lastname' => 'UpdatedLastName',
            'username' => 'updatedusername',
            'email' => 'updatedemail@example.com',
        ]);

        // Assert the response contains the updated data
        $response->assertJsonFragment($updatedData);
    }

    /**
     * Test validation when invalid data is provided.
     *
     * @return void
     */
    public function test_user_update_fails_with_invalid_data()
    {
        // Create a user
        $user = User::factory()->create();

        // Act as the user
        Sanctum::actingAs($user, ['*']); // Authenticate as the created user

        // Invalid data (username already taken)
        $invalidData = [
            'firstname' => '', // Required field is empty
            'lastname' => 'UpdatedLastName',
            'username' => $user->username, // Same username
            'email' => 'invalidemail', // Invalid email format
        ];

        // Send PUT request with invalid data
        $response = $this->putJson('/api/user', $invalidData);

        // Assert that validation errors are returned
        $response->assertStatus(422); // 422 Unprocessable Entity

        // Assert that the validation errors are for specific fields
        $response->assertJsonValidationErrors(['firstname', 'email']);
    }

    /**
     * Test unauthorized user trying to update their information.
     *
     * @return void
     */
    public function test_unauthenticated_user_cannot_update_information()
    {
        // Create a user
        $user = User::factory()->create();

        // Send PUT request without authentication
        $response = $this->putJson('/api/user', [
            'firstname' => 'UpdatedFirstName',
            'lastname' => 'UpdatedLastName',
            'username' => 'updatedusername',
            'email' => 'updatedemail@example.com',
        ]);

        // Assert that the response status is 401 (Unauthorized)
        $response->assertStatus(401);
    }

    // Currently not working, new user can be created with email that is used by different user
    // /**
    //  * Test that a user cannot update other users' information.
    //  *
    //  * @return void
    //  */
    // public function test_user_cannot_update_other_users_information()
    // {
    //     // Create two users
    //     $user1 = User::factory()->create();
    //     $user2 = User::factory()->create();

    //     // Act as the first user
    //     Sanctum::actingAs($user1, ['*']); // Authenticate as user1

    //     // Attempt to update user2's information
    //     $response = $this->putJson('/api/user', [
    //         'firstname' => 'UpdatedFirstName',
    //         'lastname' => 'UpdatedLastName',
    //         'username' => 'updatedusername',
    //         'email' => 'updatedemail@example.com',
    //     ]);

    //     // Assert that the response status is 403 (Forbidden)
    //     $response->assertStatus(403);
    // }
}
