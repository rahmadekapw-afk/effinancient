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

        // Ensure existing rows don't have values outside the target enum
        DB::statement("UPDATE `pembayarans` SET `status` = 'gagal' WHERE `status` NOT IN ('berhasil','gagal')");
        DB::statement("ALTER TABLE `pembayarans` MODIFY `status` ENUM('berhasil','gagal') NOT NULL DEFAULT 'gagal'");

    }
};
