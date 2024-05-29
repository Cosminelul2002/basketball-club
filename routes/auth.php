<?php

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
|
| Here is where you can register auth web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LoginTenantController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RegisterTenantController;
use App\Http\Controllers\SuperAdminController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {
        // your actual routes
        // Auth routes
        Route::name('auth.')->prefix('/auth')->group(function () {
            Route::get('/register', [RegisterTenantController::class, 'show'])->name('register');
            Route::post('/register', [RegisterTenantController::class, 'store'])->name('register.post');
        });

        Route::name('auth.')->prefix('/auth')->group(function () {
            Route::get('/login', [LoginController::class, 'index'])->name('login');
            Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
            Route::post('/login', [LoginTenantController::class, 'login'])->name('login.post');
        });

        Route::name("super_admin.")->prefix('/master')->group(function () {
            Route::get('/dashboard', [SuperAdminController::class, 'dashboard'])->name('dashboard');
            // Route::name("dashboard.")->prefix('/dashboard')->group(function () {
            //     Route::resources([
            //         'players' => AdminPlayerController::class,
            //         'coaches' => AdminCoachController::class,
            //         'groups' => AdminPlayerGroupController::class,
            //         'joins' => AdminJoinController::class,
            //         'products' => AdminProductController::class,
            //         'locations' => AdminLocationController::class,
            //         'categories' => AdminCategoryController::class,
            //     ]);
            //     Route::post('joins/{join}/approve', [AdminJoinController::class, 'approve'])->name('joins.approve');
            //     Route::get('categories/{category}/add-products', [AdminCategoryController::class, 'addProdcuts'])->name('categories.add-products');
            //     Route::post('categories/{category}/add-products', [AdminCategoryController::class, 'storeProducts'])->name('categories.store-products');
            // });
        });

        // // Password reset routes
        // Route::get('/reset-password', [LoginController::class, 'showForgotPass'])->middleware('guest')->name('password.request');
        // Route::post('/reset-password', [LoginController::class, 'sendResetLink'])->middleware('guest')->name('password.email');
        // Route::get('/reset-password/{token}/{email}', [LoginController::class, 'showResetForm'])->middleware('guest')->name('password.reset');
        // Route::post('/reset-password/form', [LoginController::class, 'resetPassword'])->middleware('guest')->name('password.update');

        // // Route::get('/login', [LoginController::class, 'index'])->name('login');
        // // Email verification routes
        // Route::get('/email/verify', function () {
        //     return inertia('Auth/VerifyEmail');
        // })->middleware('auth')->name('verification.notice');

        // Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        //     $request->fulfill();

        //     return inertia('Auth/EmailVerified');
        // })->middleware(['signed'])->name('verification.verify');

        // Route::post('/email/verification-notification', function (Request $request) {
        //     $request->user()->sendEmailVerificationNotification();

        //     return back()->with('message', 'Verification link sent!');
        // })->middleware(['auth', 'throttle:6,1'])->name('verification.send');

        // // Google login
        Route::get('/google/redirect', [GoogleLoginController::class, 'redirectToGoogle'])->name('google.redirect');
        Route::get('/google/callback', [GoogleLoginController::class, 'handleGoogleCallback'])->name('google.callback');
    });
}
