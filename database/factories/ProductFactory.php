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
    public function definition()
    {
        $name = \ucfirst(fake()->safeColorName());

        return [
            'name' => $name,
            'description' => $name . ' ' . 'Example Description',
            'price' => fake()->numberBetween(1500, 15000),
        ];
    }
}
