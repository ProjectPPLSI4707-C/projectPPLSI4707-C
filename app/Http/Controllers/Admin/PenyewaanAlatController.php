<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\PenyewaanAlat;
use Illuminate\Http\Request;

class PenyewaanAlatController extends Controller
{
    /**
     * Menampilkan daftar semua permintaan penyewaan alat.
     */
    public function index(Request $request)
    {
        $status = $request->query('status', 'all');

        $query = PenyewaanAlat::with(['user', 'alat'])->latest();

        if ($status !== 'all') {
            $query->where('status_pembayaran', $status);
        }

        $penyewaans   = $query->paginate(15)->withQueryString();
        $pendingCount = PenyewaanAlat::where('status_pembayaran', 'pending')->count();
        $dibayarCount = PenyewaanAlat::where('status_pembayaran', 'dibayar')->count();
        $ditolakCount = PenyewaanAlat::where('status_pembayaran', 'ditolak')->count();
        $totalCount   = PenyewaanAlat::count();

        return view('admin.alat.index', compact(
            'penyewaans',
            'status',
            'pendingCount',
            'dibayarCount',
            'ditolakCount',
            'totalCount'
        ));
    }

    /**
     * Menampilkan detail satu permintaan penyewaan alat.
     */
    public function show($id)
    {
        $penyewaan = PenyewaanAlat::with(['user', 'alat'])->findOrFail($id);

        return view('admin.alat.show', compact('penyewaan'));
    }

    /**
     * Menyetujui (approve) permintaan penyewaan alat.
     * Status pembayaran berubah jadi 'dibayar', status alat jadi 'dipinjam'.
     */
    public function approve($id)
    {
        $penyewaan = PenyewaanAlat::with('alat')->findOrFail($id);

        if ($penyewaan->status_pembayaran !== 'pending') {
            return back()->with('error', 'Hanya penyewaan berstatus pending yang dapat disetujui.');
        }

        $penyewaan->update(['status_pembayaran' => 'dibayar']);

        // Update status alat menjadi dipinjam
        $penyewaan->alat->update(['status' => Alat::STATUS_DIPINJAM]);

        return redirect()
            ->route('admin.alat.show', $id)
            ->with('success', "Penyewaan alat \"{$penyewaan->alat->nama_alat}\" oleh {$penyewaan->user->name} telah disetujui.");
    }

    /**
     * Menolak (reject) permintaan penyewaan alat.
     * Status pembayaran berubah jadi 'ditolak'.
     */
    public function reject($id)
    {
        $penyewaan = PenyewaanAlat::with('alat')->findOrFail($id);

        if ($penyewaan->status_pembayaran !== 'pending') {
            return back()->with('error', 'Hanya penyewaan berstatus pending yang dapat ditolak.');
        }

        $penyewaan->update(['status_pembayaran' => 'ditolak']);

        return redirect()
            ->route('admin.alat.show', $id)
            ->with('success', "Penyewaan alat \"{$penyewaan->alat->nama_alat}\" oleh {$penyewaan->user->name} telah ditolak.");
    }

    /**
     * Mencatat pengembalian alat.
     * Status alat kembali menjadi 'tersedia', tanggal_kembali dicatat.
     */
    public function returnAlat(Request $request, $id)
    {
        $request->validate([
            'tanggal_kembali' => 'required|date',
        ]);

        $penyewaan = PenyewaanAlat::with('alat')->findOrFail($id);

        if ($penyewaan->status_pembayaran !== 'dibayar') {
            return back()->with('error', 'Hanya penyewaan yang sudah disetujui (dibayar) yang bisa dicatat pengembaliannya.');
        }

        if ($penyewaan->tanggal_kembali) {
            return back()->with('error', 'Alat ini sudah pernah dicatat pengembaliannya.');
        }

        $penyewaan->update([
            'tanggal_kembali' => $request->tanggal_kembali,
        ]);

        // Update status alat menjadi tersedia kembali
        $penyewaan->alat->update(['status' => Alat::STATUS_TERSEDIA]);

        return redirect()
            ->route('admin.alat.show', $id)
            ->with('success', "Pengembalian alat \"{$penyewaan->alat->nama_alat}\" berhasil dicatat. Alat kini tersedia kembali.");
    }

    /**
     * Mengubah status operasional alat secara manual.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:tersedia,dipinjam,maintenance',
        ]);

        // $id di sini adalah ID penyewaan, kita ambil alat-nya
        $penyewaan = PenyewaanAlat::with('alat')->findOrFail($id);
        $alat      = $penyewaan->alat;

        $alat->update(['status' => $request->status]);

        $labelStatus = [
            'tersedia'    => 'Tersedia',
            'dipinjam'    => 'Dipinjam',
            'maintenance' => 'Maintenance',
        ];

        return redirect()
            ->route('admin.alat.show', $id)
            ->with('success', "Status alat \"{$alat->nama_alat}\" berhasil diubah menjadi {$labelStatus[$request->status]}.");
    }
}
