<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Category;

class CategoryTest extends TestCase
{
    public function test_has_many_products()
    {
        $category = Category::factory()->create();
        $this->assertInstanceOf(Collection::class, $category->products);
    }
}
