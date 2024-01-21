<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            'name' => "Telur " . $this->faker->word(),
            'price' => $this->faker->numberBetween(2, 6) . $this->faker->numerify('#000'),
            'description' => $this->faker->sentence(10),
            'stock' => $this->faker->numberBetween(10, 200),
            'image' => 'default.png',
        ];
    }
}
