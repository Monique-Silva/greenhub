<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrdersHasProducts;
use App\Models\Product;
use Illuminate\Database\Seeder;

class OrdersHasProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OrdersHasProducts::factory(30)
            ->has(Order::factory(1)->has(Product::factory(5)))
            ->create();
    }
}
