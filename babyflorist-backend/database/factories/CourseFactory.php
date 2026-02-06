<?php

namespace Database\Factories;

use App\Models\CourseCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->sentence(4);
        $price = $this->faker->randomFloat(2, 50, 500);
        $salePrice = $this->faker->optional(0.7)->randomFloat(2, 10, $price - 5);

        $discountPercent = 0;
        if ($salePrice) {
            $discountPercent = round((($price - $salePrice) / $price) * 100);
        }

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->paragraph(),
            'content' => $this->faker->paragraphs(3, true),
            'price' => $price,
            'sale_price' => $salePrice,
            'discount_percent' => $discountPercent,
            'thumbnail' => 'https://placehold.co/600x400?text=' . urlencode($name),
            'instructor' => $this->faker->name(),
            'lesson_count' => $this->faker->numberBetween(5, 50),
            'student_count' => $this->faker->numberBetween(0, 1000),
            'is_active' => true,
            'type' => $this->faker->randomElement(['online', 'offline']),
            'format' => $this->faker->randomElement(['course', 'workshop']),
            'label' => $this->faker->randomElement(['basic', 'advanced']),
            'is_featured' => $this->faker->boolean(20),
            'targets' => $this->faker->sentences(3),
            'sale_start' => $this->faker->optional(0.5)->dateTimeBetween('-1 month', 'now'),
            'sale_end' => $this->faker->optional(0.5)->dateTimeBetween('now', '+1 month'),
            'course_category_id' => CourseCategory::factory(),
        ];
    }
}
