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
use App\Http\Controllers\JoinController;
use Illuminate\Support\Facades\Route;

$allMethods = ['index', 'show', 'store', 'update', 'destroy', 'create', 'edit'];
Route::name("admin.")->prefix('/admin')->group(function () use ($allMethods) {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::name("dashboard.")->prefix('/dashboard')->group(function () use ($allMethods) {
        Route::name("players.")->prefix('/players')->group(function () use ($allMethods) {
            Route::get('/', [AdminPlayerController::class, 'index'])->name('index');
            Route::get('/create', [AdminPlayerController::class, 'create'])->name('create');
            Route::post('/create', [AdminPlayerController::class, 'store'])->name('store');
            Route::get('/{player}', [AdminPlayerController::class, 'show'])->name('show');
            Route::get('/{player}/edit', [AdminPlayerController::class, 'edit'])->name('edit');
            Route::put('/{player}', [AdminPlayerController::class, 'update'])->name('update');
            Route::delete('/{player}', [AdminPlayerController::class, 'destroy'])->name('destroy');
        });
        Route::name('coaches.')->prefix('/coaches')->group(function () use ($allMethods) {
            Route::get('/', [AdminCoachController::class, 'index'])->name('index');
            Route::get('/create', [AdminCoachController::class, 'create'])->name('create');
            Route::post('/create', [AdminCoachController::class, 'store'])->name('store');
            Route::get('/{coach}', [AdminCoachController::class, 'show'])->name('show');
            Route::get('/{coach}/edit', [AdminCoachController::class, 'edit'])->name('edit');
            Route::put('/{coach}', [AdminCoachController::class, 'update'])->name('update');
            Route::delete('/{coach}', [AdminCoachController::class, 'destroy'])->name('destroy');
        });
        Route::name("groups.")->prefix('/groups')->group(function () use ($allMethods) {
            Route::get('/', [AdminPlayerGroupController::class, 'index'])->name('index');
            Route::get('/create', [AdminPlayerGroupController::class, 'create'])->name('create');
            Route::post('/create', [AdminPlayerGroupController::class, 'store'])->name('store');
            Route::get('/{group}', [AdminPlayerGroupController::class, 'show'])->name('show');
            Route::get('/{group}/edit', [AdminPlayerGroupController::class, 'edit'])->name('edit');
            Route::put('/{group}', [AdminPlayerGroupController::class, 'update'])->name('update');
            Route::delete('/{group}', [AdminPlayerGroupController::class, 'destroy'])->name('destroy');
        });
        Route::name("joins.")->prefix('/joins')->group(function () use ($allMethods) {
            Route::get('/', [AdminJoinController::class, 'index'])->name('index');
            Route::post('approve/{join}', [AdminJoinController::class, 'approve'])->name('approve');
            Route::delete('/{join}', [JoinController::class, 'destroy'])->name('destroy');
        });
        Route::name('products.')->prefix('/products')->group(function () use ($allMethods) {
            Route::get('/', [AdminProductController::class, 'index'])->name('index');
            Route::get('/create', [AdminProductController::class, 'create'])->name('create');
            Route::post('/create', [AdminProductController::class, 'store'])->name('store');
            Route::get('/{product}', [AdminProductController::class, 'show'])->name('show');
            Route::get('/{product}/edit', [AdminProductController::class, 'edit'])->name('edit');
            Route::put('/{product}', [AdminProductController::class, 'update'])->name('update');
            Route::delete('/{product}', [AdminProductController::class, 'destroy'])->name('destroy');
        });
        Route::name('categories.')->prefix('/categories')->group(function () use ($allMethods) {
            Route::get('/', [AdminCategoryController::class, 'index'])->name('index');
            Route::get('/create', [AdminCategoryController::class, 'create'])->name('create');
            Route::post('/create', [AdminCategoryController::class, 'store'])->name('store');
            Route::get('/{category}', [AdminCategoryController::class, 'show'])->name('show');
            Route::get('/{category}/add-products', [AdminCategoryController::class, 'addProdcuts'])->name('add-products');
            Route::post('/{category}/add-products', [AdminCategoryController::class, 'storeProducts'])->name('store-products');
            Route::get('/{category}/edit', [AdminCategoryController::class, 'edit'])->name('edit');
            Route::put('/{category}', [AdminCategoryController::class, 'update'])->name('update');
            Route::delete('/{category}', [AdminCategoryController::class, 'destroy'])->name('destroy');
        });
        Route::name('locations.')->prefix('/locations')->group(function () use ($allMethods) {
            Route::get('/', [AdminLocationController::class, 'index'])->name('index');
            Route::get('/create', [AdminLocationController::class, 'create'])->name('create');
            Route::post('/create', [AdminLocationController::class, 'store'])->name('store');
            Route::get('/{location}', [AdminLocationController::class, 'show'])->name('show');
            Route::get('/{location}/edit', [AdminLocationController::class, 'edit'])->name('edit');
            Route::put('/{location}', [AdminLocationController::class, 'update'])->name('update');
            Route::delete('/{location}', [AdminLocationController::class, 'destroy'])->name('destroy');
        });
    });
});
