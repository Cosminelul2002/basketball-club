<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminCoachController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminJoinController;
use App\Http\Controllers\Admin\AdminLocationController;
use App\Http\Controllers\Admin\AdminPlayerController;
use App\Http\Controllers\Admin\AdminPlayerGroupController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminCalendarController;
use App\Http\Controllers\Admin\AdminEventController;
use App\Http\Controllers\Admin\AdminSalaryController;
use App\Http\Controllers\Admin\AdminStaffController;
use App\Http\Controllers\Admin\AdminStaffRoleController;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SuperAdminController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    $allMethods = ['index', 'show', 'store', 'update', 'destroy', 'create', 'edit'];
    Route::get('/', [LandingController::class, 'tenant'])->name('tenant.landing');

    Route::name('auth.')->prefix('/auth')->group(function () {
        Route::get('/register', [RegisterController::class, 'show'])->name('register');
        Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
    });

    Route::name('auth.')->prefix('/auth')->group(function () {
        Route::get('/login', [LoginController::class, 'index'])->name('login');
        Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
        Route::post('/login', [LoginController::class, 'login'])->name('login.post');
        // Route::get('/register', [RegisterController::class, 'show'])->name('register');
        // Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
    });

    // Password reset routes
    Route::get('/reset-password', [LoginController::class, 'showForgotPass'])->middleware('guest')->name('password.request');
    Route::post('/reset-password', [LoginController::class, 'sendResetLink'])->middleware('guest')->name('password.email');
    Route::get('/reset-password/{token}/{email}', [LoginController::class, 'showResetForm'])->middleware('guest')->name('password.reset');
    Route::post('/reset-password/form', [LoginController::class, 'resetPassword'])->middleware('guest')->name('password.update');

    // Route::get('/login', [LoginController::class, 'index'])->name('login');
    // Email verification routes
    Route::get('/email/verify', function () {
        return inertia('Auth/VerifyEmail');
    })->middleware('auth')->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return inertia('Auth/EmailVerified');
    })->middleware(['signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');

    // Google login
    Route::get('/google/redirect', [GoogleLoginController::class, 'redirectToGoogle'])->name('google.redirect');
    Route::get('/google/callback', [GoogleLoginController::class, 'handleGoogleCallback'])->name('google.callback');

    // Super Admin routes
    Route::name("super-admin.")->prefix('/super-admin')->group(function () use ($allMethods) {
        Route::get('/dashboard', [SuperAdminController::class, 'dashboard'])->name('dashboard');
        // Route::name("dashboard.")->prefix('/dashboard')->group(function () use ($allMethods) {
        //     Route::resources([
        //         'players' => AdminPlayerController::class,
        //         'coaches' => AdminCoachController::class,
        //         'groups' => AdminPlayerGroupController::class,
        //         'calendar' => AdminCalendarController::class,
        //         'events' => AdminEventController::class,
        //         'products' => AdminProductController::class,
        //         'locations' => AdminLocationController::class,
        //         'categories' => AdminCategoryController::class,
        //         'salaries' => AdminSalaryController::class,
        //         'staff-roles' => AdminStaffRoleController::class,
        //         'staff' => AdminStaffController::class,
        //     ]);
        //     Route::post('groups/default-groups', [AdminPlayerGroupController::class, 'createDefaultGroups'])->name('groups.create-default-groups');
        //     Route::post('events/{event}/add-to-calendar', [AdminEventController::class, 'addToCalendar'])->name('events.add-to-calendar');
        //     Route::post('joins/{join}/approve', [AdminJoinController::class, 'approve'])->name('joins.approve');
        //     Route::get('categories/{category}/add-products', [AdminCategoryController::class, 'addProdcuts'])->name('categories.add-products');
        //     Route::post('categories/{category}/add-products', [AdminCategoryController::class, 'storeProducts'])->name('categories.store-products');
        // });
    });

    // Admin routes
    Route::name("admin.")->prefix('/admin')->group(function () use ($allMethods) {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::name("dashboard.")->prefix('/dashboard')->group(function () use ($allMethods) {
            Route::resources([
                'players' => AdminPlayerController::class,
                'coaches' => AdminCoachController::class,
                'groups' => AdminPlayerGroupController::class,
                'calendar' => AdminCalendarController::class,
                'events' => AdminEventController::class,
                'products' => AdminProductController::class,
                'locations' => AdminLocationController::class,
                'categories' => AdminCategoryController::class,
                'salaries' => AdminSalaryController::class,
                'staff-roles' => AdminStaffRoleController::class,
                'staff' => AdminStaffController::class,
            ]);
            Route::post('groups/default-groups', [AdminPlayerGroupController::class, 'createDefaultGroups'])->name('groups.create-default-groups');
            Route::post('events/{event}/add-to-calendar', [AdminEventController::class, 'addToCalendar'])->name('events.add-to-calendar');
            Route::post('joins/{join}/approve', [AdminJoinController::class, 'approve'])->name('joins.approve');
            Route::get('categories/{category}/add-products', [AdminCategoryController::class, 'addProdcuts'])->name('categories.add-products');
            Route::post('categories/{category}/add-products', [AdminCategoryController::class, 'storeProducts'])->name('categories.store-products');
        });
    });

    // Parent routes
    Route::name('parent.')->prefix('/parent')->group(function () {
        Route::get('/dashboard', [ParentController::class, 'dashboard'])->name('dashboard');
    });

    // Player routes
    Route::name('player.')->prefix('/player')->group(function () {
        Route::get('/dashboard', [PlayerController::class, 'dashboard'])->name('dashboard');
    });
});
