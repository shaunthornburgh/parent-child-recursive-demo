<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_category_can_be_created()
    {
        $category = Category::factory()->create([
            'name' => 'Electronics'
        ]);

        $this->assertDatabaseHas('categories', ['name' => 'Electronics']);
    }

    public function test_a_category_can_have_a_parent_category()
    {
        $parent = Category::factory()->create([
            'name' => 'Electronics'
        ]);

        $child = Category::factory()->create([
            'name' => 'Mobile Phones',
            'parent_id' => $parent->id
        ]);

        $this->assertEquals($parent->id, $child->parent->id);
    }
}
