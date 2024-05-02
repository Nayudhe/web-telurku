<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
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
            'total_price' => $this->faker->numberBetween(1, 9) . $this->faker->numerify('#000'),
            'address' => $this->faker->address(),
            // 'status' => $this->faker->randomElement(['waiting', 'accepted', 'canceled', 'done']),
            'status' => 'done',
            'payment_status' => 2,
            'created_at' => $this->faker->dateTimeBetween('-4 months', 'now'),
        ];
    }
}
