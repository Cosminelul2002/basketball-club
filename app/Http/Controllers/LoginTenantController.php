<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginTenantRequest;
use App\Traits\Tenant\LoginTenantTrait;
use Illuminate\Http\Request;

class LoginTenantController extends Controller
{

    use LoginTenantTrait;

    /**
     * Login tenant.
     * 
     * @param LoginTenantRequest $request
     * @return \Inertia\Response
     */
    public function login(LoginTenantRequest $request)
    {
        return $this->login_tenant($request);
    }
}
