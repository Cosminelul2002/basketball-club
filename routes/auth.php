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

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('auth.logout');
Route::post('/login', [LoginController::class, 'login'])->name('auth.login.post');
Route::get('/reset-password', [LoginController::class, 'showForgotPass'])->middleware('guest')->name('password.request');
Route::post('/reset-password', [LoginController::class, 'sendResetLink'])->middleware('guest')->name('password.email');
Route::get('/reset-password/{token}/{email}', [LoginController::class, 'showResetForm'])->middleware('guest')->name('password.reset');
Route::post('/reset-password/form', [LoginController::class, 'resetPassword'])->middleware('guest')->name('password.update');
Route::get('/register', [RegisterController::class, 'show'])->name('auth.register');
Route::post('/register', [RegisterController::class, 'register'])->name('auth.register.post');
