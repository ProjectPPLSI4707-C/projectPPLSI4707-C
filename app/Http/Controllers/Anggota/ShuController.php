<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\ShuDistribution;
use Illuminate\Http\Request;

class ShuController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        // Semua distribusi SHU yang sudah distributed
        $distributions = ShuDistribution::where('user_id', $user->id)
            ->where('status', 'distributed')
            ->orderByDesc('tahun')
            ->get();

        // SHU terbaru
        $latest = $distributions->first();

        // Total sepanjang masa
        $totalSepanjangMasa = $distributions->sum('total_shu');

        return view('anggota.shu.index', compact('distributions', 'latest', 'totalSepanjangMasa'));
    }
}
