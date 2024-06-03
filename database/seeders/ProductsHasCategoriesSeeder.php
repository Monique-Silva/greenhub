<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductsHasCategories;
use Illuminate\Database\Seeder;

class ProductsHasCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductsHasCategories::factory(30)
            ->has(Product::factory(10)->has(Category::factory(1)))
            ->create();
    }
}
