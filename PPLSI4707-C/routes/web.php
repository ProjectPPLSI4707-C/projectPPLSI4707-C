<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes — Fajri (Detail Data Anggota, Hapus Data Anggota)
|--------------------------------------------------------------------------
*/

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        // Daftar anggota — untuk mengakses detail dan hapus
        Route::get('/anggota', [AdminController::class, 'anggota'])->name('anggota');
        // Detail Data Anggota
        Route::get('/anggota/{id}', [AdminController::class, 'showAnggota'])->name('anggota.show');
        // Hapus Data Anggota
        Route::delete('/anggota/{id}', [AdminController::class, 'deleteAnggota'])->name('anggota.delete');
    });
});
