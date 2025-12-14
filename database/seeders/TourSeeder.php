<?php

namespace Database\Seeders;

use App\Models\Destination;
use App\Models\Tour;
use Illuminate\Database\Seeder;

class TourSeeder extends Seeder
{
    public function run(): void
    {
        $alexandria = Destination::where('slug', 'alexandria')->first();
        $cairo = Destination::where('slug', 'cairo')->first();
        $luxor = Destination::where('slug', 'luxor')->first();
        $sharm = Destination::where('slug', 'sharm-el-sheikh')->first();

        // Tour 1: Alexandria City Tour
        if ($alexandria) {
            Tour::updateOrCreate(
                ['slug' => 'alexandria-city-tour-from-alexandria-port'],
                [
                    'name' => 'Alexandria City Tour from Alexandria Port',
                    'destination_id' => $alexandria->id,
                    'price' => 119.00, // Lowest price for visual reference
                    'duration_days' => 1,
                    'duration_nights' => 0,
                    'type' => 'Private Day Tour',
                    'availability' => 'Daily',
                    'description' => '<p>See the wonders of the second city of Egypt by leaving your ship in port. Explore the Kom Al Shoqafa Catacombs, the Qaitbay Citadel, the rebuilt Bibliotheca Alexandrina, and more…</p>
                    <p><strong>Overview:</strong></p>
                    <p>Experience the unique history of Alexandria, a city founded by Alexander the Great. Visit the ancient Roman Catacombs, marvel at the medieval Qaitbay Citadel built on the site of the ancient Lighthouse, and tour the modern Library of Alexandria.</p>',
                    'is_featured' => true,
                    'is_active' => true,
                    'images' => [
                        'tours/alexandria-1.jpg',
                        'tours/alexandria-2.jpg',
                    ],
                    'itinerary' => [
                        [
                            'day_title' => 'Alexandria Port to City Highlights',
                            'description' => 'Pick up from Alexandria Port. Visit the Catacombs of Kom El Shoqafa (largest Roman Cemetery). Visit Pompey\'s Pillar. Drive to visit the Citadel of Qaitbay. Stop for lunch at a local restaurant. Visit the Library of Alexandria. Return to the port.'
                        ]
                    ],
                    'price_tiers' => [
                        ['min_people' => 2, 'max_people' => 2, 'price_per_person' => 209],
                        ['min_people' => 3, 'max_people' => 3, 'price_per_person' => 159],
                        ['min_people' => 4, 'max_people' => 4, 'price_per_person' => 139],
                        ['min_people' => 5, 'max_people' => 5, 'price_per_person' => 129],
                        ['min_people' => 6, 'max_people' => 15, 'price_per_person' => 119],
                    ],
                    'included' => [
                        ['item' => 'Pick up services from Alexandria Port & return.'],
                        ['item' => 'All transfers by a private air-conditioned vehicle.'],
                        ['item' => 'Private English-speaking Egyptologist guide.'],
                        ['item' => 'Entrance fees to all the mentioned sites.'],
                        ['item' => 'Mineral water on board the vehicle during the tour.'],
                        ['item' => 'Lunch meal at local restaurant in Alexandria.'],
                        ['item' => 'All Service charges & taxes.'],
                    ],
                    'excluded' => [
                        ['item' => 'Any extras not mentioned in the itinerary.'],
                        ['item' => 'Tipping.'],
                    ]
                ]
            );
        }

        // Tour 2: Pyramids Day Tour
        if ($cairo) {
            Tour::updateOrCreate(
                ['slug' => 'giza-pyramids-sphinx-tour'],
                [
                    'name' => 'Giza Pyramids & Sphinx Half Day Tour',
                    'destination_id' => $cairo->id,
                    'price' => 60.00,
                    'duration_days' => 1,
                    'duration_nights' => 0,
                    'type' => 'Private Half Day Tour',
                    'availability' => 'Daily',
                    'description' => '<p>Visit the Great Pyramids of Giza and the Sphinx with a private guide.</p>',
                    'is_featured' => true,
                    'itinerary' => [
                        [
                            'day_title' => 'Pyramids & Sphinx',
                            'description' => 'Pick up from hotel. Visit Cheops, Chephren, and Mykerinus pyramids. Visit the Great Sphinx. Return to hotel.'
                        ]
                    ],
                    'price_tiers' => [
                        ['min_people' => 1, 'max_people' => 1, 'price_per_person' => 90],
                        ['min_people' => 2, 'max_people' => 4, 'price_per_person' => 60],
                    ],
                    'included' => [
                        ['item' => 'Hotel pickup and drop-off'],
                        ['item' => 'Professional guide'],
                    ],
                    'excluded' => [
                        ['item' => 'Entrance fees'],
                        ['item' => 'Tips'],
                    ]
                ]
            );
        }

         // Tour 3: Sharm El-Sheikh Adventure
         if ($sharm) {
            Tour::updateOrCreate(
                ['slug' => 'sharm-el-sheikh-complete-adventure'],
                [
                    'name' => 'Sharm El-Sheikh Complete Adventure',
                    'destination_id' => $sharm->id,
                    'price' => 450.00,
                    'duration_days' => 4,
                    'duration_nights' => 3,
                    'type' => 'Adventure Package',
                    'availability' => 'Sundays',
                    'description' => '<p>4 days of fun in the sun including snorkeling, desert safari, and relaxation.</p>',
                    'is_featured' => true,
                    'itinerary' => [
                        ['day_title' => 'Day 1', 'description' => 'Arrival and Hotel Check-in'],
                        ['day_title' => 'Day 2', 'description' => 'Ras Mohammed Snorkeling Trip'],
                        ['day_title' => 'Day 3', 'description' => 'Desert Safari & Bedouin Dinner'],
                        ['day_title' => 'Day 4', 'description' => 'Departure'],
                    ],
                    'images' => ['tours/sharm-1.jpg'],
                    'price_tiers' => [
                        ['min_people' => 2, 'max_people' => 10, 'price_per_person' => 450],
                    ],
                     'included' => [
                        ['item' => 'Accommodation'],
                        ['item' => 'Transfers'],
                    ],
                    'excluded' => [
                        ['item' => 'International Flights'],
                    ]
                ]
            );
        }
    }
}
