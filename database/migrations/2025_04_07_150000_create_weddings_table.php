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
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('slug')->unique();
            $table->string('bride_name');
            $table->string('groom_name');
            $table->string('bride_parents_info')->nullable();  // Keterangan orang tua mempelai wanita
            $table->string('groom_parents_info')->nullable();  // Keterangan orang tua mempelai pria
            $table->dateTime('akad_date')->nullable();
            $table->dateTime('reception_date')->nullable();
            $table->string('location');
            $table->string('place_name')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('template_id')->nullable()->constrained('templates')->nullOnDelete();
            $table->foreignId('music_id')->nullable()->constrained('musics')->nullOnDelete();            
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
