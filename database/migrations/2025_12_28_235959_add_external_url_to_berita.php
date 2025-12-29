<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('berita', function (Blueprint $table) {
            if (! Schema::hasColumn('berita', 'external_url')) {
                $table->string('external_url', 2048)->nullable()->after('slug');
            }
        });
    }

    public function down()
    {
        Schema::table('berita', function (Blueprint $table) {
            if (Schema::hasColumn('berita', 'external_url')) {
                $table->dropColumn('external_url');
            }
        });
    }
};
