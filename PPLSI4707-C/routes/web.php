<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes — Kei (Logout Pengguna, Status Keanggotaan)
|--------------------------------------------------------------------------
*/

// Authenticated routes
Route::middleware('auth')->group(function () {
    // Logout Pengguna
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Status Keanggotaan — Admin mengubah status anggota
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/anggota/{id}', [AdminController::class, 'showAnggota'])->name('anggota.show');
        Route::put('/anggota/{id}/status', [AdminController::class, 'updateStatus'])->name('anggota.status');
    });

    // Anggota melihat status keanggotaan sendiri
    Route::middleware('role:anggota')->prefix('anggota')->name('anggota.')->group(function () {
        Route::get('/dashboard', [AnggotaController::class, 'dashboard'])->name('dashboard');
    });
});
