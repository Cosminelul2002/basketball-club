<?php

namespace App\Services;

use App\Exceptions\CustomException;
use App\Models\Player;

class JoinService
{
    public static function createPlayerFromJoin($join)
    {
        dd($join);
        try {
            Player::create([
                'first_name' => $join->first_name,
                'last_name' => $join->last_name,
                'date_of_birth' => $join->date_of_birth,
                'skill_level' => 'Începător', // default value, can be changed later
                'age' => $join->age,
                'parent_name' => $join->parent_name,
                'parent_phone' => $join->phone,
                'parent_email' => $join->email,
            ]);
            $join->update([
                'approved' => true,
            ]);
        } catch (\Exception $e) {
            dd($e->getMessage());
            throw new CustomException('Player could not be created from join.');
        }
    }
}
