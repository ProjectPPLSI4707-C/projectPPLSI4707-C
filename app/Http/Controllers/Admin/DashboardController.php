<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pinjaman;
use App\Models\Simpanan;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAnggota        = User::where('role', 'anggota')->count();
        $totalSimpananAll    = Simpanan::where('status', 'Success')->sum('jumlah');
        $pendingSimpanan     = Simpanan::pending()->count();
        $pendingPinjaman     = Pinjaman::pending()->count();
        $totalPinjamanAktif  = Pinjaman::approved()->sum('jumlah_pinjaman');

        $recentSimpanan = Simpanan::with('user')->pending()->latest()->take(5)->get();
        $recentPinjaman = Pinjaman::with('user')->pending()->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalAnggota',
            'totalSimpananAll',
            'pendingSimpanan',
            'pendingPinjaman',
            'totalPinjamanAktif',
            'recentSimpanan',
            'recentPinjaman'
        ));
    }
}
