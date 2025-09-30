<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
        $categories = ['Web Development', 'Mobile Development', 'Desktop Development', 'Game Development', 'Data Science', 'Machine Learning', 'Artificial Intelligence', 'Cyber Security', 'Networking'];

        $skills = ['HTML', 'CSS', 'JavaScript', 'PHP', 'Python', 'Java', 'C#', 'C++', 'Ruby', 'Swift', 'Kotlin', 'Dart', 'React', 'Vue'];

        return [
            'owner_id' => 1,
            'title' => $this->faker->sentence(6, true),
            'description' => $this->faker->paragraph(4, true),
            'category' => $this->faker->randomElement($categories),
            'skills' => json_encode($this->faker->randomElement($skills)),
            'salary_range' => $this->faker->randomElement($salaryRanges),
            'duration' => $this->faker->numberBetween(1, 12) . ' months',
            'start_date' => $this->faker->dateTimeBetween('+1 week', '+1 month'),
            'deadline' => $this->faker->dateTimeBetween('+2 months', '+6 months'),
            'application_start_date' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'application_deadline' => $this->faker->dateTimeBetween('now', '+1 month'),
        ];
    }
}
