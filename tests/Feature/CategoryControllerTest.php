<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that index returns all categories.
     */
    public function test_index_returns_all_categories()
    {
        Category::insert([
            ['name' => 'Web Development'],
            ['name' => 'Mobile Development']
        ]);

        $response = $this->getJson('/api/category');

        $response->assertStatus(200)
                 ->assertJsonCount(2);
    }
}
