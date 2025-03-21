<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Define salary ranges
        $salaryRanges = ['10-20k', '20-30k', '30-50k', '50-70k'];
        
        // Define categories
        $categories = ['Web Development', 'Graphic Design', 'Content Writing', 'Marketing'];

        return [
            'owner_id' => 1,
            'title' => $this->faker->sentence(6, true),
            'description' => $this->faker->paragraph(4, true),
            'category' => $this->faker->randomElement($categories),
            'skills' => json_encode($this->faker->words(5)),
            'salary_range' => $this->faker->randomElement($salaryRanges),
            'duration' => $this->faker->numberBetween(1, 12) . ' months',
            'start_date' => $this->faker->dateTimeBetween('+1 week', '+1 month'),
            'deadline' => $this->faker->dateTimeBetween('+2 months', '+6 months'),
            'application_start_date' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'application_deadline' => $this->faker->dateTimeBetween('now', '+1 month'),
        ];
    }
}
