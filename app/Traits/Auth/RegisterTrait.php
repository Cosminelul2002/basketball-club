<?php

namespace App\Traits\Auth;

use App\Models\User;
use Codestage\Authorization\Models\Role;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

trait RegisterTrait
{
    /**
     * Show the registration form.
     *
     * @return \Inertia\Response
     */
    public function register_view()
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Http\Requests\Auth\RegisterRequest  $registerRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register_user($request, $registerRequest)
    {
        // save user
        $data = $registerRequest->validated();
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        $user->user_roles()->insert([
            'user_id' => $user->id,
            'role_id' => Role::query()->where('key', 'user')->first()->id,
            'user_type' => 'App\Models\User',
        ]);

        $request->session()->flash('message', 'Inregistrare cu succes. Autentificati-va pentru a continua.');

        return redirect()->route('login');
    }
}
