<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'username' => 'testuser',
            'firstname' => 'Test',
            'lastname' => 'User',
            'email' => 'test@hobbydevs.com'
        ]);
        
        \App\Models\Project::factory()->create([
            'title' => 'Hobby Devs',
            'description' => 'This is a fun Software Engineering Project for young students of Computer Science!',
            'salary_range' => 'You will not get paid ;)',
            'duration' => '2 Semesters',
        ]);
        \App\Models\Project::factory(10)->create();
    }
}
