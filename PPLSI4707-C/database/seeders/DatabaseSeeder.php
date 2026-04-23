<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin account
        User::create([
            'nomor_id_anggota' => '#SL-2026-0001',
            'nama_lengkap' => 'Administrator',
            'email' => 'admin@koperasi.com',
            'password' => Hash::make('admin123'),
            'no_ktp' => '3201010101010001',
            'no_telepon' => '081200000001',
            'alamat' => 'Jl. Koperasi No. 1, Jakarta Pusat',
            'role' => 'admin',
            'status_keanggotaan' => 'aktif',
            'tanggal_bergabung' => '2025-01-15',
            'email_verified_at' => now(),
        ]);

        // Anggota 1 - Aktif
        User::create([
            'nomor_id_anggota' => '#SL-2026-0002',
            'nama_lengkap' => 'Budi Santoso',
            'email' => 'budi@email.com',
            'password' => Hash::make('password'),
            'no_ktp' => '3201010101010002',
            'no_telepon' => '081234567890',
            'alamat' => 'Jl. Merdeka No. 45, Bandung',
            'role' => 'anggota',
            'status_keanggotaan' => 'aktif',
            'tanggal_bergabung' => '2025-03-20',
            'email_verified_at' => now(),
        ]);

        // Anggota 2 - Aktif
        User::create([
            'nomor_id_anggota' => '#SL-2026-0003',
            'nama_lengkap' => 'Siti Rahayu',
            'email' => 'siti@email.com',
            'password' => Hash::make('password'),
            'no_ktp' => '3201010101010003',
            'no_telepon' => '081298765432',
            'alamat' => 'Jl. Sudirman No. 12, Surabaya',
            'role' => 'anggota',
            'status_keanggotaan' => 'aktif',
            'tanggal_bergabung' => '2025-06-10',
            'email_verified_at' => now(),
        ]);

        // Anggota 3 - Menunggu Verifikasi
        User::create([
            'nomor_id_anggota' => '#SL-2026-0004',
            'nama_lengkap' => 'Ahmad Fauzi',
            'email' => 'ahmad@email.com',
            'password' => Hash::make('password'),
            'no_ktp' => '3201010101010004',
            'no_telepon' => '081311112222',
            'alamat' => 'Jl. Gatot Subroto No. 78, Semarang',
            'role' => 'anggota',
            'status_keanggotaan' => 'menunggu',
            'tanggal_bergabung' => '2026-04-01',
            'email_verified_at' => now(),
        ]);

        // Anggota 4 - Menunggu Verifikasi
        User::create([
            'nomor_id_anggota' => '#SL-2026-0005',
            'nama_lengkap' => 'Dewi Lestari',
            'email' => 'dewi@email.com',
            'password' => Hash::make('password'),
            'no_ktp' => '3201010101010005',
            'no_telepon' => '081399998888',
            'alamat' => 'Jl. Ahmad Yani No. 33, Yogyakarta',
            'role' => 'anggota',
            'status_keanggotaan' => 'menunggu',
            'tanggal_bergabung' => '2026-04-15',
            'email_verified_at' => now(),
        ]);

        // Anggota 5 - Ditangguhkan
        User::create([
            'nomor_id_anggota' => '#SL-2026-0006',
            'nama_lengkap' => 'Rudi Hartono',
            'email' => 'rudi@email.com',
            'password' => Hash::make('password'),
            'no_ktp' => '3201010101010006',
            'no_telepon' => '081377776666',
            'alamat' => 'Jl. Diponegoro No. 56, Medan',
            'role' => 'anggota',
            'status_keanggotaan' => 'ditangguhkan',
            'tanggal_bergabung' => '2025-09-05',
            'email_verified_at' => now(),
        ]);
    }
}
