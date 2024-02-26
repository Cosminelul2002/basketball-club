<?php

namespace Database\Factories;

use App\Models\PlayerGroup;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Player>
 */
class PlayerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'date_of_birth' => $this->faker->date(),
            'gender' => $this->faker->randomElement(['masculin', 'feminin']),
            'height' => $this->faker->numberBetween(150, 200),
            'weight' => $this->faker->numberBetween(40, 100),
            'position' => $this->faker->randomElement(['Pleacă', 'Aruncă', 'Mică Aripă', 'Aripă Mare', 'Centru']),
            'skill_level' => $this->faker->randomElement(['Începător', 'Intermediar', 'Avansat']),
            'parent_name' => $this->faker->name,
            'parent_email' => $this->faker->unique()->safeEmail,
            'parent_phone' => $this->faker->phoneNumber,
            'player_group_id' => PlayerGroup::inRandomOrder()->get('id')->first()->id,
        ];
    }
}
