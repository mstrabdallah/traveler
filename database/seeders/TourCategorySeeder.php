<?php

namespace Database\Seeders;

use App\Models\TourCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TourCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Travel Packages',
            'Day Tours',
            'Nile Cruises',
            'Shore Excursions',
        ];

        foreach ($categories as $index => $category) {
            TourCategory::updateOrCreate(
                ['slug' => Str::slug($category)],
                [
                    'name' => $category,
                    'is_active' => true,
                    'sort_order' => $index,
                ]
            );
        }
    }
}
