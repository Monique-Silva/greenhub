<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number' => fake()->randomNumber(3, false),
            'road' => fake()->text(),
            'postal_code' => fake()->randomNumber(5, false),
            'city' => fake()->city(),
            'country' => "France",
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
