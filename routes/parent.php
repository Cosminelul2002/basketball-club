<?php

/*
|--------------------------------------------------------------------------
| Parent Routes
|--------------------------------------------------------------------------
|
| Here is where you can register parent web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\ParentController;
use Illuminate\Support\Facades\Route;

Route::name('parent.')->prefix('/parent')->group(function () {
    Route::get('/dashboard', [ParentController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [ParentController::class, 'profile'])->name('profile');
    Route::get('/edit', [ParentController::class, 'edit'])->name('edit');
    Route::post('/update', [ParentController::class, 'update'])->name('update');
});
