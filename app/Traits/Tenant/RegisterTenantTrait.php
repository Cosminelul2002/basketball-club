<?php

namespace App\Traits\Tenant;

use App\Events\NewTenantCreated;
use App\Http\Requests\StoreTenantRequest;
use App\Models\Tenant;
use App\Models\User;
use Codestage\Authorization\Models\Role;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Stancl\Tenancy\Database\Models\Domain;

trait RegisterTenantTrait
{
    /**
     * Display the tenant registration page.
     *
     * @return \Inertia\Response
     */
    public function registerTenant()
    {
        return Inertia::render('Tenant/Register');
    }

    /**
     * Store a newly created tenant in storage.
     *
     * @param  \App\Http\Requests\StoreTenantRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeTenant(StoreTenantRequest $request, $superAdmin = false)
    {
        $request->validated();
        // Create a new user
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        // Assign the user the role of admin
        $user->user_roles()->insert([
            'user_id' => $user->id,
            'role_id' => Role::query()->where('key', 'admin')->first()->id,
            'user_type' => 'App\Models\User',
        ]);

        // Create a new tenant
        $tenant = Tenant::create([
            'name' => $request['name'],
            'type' => $request['type'],
            'owner_id' => $user->id,
        ]);

        // Create a domain for the tenant
        Domain::create([
            'domain' => $request['domain'] . '.localhost',
            'tenant_id' => $tenant->id,
        ]);

        // Initialize the tenant
        $createdTenant = Tenant::find($tenant->id);

        if ($superAdmin === false) {
            tenancy()->initialize($createdTenant);
        }


        // Create the user also in the tenant
        $createdTenant->run(function () use ($request, $createdTenant) {
            $userTenant = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]);

            event(new NewTenantCreated($createdTenant));
            $userTenant->user_roles()->insert([
                'user_id' => $userTenant->id,
                'role_id' => Role::query()->where('key', 'admin')->first()->id,
                'user_type' => 'App\Models\User',
            ]);
        });

        // Redirect to the tenant dashboard
        if ($superAdmin) {
            return redirect()->route('super_admin.dashboard.tenants.index');
        }
        return redirect()->route('auth.login');
    }
}
