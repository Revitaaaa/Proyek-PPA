<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_laporan')->unique(); // Contoh: LAP-2025-0001
            $table->string('kategori'); // Kekerasan Perempuan, KDRT, Bullying, dll.
            $table->enum('sebagai', ['Korban', 'Saksi', 'Kerabat']);
            $table->string('pelapor_nama');
            $table->string('lokasi'); // Kota/Kabupaten
            $table->dateTime('tanggal_kejadian');
            $table->text('kronologi');
            $table->string('bukti_lampiran')->nullable();
            $table->enum('status', ['Menunggu Verifikasi', 'Sedang Diproses', 'Selesai'])->default('Menunggu Verifikasi');
            $table->text('catatan_admin')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};