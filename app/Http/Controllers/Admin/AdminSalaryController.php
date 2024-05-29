<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSalaryRequest;
use App\Models\Salary;
use App\Traits\Admin\AdminResourceTrait;
use App\Traits\Admin\AdminSalaryTrait;
use Codestage\Authorization\Attributes\Authorize;
use Illuminate\Http\Request;


#[Authorize(roles: 'admin')]
class AdminSalaryController extends Controller
{
    use AdminResourceTrait, AdminSalaryTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return $this->indexResources('Salaries', Salary::class);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Salary  $salary
     * @return \Inertia\Response
     */
    public function show(Salary $salary)
    {
        return $this->showResource('Salary', $salary);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Salary  $salary
     * @return \Inertia\Response
     */
    public function create()
    {
        return $this->create_salary();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSalaryRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreSalaryRequest $request)
    {
        return $this->storeResource($request, Salary::class, 'admin.dashboard.salaries.index', 'Salariu creat cu succes.');
    }

    public function destroy(Salary $salary)
    {
        return $this->destroyResource($salary, 'admin.dashboard.salaries.index', 'Salariu șters cu succes.');
    }
}
