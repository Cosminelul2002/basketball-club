<?php

namespace App\Traits\Admin;

use Inertia\Inertia;

trait AdminSalaryTrait
{
    public function create_salary()
    {
        return Inertia::render('Admin/Salaries/Create', [
            'salary_types' => \App\Enums\Salary_Types::values(),
            'currencies' => \App\Enums\Currency::values()
        ]);
    }
}
