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
    public function storeTenant(StoreTenantRequest $request)
    {
        $request->validated();

        // Create a new user
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        // Create a new tenant
        $tenant = Tenant::create([
            'name' => $request['name'],
            'type' => $request['type'],
            'owner_id' => $user->id,
        ]);

        // Create a domain for the tenant
        Domain::create([
            'domain' => $request['domain'],
            'tenant_id' => $tenant->id,
        ]);

        // Initialize the tenant
        tenancy()->initialize($tenant);

        // Create the user also in the tenant
        $tenant->run(function () use ($request) {
            $userTenant = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]);
            $userTenant->user_roles()->insert([
                'user_id' => $userTenant->id,
                'role_id' => Role::query()->where('key', 'admin')->first()->id,
                'user_type' => 'App\Models\User',
            ]);
        });

        // Redirect to the tenant dashboard
        // return response()->json(['subdomain_url' => 'http://' . $data['domain'] . ':8000']);
        return Inertia::location('http://' . $request['domain'] . ':8000');
        // return redirect()->route('tenant.landing')->domain($d);
        // return redirect(tenant_route($domain->domain . ':8000', 'tenant.landing'));
    }
}
