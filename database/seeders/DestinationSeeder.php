<?php

namespace Database\Seeders;

use App\Models\Destination;
use Illuminate\Database\Seeder;

class DestinationSeeder extends Seeder
{
    public function run(): void
    {
        $destinations = [
            [
                'name' => 'Cairo',
                'slug' => 'cairo',
                'description' => 'Explore the Great Pyramids of Giza, the Sphinx, and the Egyptian Museum in Cairo, the vibrant capital of Egypt.',
                'image' => 'destinations/cairo.jpg', // Placeholder path
            ],
            [
                'name' => 'Luxor',
                'slug' => 'luxor',
                'description' => 'Discover the world\'s greatest open-air museum, featuring the Valley of the Kings and Karnak Temple.',
                'image' => 'destinations/luxor.jpg',
            ],
            [
                'name' => 'Aswan',
                'slug' => 'aswan',
                'description' => 'Experience the serene beauty of the Nile, the Philae Temple, and the High Dam in Aswan.',
                'image' => 'destinations/aswan.jpg',
            ],
            [
                'name' => 'Alexandria',
                'slug' => 'alexandria',
                'description' => 'The Pearl of the Mediterranean, known for its Roman amphitheater, catacombs, and library.',
                'image' => 'destinations/alexandria.jpg',
            ],
            [
                'name' => 'Hurghada',
                'slug' => 'hurghada',
                'description' => 'Relax on the Red Sea coast with world-class diving, snorkeling, and pristine beaches.',
                'image' => 'destinations/hurghada.jpg',
            ],
            [
                'name' => 'Sharm El Sheikh',
                'slug' => 'sharm-el-sheikh',
                'description' => 'A resort town between the desert of the Sinai Peninsula and the Red Sea, famous for its clear waters.',
                'image' => 'destinations/sharm.jpg',
            ],
            [
                'name' => 'Nile Cruise',
                'slug' => 'nile-cruise',
                'description' => 'Sail the Nile in luxury and visit ancient temples between Luxor and Aswan.',
                'image' => 'destinations/nile-cruise.jpg',
            ],
        ];

        foreach ($destinations as $destination) {
            Destination::updateOrCreate(
                ['slug' => $destination['slug']],
                $destination
            );
        }
    }
}
