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
        Schema::create('soal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kelas_id');
            $table->unsignedBigInteger('kategori_soal_id');
            $table->unsignedBigInteger('sub_kategori_soal_id');
            $table->string('pertanyaan', 1000);
            $table->string('pembahasan');
            $table->string('jawaban');
            $table->timestamps();
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
            $table->foreign('kategori_soal_id')->references('id')->on('kategori_soal')->onDelete('cascade');
            $table->foreign('sub_kategori_soal_id')->references('id')->on('sub_kategori_soal')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soals');
    }
};
