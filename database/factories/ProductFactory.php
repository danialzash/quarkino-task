<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'available_quantity' => fake()->numberBetween(0,100),
            'cost' => fake()->numberBetween(1, 1000000) * 1000,
            'brand' => fake()->firstNameFemale(),
        ];
    }
}
