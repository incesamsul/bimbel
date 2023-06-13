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
        Schema::create('paket_video_relasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_paket_video');
            $table->unsignedBigInteger('id_materi_video');
            $table->timestamps();
            $table->foreign('id_paket_video')->references('id')->on('paket_video')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_materi_video')->references('id')->on('materi_video')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paket_video_relasi');
    }
};
