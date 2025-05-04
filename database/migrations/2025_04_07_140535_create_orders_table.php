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
            $table->string('email_pemesan')->nullable();
            $table->string('phone_number');
            $table->enum('status', [
                'created',         // Pesanan dibuat
                'processed',       // Sedang dibuatkan undangan
                'published',       // Sudah tayang
                'completed'        // Selesai, semua proses beres
            ])->default('created');
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
