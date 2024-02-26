<?php

namespace App\Http\Controllers;

use App\Enums\Permission;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class LoginController extends Controller
{
    public function show()
    {
        return Inertia::render('Auth/Login');
    }

    public function login(LoginRequest $request)
    {
        // verify if credentials are valid
        // maintain the user log in
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if ($request->get('remember')) {
                Auth::user()->setRememberToken($request->get('remember'));
            }
            $request->session()->regenerate();

            return redirect()->route('landing');
        } else {
            return redirect()->back()->with('error', 'Invalid credentials');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('landing');
    }
}
