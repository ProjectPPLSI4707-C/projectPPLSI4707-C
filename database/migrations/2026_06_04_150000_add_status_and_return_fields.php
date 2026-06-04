<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Tambah kolom status ke tabel alats
        Schema::table('alats', function (Blueprint $table) {
            $table->enum('status', ['tersedia', 'dipinjam', 'maintenance'])->default('tersedia')->after('gambar');
        });

        // Tambah kolom tanggal_kembali ke tabel penyewaan_alats
        Schema::table('penyewaan_alats', function (Blueprint $table) {
            $table->date('tanggal_kembali')->nullable()->after('bukti_pembayaran');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alats', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('penyewaan_alats', function (Blueprint $table) {
            $table->dropColumn('tanggal_kembali');
        });
    }
};
