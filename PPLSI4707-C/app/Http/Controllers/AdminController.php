<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Show detailed member profile.
     * Fitur: Detail Data Anggota
     */
    public function showAnggota($id)
    {
        $anggota = User::where('role', 'anggota')->findOrFail($id);
        return view('admin.anggota.show', compact('anggota'));
    }

    /**
     * Delete a member.
     * Fitur: Hapus Data Anggota
     */
    public function deleteAnggota($id)
    {
        $anggota = User::where('role', 'anggota')->findOrFail($id);
        $nama = $anggota->nama_lengkap;
        $anggota->delete();

        return redirect()->route('admin.anggota')
            ->with('success', "Data anggota \"{$nama}\" berhasil dihapus.");
    }

    /**
     * Show member list — untuk mengakses detail dan hapus anggota.
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
}
