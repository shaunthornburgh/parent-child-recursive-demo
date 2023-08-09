<?php

namespace Tests\Unit;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryRelationshipTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_category_has_children()
    {
        $category = Category::create(['name' => 'Electronics']);
        $child1 = Category::create(['name' => 'Mobile Phones', 'parent_id' => $category->id]);
        $child2 = Category::create(['name' => 'Laptops', 'parent_id' => $category->id]);

        $this->assertCount(2, $category->children);
    }

    public function test_a_category_has_a_parent()
    {
        $parent = Category::create(['name' => 'Electronics']);

        $child = Category::create(['name' => 'Mobile Phones', 'parent_id' => $parent->id]);

        $this->assertEquals($parent->id, $child->parent->id);
    }
}
