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

        $file = $request->file('bukti_bayar');
        $ext = $file->getClientOriginalExtension();
        $newName = time() . '_' . uniqid() . '.' . $ext;
        $targetDir = public_path('uploads/bukti_bayar_angsuran');
        if (! is_dir($targetDir)) mkdir($targetDir, 0755, true);
        $file->move($targetDir, $newName);
        $path = 'uploads/bukti_bayar_angsuran/' . $newName;

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
    public function show(AngsuranPinjaman $angsuran)
    {
        if ($angsuran->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $angsuran->load('pinjaman.angsuran');
        
        $pinjaman = $angsuran->pinjaman;
        
        $angsuranDibayar = $pinjaman->angsuran->where('status', 'Success')->count();
        $totalDibayar    = $pinjaman->angsuran->where('status', 'Success')->sum('jumlah');
        $totalPengembalian = $pinjaman->totalPengembalian();
        
        $sisaTenor   = max(0, $pinjaman->tenor - $angsuranDibayar);
        $sisaTagihan = max(0, $totalPengembalian - $totalDibayar);

        return view('anggota.angsuran.show', compact('angsuran', 'sisaTenor', 'sisaTagihan'));
    }

    public function history(Request $request)
    {
        $user       = auth()->user();
        $filterStatus = $request->query('status', 'all');

        $query = AngsuranPinjaman::with('pinjaman')
            ->where('user_id', $user->id)
            ->latest('tanggal_bayar');

        if ($filterStatus !== 'all') {
            $query->where('status', $filterStatus);
        }

        $histori = $query->get();

        // Statistik
        $totalPembayaran      = AngsuranPinjaman::where('user_id', $user->id)->count();
        $totalTerverifikasi   = AngsuranPinjaman::where('user_id', $user->id)->where('status', 'Success')->count();
        $totalPending         = AngsuranPinjaman::where('user_id', $user->id)->where('status', 'Pending')->count();
        $totalNominal         = AngsuranPinjaman::where('user_id', $user->id)->where('status', 'Success')->sum('jumlah');

        // Kelompokkan per pinjaman untuk progress bar (hanya dari data yang tidak difilter)
        $pinjamanList = Pinjaman::where('user_id', $user->id)
            ->where('status_pengajuan', 'Approved')
            ->with(['angsuran' => function ($q) {
                $q->latest('tanggal_bayar');
            }])
            ->get();

        return view('anggota.angsuran.history', compact(
            'histori',
            'filterStatus',
            'totalPembayaran',
            'totalTerverifikasi',
            'totalPending',
            'totalNominal',
            'pinjamanList',
        ));
    }
}

