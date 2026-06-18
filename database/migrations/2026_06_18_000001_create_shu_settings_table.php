<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shu_settings', function (Blueprint $table) {
            $table->id();
            $table->year('tahun')->unique();
            $table->decimal('total_shu', 15, 2);
            $table->decimal('persen_cadangan', 5, 2);
            $table->decimal('persen_jasa_modal', 5, 2);
            $table->decimal('persen_jasa_usaha', 5, 2);
            $table->timestamp('generated_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shu_settings');
    }
};
