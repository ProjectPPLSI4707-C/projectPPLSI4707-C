<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $totalSimpanan  = $user->totalSimpanan();
        $simpananPokok  = $user->totalSimpananByJenis('Pokok');
        $simpananWajib  = $user->totalSimpananByJenis('Wajib');
        $simpananSukarela = $user->totalSimpananByJenis('Sukarela');

        $pinjamanAktif  = $user->pinjaman()->where('status_pengajuan', 'Approved')->latest()->first();
        $pinjamanPending = $user->pinjaman()->where('status_pengajuan', 'Pending')->count();

        $riwayatTerbaru = $user->simpanan()->latest()->take(5)->get();

        return view('anggota.dashboard', compact(
            'user',
            'totalSimpanan',
            'simpananPokok',
            'simpananWajib',
            'simpananSukarela',
            'pinjamanAktif',
            'pinjamanPending',
            'riwayatTerbaru'
        ));
    }
}
