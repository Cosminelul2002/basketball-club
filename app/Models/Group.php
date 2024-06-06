<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'tax',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function coaches()
    {
        return $this->belongsToMany(Coach::class, 'coach_group', 'player_group_id', 'coach_id')
            ->using(CoachGroup::class);
    }

    public function players()
    {
        return $this->belongsToMany(Player::class, 'player_group')->withPivot('player_id');
    }

    public function staff()
    {
        return $this->belongsToMany(Staff::class, 'staff_group')->withPivot('staff_id');
    }
}
