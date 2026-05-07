<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Pinjaman;
use Illuminate\Http\Request;

class PinjamanController extends Controller
{
    public function index()
    {
        $pinjaman = auth()->user()->pinjaman()->latest()->paginate(10);
        return view('anggota.pinjaman.index', compact('pinjaman'));
    }

    public function create()
    {
        return view('anggota.pinjaman.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jumlah_pinjaman'   => ['required', 'numeric', 'min:500000'],
            'tenor'             => ['required', 'integer', 'min:1', 'max:60'],
            'tujuan_pinjaman'   => ['required', 'string', 'min:20', 'max:500'],
            'dokumen_pendukung' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
        ], [
            'jumlah_pinjaman.required' => 'Jumlah pinjaman wajib diisi.',
            'jumlah_pinjaman.min'      => 'Minimal pinjaman adalah Rp 500.000.',
            'tenor.required'           => 'Tenor wajib dipilih.',
            'tenor.min'                => 'Tenor minimal 1 bulan.',
            'tenor.max'                => 'Tenor maksimal 60 bulan.',
            'tujuan_pinjaman.required' => 'Tujuan pinjaman wajib diisi.',
            'tujuan_pinjaman.min'      => 'Tujuan pinjaman minimal 20 karakter.',
            'dokumen_pendukung.mimes'  => 'Format file harus JPG, PNG, atau PDF.',
            'dokumen_pendukung.max'    => 'Ukuran file maksimal 5 MB.',
        ]);

        $dokumenPath = null;
        if ($request->hasFile('dokumen_pendukung')) {
            $dokumenPath = $request->file('dokumen_pendukung')->store('dokumen_pinjaman', 'public');
        }

        Pinjaman::create([
            'user_id'           => auth()->id(),
            'jumlah_pinjaman'   => $validated['jumlah_pinjaman'],
            'tenor'             => $validated['tenor'],
            'bunga_pinjaman'    => 1.00,
            'tujuan_pinjaman'   => $validated['tujuan_pinjaman'],
            'dokumen_pendukung' => $dokumenPath,
            'status_pengajuan'  => 'Pending',
            'tanggal_pengajuan' => now()->toDateString(),
        ]);

        return redirect()
            ->route('anggota.pinjaman.index')
            ->with('success', 'Pengajuan pinjaman berhasil dikirim. Menunggu persetujuan admin.');
    }

    /**
     * AJAX endpoint — hitung simulasi angsuran
     */
    public function simulasi(Request $request)
    {
        $request->validate([
            'jumlah' => ['required', 'numeric', 'min:0'],
            'tenor'  => ['required', 'integer', 'min:1', 'max:60'],
        ]);

        $jumlah = (float) $request->jumlah;
        $tenor  = (int)   $request->tenor;
        $bunga  = 1.00; // 1% flat per bulan

        if ($jumlah <= 0 || $tenor <= 0) {
            return response()->json(['angsuran' => 0, 'total' => 0, 'total_bunga' => 0]);
        }

        $angsuranPokok = $jumlah / $tenor;
        $bungaPerBulan = $jumlah * ($bunga / 100);
        $angsuran      = round($angsuranPokok + $bungaPerBulan, 2);
        $totalBunga    = round($bungaPerBulan * $tenor, 2);
        $total         = round($angsuran * $tenor, 2);

        return response()->json([
            'angsuran'    => $angsuran,
            'total'       => $total,
            'total_bunga' => $totalBunga,
            'bunga_persen'=> $bunga,
        ]);
    }
}
