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
            'price' => fake()->randomNumber(2, false),
            'vat_rate' => '20',
            'stock' => fake()->randomNumber(2, true),
            'description' => fake()->text(),
            'environmental_impact' => fake()->randomNumber(1, false),
            'origin' => 'France',
            'measuring_unit' => 'kg',
            'measure' => fake()->randomNumber(1, true),
        ];
    }
}
