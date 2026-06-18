<?php

namespace App\Services;

use App\Models\Pinjaman;
use App\Models\ShuDistribution;
use App\Models\ShuSetting;
use App\Models\Simpanan;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ShuCalculatorService
{
    /**
     * Hitung total simpanan terverifikasi seluruh anggota.
     */
    public function calculateTotalSavings(): float
    {
        return Simpanan::where('status', 'Success')->sum('jumlah');
    }

    /**
     * Hitung total simpanan terverifikasi seorang anggota.
     */
    public function calculateUserSavings(User $user): float
    {
        return $user->simpanan()->where('status', 'Success')->sum('jumlah');
    }

    /**
     * Hitung total transaksi usaha (pinjaman approved + angsuran verified) seluruh anggota.
     */
    public function calculateTotalTransactions(): float
    {
        $totalPinjaman = Pinjaman::where('status_pengajuan', 'Approved')->sum('jumlah_pinjaman');
        $totalAngsuran = DB::table('angsuran_pinjaman')->where('status', 'Success')->sum('jumlah');

        return $totalPinjaman + $totalAngsuran;
    }

    /**
     * Hitung total transaksi usaha seorang anggota.
     */
    public function calculateUserTransactions(User $user): float
    {
        $pinjaman = $user->pinjaman()->where('status_pengajuan', 'Approved')->sum('jumlah_pinjaman');
        $angsuran = $user->angsuranPinjaman()->where('status', 'Success')->sum('jumlah');

        return $pinjaman + $angsuran;
    }

    /**
     * Generate distribusi SHU untuk seluruh anggota.
     */
    public function generateAnnualShu(ShuSetting $setting): int
    {
        $danaJasaModal = $setting->danaJasaModal();
        $danaJasaUsaha = $setting->danaJasaUsaha();

        $totalSimpanan  = $this->calculateTotalSavings();
        $totalTransaksi = $this->calculateTotalTransactions();

        $anggotaList = User::where('role', 'anggota')->get();
        $count = 0;

        DB::transaction(function () use ($setting, $anggotaList, $danaJasaModal, $danaJasaUsaha, $totalSimpanan, $totalTransaksi, &$count) {
            // Hapus distribusi lama jika ada (re-generate)
            ShuDistribution::where('tahun', $setting->tahun)->delete();

            foreach ($anggotaList as $user) {
                $userSimpanan  = $this->calculateUserSavings($user);
                $userTransaksi = $this->calculateUserTransactions($user);

                // Hitung jasa modal
                $jasaModal = $totalSimpanan > 0
                    ? round(($userSimpanan / $totalSimpanan) * $danaJasaModal, 2)
                    : 0;

                // Hitung jasa usaha
                $jasaUsaha = $totalTransaksi > 0
                    ? round(($userTransaksi / $totalTransaksi) * $danaJasaUsaha, 2)
                    : 0;

                $totalShu = round($jasaModal + $jasaUsaha, 2);

                ShuDistribution::create([
                    'user_id'                  => $user->id,
                    'tahun'                    => $setting->tahun,
                    'total_simpanan_anggota'   => $userSimpanan,
                    'total_transaksi_anggota'  => $userTransaksi,
                    'jasa_modal'               => $jasaModal,
                    'jasa_usaha'               => $jasaUsaha,
                    'total_shu'                => $totalShu,
                    'status'                   => 'draft',
                ]);

                $count++;
            }

            $setting->update(['generated_at' => now()]);
        });

        return $count;
    }

    /**
     * Approve seluruh distribusi SHU untuk tahun tertentu.
     */
    public function approveDistribution(ShuSetting $setting): int
    {
        return ShuDistribution::where('tahun', $setting->tahun)
            ->where('status', 'draft')
            ->update(['status' => 'approved']);
    }

    /**
     * Tandai seluruh distribusi SHU sebagai distributed.
     */
    public function markAsDistributed(ShuSetting $setting): int
    {
        return ShuDistribution::where('tahun', $setting->tahun)
            ->where('status', 'approved')
            ->update([
                'status'         => 'distributed',
                'distributed_at' => now(),
            ]);
    }
}
