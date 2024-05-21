<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Salary;
use App\Traits\Admin\AdminResourceTrait;
use Codestage\Authorization\Attributes\Authorize;
use Illuminate\Http\Request;


#[Authorize(roles: 'admin')]
class AdminSalaryController extends Controller
{
    use AdminResourceTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return $this->indexResources('Salaries', Salary::class);
    }

    public function show(Salary $salary)
    {
        return $this->showResource('Salary', $salary);
    }
}
