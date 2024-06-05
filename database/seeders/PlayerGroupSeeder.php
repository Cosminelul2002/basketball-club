<?php

namespace Database\Seeders;

use App\Models\PlayerGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlayerGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PlayerGroup::factory(15)->create();
    }
}
