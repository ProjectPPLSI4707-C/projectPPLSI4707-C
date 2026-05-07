<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('simpanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('jenis_simpanan', ['Pokok', 'Wajib', 'Sukarela']);
            $table->decimal('jumlah', 15, 2);
            $table->string('bukti_bayar')->nullable();
            $table->enum('status', ['Pending', 'Success'])->default('Pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('simpanan');
    }
};
