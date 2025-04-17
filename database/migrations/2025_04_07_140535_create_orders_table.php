<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi')->unique();
            $table->string('nama_pemesan');
            $table->string('phone_number');
            $table->unsignedBigInteger('payment_total')->default(0);
            $table->string('payment_proof')->nullable();
            $table->enum('status', [
                'pending',         // Belum ada pembayaran
                'waiting_verify',  // Sudah bayar, menunggu verifikasi admin
                'paid',            // Sudah diverifikasi, siap diproses
                'processed',       // Sedang dibuatkan undangan
                'published',       // Sudah tayang
                'completed'        // Selesai, semua proses beres
            ])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
