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

// Home
Route::get('/', [PortalController::class, 'home'])->name('home');

// Portal Reimburse
Route::get('/reimburse', [PortalController::class, 'reimburse'])->name('reimburse');

// Portal Sertifikat
Route::get('/sertifikat', [PortalController::class, 'sertifikat'])->name('sertifikat');

/*
|--------------------------------------------------------------------------
| Auth Routes (Admin Login)
|--------------------------------------------------------------------------
*/

// Tampilkan form login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Proses login
Route::post('/login', [AuthController::class, 'login']);

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Admin Routes (CRUD Reimburse)
|--------------------------------------------------------------------------
*/

// Semua route di dalam group ini hanya bisa diakses jika sudah login
Route::middleware('auth')->prefix('admin')->group(function() {

    // Dashboard
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');

    // Form Tambah
    Route::get('/create', [AdminController::class, 'create'])->name('admin.create');

    // Simpan data baru
    Route::post('/', [AdminController::class, 'store'])->name('admin.store');

    // Form Edit
    Route::get('/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit');

    // Update data
    Route::put('/{id}', [AdminController::class, 'update'])->name('admin.update');

    // Hapus data
    Route::delete('/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
});
