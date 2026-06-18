<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Anggota;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\VerifikasiAngsuranController;
use App\Http\Controllers\Admin\InventarisAlatController;

// ─── Landing Page ─────────────────────────────────────────────────────────────
Route::get('/', function () {
    return view('landing');
})->name('landing');

// ─── Auth ─────────────────────────────────────────────────────────────────────
Route::get('/login',  [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register',  [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

// 👇 INI ADALAH BAGIAN LUPA PASSWORD YANG DITAMBAHKAN 👇
Route::get('/lupa-password', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'showVerifyForm'])->name('password.verify');
Route::post('/lupa-password', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'verify'])->name('password.verify.post');

Route::get('/reset-password', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'reset'])->name('password.reset.post');
// 👆 BATAS BAGIAN LUPA PASSWORD 👆


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
    Route::get('/angsuran',              [Anggota\AngsuranPinjamanController::class, 'history'])->name('angsuran.history');
    Route::get('/angsuran/baru',         [Anggota\AngsuranPinjamanController::class, 'create'])->name('angsuran.create');
    Route::post('/angsuran',             [Anggota\AngsuranPinjamanController::class, 'store'])->name('angsuran.store');
    Route::get('/angsuran/{angsuran}',   [Anggota\AngsuranPinjamanController::class, 'show'])->name('angsuran.show');

    // Tagihan
    Route::get('/tagihan',              [Anggota\TagihanController::class, 'index'])->name('tagihan.index');

    // Profile
    Route::get('/profile/show',         [Anggota\ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile',              [Anggota\ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/photo',        [Anggota\ProfileController::class, 'photo'])->name('profile.photo');
    Route::put('/profile',              [Anggota\ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password',     [Anggota\ProfileController::class, 'updatePassword'])->name('profile.password');

    // Alat
    Route::get('/alat',                 [Anggota\AlatController::class, 'index'])->name('alat.index');
    Route::get('/alat/{id}',            [Anggota\AlatController::class, 'show'])->name('alat.show');
    Route::post('/alat/{id}/sewa',      [Anggota\AlatController::class, 'sewa'])->name('alat.sewa');
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

    Route::get('/angsuran',                       [Admin\AngsuranPinjamanController::class, 'index'])->name('angsuran.index');
    Route::get('/angsuran/{angsuran}',            [Admin\AngsuranPinjamanController::class, 'show'])->name('angsuran.show');
    Route::patch('/angsuran/{angsuran}/verify',   [Admin\AngsuranPinjamanController::class, 'verify'])->name('angsuran.verify');

    // Penyewaan Alat
    Route::get('/alat',                           [Admin\PenyewaanAlatController::class, 'index'])->name('alat.index');
    Route::get('/alat/{id}',                      [Admin\PenyewaanAlatController::class, 'show'])->name('alat.show');
    Route::patch('/alat/{id}/approve',            [Admin\PenyewaanAlatController::class, 'approve'])->name('alat.approve');
    Route::patch('/alat/{id}/reject',             [Admin\PenyewaanAlatController::class, 'reject'])->name('alat.reject');
    Route::post('/alat/{id}/return',              [Admin\PenyewaanAlatController::class, 'returnAlat'])->name('alat.return');
    Route::patch('/alat/{id}/status',             [Admin\PenyewaanAlatController::class, 'updateStatus'])->name('alat.status');

    // Inventaris Alat
    Route::resource('inventaris-alat', InventarisAlatController::class);

    // Manajemen Anggota
    Route::get('/anggota',              [Admin\AnggotaController::class, 'index'])->name('anggota.index');
    Route::get('/anggota/{user}/edit',  [Admin\AnggotaController::class, 'edit'])->name('anggota.edit');
    Route::put('/anggota/{user}',       [Admin\AnggotaController::class, 'update'])->name('anggota.update');
    Route::delete('/anggota/{user}',    [Admin\AnggotaController::class, 'destroy'])->name('anggota.destroy');
});