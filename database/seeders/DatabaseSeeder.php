<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Career;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            // CategorySeeder::class,
            // ProductSeeder::class,
            // RoleSeeder::class,
            // PlayerGroupSeeder::class,
            // PlayerSeeder::class,
            // CoachSeeder::class,
            // CoachGroupSeeder::class,
            // LocationSeeder::class,
        ]);

        // \App\Models\User::factory(100)->create();
    }
}
