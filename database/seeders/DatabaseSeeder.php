<?php

namespace Database\Seeders;

use App\Models\Pinjaman;
use App\Models\Simpanan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        $admin = User::create([
            'name'     => 'Administrator',
            'email'    => 'admin@skoter.id',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        // Anggota 1
        $anggota1 = User::create([
            'name'     => 'Budi Santoso',
            'email'    => 'budi@skoter.id',
            'password' => Hash::make('password'),
            'role'     => 'anggota',
        ]);

        // Anggota 2
        $anggota2 = User::create([
            'name'     => 'Siti Rahayu',
            'email'    => 'siti@skoter.id',
            'password' => Hash::make('password'),
            'role'     => 'anggota',
        ]);

        // Simpanan untuk anggota 1
        Simpanan::create([
            'user_id'        => $anggota1->id,
            'jenis_simpanan' => 'Pokok',
            'jumlah'         => 500000,
            'bukti_bayar'    => null,
            'status'         => 'Success',
        ]);
        Simpanan::create([
            'user_id'        => $anggota1->id,
            'jenis_simpanan' => 'Wajib',
            'jumlah'         => 100000,
            'bukti_bayar'    => null,
            'status'         => 'Success',
        ]);
        Simpanan::create([
            'user_id'        => $anggota1->id,
            'jenis_simpanan' => 'Wajib',
            'jumlah'         => 100000,
            'bukti_bayar'    => null,
            'status'         => 'Pending',
        ]);
        Simpanan::create([
            'user_id'        => $anggota1->id,
            'jenis_simpanan' => 'Sukarela',
            'jumlah'         => 250000,
            'bukti_bayar'    => null,
            'status'         => 'Success',
        ]);

        // Simpanan untuk anggota 2
        Simpanan::create([
            'user_id'        => $anggota2->id,
            'jenis_simpanan' => 'Pokok',
            'jumlah'         => 500000,
            'bukti_bayar'    => null,
            'status'         => 'Success',
        ]);
        Simpanan::create([
            'user_id'        => $anggota2->id,
            'jenis_simpanan' => 'Wajib',
            'jumlah'         => 100000,
            'bukti_bayar'    => null,
            'status'         => 'Pending',
        ]);

        // Pinjaman untuk anggota 1
        Pinjaman::create([
            'user_id'          => $anggota1->id,
            'jumlah_pinjaman'  => 5000000,
            'tenor'            => 12,
            'bunga_pinjaman'   => 1.00,
            'tujuan_pinjaman'  => 'Modal usaha warung makan',
            'dokumen_pendukung'=> null,
            'status_pengajuan' => 'Approved',
            'tanggal_pengajuan'=> now()->subDays(30)->toDateString(),
            'catatan_admin'    => 'Disetujui, simpanan mencukupi.',
        ]);

        // Pinjaman untuk anggota 2 (pending)
        Pinjaman::create([
            'user_id'          => $anggota2->id,
            'jumlah_pinjaman'  => 3000000,
            'tenor'            => 6,
            'bunga_pinjaman'   => 1.00,
            'tujuan_pinjaman'  => 'Biaya pendidikan anak',
            'dokumen_pendukung'=> null,
            'status_pengajuan' => 'Pending',
            'tanggal_pengajuan'=> now()->toDateString(),
            'catatan_admin'    => null,
        ]);

        // ─── SHU Setting & Distribution ───────────────────────────────────────────
        $shuSetting = \App\Models\ShuSetting::create([
            'tahun'              => 2025,
            'total_shu'          => 60000000,
            'persen_cadangan'    => 40,
            'persen_jasa_modal'  => 30,
            'persen_jasa_usaha'  => 30,
            'generated_at'       => now(),
        ]);

        \App\Models\ShuDistribution::create([
            'user_id'                 => $anggota1->id,
            'tahun'                   => 2025,
            'total_simpanan_anggota'  => 850000,
            'total_transaksi_anggota' => 5000000,
            'jasa_modal'              => 11647059,
            'jasa_usaha'              => 11250000,
            'total_shu'               => 22897059,
            'status'                  => 'distributed',
            'distributed_at'          => now(),
        ]);

        \App\Models\ShuDistribution::create([
            'user_id'                 => $anggota2->id,
            'tahun'                   => 2025,
            'total_simpanan_anggota'  => 500000,
            'total_transaksi_anggota' => 3000000,
            'jasa_modal'              => 6352941,
            'jasa_usaha'              => 6750000,
            'total_shu'               => 13102941,
            'status'                  => 'distributed',
            'distributed_at'          => now(),
        ]);
    }
}
