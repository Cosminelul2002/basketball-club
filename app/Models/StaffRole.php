<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffRole extends Model
{
    use HasFactory;

    protected $table = 'staff_roles';

    protected $fillable = [
        'name',
        'description'
    ];

    public function staff()
    {
        return $this->hasMany(Staff::class);
    }
}
