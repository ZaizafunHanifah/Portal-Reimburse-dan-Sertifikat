<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortalController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [PortalController::class, 'home'])->name('home');

Route::get('/reimburse', [PortalController::class, 'reimburse'])->name('reimburse');

Route::get('/sertifikat', [PortalController::class, 'sertifikat'])->name('sertifikat');

/*
|--------------------------------------------------------------------------
| Auth Routes (Admin Login)
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Admin Routes (CRUD Reimburse)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->prefix('admin')->group(function() {

    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/create', [AdminController::class, 'create'])->name('admin.create');

    Route::post('/', [AdminController::class, 'store'])->name('admin.store');

    Route::get('/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit');

    Route::put('/{id}', [AdminController::class, 'update'])->name('admin.update');

    Route::delete('/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
});
