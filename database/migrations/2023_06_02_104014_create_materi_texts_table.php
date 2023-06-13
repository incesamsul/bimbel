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
        Schema::create('materi_text', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kategori_soal_id');
            $table->string('judul_materi');
            $table->string('link');
            $table->timestamps();
            $table->foreign('kategori_soal_id')->references('id')->on('kategori_soal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materi_text');
    }
};
