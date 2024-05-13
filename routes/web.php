<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminJoinController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admin\AdminCoachController;
use App\Http\Controllers\Admin\AdminLocationController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JoinController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\Admin\AdminPlayerController;
use App\Http\Controllers\Admin\AdminPlayerGroupController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;
use Stripe\Stripe;

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
        Route::apiResource('categories', CategoryController::class);
        Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
        Route::get('/coaches', [CoachController::class, 'index'])->name('coaches');
        Route::get('/coaches/{coach}', [CoachController::class, 'show'])->name('coaches.show');
    });
}