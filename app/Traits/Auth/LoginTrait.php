<?php

namespace App\Traits\Auth;

use App\Http\Requests\ResetLinkRequest;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;

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

    /**
     * Send a reset link to the user via email.
     *
     * @return \Inertia\Response
     */
    public function send_reset_link(ResetLinkRequest $request)
    {
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    /**
     * Display the reset password form.
     *
     * @return \Inertia\Response
     */
    public function show_reset_form(string $token, string $email)
    {
        return Inertia::render('Auth/ResetPassForm', [
            'token' => $token,
            'email' => $email
        ]);
    }

    /**
     * Reset the user password.
     *
     * @param  \App\Http\Requests\ResetPasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reset_password(ResetPasswordRequest $request)
    {
        $request->validated();

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('auth.login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
