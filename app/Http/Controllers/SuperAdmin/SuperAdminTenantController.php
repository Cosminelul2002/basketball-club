<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTenantRequest;
use App\Models\Tenant;
use App\Models\User;
use App\Traits\Admin\AdminResourceTrait;
use App\Traits\SuperAdmin\SuperAdminTenantTrait;
use App\Traits\Tenant\RegisterTenantTrait;
use Codestage\Authorization\Attributes\Authorize;
use Inertia\Inertia;

#[Authorize(roles: 'super_admin')]
class SuperAdminTenantController extends Controller
{

    use SuperAdminTenantTrait, RegisterTenantTrait, AdminResourceTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    #[Authorize(roles: 'super_admin')]
    public function index()
    {
        return $this->index_tenants();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    #[Authorize(roles: 'super_admin')]
    public function show(Tenant $tenant)
    {
        return $this->show_tenant($tenant);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    #[Authorize(roles: 'super_admin')]
    public function create()
    {
        return Inertia::render('SuperAdmin/Tenants/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTenantRequest  $request
     * @return \Illuminate\Http\Response
     */
    #[Authorize(roles: 'super_admin')]
    public function store(StoreTenantRequest $request)
    {
        return $this->storeTenant($request, true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    #[Authorize(roles: 'super_admin')]
    public function destroy(Tenant $tenant)
    {
        return $this->destroyResource($tenant, 'super_admin.dashboard.tenants.index', 'Tenant șters cu succes!');
    }
}
