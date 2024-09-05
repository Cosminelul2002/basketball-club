<?php

namespace App\Traits\SuperAdmin;

use App\Models\Tenant;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

trait SuperAdminTenantTrait
{
    /**
     * Render the index page for tenants.
     *
     * @return \Inertia\Response
     */
    public function index_tenants()
    {
        $tenants = Tenant::query()
            ->orderBy('created_at', 'desc')
            ->when(Request::input('filters'), function ($query, $filters) {
                // if (isset($filters['searchName'])) {
                //     $query->where('first_name', 'like', '%' . $filters['searchName'] . '%');
                //     // ->orWhere('last_name', 'like', '%' . $filters['searchName'] . '%');
                // }

                // if (isset($filters['searchGroup'])) {
                //     $query->whereHas('groups', function ($groupQuery) use ($filters) {
                //         $groupQuery->where('name', 'like', '%' . $filters['searchGroup'] . '%');
                //     });
                // }

                // if (isset($filters['searchSkill_level'])) {
                //     $query->where('skill_level', $filters['searchSkill_level']);
                // }

                // if (isset($filters['searchYear'])) {
                //     $query->whereYear('date_of_birth', $filters['searchYear']);
                // }
            })
            ->with(['user'])
            ->paginate(9)
            ->withQueryString()
            ->through(function ($tenant) {
                return [
                    'id' => $tenant->id,
                    'name' => $tenant->name,
                    'email' => $tenant->email,
                    'domain' => $tenant->domains->first()->domain,
                    'status' => $tenant->status,
                    'type' => $tenant->type,
                    'owner' => $tenant->user,
                    'tenancy_db_name' => $tenant->tenancy_db_name,
                    'created_at' => date($tenant->created_at),
                ];
            });
        // dd($players);
        return Inertia::render('SuperAdmin/Tenants/List', [
            'tenants' => $tenants,
            'prevFilters' => Request::input('filters') ?? [],
        ]);
    }

    /**
     * Render the show page for a tenant.
     *
     * @param  \App\Models\Tenant  $tenant
     * @return \Inertia\Response
     */
    public function show_tenant(Tenant $tenant)
    {
        return Inertia::render('SuperAdmin/Tenants/Show', [
            'tenant' => $tenant->load(['user']),
            'domains' => $tenant->domains,
        ]);
    }

    /**
     * Render the create page for a tenant.
     *
     * @return \Inertia\Response
     */
    public function create_tenant()
    {
        return Inertia::render('SuperAdmin/Tenants/Create');
    }
}
