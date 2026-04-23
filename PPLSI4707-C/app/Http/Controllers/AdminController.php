<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Update member status.
     * Fitur: Status Keanggotaan
     */
    public function updateStatus(Request $request, $id)
    {
        $anggota = User::where('role', 'anggota')->findOrFail($id);

        $request->validate([
            'status_keanggotaan' => ['required', 'in:menunggu,aktif,ditangguhkan'],
        ]);

        $anggota->update([
            'status_keanggotaan' => $request->status_keanggotaan,
        ]);

        return redirect()->back()
            ->with('success', "Status anggota \"{$anggota->nama_lengkap}\" berhasil diperbarui.");
    }

    /**
     * Show detailed member profile — untuk mengakses halaman ubah status.
     */
    public function showAnggota($id)
    {
        $anggota = User::where('role', 'anggota')->findOrFail($id);
        return view('admin.anggota.show', compact('anggota'));
    }
}
