<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StaffGroup>
 */
class StaffGroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'staff_id' => \App\Models\Staff::inRandomOrder()->first()->id,
            'group_id' => \App\Models\Group::inRandomOrder()->first()->id,
        ];
    }
}
