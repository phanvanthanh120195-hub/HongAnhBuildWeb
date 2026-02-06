<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure some categories exist first if not using the factory's auto-creation
        if (CourseCategory::count() === 0) {
            CourseCategory::factory()->count(5)->create();
        }

        // Create 10 courses, assigning them to random existing categories
        Course::factory()
            ->count(10)
            ->recycle(CourseCategory::all())
            ->create();
    }
}
