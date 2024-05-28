<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\DashboardController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('doLogin');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('forgot-password',[ForgotPasswordController::class, 'showLinkRequest'])->name('showLinkRequest');
Route::post('forgot-password',[ForgotPasswordController::class, 'sendResetEmail'])->name('sendResetEmail');
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showReset'])->name('password.reset');
Route::post('reset-pasword', [ResetPasswordController::class, 'reset'])->name('reset');

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
