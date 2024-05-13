<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailVerificationRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ResetLinkRequest;
use App\Http\Requests\ResetPasswordRequest;
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
        return $this->login_tenant($request);
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

    /**
     * Display the forgot password page.
     *
     * @return \Inertia\Response
     */
    public function showForgotPass()
    {
        return Inertia::render('Auth/ForgotPassword');
    }

    /**
     * Send a reset password link to the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendResetLink(ResetLinkRequest $request)
    {
        return $this->send_reset_link($request);
    }

    /**
     * Display the reset password form.
     *
     * @param  string  $token
     * @param  string  $email
     * @return \Inertia\Response
     */
    public function showResetForm(string $token, string $email)
    {
        return $this->show_reset_form($token, $email);
    }

    /**
     * Reset the user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resetPassword(ResetPasswordRequest $request)
    {
        return $this->reset_password($request);
    }

    /**
     * Show the email verification notice.
     *
     * @return \Inertia\Response
     */
    public function showVerifyEmail()
    {
        return $this->show_verify_email();
    }

    /**
     * Verify the user's email address.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verifyEmail(EmailVerificationRequest $request)
    {
        return $this->verify_email($request);
    }
}
