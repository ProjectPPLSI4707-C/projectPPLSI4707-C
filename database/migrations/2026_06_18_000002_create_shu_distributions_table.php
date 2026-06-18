<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shu_distributions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->year('tahun');
            $table->decimal('total_simpanan_anggota', 15, 2)->default(0);
            $table->decimal('total_transaksi_anggota', 15, 2)->default(0);
            $table->decimal('jasa_modal', 15, 2)->default(0);
            $table->decimal('jasa_usaha', 15, 2)->default(0);
            $table->decimal('total_shu', 15, 2)->default(0);
            $table->enum('status', ['draft', 'approved', 'distributed'])->default('draft');
            $table->timestamp('distributed_at')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'tahun']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shu_distributions');
    }
};
