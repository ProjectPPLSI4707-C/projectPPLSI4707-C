<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    /**
     * Tampilkan daftar anggota dengan fitur pencarian.
     */
    public function index(Request $request)
    {
        $query = User::where('role', 'anggota')->latest();

        if ($q = $request->query('q')) {
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%")
                    ->orWhere('phone', 'like', "%{$q}%")
                    ->orWhere('address', 'like', "%{$q}%");
            });
        }

        $anggota = $query->paginate(15);

        return view('admin.anggota.index', compact('anggota'));
    }

    /**
     * Tampilkan form edit anggota.
     */
    public function edit(User $user)
    {
        abort_unless($user->role === 'anggota', 404);

        return view('admin.anggota.edit', compact('user'));
    }

    /**
     * Update data anggota.
     */
    public function update(Request $request, User $user)
    {
        abort_unless($user->role === 'anggota', 404);

        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone'   => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
        ]);

        $user->update($validated);

        return redirect()
            ->route('admin.anggota.index')
            ->with('success', "Data anggota {$user->name} berhasil diperbarui.");
    }

    /**
     * Hapus anggota.
     */
    public function destroy(User $user)
    {
        abort_unless($user->role === 'anggota', 404);

        // Jangan hapus admin sendiri
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }

        $name = $user->name;
        $user->delete();

        return redirect()
            ->route('admin.anggota.index')
            ->with('success', "Anggota {$name} berhasil dihapus.");
    }
}
