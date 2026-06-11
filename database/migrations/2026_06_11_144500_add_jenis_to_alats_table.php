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
        if (! Schema::hasTable('alats') || Schema::hasColumn('alats', 'jenis')) {
            return;
        }

        Schema::table('alats', function (Blueprint $table) {
            $table->string('jenis')->default('Lainnya')->after('nama_alat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! Schema::hasTable('alats') || ! Schema::hasColumn('alats', 'jenis')) {
            return;
        }

        Schema::table('alats', function (Blueprint $table) {
            $table->dropColumn('jenis');
        });
    }
};
