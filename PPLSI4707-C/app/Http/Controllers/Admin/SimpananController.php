<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Simpanan;
use Illuminate\Http\Request;

class SimpananController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status', 'Pending');
        $jenis  = $request->query('jenis');

        $query = Simpanan::with('user')->latest();

        if ($status !== 'all') {
            $query->where('status', $status);
        }
        if ($jenis) {
            $query->where('jenis_simpanan', $jenis);
        }

        $simpanan        = $query->paginate(15);
        $pendingCount    = Simpanan::pending()->count();
        $successCount    = Simpanan::success()->count();

        return view('admin.simpanan.index', compact('simpanan', 'status', 'jenis', 'pendingCount', 'successCount'));
    }

    public function show(Simpanan $simpanan)
    {
        $simpanan->load('user');
        $riwayatUser = $simpanan->user->simpanan()->latest()->take(10)->get();
        return view('admin.simpanan.show', compact('simpanan', 'riwayatUser'));
    }

    public function verify(Simpanan $simpanan)
    {
        if ($simpanan->status !== 'Pending') {
            return back()->with('error', 'Transaksi ini sudah diverifikasi sebelumnya.');
        }

        $simpanan->update(['status' => 'Success']);

        return redirect()
            ->route('admin.simpanan.index')
            ->with('success', "Simpanan {$simpanan->user->name} sebesar Rp " . number_format($simpanan->jumlah, 0, ',', '.') . " berhasil diverifikasi.");
    }
}
