<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        if (Auth::check()) {
            return $this->redirectByRole();
        }
        return view('Auth.registration');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone'    => ['required', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'name.required'      => 'Nama lengkap wajib diisi.',
            'name.string'        => 'Nama lengkap harus berupa teks.',
            'name.max'           => 'Nama lengkap tidak boleh lebih dari 255 karakter.',
            'email.required'     => 'Email wajib diisi.',
            'email.email'        => 'Format email tidak valid.',
            'email.max'          => 'Email tidak boleh lebih dari 255 karakter.',
            'email.unique'       => 'Email ini sudah terdaftar.',
            'phone.required'     => 'Nomor telepon wajib diisi.',
            'phone.max'          => 'Nomor telepon tidak boleh lebih dari 20 karakter.',
            'password.required'  => 'Password wajib diisi.',
            'password.min'       => 'Password minimal harus terdiri dari 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'phone'    => $validated['phone'],
            'password' => Hash::make($validated['password']),
            'role'     => 'anggota', // default role
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return $this->redirectByRole();
    }

    private function redirectByRole()
    {
        if (Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('anggota.dashboard');
    }
}
