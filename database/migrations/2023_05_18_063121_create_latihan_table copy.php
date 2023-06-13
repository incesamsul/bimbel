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
        Schema::create('latihan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_latihan');
            $table->unsignedBigInteger('kelas_id');
            $table->unsignedBigInteger('kategori_soal_id');
            $table->integer('durasi');
            $table->dateTime('mulai');
            $table->timestamps();
            $table->foreign('kelas_id')->references('id')->on('kelas');
            $table->foreign('kategori_soal_id')->references('id')->on('kategori_soal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('latihan');
    }
};
