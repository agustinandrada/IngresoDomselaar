<?php

use App\Http\Controllers\OwnerController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\VisitorController;
use App\Http\Middleware\CheckAuthenticated;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorizedController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\UserController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

// Ruta para la página de inicio de sesión sin el middleware
Route::get('estancias/login', [AuthController::class, 'showLoginForm'])->name('login')
    ->middleware(\App\Http\Middleware\ReloadCache::class);
Route::post('estancias/login', [AuthController::class, 'login']);

// Rutas protegidas por el middleware CheckAuthenticated
Route::middleware([CheckAuthenticated::class])->group(function () {
    Route::prefix('estancias')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        // Ruta para la dashboard
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware(\App\Http\Middleware\ReloadCache::class, \App\Http\Middleware\CloseSession::class);

        // Rutas para historial de entradas y salidas
        Route::get('/entry-list', [DashboardController::class, 'getAllData'])->name('history')->middleware(\App\Http\Middleware\ReloadCache::class, \App\Http\Middleware\CloseSession::class);
        Route::post('/entry/period', [DashboardController::class, 'getPeriod'])->name('history-search-period')->middleware(\App\Http\Middleware\ReloadCache::class, \App\Http\Middleware\CloseSession::class);
        Route::post('/entry/condition', [DashboardController::class, 'getCondition'])->name('history-search-condition')->middleware(\App\Http\Middleware\ReloadCache::class, \App\Http\Middleware\CloseSession::class);
        Route::post('/entry/type', [DashboardController::class, 'getType'])->name('history-search-type')->middleware(\App\Http\Middleware\ReloadCache::class, \App\Http\Middleware\CloseSession::class);

        // Rutas para soporte técnico
        Route::get('/technical-support', function () {
            return view('admin.soporte');
        })->name('technical-support');

        // Rutas de exportación
        Route::get('/export-owners', [ExportController::class, 'exportOwners'])->name('export-owners');
        Route::get('/export-authorized', [ExportController::class, 'exportAuthorized'])->name('export-authorized');
        Route::get('/export-visitors', [ExportController::class, 'exportVisitors'])->name('export-visitors');
        Route::get('/export-tenants', [ExportController::class, 'exportTenants'])->name('export-tenants');
        Route::get('/export-history', [ExportController::class, 'exportHistory'])->name('export-history');

        // Rutas administrativas
        Route::get('/manage-users', [UserController::class, 'manage'])->name('manage-users')->middleware(\App\Http\Middleware\ReloadCache::class, \App\Http\Middleware\CloseSession::class);
        Route::get('/create-user', [UserController::class, 'create'])->name('create-user')->middleware(\App\Http\Middleware\CloseSession::class);
        Route::get('/edit-user/{id}', [UserController::class, 'edit'])->name('edit-user')->middleware(\App\Http\Middleware\CloseSession::class);
        Route::get('/view-user/{id}', [UserController::class, 'view'])->name('view-user')->middleware(\App\Http\Middleware\CloseSession::class);
        Route::post('/store-user', [UserController::class, 'store'])->name('store-user');
        Route::post('/delete-user/{id}', [UserController::class, 'delete'])->name('delete-user');
        Route::post('/update-user/{id}', [UserController::class, 'update'])->name('update-user');

        // Rutas de restablecimiento de contraseña
        Route::get('password/reset', [AuthController::class, 'resetPassword'])->name('password.request');
        Route::post('password/email', [AuthController::class, 'sendResetLink'])->name('sendCode');
        Route::get('password/reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
        Route::post('password/reset', [AuthController::class, 'reset'])->name('password.update');

        // Rutas para propietarios
        Route::get('owner-list', [OwnerController::class, 'index'])->name('owner-list')->middleware(\App\Http\Middleware\ReloadCache::class, \App\Http\Middleware\CloseSession::class);
        Route::get('create-owner', [OwnerController::class, 'create'])->name('create-owner')->middleware(\App\Http\Middleware\CloseSession::class);
        Route::get('edit-owner/{id}', [OwnerController::class, 'edit'])->name('edit-owner')->middleware(\App\Http\Middleware\CloseSession::class);
        Route::get('view-owner/{id}', [OwnerController::class, 'view'])->name('view-owner')->middleware(\App\Http\Middleware\CloseSession::class);
        Route::post('store-owner', [OwnerController::class, 'store'])->name('store-owner');
        Route::post('delete-owner/{id}', [OwnerController::class, 'delete'])->name('delete-owner');
        Route::post('update-owner/{id}', [OwnerController::class, 'update'])->name('update-owner');

        // Rutas para autorizados
        Route::get('/authorized-list', [AuthorizedController::class, 'index'])->name('authorized-list')->middleware(\App\Http\Middleware\ReloadCache::class, \App\Http\Middleware\CloseSession::class);
        Route::get('/create-authorized', [AuthorizedController::class, 'create'])->name('create-authorized')->middleware(\App\Http\Middleware\CloseSession::class);
        Route::get('/edit-authorized/{id}', [AuthorizedController::class, 'edit'])->name('edit-authorized')->middleware(\App\Http\Middleware\CloseSession::class);
        Route::get('/view-authorized/{id}', [AuthorizedController::class, 'view'])->name('view-authorized')->middleware(\App\Http\Middleware\CloseSession::class);
        Route::post('/store-authorized', [AuthorizedController::class, 'store'])->name('store-authorized');
        Route::post('/delete-authorized/{id}', [AuthorizedController::class, 'delete'])->name('delete-authorized');
        Route::post('/update-authorized/{id}', [AuthorizedController::class, 'update'])->name('update-authorized');

        // Rutas para visitantes
        Route::get('/visitor-list', [VisitorController::class, 'index'])->name('visitor-list')->middleware(\App\Http\Middleware\ReloadCache::class, \App\Http\Middleware\CloseSession::class);
        Route::get('/create-visitor', [VisitorController::class, 'create'])->name('create-visitor')->middleware(\App\Http\Middleware\CloseSession::class);
        Route::get('/edit-visitor/{id}', [VisitorController::class, 'edit'])->name('edit-visitor')->middleware(\App\Http\Middleware\CloseSession::class);
        Route::get('/view-visitor/{id}', [VisitorController::class, 'view'])->name('view-visitor')->middleware(\App\Http\Middleware\CloseSession::class);
        Route::post('/store-visitor', [VisitorController::class, 'store'])->name('store-visitor');
        Route::post('/delete-visitor/{id}', [VisitorController::class, 'delete'])->name('delete-visitor');
        Route::post('/update-visitor/{id}', [VisitorController::class, 'update'])->name('update-visitor');

        // Rutas para inquilinos
        Route::get('tenant-list', [TenantController::class, 'index'])->name('tenant-list')->middleware(\App\Http\Middleware\ReloadCache::class, \App\Http\Middleware\CloseSession::class);
        Route::get('create-tenant', [TenantController::class, 'create'])->name('create-tenant')->middleware(\App\Http\Middleware\CloseSession::class);
        Route::get('edit-tenant/{id}', [TenantController::class, 'edit'])->name('edit-tenant')->middleware(\App\Http\Middleware\CloseSession::class);
        Route::get('view-tenant/{id}', [TenantController::class, 'view'])->name('view-tenant')->middleware(\App\Http\Middleware\CloseSession::class);
        Route::post('store-tenant', [TenantController::class, 'store'])->name('store-tenant');
        Route::post('delete-tenant/{id}', [TenantController::class, 'delete'])->name('delete-tenant');
        Route::post('update-tenant/{id}', [TenantController::class, 'update'])->name('update-tenant');

        // Rutas para entradas y salidas
        Route::post('entry', [EntryController::class, 'search'])->name('entry-search')->middleware(\App\Http\Middleware\ReloadCache::class, \App\Http\Middleware\CloseSession::class);
        Route::post('store', [EntryController::class, 'store'])->name('entry-store')->middleware(\App\Http\Middleware\ReloadCache::class, \App\Http\Middleware\CloseSession::class);
    });
});
