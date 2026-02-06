<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure some categories exist
        if (ProductCategory::count() === 0) {
            ProductCategory::factory()->count(5)->create();
        }

        // Create 12 products
        Product::factory()
            ->count(12)
            ->recycle(ProductCategory::all())
            ->create();
    }
}
