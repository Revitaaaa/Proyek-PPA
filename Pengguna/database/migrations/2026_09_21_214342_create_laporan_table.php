<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('laporan', function (Blueprint $table) {
            $table->id('id_laporan');
            $table->unsignedBigInteger('id_pengguna')->default(1);
            $table->string('nama_pelapor', 100)->default('Revitaaa');
            $table->string('kategori', 100);
            $table->string('sebagai', 50)->default('Korban');
            $table->string('judul_kasus', 200)->nullable();
            $table->text('kronologi');
            $table->string('lokasi_kejadian', 255);
            $table->string('tanggal_kejadian', 50)->default('12 Mei 2025');
            $table->string('bukti_file', 255)->default('bukti.jpg');
            $table->string('status_penanganan', 50)->default('Menunggu Verifikasi');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('laporan');
    }
};