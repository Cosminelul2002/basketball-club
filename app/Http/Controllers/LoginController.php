<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Traits\Auth\LoginTrait;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LoginController extends Controller
{
    use LoginTrait;

    /**
     * Display the login page.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return $this->login_view();
    }

    /**
     * Login a user to the application.
     *
     * @param  \App\Http\Requests\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(LoginRequest $request)
    {
        return $this->login_user($request);
    }

    // public function login(LoginRequest $request)
    // {
    //     if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
    //         if ($request->get('remember')) {
    //             Auth::user()->setRememberToken($request->get('remember'));
    //         }
    //         $request->session()->regenerate();

    //         return redirect()->route('landing');
    //     } else {
    //         return redirect()->back()->with('error', 'Invalid credentials');
    //     }
    // }

    /**
     * Logout a user from the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        return $this->logout_user($request);
    }
}
