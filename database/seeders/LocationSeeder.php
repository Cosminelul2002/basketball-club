<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            [
                'address' => '123 Main St',
                'city' => 'Springfield',
                'area' => 'IL',
            ],
            [
                'address' => '456 Elm St',
                'city' => 'Springfield',
                'area' => 'IL',
            ],
            [
                'address' => '789 Oak St',
                'city' => 'Springfield',
                'area' => 'IL',
            ],
        ];

        foreach ($locations as $location) {
            \App\Models\Location::create($location);
        }
    }
}
