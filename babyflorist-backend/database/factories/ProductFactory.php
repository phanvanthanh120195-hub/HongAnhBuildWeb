<?php

namespace Database\Factories;

use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $name = $this->faker->words(3, true);
        $price = $this->faker->randomFloat(2, 20, 200);
        $salePrice = $this->faker->optional(0.6)->randomFloat(2, 10, $price - 5);
        $discountPercent = 0;

        if ($salePrice) {
            $discountPercent = round((($price - $salePrice) / $price) * 100);
        }

        return [
            'sku' => $this->faker->unique()->bothify('PROD-####'),
            'name' => ucfirst($name),
            'slug' => Str::slug($name),
            'description' => $this->faker->paragraph(),
            'price' => $price,
            'sale_price' => $salePrice,
            'discount_percent' => $discountPercent,
            'stock' => $this->faker->numberBetween(10, 100),
            'thumbnail' => 'https://placehold.co/600x600?text=' . urlencode($name),
            'label' => $this->faker->randomElement(['New', 'Sale', 'Hot', null]),
            'is_featured' => $this->faker->boolean(20),
            'is_active' => true,
            'product_category_id' => ProductCategory::factory(),
        ];
    }
}
