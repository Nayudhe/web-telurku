<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $order = Order::factory()->create();
        return [
            'order_id' => $order->id,
            // 'product_id' => $this->faker->numberBetween(1, 4),
            'product_id' => 1,
            'product_name' => 'Telur Ayam Negeri',
            'quantity' => $this->faker->numberBetween(1, 20),
            'created_at' => $order->created_at,
        ];
    }
}
