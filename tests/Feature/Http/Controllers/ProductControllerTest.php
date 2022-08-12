<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_guest()
    {
        $this->get('products')->assertRedirect('login'); // index
        $this->get('products/create')->assertRedirect('login'); // create
        $this->post('products', [])->assertRedirect('login'); // store
        $this->get('products/1')->assertRedirect('login'); // show
        $this->get('products/1/edit')->assertRedirect('login'); // edit
        $this->put('products/1')->assertRedirect('login'); // update
        $this->delete('products/1')->assertRedirect('login'); // destroy
    }

    public function test_index_empty()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('products')
            ->assertStatus(200)
            ->assertSee([]);
    }

    public function test_index_with_data()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);

        $this->actingAs($user)
            ->get('products')
            ->assertStatus(200)
            ->assertSee($product->id)
            ->assertSee($product->name);
    }

    public function test_create()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('products/create')
            ->assertStatus(200);
    }

    public function test_store()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $data = [
            'category_id' => $category->id,
            'sku' => $this->faker->ean8(), // Generate a random EAN-8 barcode.
            'name' => $this->faker->word(),
            'description' => $this->faker->text(800),
            'price' => $this->faker->randomFloat(2, 0, 10000),
            'quantity' => $this->faker->numberBetween(1, 100),
            'state' => $this->faker->boolean($chanceOfGettingTrue = 50),
        ];

        $this->actingAs($user)
            ->post('products', $data)
            ->assertRedirect('products');

        $this->assertDatabaseHas('products', $data);
    }

    public function test_validation_sku_size()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $data = [
            'category_id' => $category->id,
            'sku' => 'wrong-sku', // 8 size validation. 'wrong-sku' (9 characters)
            'name' => $this->faker->word(),
            'description' => $this->faker->text(800),
            'price' => $this->faker->randomFloat(2, 0, 10000),
            'quantity' => $this->faker->numberBetween(1, 100),
            'state' => $this->faker->boolean($chanceOfGettingTrue = 50),
        ];

        $this->actingAs($user)
            ->post('products', $data)
            ->assertSessionHasErrors();

        $this->assertDatabaseMissing('products', $data);
    }

    public function test_validation_sku_unique()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        Product::factory()->create(['sku' => 'aaaaaaaa']); // product_id = 1
        $data = [
            'category_id' => $category->id,
            'sku' => 'aaaaaaaa', // already exists
            'name' => $this->faker->word(),
            'description' => $this->faker->text(800),
            'price' => $this->faker->randomFloat(2, 0, 10000),
            'quantity' => $this->faker->numberBetween(1, 100),
            'state' => $this->faker->boolean($chanceOfGettingTrue = 50),
        ];

        $this->actingAs($user)
            ->post('products', $data) // product_id = 2
            ->assertSessionHasErrors();

        $this->assertDatabaseMissing('products', $data);
    }

    public function test_validation_state_is_boolean()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $data = [
            'category_id' => $category->id,
            'sku' => $this->faker->ean8(), // Generate a random EAN-8 barcode.
            'name' => $this->faker->word(),
            'description' => $this->faker->text(800),
            'price' => $this->faker->randomFloat(2, 0, 10000),
            'quantity' => $this->faker->numberBetween(1, 100),
            'state' => 'not-boolean', // Not boolean type
        ];

        $this->actingAs($user)
            ->post('products', $data)
            ->assertSessionHasErrors();

        $this->assertDatabaseMissing('products', $data);
    }

    public function test_show()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);

        $this->actingAs($user)
            ->get("products/$product->id")
            ->assertStatus(200);
    }

    public function test_edit()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);

        $this->actingAs($user)
            ->get("products/$product->id/edit")
            ->assertStatus(200)
            ->assertSee($product->name);
    }

    public function test_update()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);
        $data = [
            'category_id' => $category->id,
            'sku' => $this->faker->ean8(), // Generate a random EAN-8 barcode.
            'name' => $this->faker->word(),
            'description' => $this->faker->text(800),
            'price' => $this->faker->randomFloat(2, 0, 10000),
            'quantity' => $this->faker->numberBetween(1, 100),
            'state' => $this->faker->boolean($chanceOfGettingTrue = 50),
        ];

        $this->actingAs($user)
            ->put("products/$product->id", $data)
            ->assertRedirect("products/$product->id/edit");

        $this->assertDatabaseHas('products', $data);
    }

    public function test_destroy()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);

        $this->actingAs($user)
            ->delete("products/$product->id")
            ->assertRedirect('products');

        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
        ]);
    }
}
