<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShuDistribution;
use App\Models\ShuSetting;
use App\Services\ShuCalculatorService;
use Illuminate\Http\Request;

class ShuController extends Controller
{
    protected ShuCalculatorService $calculator;

    public function __construct(ShuCalculatorService $calculator)
    {
        $this->calculator = $calculator;
    }

    public function index()
    {
        $settings = ShuSetting::latest('tahun')->get();

        // Statistik
        $currentYear      = now()->year;
        $currentSetting    = ShuSetting::where('tahun', $currentYear)->first();
        $totalShuTahunIni  = $currentSetting?->total_shu ?? 0;
        $distributed       = $currentSetting
            ? ShuDistribution::where('tahun', $currentYear)->distributed()->sum('total_shu')
            : 0;
        $penerima          = $currentSetting
            ? ShuDistribution::where('tahun', $currentYear)->distributed()->count()
            : 0;

        return view('admin.shu.index', compact(
            'settings',
            'totalShuTahunIni',
            'distributed',
            'penerima',
            'currentYear'
        ));
    }

    public function create()
    {
        return view('admin.shu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun'              => ['required', 'integer', 'min:2020', 'max:2099', 'unique:shu_settings,tahun'],
            'total_shu'          => ['required', 'numeric', 'min:1'],
            'persen_cadangan'    => ['required', 'numeric', 'min:0', 'max:100'],
            'persen_jasa_modal'  => ['required', 'numeric', 'min:0', 'max:100'],
            'persen_jasa_usaha'  => ['required', 'numeric', 'min:0', 'max:100'],
        ], [
            'tahun.unique' => 'Konfigurasi SHU untuk tahun ini sudah ada.',
        ]);

        // Validasi total persentase = 100
        $total = $request->persen_cadangan + $request->persen_jasa_modal + $request->persen_jasa_usaha;
        if (abs($total - 100) > 0.01) {
            return back()->withInput()->with('error', 'Total persentase harus 100%. Saat ini: ' . number_format($total, 2) . '%');
        }

        $setting = ShuSetting::create($request->only([
            'tahun', 'total_shu', 'persen_cadangan', 'persen_jasa_modal', 'persen_jasa_usaha',
        ]));

        return redirect()
            ->route('admin.shu.show', $setting)
            ->with('success', 'Konfigurasi SHU tahun ' . $setting->tahun . ' berhasil dibuat.');
    }

    public function show(ShuSetting $shuSetting)
    {
        $distributions = ShuDistribution::with('user')
            ->where('tahun', $shuSetting->tahun)
            ->orderByDesc('total_shu')
            ->get();

        $totalDistributed = $distributions->sum('total_shu');

        return view('admin.shu.show', compact('shuSetting', 'distributions', 'totalDistributed'));
    }

    public function generate(ShuSetting $shuSetting)
    {
        $count = $this->calculator->generateAnnualShu($shuSetting);

        return redirect()
            ->route('admin.shu.show', $shuSetting)
            ->with('success', "SHU berhasil di-generate untuk {$count} anggota.");
    }

    public function approve(ShuSetting $shuSetting)
    {
        if ($shuSetting->status !== 'draft') {
            return back()->with('error', 'SHU hanya dapat di-approve dari status Draft.');
        }

        $count = $this->calculator->approveDistribution($shuSetting);

        return redirect()
            ->route('admin.shu.show', $shuSetting)
            ->with('success', "Distribusi SHU berhasil di-approve untuk {$count} anggota.");
    }

    public function distribute(ShuSetting $shuSetting)
    {
        if ($shuSetting->status !== 'approved') {
            return back()->with('error', 'SHU hanya dapat didistribusikan dari status Approved.');
        }

        $count = $this->calculator->markAsDistributed($shuSetting);

        return redirect()
            ->route('admin.shu.show', $shuSetting)
            ->with('success', "SHU berhasil didistribusikan ke {$count} anggota.");
    }

    public function export(ShuSetting $shuSetting)
    {
        $distributions = ShuDistribution::with('user')
            ->where('tahun', $shuSetting->tahun)
            ->orderByDesc('total_shu')
            ->get();

        $filename = 'shu_distribusi_' . $shuSetting->tahun . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($distributions) {
            $file = fopen('php://output', 'w');

            // BOM for Excel UTF-8
            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));

            // Header
            fputcsv($file, [
                'No', 'Nama Anggota', 'Email', 'Total Simpanan', 'Total Transaksi',
                'Jasa Modal (Rp)', 'Jasa Usaha (Rp)', 'Total SHU (Rp)', 'Status',
            ]);

            // Data
            foreach ($distributions as $i => $d) {
                fputcsv($file, [
                    $i + 1,
                    $d->user->name,
                    $d->user->email,
                    $d->total_simpanan_anggota,
                    $d->total_transaksi_anggota,
                    $d->jasa_modal,
                    $d->jasa_usaha,
                    $d->total_shu,
                    ucfirst($d->status),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
