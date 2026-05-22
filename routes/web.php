<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Anggota;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

// ─── Root redirect ────────────────────────────────────────────────────────────
Route::get('/', function () {
    return redirect()->route('login');
});

// ─── Auth ─────────────────────────────────────────────────────────────────────
Route::get('/login',  [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register',  [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

// ─── Anggota ──────────────────────────────────────────────────────────────────
Route::prefix('anggota')->name('anggota.')->middleware(['auth', 'role:anggota'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [Anggota\DashboardController::class, 'index'])->name('dashboard');

    // Simpanan
    Route::get('/simpanan',        [Anggota\SimpananController::class, 'index'])->name('simpanan.index');
    Route::get('/simpanan/baru',   [Anggota\SimpananController::class, 'create'])->name('simpanan.create');
    Route::post('/simpanan',       [Anggota\SimpananController::class, 'store'])->name('simpanan.store');

    // Pinjaman
    Route::get('/pinjaman',              [Anggota\PinjamanController::class, 'index'])->name('pinjaman.index');
    Route::get('/pinjaman/ajukan',       [Anggota\PinjamanController::class, 'create'])->name('pinjaman.create');
    Route::post('/pinjaman',             [Anggota\PinjamanController::class, 'store'])->name('pinjaman.store');
    Route::post('/pinjaman/simulasi',    [Anggota\PinjamanController::class, 'simulasi'])->name('pinjaman.simulasi');

    // Angsuran
    Route::get('/angsuran/baru',         [Anggota\AngsuranPinjamanController::class, 'create'])->name('angsuran.create');
    Route::post('/angsuran',             [Anggota\AngsuranPinjamanController::class, 'store'])->name('angsuran.store');
    Route::get('/angsuran/{angsuran}',   [Anggota\AngsuranPinjamanController::class, 'show'])->name('angsuran.show');

    // Tagihan
    Route::get('/tagihan',              [Anggota\TagihanController::class, 'index'])->name('tagihan.index');

    // Profile
    Route::get('/profile',              [Anggota\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile',              [Anggota\ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password',     [Anggota\ProfileController::class, 'updatePassword'])->name('profile.password');
});

// ─── Admin ────────────────────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');

    // Simpanan
    Route::get('/simpanan',               [Admin\SimpananController::class, 'index'])->name('simpanan.index');
    Route::get('/simpanan/{simpanan}',    [Admin\SimpananController::class, 'show'])->name('simpanan.show');
    Route::patch('/simpanan/{simpanan}/verify', [Admin\SimpananController::class, 'verify'])->name('simpanan.verify');

    // Pinjaman
    Route::get('/pinjaman',                       [Admin\PinjamanController::class, 'index'])->name('pinjaman.index');
    Route::get('/pinjaman/{pinjaman}',            [Admin\PinjamanController::class, 'show'])->name('pinjaman.show');
    Route::patch('/pinjaman/{pinjaman}/approve',  [Admin\PinjamanController::class, 'approve'])->name('pinjaman.approve');
    Route::patch('/pinjaman/{pinjaman}/reject',   [Admin\PinjamanController::class, 'reject'])->name('pinjaman.reject');
});
