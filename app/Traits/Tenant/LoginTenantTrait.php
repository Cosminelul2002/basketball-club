<?php

namespace App\Traits\Tenant;

use App\Http\Requests\LoginTenantRequest;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

trait LoginTenantTrait
{
    /**
     * Login tenant to their specific login domain.
     *
     * @param LoginTenantRequest $request
     * @return \Inertia\Response
     */
    public function login_tenant(LoginTenantRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if (auth()->user()->hasRole('super_admin')) {
                return redirect()->route('super_admin.dashboard');
            }

            $tenant = Tenant::where('owner_id', $user->id)->first();

            if ($tenant) {
                $domain = $tenant->domains->first();
                tenancy()->initialize($tenant);
                return Inertia::location('http://' . $domain->domain . ':8000/vendor');
            } else {
                return redirect()->back()->withErrors('Invalid credentials');
            }
        }

        return redirect()->back()->withErrors('Invalid credentials');
    }

    // Logout a user from the application.
    public function logout_tenant(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('landing');
    }
}
