<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AngsuranPinjaman;
use Illuminate\Http\Request;

class AngsuranPinjamanController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status', 'all');
        $query = AngsuranPinjaman::with(['user', 'pinjaman'])->latest();

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $angsurans = $query->paginate(10);
        $pendingCount = AngsuranPinjaman::where('status', 'Pending')->count();
        $successCount = AngsuranPinjaman::where('status', 'Success')->count();

        return view('admin.angsuran.index', compact('angsurans', 'status', 'pendingCount', 'successCount'));
    }

    public function show(AngsuranPinjaman $angsuran)
    {
        $angsuran->load(['user', 'pinjaman']);
        return view('admin.angsuran.show', compact('angsuran'));
    }

    public function verify(AngsuranPinjaman $angsuran)
    {
        $angsuran->update([
            'status'      => 'Success',
            'verified_at' => now(),
        ]);

        return redirect()->route('admin.angsuran.index')
            ->with('success', 'Pembayaran angsuran berhasil diverifikasi.');
    }
}