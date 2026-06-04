<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\PenyewaanAlat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlatController extends Controller
{
    public function index(Request $request)
    {
        $query = Alat::query();
        if ($request->has('search')) {
            $query->where('nama_alat', 'like', '%' . $request->search . '%');
        }
        $alats = $query->paginate(12);
        
        return view('anggota.alat.index', compact('alats'));
    }

    public function show($id)
    {
        $alat = Alat::findOrFail($id);
        
        // Ambil jadwal penyewaan yang disetujui/dibayar untuk alat ini
        $jadwalPenyewaan = PenyewaanAlat::where('alat_id', $id)
            ->whereIn('status_pembayaran', ['dibayar', 'pending'])
            ->orderBy('tanggal_mulai', 'asc')
            ->get();
            
        return view('anggota.alat.show', compact('alat', 'jadwalPenyewaan'));
    }

    public function sewa(Request $request, $id)
    {
        $request->validate([
            'tanggal_mulai' => 'required|date|after_or_equal:today',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $alat = Alat::findOrFail($id);

        // Cek jika alat sedang dalam maintenance
        if ($alat->status === 'maintenance') {
            return back()->with('error', 'Alat ini sedang dalam masa pemeliharaan dan tidak dapat disewa saat ini.');
        }

        $bentrok = PenyewaanAlat::where('alat_id', $id)
            ->whereIn('status_pembayaran', ['pending', 'dibayar'])
            ->where(function($query) use ($request) {
                $query->whereBetween('tanggal_mulai', [$request->tanggal_mulai, $request->tanggal_selesai])
                      ->orWhereBetween('tanggal_selesai', [$request->tanggal_mulai, $request->tanggal_selesai])
                      ->orWhere(function($q) use ($request) {
                          $q->where('tanggal_mulai', '<=', $request->tanggal_mulai)
                            ->where('tanggal_selesai', '>=', $request->tanggal_selesai);
                      });
            })->exists();

        if ($bentrok) {
            return back()->with('error', 'Alat tidak tersedia pada tanggal tersebut.');
        }

        // Hitung total harga
        $diff = strtotime($request->tanggal_selesai) - strtotime($request->tanggal_mulai);
        $days = max(1, round($diff / (60 * 60 * 24))); // Minimal 1 hari
        $total_harga = $days * $alat->harga_sewa;

        // Upload bukti
        $buktiPath = $request->file('bukti_pembayaran')->store('bukti_sewa_alat', 'public');

        PenyewaanAlat::create([
            'user_id' => auth()->id(),
            'alat_id' => $alat->id,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'total_harga' => $total_harga,
            'status_pembayaran' => 'pending', // Menunggu konfirmasi admin
            'bukti_pembayaran' => $buktiPath
        ]);

        return redirect()->route('anggota.alat.index')->with('success', 'Penyewaan alat berhasil diajukan dan menunggu konfirmasi.');
    }
}
