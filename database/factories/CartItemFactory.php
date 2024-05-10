<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            // 'product_id' => $this->faker->numberBetween(1, 4),
            'product_id' => 1,
            'quantity' => $this->faker->numberBetween(1, 10),
            'total_price' => function (array $attributes) {
                return $attributes['quantity'] * Product::find($attributes['product_id'])->price;
            },
        ];
    }
}
