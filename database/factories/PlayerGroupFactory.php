<?php

namespace Database\Factories;

use App\Models\Group;
use App\Models\Player;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PlayerGroup>
 */
class PlayerGroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'player_id' => Player::inRandomOrder()->first()->id,
            'group_id' => Group::inRandomOrder()->first()->id,
        ];
    }
}
