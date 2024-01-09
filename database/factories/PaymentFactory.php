<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_id' => Order::factory(),
            'amount' => $this->faker->numerify('##000'),
            'status' => $this->faker->randomElement(['Waiting', 'Completed']),
        ];
    }
}
