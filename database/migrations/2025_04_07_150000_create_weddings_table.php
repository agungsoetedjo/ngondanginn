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
        Schema::create('weddings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('slug')->unique();
            $table->string('bride_name');
            $table->string('groom_name');
            $table->string('bride_parents_info')->nullable();  // Keterangan orang tua mempelai wanita
            $table->string('groom_parents_info')->nullable();  // Keterangan orang tua mempelai pria
            $table->dateTime('akad_date')->nullable();
            $table->dateTime('reception_date')->nullable();
            $table->string('akad_location');
            $table->string('akad_place_name')->nullable();
            $table->string('reception_location');
            $table->string('reception_place_name')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('template_id')->nullable()->constrained('templates')->nullOnDelete();
            $table->foreignId('music_id')->nullable()->constrained('musics')->nullOnDelete();
            $table->foreignId('order_id')->nullable()->constrained('orders')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weddings');
    }
};
