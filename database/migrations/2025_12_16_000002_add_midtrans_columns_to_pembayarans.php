<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMidtransColumnsToPembayarans extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pembayarans', function (Blueprint $table) {
            if (! Schema::hasColumn('pembayarans', 'midtrans_order_id')) {
                $table->string('midtrans_order_id')->nullable()->after('pembayaran_id');
            }
            if (! Schema::hasColumn('pembayarans', 'midtrans_transaction_id')) {
                $table->string('midtrans_transaction_id')->nullable()->after('midtrans_order_id');
            }
            if (! Schema::hasColumn('pembayarans', 'midtrans_status')) {
                $table->string('midtrans_status')->nullable()->after('midtrans_transaction_id');
            }
            if (! Schema::hasColumn('pembayarans', 'midtrans_response')) {
                $table->json('midtrans_response')->nullable()->after('midtrans_status');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pembayarans', function (Blueprint $table) {
            if (Schema::hasColumn('pembayarans', 'midtrans_response')) {
                $table->dropColumn('midtrans_response');
            }
            if (Schema::hasColumn('pembayarans', 'midtrans_status')) {
                $table->dropColumn('midtrans_status');
            }
            if (Schema::hasColumn('pembayarans', 'midtrans_transaction_id')) {
                $table->dropColumn('midtrans_transaction_id');
            }
            if (Schema::hasColumn('pembayarans', 'midtrans_order_id')) {
                $table->dropColumn('midtrans_order_id');
            }
        });
    }
}
