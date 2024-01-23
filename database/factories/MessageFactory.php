<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sender_name' => $this->faker->name(),
            'sender_email' => $this->faker->safeEmail(),
            'message' => $this->faker->realText(),
        ];
    }
}
