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

    /**
     * Logout tenant.
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        return $this->logout_tenant($request);
    }
}
