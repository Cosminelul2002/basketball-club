<?php

namespace Database\Seeders;

use App\Enums\Coach_Roles;
use App\Models\Coach;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CoachSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $coaches = [
            [
                'first_name' => 'Pătrașcu',
                'last_name' => 'Cosmin',
                'date_of_birth' => '2002-02-02',
                'description' => 'Pătrașcu Cosmin este un antrenor de baschet cu experiență de peste 10 ani. A antrenat echipe de toate vârstele și a obținut rezultate remarcabile cu fiecare dintre ele.',
                'email' => 'cosminpatrascu611@yahoo.com',
                'phone' => '0764620876',
                'image' => 'coach.jpg',
                'role' => Coach_Roles::HeadCoach
            ],
            [
                'first_name' => 'Mihai',
                'last_name' => 'Andrei',
                'date_of_birth' => '2000-01-01',
                'description' => 'Mihai Andrei este un antrenor de baschet cu experiență de peste 10 ani. A antrenat echipe de toate vârstele și a obținut rezultate remarcabile cu fiecare dintre ele.',
                'email' => 'asdafaerfa@yahoo.com',
                'phone' => '0764620343',
                'image' => 'coach.jpg',
                'role' => Coach_Roles::AssistantCoach
            ],
            [
                'first_name' => 'Popescu',
                'last_name' => 'Ion',
                'date_of_birth' => '2001-03-03',
                'description' => 'Popescu Ion este un antrenor de baschet cu experiență de peste 10 ani. A antrenat echipe de toate vârstele și a obținut rezultate remarcabile cu fiecare dintre ele.',
                'email' => 'porpre@yahoo.com',
                'phone' => '0764620343',
                'image' => 'coach.jpg',
                'role' => Coach_Roles::PlayerCoach
            ]
        ];

        foreach ($coaches as $coach) {
            Coach::insert([
                'first_name' => $coach['first_name'],
                'last_name' => $coach['last_name'],
                'date_of_birth' => $coach['date_of_birth'],
                'description' => $coach['description'],
                'email' => $coach['email'],
                'phone' => $coach['phone'],
                'image' => $coach['image'],
                'role' => $coach['role']
            ]);
        }
    }
}
