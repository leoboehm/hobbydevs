<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    // /**
    //  * Test successful user update.
    //  *
    //  * @return void
    //  */
    // public function test_user_can_update_their_information()
    // {
    //     // Create a user
    //     $user = User::factory()->create();

    //     // Act as the user and send a valid update request
    //     Sanctum::actingAs($user, ['*']); // Authenticate as the created user
        
    //     $updatedData = [
    //         'id' => $user->id,
    //         'firstname' => 'UpdatedFirstName',
    //         'lastname' => 'UpdatedLastName',
    //         'username' => 'updatedusername',
    //     ];

    //     // Send PUT request to update user
    //     $response = $this->putJson('/api/user', $updatedData);

    //     // Assert that the response status is 200 (OK)
    //     $response->assertStatus(200);

    //     // Assert that the data has been updated in the database
    //     $this->assertDatabaseHas('users', [
    //         'id' => $user->id,
    //         'firstname' => 'UpdatedFirstName',
    //         'lastname' => 'UpdatedLastName',
    //         'username' => 'updatedusername',
    //     ]);
    // }

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
            'id' => $user->id,
            'firstname' => '', // Required field is empty
            'lastname' => 'UpdatedLastName',
            'username' => $user->username, // Same username
        ];

        // Send PUT request with invalid data
        $response = $this->putJson('/api/user', $invalidData);

        // Assert that validation errors are returned
        $response->assertStatus(422); // 422 Unprocessable Entity

        // Assert that the validation errors are for specific fields
        $response->assertJsonValidationErrors(['firstname']);
    }
}
