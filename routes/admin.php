<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminCoachController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminJoinController;
use App\Http\Controllers\Admin\AdminLocationController;
use App\Http\Controllers\Admin\AdminPlayerController;
use App\Http\Controllers\Admin\AdminPlayerGroupController;
use App\Http\Controllers\Admin\AdminProductController;
use Illuminate\Support\Facades\Route;

foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {
        // your actual routes
        $allMethods = ['index', 'show', 'store', 'update', 'destroy', 'create', 'edit'];
        Route::name("admin.")->prefix('/admin')->group(function () use ($allMethods) {
            Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
            Route::name("dashboard.")->prefix('/dashboard')->group(function () use ($allMethods) {
                Route::resources([
                    'players' => AdminPlayerController::class,
                    'coaches' => AdminCoachController::class,
                    'groups' => AdminPlayerGroupController::class,
                    'joins' => AdminJoinController::class,
                    'products' => AdminProductController::class,
                    'locations' => AdminLocationController::class,
                    'categories' => AdminCategoryController::class,
                ]);
                Route::post('joins/{join}/approve', [AdminJoinController::class, 'approve'])->name('joins.approve');
                Route::get('categories/{category}/add-products', [AdminCategoryController::class, 'addProdcuts'])->name('categories.add-products');
                Route::post('categories/{category}/add-products', [AdminCategoryController::class, 'storeProducts'])->name('categories.store-products');
            });
        });
    });
}
