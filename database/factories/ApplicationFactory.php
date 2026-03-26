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
            'skills' => $this->faker->words(5),
            'availability' => $this->faker->randomElement(['Immediate', '1-2 weeks', '1 month']),
            'past_experience' => $this->faker->paragraph(3),
            'motivation' => $this->faker->paragraph(2),
            'contact_info' => $this->faker->email(),
            'user_id' => User::factory(),
            'project_id' => Project::factory(),
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
        ];
    }
}
