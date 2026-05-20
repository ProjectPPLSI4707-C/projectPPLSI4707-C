<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\AngsuranPinjaman;
use App\Models\Pinjaman;
use Illuminate\Http\Request;

class AngsuranPinjamanController extends Controller
{
    public function create()
    {
        $pinjaman = auth()->user()
            ->pinjaman()
            ->approved()
            ->latest('tanggal_pengajuan')
            ->get();

        return view('anggota.angsuran.create', compact('pinjaman'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pinjaman_id'   => ['required', 'integer', 'exists:pinjaman,id'],
            'tanggal_bayar' => ['required', 'date'],
            'jumlah'        => ['required', 'numeric', 'min:1000'],
            'bukti_bayar'   => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
        ], [
            'pinjaman_id.required'   => 'Pinjaman wajib dipilih.',
            'pinjaman_id.exists'     => 'Pinjaman tidak ditemukan.',
            'tanggal_bayar.required' => 'Tanggal pembayaran wajib diisi.',
            'tanggal_bayar.date'     => 'Tanggal pembayaran tidak valid.',
            'jumlah.required'        => 'Jumlah pembayaran wajib diisi.',
            'jumlah.min'             => 'Minimal pembayaran adalah Rp 1.000.',
            'bukti_bayar.required'   => 'Bukti pembayaran wajib diunggah.',
            'bukti_bayar.mimes'      => 'Format file harus JPG, PNG, atau PDF.',
            'bukti_bayar.max'        => 'Ukuran file maksimal 2 MB.',
        ]);

        $pinjaman = Pinjaman::query()
            ->whereKey($validated['pinjaman_id'])
            ->where('user_id', auth()->id())
            ->approved()
            ->firstOrFail();

        $path = $request->file('bukti_bayar')->store('bukti_bayar_angsuran', 'public');

        AngsuranPinjaman::create([
            'pinjaman_id'   => $pinjaman->id,
            'user_id'       => auth()->id(),
            'tanggal_bayar' => $validated['tanggal_bayar'],
            'jumlah'        => $validated['jumlah'],
            'bukti_bayar'   => $path,
            'status'        => 'Pending',
        ]);

        return redirect()
            ->route('anggota.angsuran.create')
            ->with('success', 'Pembayaran angsuran berhasil diajukan. Menunggu verifikasi admin.');
    }
}
