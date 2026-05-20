<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pinjaman;
use Illuminate\Http\Request;

class PinjamanController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status', 'Pending');

        $query = Pinjaman::with('user')->latest();

        if ($status !== 'all') {
            $query->where('status_pengajuan', $status);
        }

        $pinjaman      = $query->paginate(15);
        $pendingCount  = Pinjaman::pending()->count();
        $approvedCount = Pinjaman::approved()->count();
        $rejectedCount = Pinjaman::rejected()->count();

        return view('admin.pinjaman.index', compact('pinjaman', 'status', 'pendingCount', 'approvedCount', 'rejectedCount'));
    }

    public function show(Pinjaman $pinjaman)
    {
        $pinjaman->load('user');
        $riwayatSimpanan = $pinjaman->user->simpanan()->latest()->get();
        $totalSimpanan   = $pinjaman->user->totalSimpanan();
        $simpananPokok   = $pinjaman->user->totalSimpananByJenis('Pokok');
        $simpananWajib   = $pinjaman->user->totalSimpananByJenis('Wajib');
        $simpananSukarela = $pinjaman->user->totalSimpananByJenis('Sukarela');

        return view('admin.pinjaman.show', compact(
            'pinjaman',
            'riwayatSimpanan',
            'totalSimpanan',
            'simpananPokok',
            'simpananWajib',
            'simpananSukarela'
        ));
    }

    public function approve(Request $request, Pinjaman $pinjaman)
    {
        if (!$pinjaman->isPending()) {
            return back()->with('error', 'Pengajuan ini sudah diproses sebelumnya.');
        }

        $request->validate([
            'catatan_admin' => ['nullable', 'string', 'max:500'],
        ]);

        $pinjaman->update([
            'status_pengajuan' => 'Approved',
            'catatan_admin'    => $request->catatan_admin ?? 'Pengajuan disetujui.',
        ]);

        return redirect()
            ->route('admin.pinjaman.index')
            ->with('success', "Pengajuan pinjaman {$pinjaman->user->name} berhasil disetujui.");
    }

    public function reject(Request $request, Pinjaman $pinjaman)
    {
        if (!$pinjaman->isPending()) {
            return back()->with('error', 'Pengajuan ini sudah diproses sebelumnya.');
        }

        $request->validate([
            'catatan_admin' => ['required', 'string', 'max:500'],
        ], [
            'catatan_admin.required' => 'Alasan penolakan wajib diisi.',
        ]);

        $pinjaman->update([
            'status_pengajuan' => 'Rejected',
            'catatan_admin'    => $request->catatan_admin,
        ]);

        return redirect()
            ->route('admin.pinjaman.index')
            ->with('success', "Pengajuan pinjaman {$pinjaman->user->name} telah ditolak.");
    }
}
