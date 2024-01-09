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
            'total_price' => $this->faker->numerify('##000'),
            'status' => $this->faker->randomElement(['Waiting', 'Accepted', 'Done']),
        ];
    }
}
