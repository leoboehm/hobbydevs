<?php

namespace Database\Factories;

use App\Models\Application;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Application>
 */
class ApplicationFactory extends Factory
{
    protected $model = Application::class;

    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'skills' => json_encode($this->faker->words(5)), // store as JSON-encoded array
            'availability' => $this->faker->randomElement(['Immediate', '1-2 weeks', '1 month']),
            'past_experience' => $this->faker->paragraph(3),
            'motivation' => $this->faker->paragraph(2),
            'contact_info' => $this->faker->email(),
            'user_id' => User::factory(), // generates a user automatically
            'project_id' => Project::factory(), // generates a project automatically
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
        ];
    }
}
