<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pinjaman', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->decimal('jumlah_pinjaman', 15, 2);
            $table->unsignedTinyInteger('tenor'); // dalam bulan
            $table->decimal('bunga_pinjaman', 5, 2)->default(1.00); // % per bulan flat
            $table->text('tujuan_pinjaman');
            $table->string('dokumen_pendukung')->nullable();
            $table->enum('status_pengajuan', ['Pending', 'Approved', 'Rejected'])->default('Pending');
            $table->date('tanggal_pengajuan');
            $table->text('catatan_admin')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pinjaman');
    }
};
