<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Skill;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SkillControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that index returns all skills.
     */
    public function test_index_returns_all_skills()
    {
        Skill::insert([
            ['name' => 'HTML'],
            ['name' => 'CSS'],
            ['name' => 'JavaScript'],
            ['name' => 'PHP']
        ]);

        $response = $this->getJson('/api/skill');

        $response->assertStatus(200)
                 ->assertJsonCount(4);
    }
}
