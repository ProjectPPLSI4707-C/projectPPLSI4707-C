<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    // Menampilkan form input Email & No. HP
    public function showVerifyForm()
    {
        return view('auth.forgot-password');
    }

    // Memproses pencocokan data
    public function verify(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'phone' => 'required'
        ], [
            'email.required' => 'Email wajib diisi.',
            'phone.required' => 'Nomor HP wajib diisi.'
        ]);

        $user = User::where('email', $request->email)->where('phone', $request->phone)->first();

        if (!$user) {
            return back()->withErrors(['error' => 'Data Email dan Nomor Telepon tidak cocok dengan catatan kami.'])->withInput();
        }

        // Tiket rahasia: Simpan ID user ke session sementara
        session(['reset_user_id' => $user->id]);

        return redirect()->route('password.reset');
    }

    // Menampilkan form buat password baru
    public function showResetForm()
    {
        // Cegah orang yang menebak URL tanpa verifikasi
        if (!session()->has('reset_user_id')) {
            return redirect()->route('login')->withErrors(['email' => 'Sesi ubah sandi tidak valid atau sudah kadaluarsa.']);
        }
        return view('auth.reset-password');
    }

    // Memproses perubahan password
    public function reset(Request $request)
    {
        if (!session()->has('reset_user_id')) {
            return redirect()->route('login');
        }

        $request->validate([
            'password' => 'required|min:8|confirmed',
        ], [
            'password.required' => 'Password baru wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sama.'
        ]);

        $user = User::find(session('reset_user_id'));
        $user->password = Hash::make($request->password);
        $user->save();

        // Hapus tiket rahasia agar tidak bisa disalahgunakan
        session()->forget('reset_user_id');

        // Kembali ke login dengan pesan sukses (opsional ditangkap di view login)
        return redirect()->route('login')->withErrors(['email' => 'Kata sandi berhasil diubah! Silakan login.']);
    }
}