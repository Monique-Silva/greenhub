<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductHasCategories>
 */
class OrdersHasProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'quantity' => fake()->randomNumber(1, false),
            'unit_price' => fake()->randomNumber(2, false),
            'unit_price_vat' => 20,
            'order_id' => Order::inRandomOrder()->first(),
            'product_id' => Product::inRandomOrder()->first(),
        ];
    }
}
