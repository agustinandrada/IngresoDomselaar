<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

Route::prefix('estancias')->group(function () {
    Route::get('/', function () {
        return view('login');
    })->name('login');

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware(\App\Http\Middleware\ReloadCache::class);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    //* ADMIN ROUTES */

    Route::get('/manage-users', [UserController::class, 'manage'])->name('manage-users')->middleware(\App\Http\Middleware\ReloadCache::class);
    Route::get('/create-user', [UserController::class, 'create'])->name('create-user');
    Route::get('/edit-user/{id}', [UserController::class, 'edit'])->name('edit-user');
    Route::get('/view-user/{id}', [UserController::class, 'view'])->name('view-user');

    Route::post('/store-user', [UserController::class, 'store'])->name('store-user');
    Route::post('/delete-user/{id}', [UserController::class, 'delete'])->name('delete-user');
    Route::post('/update-user/{id}', [UserController::class, 'update'])->name('update-user');

    //* FORGOT PASSWORD ROUTES */

    Route::get('password/reset', [AuthController::class, 'resetPassword'])->name('password.request');
    Route::post('password/email', [AuthController::class, 'sendResetLink'])->name('sendCode');
    Route::get('password/reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [AuthController::class, 'reset'])->name('password.update');

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware(\App\Http\Middleware\ReloadCache::class);
});
