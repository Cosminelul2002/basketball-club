<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStaffRequest;
use App\Models\Staff;
use App\Traits\Admin\AdminResourceTrait;
use App\Traits\Admin\AdminStaffTrait;
use Illuminate\Http\Request;

class AdminStaffController extends Controller
{
    use AdminResourceTrait, AdminStaffTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return $this->indexResources('Staff', Staff::class, ['salary', 'role']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return $this->create_staff();
    }

    public function store(StoreStaffRequest $request)
    {
        return $this->storeResource($request, Staff::class, 'admin.dashboard.staff.index', 'Membrul a fost adaugat cu succes.');
    }
}
