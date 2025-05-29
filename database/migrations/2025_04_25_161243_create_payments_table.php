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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->nullable()->constrained('orders')->onDelete('cascade');
            $table->unsignedBigInteger('payment_total')->nullable()->default(0);
            $table->string('payment_proof')->nullable();
            $table->string('payment_desc')->nullable();
            $table->enum('payment_status', [
                'pending',         // Belum ada pembayaran 
                'rejected',        // Pembayaran Ditolak
                'waiting_verify',  // Sudah bayar, menunggu verifikasi admin
                'paid'             // Pembayaran Diterima
            ])->nullable()->default('pending');
            $table->foreignId('payment_dests_id')->nullable()->constrained('payment_dests')->nullOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
