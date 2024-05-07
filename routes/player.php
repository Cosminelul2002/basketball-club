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

use App\Http\Controllers\PlayerController;
use Illuminate\Support\Facades\Route;

Route::middleware('verified')->group(function () {
    Route::prefix('player')->name('player.')->group(function () {
        Route::get('/dashboard', [PlayerController::class, 'dashboard'])->name('dashboard');
    });
});
