<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Simpanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SimpananController extends Controller
{
    public function index(Request $request)
    {
        $user  = auth()->user();
        $jenis = $request->query('jenis');

        $simpananQuery = DB::table('simpanan')
            ->where('user_id', $user->id)
            ->when($jenis, function ($query, $jenis) {
                $query->where('jenis_simpanan', $jenis);
            })
            ->selectRaw("'Simpanan' as tipe, jenis_simpanan as deskripsi, jumlah, bukti_bayar, status, created_at");

        $angsuranQuery = DB::table('angsuran_pinjaman')
            ->where('user_id', $user->id)
            ->selectRaw("'Angsuran' as tipe, CONCAT('Angsuran Pinjaman #', pinjaman_id) as deskripsi, jumlah, bukti_bayar, status, created_at");

        $union = $simpananQuery->unionAll($angsuranQuery);

        $simpanan = DB::query()
            ->fromSub($union, 'transaksi')
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        $totalPokok    = $user->totalSimpananByJenis('Pokok');
        $totalWajib    = $user->totalSimpananByJenis('Wajib');
        $totalSukarela = $user->totalSimpananByJenis('Sukarela');

        return view('anggota.simpanan.index', compact(
            'simpanan', 'totalPokok', 'totalWajib', 'totalSukarela', 'jenis'
        ));
    }

    public function create()
    {
        return view('anggota.simpanan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_simpanan' => ['required', 'in:Pokok,Wajib,Sukarela'],
            'jumlah'         => ['required', 'numeric', 'min:1000'],
            'bukti_bayar'    => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
        ], [
            'jenis_simpanan.required' => 'Jenis simpanan wajib dipilih.',
            'jenis_simpanan.in'       => 'Jenis simpanan tidak valid.',
            'jumlah.required'         => 'Jumlah simpanan wajib diisi.',
            'jumlah.min'              => 'Minimal simpanan adalah Rp 1.000.',
            'bukti_bayar.required'    => 'Bukti pembayaran wajib diunggah.',
            'bukti_bayar.mimes'       => 'Format file harus JPG, PNG, atau PDF.',
            'bukti_bayar.max'         => 'Ukuran file maksimal 2 MB.',
        ]);

        $path = $request->file('bukti_bayar')->store('bukti_bayar', 'public');

        Simpanan::create([
            'user_id'        => auth()->id(),
            'jenis_simpanan' => $validated['jenis_simpanan'],
            'jumlah'         => $validated['jumlah'],
            'bukti_bayar'    => $path,
            'status'         => 'Pending',
        ]);

        return redirect()
            ->route('anggota.simpanan.index')
            ->with('success', 'Pembayaran simpanan berhasil diajukan. Menunggu verifikasi admin.');
    }
}
