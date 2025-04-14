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

        \App\Models\Category::insert([
            ['name' => 'Web Development'],
            ['name' => 'Mobile Development'],
            ['name' => 'Desktop Development'],
            ['name' => 'Game Development'],
            ['name' => 'Data Science'],
            ['name' => 'Machine Learning'],
            ['name' => 'Artificial Intelligence'],
            ['name' => 'Cyber Security'],
            ['name' => 'Networking'],
        ]);

        
        \App\Models\Skill::insert([
            ['name' => 'HTML'],
            ['name' => 'CSS'],
            ['name' => 'JavaScript'],
            ['name' => 'PHP'],
            ['name' => 'Python'],
            ['name' => 'Java'],
            ['name' => 'C#'],
            ['name' => 'C++'],
            ['name' => 'Ruby'],
            ['name' => 'Swift'],
            ['name' => 'Kotlin'],
            ['name' => 'Dart'],
            ['name' => 'React'],
            ['name' => 'Vue'],
        ]);
    }
}
