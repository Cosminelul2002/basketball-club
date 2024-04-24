<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Traits\Auth\RegisterTrait;
use Codestage\Authorization\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class RegisterController extends Controller
{
    use RegisterTrait;

    /**
     * Show the registration form.
     *
     * @return \Inertia\Response
     */
    public function show()
    {
        return $this->register_view();
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Http\Requests\Auth\RegisterRequest  $registerRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request, RegisterRequest $registerRequest)
    {
        return $this->register_user($request, $registerRequest);
    }
}
