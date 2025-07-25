<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            'Chennai',
            'Bangalore',
            'Hyderabad',
            'Mumbai',
            'Delhi',
            'Pune',
            'Kolkata',
            'Ahmedabad',
            'Jaipur',
            'Coimbatore'
        ];

        foreach ($cities as $city) {
            Location::create(['city' => $city]);
        }
    }
}
