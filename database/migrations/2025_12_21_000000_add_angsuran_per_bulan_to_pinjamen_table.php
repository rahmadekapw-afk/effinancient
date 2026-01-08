<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('pinjamen')) {
            Schema::table('pinjamen', function (Blueprint $table) {
                if (! Schema::hasColumn('pinjamen', 'angsuran_per_bulan')) {
                    $table->decimal('angsuran_per_bulan', 12, 2)->nullable()->after('tanggal_pengajuan');
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('pinjamen')) {
            Schema::table('pinjamen', function (Blueprint $table) {
                if (Schema::hasColumn('pinjamen', 'angsuran_per_bulan')) {
                    $table->dropColumn('angsuran_per_bulan');
                }
            });
        }
    }
};
