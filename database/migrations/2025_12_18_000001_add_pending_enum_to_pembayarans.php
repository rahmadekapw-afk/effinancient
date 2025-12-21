<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Add 'pending' to status enum for pembayarans
        DB::statement("ALTER TABLE `pembayarans` MODIFY `status` ENUM('berhasil','gagal','pending') NOT NULL DEFAULT 'gagal'");
    }

    public function down(): void
    {
        // Revert to previous enum (remove 'pending')
        DB::statement("ALTER TABLE `pembayarans` MODIFY `status` ENUM('berhasil','gagal','pending') NOT NULL DEFAULT 'gagal'");
    }
};
