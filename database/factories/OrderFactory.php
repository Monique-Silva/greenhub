<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
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
            'order_date' => fake()->date(),
            'delivery_date' => fake()->date(),
            'bill' => fake()->randomNumber(2, true),
            'vat' => 20,
            'shipping_fee' => fake()->randomNumber(1, true),
            'total_price' => fake()->randomNumber(3, true),
            'user_id' => User::inRandomOrder()->first(),
        ];
    }
}
