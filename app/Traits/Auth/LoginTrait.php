<?php

namespace App\Traits\Auth;

use App\Http\Requests\ResetLinkRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Stancl\Tenancy\Database\Models\Domain;

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
    public function login_tenant($request)
    {
        // get the tenant

        // $tenant = $domain->tenant;
        // tenancy()->initialize($tenant);

        $credentials = $request->only('email', 'password');

        // Check if user's email is verified
        if (!Auth::attempt($credentials, $request->filled('remember'))) {
            return redirect()->back()->withErrors('Invalid credentials');
        }

        // Check if the user's email is verified
        // if (!Auth::user()->hasVerifiedEmail()) {
        //     Auth::logout();
        //     return redirect()->back()->withErrors(['email' => 'Your email is not verified. Please verify your email to login.']);
        // }

        $request->session()->regenerate();

        // initialize the tenant
        // dd($request->getHost());
        // $domain = Domain::where('domain', $request->getHost())->first();
        // $tenant = $domain->tenant;
        // tenancy()->initialize($tenant);

        // redirect based on user role
        if (auth()->user()->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }

        if (auth()->user()->hasRole('super_admin')) {
            return redirect()->route('super_admin.dashboard');
        }
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

    /**
     * Display the verify email page.
     *
     * @return \Inertia\Response
     */
    public function show_verify_email()
    {
        return Inertia::render('Auth/VerifyEmail');
    }

    /**
     * Verify the user's email.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify_email($request)
    {
        dd($request->route('id'), $request->route('hash'));
        // $request->fullfill();

        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('landing');
        }
    }
}
