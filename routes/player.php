<?php

/*
|--------------------------------------------------------------------------
| Player Routes
|--------------------------------------------------------------------------
|
| Here is where you can register player web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\Admin\AdminPlayerController;
use Illuminate\Support\Facades\Route;

Route::name('player.')->prefix('/player')->group(function () {
    Route::get('/dashboard', [AdminPlayerController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [AdminPlayerController::class, 'profile'])->name('profile');
    Route::get('/edit', [AdminPlayerController::class, 'edit'])->name('edit');
    Route::put('/update', [AdminPlayerController::class, 'update'])->name('update');
});
