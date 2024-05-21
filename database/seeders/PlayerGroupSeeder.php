<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlayerGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $groups = [
            ['name' => 'Inițiere'],
            ['name' => 'Babybaschet'],
            ['name' => 'Minibaschet'],
            ['name' => 'U13'],
            ['name' => 'U14'],
            ['name' => 'U15'],
            ['name' => 'U16'],
            ['name' => 'U18'],
            ['name' => 'U20'],
            ['name' => 'Liga1'],
            ['name' => 'Seniori'],
        ];

        foreach ($groups as $group) {
            Group::create($group);
        }
    }
}
