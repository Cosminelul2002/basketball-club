<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminJoinController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JoinController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\PlayerGroupController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\TeamController;
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
Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/media', [MediaController::class, 'index'])->name('media');
Route::get('/join', [JoinController::class, 'index'])->name('join.index');
Route::post('/join', [JoinController::class, 'store'])->name('join.store');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::apiResource('categories', CategoryController::class);
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

Route::name("admin.")->prefix('/admin')->group(function () use ($allMethods) {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::name("dashboard.")->prefix('/dashboard')->group(function () use ($allMethods) {
        Route::name("players.")->prefix('/players')->group(function () use ($allMethods) {
            Route::get('/', [PlayerController::class, 'index'])->name('index');
            Route::get('/create', [PlayerController::class, 'create'])->name('create');
            Route::post('/create', [PlayerController::class, 'store'])->name('store');
            Route::get('/{player}', [PlayerController::class, 'show'])->name('show');
            Route::get('/{player}/edit', [PlayerController::class, 'edit'])->name('edit');
            Route::put('/{player}', [PlayerController::class, 'update'])->name('update');
            Route::delete('/{player}', [PlayerController::class, 'destroy'])->name('destroy');
        });
        Route::name('coaches.')->prefix('/coaches')->group(function () use ($allMethods) {
            Route::get('/', [CoachController::class, 'index'])->name('index');
            Route::get('/create', [CoachController::class, 'create'])->name('create');
            Route::post('/create', [CoachController::class, 'store'])->name('store');
            Route::get('/{coach}', [CoachController::class, 'show'])->name('show');
            Route::get('/{coach}/edit', [CoachController::class, 'edit'])->name('edit');
            Route::put('/{coach}', [CoachController::class, 'update'])->name('update');
            Route::delete('/{coach}', [CoachController::class, 'destroy'])->name('destroy');
        });
        Route::name("groups.")->prefix('/groups')->group(function () use ($allMethods) {
            Route::get('/', [PlayerGroupController::class, 'index'])->name('index');
            Route::get('/create', [PlayerGroupController::class, 'create'])->name('create');
            Route::post('/create', [PlayerGroupController::class, 'store'])->name('store');
            Route::get('/{group}', [PlayerGroupController::class, 'show'])->name('show');
            Route::get('/{group}/edit', [PlayerGroupController::class, 'edit'])->name('edit');
            Route::put('/{group}', [PlayerGroupController::class, 'update'])->name('update');
            Route::delete('/{group}', [PlayerGroupController::class, 'destroy'])->name('destroy');
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
            Route::get('/{category}/edit', [AdminCategoryController::class, 'edit'])->name('edit');
            Route::put('/{category}', [AdminCategoryController::class, 'update'])->name('update');
            Route::delete('/{category}', [AdminCategoryController::class, 'destroy'])->name('destroy');
        });
    });
});

Route::name('player.')->prefix('/player')->group(function () {
    Route::get('/dashboard', [PlayerController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [PlayerController::class, 'profile'])->name('profile');
    Route::get('/edit', [PlayerController::class, 'edit'])->name('edit');
    Route::put('/update', [PlayerController::class, 'update'])->name('update');
});

Route::name('parent.')->prefix('/parent')->group(function () {
    Route::get('/dashboard', [ParentController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [ParentController::class, 'profile'])->name('profile');
    Route::get('/edit', [ParentController::class, 'edit'])->name('edit');
    Route::post('/update', [ParentController::class, 'update'])->name('update');
});

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('auth.logout');
Route::post('/login', [LoginController::class, 'login'])->name('auth.login.post');
Route::get('/reset-password', [LoginController::class, 'showForgotPass'])->middleware('guest')->name('password.request');
Route::post('/reset-password', [LoginController::class, 'sendResetLink'])->middleware('guest')->name('password.email');
Route::get('/reset-password/{token}/{email}', [LoginController::class, 'showResetForm'])->middleware('guest')->name('password.reset');
Route::post('/reset-password/form', [LoginController::class, 'resetPassword'])->middleware('guest')->name('password.update');
Route::get('/register', [RegisterController::class, 'show'])->name('auth.register');
Route::post('/register', [RegisterController::class, 'register'])->name('auth.register.post');


// Route::get('/home', [HomeController::class, 'index'])->name('home');

// Route::name('events.')->prefix('events')->group(function () {
//     Route::get('/', [EventController::class, 'index'])->name('index');
// });
// Route::resource('events', EventController::class);

// Route::name('players.')->prefix('/players')->group(function () {
//     Route::get('/', [PlayerController::class, 'index'])->name('index');
// });
// Route::resource('players', PlayerController::class);

// Route::name('activities.')->prefix('/activities')->group(function () {
//     Route::get('/', [ActivityController::class, 'index'])->name('index');
// });
// Route::resource('activities', ActivityController::class);

// Route::name('teams.')->prefix('/teams')->group(function () {
//     Route::get('/', [TeamController::class, 'index'])->name('index');
// });
// Route::resource('teams', TeamController::class);
