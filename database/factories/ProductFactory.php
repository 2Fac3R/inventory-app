<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => Category::all()->random()->id,
            'sku' => $this->faker->ean8(), // Generate a random EAN-8 barcode.
            'name' => $this->faker->word(),
            'description' => $this->faker->text(800),
            'price' => $this->faker->randomFloat(2, 0, 10000),
            'quantity' => $this->faker->numberBetween(1, 100),
            'state' => $this->faker->boolean($chanceOfGettingTrue = 50),
        ];
    }
}
