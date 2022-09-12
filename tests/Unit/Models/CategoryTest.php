<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_has_many_products()
    {
        $category = Category::factory()->create();
        $this->assertInstanceOf(Collection::class, $category->products);
    }
}
