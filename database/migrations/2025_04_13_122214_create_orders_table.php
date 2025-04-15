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
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('template_id')->nullable()->constrained()->onDelete('set null');
            $table->string('kode_transaksi')->unique();
            $table->string('bride_name');
            $table->string('groom_name');
            $table->string('bride_parents_info')->nullable();
            $table->string('groom_parents_info')->nullable();
            $table->dateTime('akad_date')->nullable();
            $table->dateTime('reception_date')->nullable();
            $table->string('place_name'); // Nama tempat acara
            $table->text('location'); // Lokasi acara lengkap
            $table->text('description')->nullable(); // Deskripsi tambahan
            $table->string('phone_number'); // Nomor HP pemesan
            $table->unsignedBigInteger('payment_total')->default(0);
            $table->string('payment_proof')->nullable();
            $table->enum('status', ['pending', 'waiting_verify', 'paid', 'completed'])->default('pending');
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
