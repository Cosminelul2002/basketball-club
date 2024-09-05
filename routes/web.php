<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\JoinController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LoginTenantController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterTenantController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\SuperAdmin\SuperAdminController;
use App\Http\Controllers\SuperAdmin\SuperAdminTenantController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

$allMethods = ['index', 'show', 'store', 'update', 'destroy', 'create', 'edit'];

foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {

        // your actual routes
        Route::get('/', [LandingController::class, 'index'])->name('landing');
        Route::get('/about', [AboutController::class, 'index'])->name('about');
        Route::get('/media', [MediaController::class, 'index'])->name('media');
        Route::get('/join', [JoinController::class, 'create'])->name('join.create');
        Route::post('/join', [JoinController::class, 'store'])->name('join.store');
        Route::get('/contact', [ContactController::class, 'index'])->name('contact');
        Route::get('/shop', [ShopController::class, 'index'])->name('shop');
        Route::get('/subscribe', [SubscribeController::class, 'index'])->name('subscriptions');
        Route::apiResource('categories', CategoryController::class);
        Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
        Route::get('/coaches', [CoachController::class, 'index'])->name('coaches');
        Route::get('/coaches/{coach}', [CoachController::class, 'show'])->name('coaches.show');

        Route::name('auth.')->prefix('/auth')->group(function () {
            Route::get('/register', [RegisterTenantController::class, 'show'])->name('register');
            Route::post('/register', [RegisterTenantController::class, 'store'])->name('register.post');
        });

        Route::name('auth.')->prefix('/auth')->group(function () {
            Route::get('/login', [LoginController::class, 'index'])->name('login');
            Route::get('/logout', [LoginTenantController::class, 'logout'])->name('logout');
            Route::post('/login', [LoginTenantController::class, 'login'])->name('login.post');
        });

        Route::name("super_admin.")->prefix('/master')->group(function () {
            Route::get('/dashboard', [SuperAdminController::class, 'dashboard'])->name('dashboard');
            Route::name('dashboard.')->prefix('/dashboard')->group(function () {
                Route::resources([
                    'tenants' => SuperAdminTenantController::class,
                ]);
                // Route::get('/categories', [SuperAdminController::class, 'categories'])->name('categories');
                // Route::get('/products', [SuperAdminController::class, 'products'])->name('products');
                // Route::get('/coaches', [SuperAdminController::class, 'coaches'])->name('coaches');
                // Route::get('/tenants', [SuperAdminTenantController::class, 'index'])->name('tenants');
            });
        });

        // Password reset routes
        Route::get('/reset-password', [LoginController::class, 'showForgotPass'])->middleware('guest')->name('password.request');
        Route::post('/reset-password', [LoginController::class, 'sendResetLink'])->middleware('guest')->name('password.email');
        Route::get('/reset-password/{token}/{email}', [LoginController::class, 'showResetForm'])->middleware('guest')->name('password.reset');
        Route::post('/reset-password/form', [LoginController::class, 'resetPassword'])->middleware('guest')->name('password.update');

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
