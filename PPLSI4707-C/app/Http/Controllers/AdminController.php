<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Show member list — Pendataan Anggota.
     */
    public function anggota(Request $request)
    {
        $query = User::where('role', 'anggota');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('nomor_id_anggota', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status') && $request->status !== 'semua') {
            $query->where('status_keanggotaan', $request->status);
        }

        $anggotaList = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.anggota.index', compact('anggotaList'));
    }

    /**
     * Show edit form for a member.
     * Fitur: Edit Data Anggota
     */
    public function editAnggota($id)
    {
        $anggota = User::where('role', 'anggota')->findOrFail($id);
        return view('admin.anggota.edit', compact('anggota'));
    }

    /**
     * Update member information.
     * Fitur: Edit Data Anggota
     */
    public function updateAnggota(Request $request, $id)
    {
        $anggota = User::where('role', 'anggota')->findOrFail($id);

        $validated = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
            'no_ktp' => ['required', 'string', 'max:20'],
            'no_telepon' => ['required', 'string', 'max:20'],
            'alamat' => ['required', 'string'],
            'status_keanggotaan' => ['required', 'in:menunggu,aktif,ditangguhkan'],
        ]);

        $anggota->update($validated);

        return redirect()->route('admin.anggota')
            ->with('success', 'Data anggota berhasil diperbarui.');
    }
}
