<?php

use App\Http\Controllers\OwnerController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\VisitorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorizedController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\UserController;

Route::prefix('estancias')->group(function () {
    Route::get('/', function () {
        return view('login');
    })->name('login');

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware(\App\Http\Middleware\ReloadCache::class);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    //* EXPORT ROUTES */

    Route::get('/export-owners', [ExportController::class, 'exportOwners'])->name('export-owners');
    Route::get('/export-authorized', [ExportController::class, 'exportAuthorized'])->name('export-authorized');
    Route::get('/export-visitors', [ExportController::class, 'exportVisitors'])->name('export-visitors');
    Route::get('/export-tenants', [ExportController::class, 'exportTenants'])->name('export-tenants');

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

    //* OWNER ROUTES */

    Route::get('owner-list', [OwnerController::class, 'index'])->name('owner-list')->middleware(\App\Http\Middleware\ReloadCache::class);;
    Route::get('create-owner', [OwnerController::class, 'create'])->name('create-owner');
    Route::get('edit-owner/{id}', [OwnerController::class, 'edit'])->name('edit-owner');
    Route::get('view-owner/{id}', [OwnerController::class, 'view'])->name('view-owner');
    Route::post('store-owner', [OwnerController::class, 'store'])->name('store-owner');
    Route::post('delete-owner/{id}', [OwnerController::class, 'delete'])->name('delete-owner');
    Route::post('update-owner/{id}', [OwnerController::class, 'update'])->name('update-owner');

    //* AUTHORIZED ROUTES */

    Route::get('/authorized-list', [AuthorizedController::class, 'index'])->name('authorized-list')->middleware(\App\Http\Middleware\ReloadCache::class);

    Route::get('/create-authorized', [AuthorizedController::class, 'create'])->name('create-authorized');
    Route::get('/edit-authorized/{id}', [AuthorizedController::class, 'edit'])->name('edit-authorized');
    Route::get('/view-authorized/{id}', [AuthorizedController::class, 'view'])->name('view-authorized');
    Route::post('/store-authorized', [AuthorizedController::class, 'store'])->name('store-authorized');
    Route::post('/delete-authorized/{id}', [AuthorizedController::class, 'delete'])->name('delete-authorized');
    Route::post('/update-authorized/{id}', [AuthorizedController::class, 'update'])->name('update-authorized');

    //* VISITOR ROUTES */

    Route::get('/visitor-list', [VisitorController::class, 'index'])->name('visitor-list')->middleware(\App\Http\Middleware\ReloadCache::class);
    Route::get('/create-visitor', [VisitorController::class, 'create'])->name('create-visitor');
    Route::get('/edit-visitor/{id}', [VisitorController::class, 'edit'])->name('edit-visitor');
    Route::get('/view-visitor/{id}', [VisitorController::class, 'view'])->name('view-visitor');
    Route::post('/store-visitor', [VisitorController::class, 'store'])->name('store-visitor');
    Route::post('/delete-visitor/{id}', [VisitorController::class, 'delete'])->name('delete-visitor');
    Route::post('/update-visitor/{id}', [VisitorController::class, 'update'])->name('update-visitor');

    //* TENANT ROUTES */

    Route::get('tenant-list', [TenantController::class, 'index'])->name('tenant-list')->middleware(\App\Http\Middleware\ReloadCache::class);;
    Route::get('create-tenant', [TenantController::class, 'create'])->name('create-tenant');
    Route::get('edit-tenant/{id}', [TenantController::class, 'edit'])->name('edit-tenant');
    Route::get('view-tenant/{id}', [TenantController::class, 'view'])->name('view-tenant');
    Route::post('store-tenant', [TenantController::class, 'store'])->name('store-tenant');
    Route::post('delete-tenant/{id}', [TenantController::class, 'delete'])->name('delete-tenant');
    Route::post('update-tenant/{id}', [TenantController::class, 'update'])->name('update-tenant');
});
