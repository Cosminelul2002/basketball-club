<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTenantRequest;
use App\Traits\Tenant\RegisterTenantTrait;
use Illuminate\Http\Request;

class RegisterTenantController extends Controller
{
    use RegisterTenantTrait;

    /**
     * Display the tenant registration page.
     *
     * @return \Inertia\Response
     */
    public function show()
    {
        return $this->registerTenant();
    }

    /**
     * Store a newly created tenant in storage.
     *
     * @param  \App\Http\Requests\StoreTenantRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreTenantRequest $request)
    {   
        return $this->storeTenant($request);
    }
}
