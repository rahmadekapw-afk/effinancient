<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsAdminReadToNotifikasis extends Migration
{
    public function up()
    {
        if (! Schema::hasTable('notifikasis')) {
            return;
        }

        Schema::table('notifikasis', function (Blueprint $table) {
            if (! Schema::hasColumn('notifikasis', 'is_admin_read')) {
                $table->boolean('is_admin_read')->default(false)->after('anggota_id');
            }
        });
    }

    public function down()
    {
        if (! Schema::hasTable('notifikasis')) {
            return;
        }

        Schema::table('notifikasis', function (Blueprint $table) {
            if (Schema::hasColumn('notifikasis', 'is_admin_read')) {
                $table->dropColumn('is_admin_read');
            }
        });
    }
}
