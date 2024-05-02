<?php

namespace App\Traits\Auth;

use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

trait LoginTrait
{
    /**
     * Display a listing of the resource for the login page.
     *
     * @return \Inertia\Response
     */
    public function login_view()
    {
        return Inertia::render('Auth/Login');
    }

    /**
     * Login a user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login_user($request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->filled('remember'))) {

            $request->session()->regenerate();

            return redirect()->intended(route('landing'));
        }

        return redirect()->back()->with('error', 'Invalid credentials');
    }

    /**
     * Logout a user from the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout_user($request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('landing');
    }
}
