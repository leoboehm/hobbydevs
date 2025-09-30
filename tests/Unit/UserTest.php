<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if a user can be created with the correct attributes.
     *
     * @return void
     */
    public function test_user_creation()
    {
        $user = User::factory()->create();

        $this->assertDatabaseHas('users', [
            'username' => $user->username,
            'email' => $user->email,
            'type' => 'Developer', // default type from factory
        ]);
    }

    /**
     * Test the password is hashed when a user is created.
     *
     * @return void
     */
    public function test_user_password_is_hashed()
    {
        $password = 'password123';
        $user = User::factory()->create(['password' => $password]);

        // Check if password is hashed
        $this->assertTrue(Hash::check($password, $user->password));
    }

    /**
     * Test the 'fillable' property to ensure only allowed fields are mass-assignable.
     *
     * @return void
     */
    public function test_fillable_property()
    {
        $fillableFields = [
            'username',
            'type',
            'firstname',
            'lastname',
            'email',
            'password'
        ];

        $user = new User();

        // Check if all fields in the fillable array are accessible
        foreach ($fillableFields as $field) {
            $this->assertTrue(in_array($field, $user->getFillable()));
        }
    }

    /**
     * Test that the user has a valid password hashing mechanism.
     *
     * @return void
     */
    public function test_user_password_hashing()
    {
        $user = User::factory()->create();
        
        $plainPassword = 'password123';
        $hashedPassword = $user->password;
        
        $this->assertNotEquals($plainPassword, $hashedPassword);
    }

    /**
     * Test the 'hidden' property to ensure sensitive fields are not serialized.
     *
     * @return void
     */
    public function test_hidden_property()
    {
        $user = User::factory()->create();

        $hiddenFields = ['password', 'remember_token'];
        
        // Check if sensitive fields are hidden from the JSON representation
        foreach ($hiddenFields as $field) {
            $this->assertTrue(in_array($field, $user->getHidden()));
        }
    }
}
