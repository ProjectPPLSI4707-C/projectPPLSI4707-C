<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes — Rangga (Pendataan Anggota, Edit Data Anggota)
|--------------------------------------------------------------------------
*/

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        // Pendataan Anggota — daftar anggota
        Route::get('/anggota', [AdminController::class, 'anggota'])->name('anggota');
        // Edit Data Anggota
        Route::get('/anggota/{id}/edit', [AdminController::class, 'editAnggota'])->name('anggota.edit');
        Route::put('/anggota/{id}', [AdminController::class, 'updateAnggota'])->name('anggota.update');
    });
});
