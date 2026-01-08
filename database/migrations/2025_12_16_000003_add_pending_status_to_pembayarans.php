<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pinjamen', function (Blueprint $table) {
            $table->decimal('jumlah_dibayar', 15, 2)
                  ->default(0)
                  ->after('angsuran_per_bulan');
        });
    }

    public function down(): void
    {
        Schema::table('pinjamen', function (Blueprint $table) {
            $table->dropColumn('jumlah_dibayar');
        });
    }
};
