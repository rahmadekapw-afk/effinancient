<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /**
         * 1. Tabel Anggota
         */
        Schema::create('anggotas', function (Blueprint $table) {
            $table->bigIncrements('anggota_id');
            $table->string('nomor_anggota', 20);
            $table->enum('status_anggota', ['aktif', 'nonaktif']);
            $table->decimal('saldo', 12, 2)->default(0);
            $table->decimal('simpanan_hari_raya', 12, 2)->default(0);
            $table->decimal('simpanan_wajib', 12, 2)->default(0);
            $table->decimal('simpanan_pokok', 12, 2)->default(0);
            $table->string('username', 50)->unique();
            $table->string('password', 255);
            $table->string('nama_lengkap', 100);
            $table->string('email', 100)->unique();
            $table->string('no_hp', 15)->nullable();
            $table->text('alamat')->nullable();
            $table->timestamps();
        });

        /**
         * 2. Tabel Admin
         */
        Schema::create('admins', function (Blueprint $table) {
            $table->bigIncrements('admin_id');
            $table->string('username', 50)->unique();
            $table->string('password', 255);
            $table->string('nama_admin', 100);
            $table->timestamps();
        });

        /**
         * 3. Tabel Super Admin
         */
        Schema::create('super_admins', function (Blueprint $table) {
            $table->bigIncrements('superadmin_id');
            $table->string('username', 50)->unique();
            $table->string('password', 255);
            $table->string('nama_superadmin', 100);
            $table->enum('level_akses', ['penuh', 'terbatas']);
            $table->timestamps();
        });

        /**
         * 4. Tabel Simpanan
         */
        Schema::create('simpanans', function (Blueprint $table) {
            $table->bigIncrements('simpanan_id');
            $table->unsignedBigInteger('anggota_id');
            $table->enum('jenis_simpanan', ['wajib', 'sukarela']);
            $table->decimal('nominal', 12, 2);
            $table->date('tanggal_setor');
            $table->decimal('saldo', 12, 2);
            $table->timestamps();

            $table->foreign('anggota_id')
                  ->references('anggota_id')->on('anggotas')
                  ->onDelete('cascade');
        });

        /**
         * 5. Tabel Pinjaman
         */
        Schema::create('pinjamen', function (Blueprint $table) {
            $table->bigIncrements('pinjaman_id');
            $table->unsignedBigInteger('anggota_id');
            $table->decimal('nominal', 12, 2);
            $table->integer('tenor');
            $table->integer('jangka_waktu')->nullable();
            $table->float('bunga');
            $table->enum('status_pinjaman', ['menunggu', 'disetujui', 'lunas','ditolak']);
            $table->enum('pembayaran', ['potong gaji', 'saldo', 'pembayaran online']);
            $table->date('tanggal_pengajuan');
            $table->decimal('angsuran_per_bulan', 12, 2)->nullable();
            // $table->integer('jumlah_dibayar')->default(0);
            $table->timestamps();

            $table->foreign('anggota_id')
                  ->references('anggota_id')->on('anggotas')
                  ->onDelete('cascade');
        });

        /**
         * 6. Tabel Pembayaran
         */
       Schema::create('pembayarans', function (Blueprint $table) {
            $table->bigIncrements('pembayaran_id');

            // Foreign keys
            $table->unsignedBigInteger('anggota_id');
            $table->unsignedBigInteger('simpanan_id')->nullable();
            $table->unsignedBigInteger('pinjaman_id')->nullable();

            // Midtrans columns
            // $table->string('midtrans_order_id', 255)->nullable();
            // $table->string('midtrans_transaction_id')->nullable()->after('midtrans_order_id');
            // $table->string('midtrans_status')->nullable()->after('midtrans_transaction_id');
            // $table->longText('midtrans_response')->nullable();

            // Payment details
            $table->string('metode', 50);
            $table->string('jenis', 50)->nullable();
            $table->decimal('nominal', 12, 2);
            $table->date('tanggal_bayar');
            // $table->integer('angsuran_ke');

            // Status with default
            $table->enum('status', ['berhasil', 'gagal', 'pending'])->default('gagal');

            // Timestamps
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('anggota_id')
                ->references('anggota_id')->on('anggotas')
                ->onDelete('cascade');
            $table->foreign('simpanan_id')
                ->references('simpanan_id')->on('simpanans')
                ->onDelete('set null');
            $table->foreign('pinjaman_id')
                ->references('pinjaman_id')->on('pinjamen')
                ->onDelete('set null');
        });


        /**
         * 7. Tabel Laporan Keuangan
         */
        Schema::create('laporan_keuangans', function (Blueprint $table) {
            $table->bigIncrements('laporan_id');
            $table->unsignedBigInteger('admin_id');
            $table->string('periode', 20);
            $table->enum('format_file', ['PDF', 'Excel']);
            $table->string('file_path', 255);
            $table->date('tanggal_buat');
            $table->timestamps();

            $table->foreign('admin_id')
                  ->references('admin_id')->on('admins')
                  ->onDelete('cascade');
        });

        /**
         * 8. Tabel Pembekuan Bulanan
         */
        Schema::create('pembekuan_bulanans', function (Blueprint $table) {
            $table->bigIncrements('pembekuan_id');
            $table->string('bulan', 10);
            $table->enum('status', ['proses', 'dibekukan']);
            $table->date('tanggal_proses');
            $table->timestamps();
        });

        /**
         * 9. Tabel Notifikasi
         */
        Schema::create('notifikasis', function (Blueprint $table) {
            $table->bigIncrements('notifikasi_id');
            $table->unsignedBigInteger('admin_id')->nullable();;
            $table->unsignedBigInteger('anggota_id')->nullable();;
            $table->string('judul', 100);
            $table->text('isi');
            $table->dateTime('tanggal');
            $table->timestamps();

            $table->foreign('admin_id')
                  ->references('admin_id')->on('admins')
                  ->onDelete('cascade');
            $table->foreign('anggota_id')
                  ->references('anggota_id')->on('anggotas')
                  ->onDelete('cascade');
        });

         Schema::create('keuangan', function (Blueprint $table) {
            $table->id();
            $table->date('date');

            $table->decimal('open', 15, 2);
            $table->decimal('high', 15, 2);
            $table->decimal('low', 15, 5);
            $table->decimal('close', 15, 5);
            $table->decimal('price', 15, 5);

            $table->enum('trend_keuangan', ['Naik', 'Turun', 'Stabil']);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('notifikasis');
        Schema::dropIfExists('pembekuan_bulanans');
        Schema::dropIfExists('laporan_keuangans');
        Schema::dropIfExists('pembayarans');
        Schema::dropIfExists('pinjamen');
        Schema::dropIfExists('simpanans');
        Schema::dropIfExists('super_admins');
        Schema::dropIfExists('admins');
        Schema::dropIfExists('anggotas');
        Schema::enableForeignKeyConstraints();
        Schema::dropIfExists('keuangan');
    }
};
