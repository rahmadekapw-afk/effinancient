<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddPendingStatusToPembayarans extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Tambah nilai 'pending' ke enum kolom `status` pada tabel `pembayarans`
        DB::statement("ALTER TABLE `pembayarans` MODIFY `status` ENUM('berhasil','gagal','pending') NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Kembalikan enum ke keadaan semula (tanpa 'pending')
        DB::statement("ALTER TABLE `pembayarans` MODIFY `status` ENUM('berhasil','gagal') NOT NULL");
    }
}
