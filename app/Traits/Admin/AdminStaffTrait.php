<?php

namespace App\Traits\Admin;

use App\Models\Salary;
use App\Models\StaffRole;
use Inertia\Inertia;

trait AdminStaffTrait
{
    public function create_staff()
    {
        return Inertia::render('Admin/Staff/Create', [
            'salaries' => Salary::all(),
            'roles' => StaffRole::all()
        ]);
    }
}
