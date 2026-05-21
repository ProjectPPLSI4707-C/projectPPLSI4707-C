<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Pinjaman;
use App\Models\Simpanan;
use App\Models\AngsuranPinjaman;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TagihanController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        // ─── Simpanan Wajib ──────────────────────────────────────────────
        // Check which months in the current year the member has paid simpanan wajib
        $currentYear  = now()->year;
        $currentMonth = now()->month;

        $paidMonths = $user->simpanan()
            ->where('jenis_simpanan', 'Wajib')
            ->where('status', 'Success')
            ->whereYear('created_at', $currentYear)
            ->get()
            ->pluck('created_at')
            ->map(fn($d) => $d->month)
            ->unique()
            ->toArray();

        $pendingMonths = $user->simpanan()
            ->where('jenis_simpanan', 'Wajib')
            ->where('status', 'Pending')
            ->whereYear('created_at', $currentYear)
            ->get()
            ->pluck('created_at')
            ->map(fn($d) => $d->month)
            ->unique()
            ->toArray();

        // Build simpanan wajib schedule for current year (Jan to current month)
        $simpananWajibSchedule = [];
        $jumlahWajibPerBulan   = 50000; // Default simpanan wajib per bulan

        for ($m = 1; $m <= $currentMonth; $m++) {
            $status = 'Belum Bayar';
            if (in_array($m, $paidMonths)) {
                $status = 'Lunas';
            } elseif (in_array($m, $pendingMonths)) {
                $status = 'Menunggu Verifikasi';
            }

            $simpananWajibSchedule[] = [
                'bulan'   => Carbon::create($currentYear, $m, 1)->locale('id')->isoFormat('MMMM Y'),
                'bulan_num' => $m,
                'jumlah'  => $jumlahWajibPerBulan,
                'status'  => $status,
            ];
        }

        $totalSimpananWajibTertunggak = collect($simpananWajibSchedule)
            ->where('status', 'Belum Bayar')
            ->sum('jumlah');

        // ─── Angsuran Pinjaman ───────────────────────────────────────────
        $pinjamanAktif = $user->pinjaman()
            ->where('status_pengajuan', 'Approved')
            ->with('angsuran')
            ->get();

        $angsuranTagihan = [];
        $totalAngsuranTertunggak = 0;

        foreach ($pinjamanAktif as $pinjaman) {
            $angsuranDibayar     = $pinjaman->angsuran->where('status', 'Success')->count();
            $angsuranPending     = $pinjaman->angsuran->where('status', 'Pending')->count();
            $angsuranPerBulan    = $pinjaman->angsuranPerBulan();
            $totalTenor          = $pinjaman->tenor;
            $sisaTenor           = $totalTenor - $angsuranDibayar;
            $totalDibayar        = $pinjaman->angsuran->where('status', 'Success')->sum('jumlah');
            $totalPengembalian   = $pinjaman->totalPengembalian();
            $sisaTagihan         = $totalPengembalian - $totalDibayar;

            // Build per-bulan schedule
            $jadwalAngsuran = [];
            $startDate = Carbon::parse($pinjaman->tanggal_pengajuan)->addMonth();

            for ($i = 1; $i <= $totalTenor; $i++) {
                $dueDate = $startDate->copy()->addMonths($i - 1);
                $status  = 'Belum Bayar';

                if ($i <= $angsuranDibayar) {
                    $status = 'Lunas';
                } elseif ($i <= $angsuranDibayar + $angsuranPending) {
                    $status = 'Menunggu Verifikasi';
                } elseif ($dueDate->lt(now())) {
                    $status = 'Jatuh Tempo';
                }

                $jadwalAngsuran[] = [
                    'ke'      => $i,
                    'jatuh_tempo' => $dueDate->locale('id')->isoFormat('D MMMM Y'),
                    'jumlah'      => $angsuranPerBulan,
                    'status'      => $status,
                ];
            }

            $angsuranBelumBayar = collect($jadwalAngsuran)
                ->whereIn('status', ['Belum Bayar', 'Jatuh Tempo'])
                ->count();

            $totalAngsuranTertunggak += $angsuranBelumBayar * $angsuranPerBulan;

            $angsuranTagihan[] = [
                'pinjaman'          => $pinjaman,
                'angsuran_per_bulan' => $angsuranPerBulan,
                'total_tenor'       => $totalTenor,
                'angsuran_dibayar'  => $angsuranDibayar,
                'angsuran_pending'  => $angsuranPending,
                'sisa_tenor'        => $sisaTenor,
                'total_dibayar'     => $totalDibayar,
                'total_pengembalian' => $totalPengembalian,
                'sisa_tagihan'      => $sisaTagihan,
                'jadwal'            => $jadwalAngsuran,
                'progress'          => $totalTenor > 0 ? round(($angsuranDibayar / $totalTenor) * 100) : 0,
            ];
        }

        // ─── Summary ─────────────────────────────────────────────────────
        $totalTagihan = $totalSimpananWajibTertunggak + $totalAngsuranTertunggak;

        // ─── Riwayat Transaksi Angsuran ──────────────────────────────────
        $riwayatAngsuran = AngsuranPinjaman::where('user_id', $user->id)
            ->with('pinjaman')
            ->latest('created_at')
            ->get();

        return view('anggota.tagihan.index', compact(
            'simpananWajibSchedule',
            'totalSimpananWajibTertunggak',
            'angsuranTagihan',
            'totalAngsuranTertunggak',
            'totalTagihan',
            'jumlahWajibPerBulan',
            'riwayatAngsuran'
        ));
    }
}
