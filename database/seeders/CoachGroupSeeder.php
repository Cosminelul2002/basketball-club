<?php

namespace Database\Seeders;

use App\Models\Coach;
use App\Models\CoachGroup;
use App\Models\Group;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CoachGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all coaches and player groups
        $coaches = Coach::all();
        $playerGroups = Group::all();

        // Attach each coach to a random player group
        foreach ($coaches as $coach) {
            $randomPlayerGroup = $playerGroups->random();
            $coachGroup = new CoachGroup([
                'coach_id' => $coach->id,
                'player_group_id' => $randomPlayerGroup->id,
            ]);
            $coachGroup->save();
        }
    }
}
