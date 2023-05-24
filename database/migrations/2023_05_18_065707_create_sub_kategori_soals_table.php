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
        Schema::create('sub_kategori_soal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kategori_soal_id');
            $table->string('nama');
            $table->timestamps();
            $table->foreign('kategori_soal_id')->references('id')->on('kategori_soal')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_kategori_soals');
    }
};
