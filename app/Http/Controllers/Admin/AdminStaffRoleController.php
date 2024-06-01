<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStaffRoleRequest;
use App\Models\StaffRole;
use App\Traits\Admin\AdminResourceTrait;
use Illuminate\Http\Request;

class AdminStaffRoleController extends Controller
{
    use AdminResourceTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return $this->indexResources('StaffRoles', StaffRole::class);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function show(StaffRole $staffRole)
    {
        return $this->showResource('StaffRole', $staffRole);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create(StaffRole $staffRole)
    {
        return $this->createResourceView('StaffRoles');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreStaffRoleRequest $request)
    {
        return $this->storeResource($request, StaffRole::class, 'admin.dashboard.staff-roles.index', 'Rolul a fost adaugat cu succes.');
    }

    public function destroy(StaffRole $staffRole)
    {
        return $this->destroyResource($staffRole, 'admin.dashboard.staff-roles.index', 'Rolul a fost sters cu succes.');
    }
}
