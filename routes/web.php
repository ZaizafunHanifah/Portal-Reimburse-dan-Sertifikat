<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortalController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\SertifikatController;
use App\Http\Controllers\Admin\SertifikatNonPsoController;
use App\Http\Controllers\Admin\PegawaiController;

/*
|--------------------------------------------------------------------------
| Public Routes (Portal)
|--------------------------------------------------------------------------
*/
Route::get('/', [PortalController::class, 'home'])->name('home');
Route::get('/sertifikat', [PortalController::class, 'sertifikat']);
Route::get('/reimburse', [PortalController::class, 'reimburse']);

// Portal Sertifikat Non PSO (pencarian berdasarkan NIK)
Route::get('/sertifikat-nonpso', [PortalController::class, 'sertifikatNonPso'])->name('portal.nonpso');

// Portal Sertifikat (pencarian berdasarkan NRP)
Route::get('/sertifikat/search', [SertifikatController::class, 'searchByNrp'])->name('sertifikat.search');

// Portal Reimburse (pencarian berdasarkan nomor sertifikat)
Route::get('/reimburse/search', [PortalController::class, 'searchReimburseByNomorSertifikat'])->name('reimburse.search');

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
| Admin Dashboard & Master Data
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/admin', [SertifikatController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/sertifikat', [SertifikatController::class, 'psoIndex'])->name('admin.sertifikat.dashboard');
    Route::get('/admin/nonpso', [SertifikatNonPsoController::class, 'index'])->name('admin.nonpso.dashboard');

    /*
    |--------------------------------------------------------------------------
    | CRUD Reimburse (admin)
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/create', [SertifikatController::class, 'create'])->name('create');
        Route::post('/', [SertifikatController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [SertifikatController::class, 'edit'])->name('edit');
        Route::put('/{id}', [SertifikatController::class, 'update'])->name('update');
        Route::delete('/{id}', [SertifikatController::class, 'destroy'])->name('destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | CRUD Sertifikat PSO
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin/sertifikat')->name('admin.sertifikat.')->group(function () {
        Route::get('/create', [SertifikatController::class, 'psoCreate'])->name('create');
        Route::post('/', [SertifikatController::class, 'psoStore'])->name('store');
        Route::get('/{id}/edit', [SertifikatController::class, 'psoEdit'])->name('edit');
        Route::put('/{id}', [SertifikatController::class, 'psoUpdate'])->name('update');
        Route::delete('/{id}', [SertifikatController::class, 'psoDestroy'])->name('destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | CRUD Sertifikat Non PSO
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin/nonpso')->name('admin.nonpso.')->group(function () {
        Route::get('/create', [SertifikatNonPsoController::class, 'create'])->name('create');
        Route::post('/', [SertifikatNonPsoController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [SertifikatNonPsoController::class, 'edit'])->name('edit');
        Route::put('/{id}', [SertifikatNonPsoController::class, 'update'])->name('update');
        Route::delete('/{id}', [SertifikatNonPsoController::class, 'destroy'])->name('destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | CRUD Pegawai
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')->group(function () {
        Route::get('pegawai', [PegawaiController::class, 'index'])->name('admin.pegawai.index');
        Route::post('pegawai', [PegawaiController::class, 'store'])->name('admin.pegawai.store');
        Route::put('pegawai/{id}', [PegawaiController::class, 'update'])->name('admin.pegawai.update');
        Route::delete('pegawai/{id}', [PegawaiController::class, 'destroy'])->name('admin.pegawai.destroy');
        Route::post('pegawai/import', [PegawaiController::class, 'import'])->name('admin.pegawai.import');
    });

});