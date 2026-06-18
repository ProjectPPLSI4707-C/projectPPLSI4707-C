<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Simpanan;
use App\Models\Pinjaman;

class LandingController extends Controller
{
    public function index()
    {
        // Total anggota terdaftar (hanya role anggota)
        $totalAnggota = User::where('role', 'anggota')->count();

        // Total simpanan dikelola (status Success)
        $totalSimpanan = Simpanan::where('status', 'Success')->sum('jumlah');

        // Total pinjaman tersalurkan (status Approved)
        $totalPinjaman = Pinjaman::where('status_pengajuan', 'Approved')->sum('jumlah_pinjaman');

        // Tingkat keberhasilan angsuran — persentase angsuran lunas dari total
        $totalAngsuranAll     = \App\Models\AngsuranPinjaman::count();
        $totalAngsuranSuccess = \App\Models\AngsuranPinjaman::where('status', 'Success')->count();
        $tingkatKeberhasilan  = $totalAngsuranAll > 0
            ? round(($totalAngsuranSuccess / $totalAngsuranAll) * 100)
            : 0;

        return view('landing', compact(
            'totalAnggota',
            'totalSimpanan',
            'totalPinjaman',
            'tingkatKeberhasilan'
        ));
    }
}
