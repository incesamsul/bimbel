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
        Schema::create('paket_soal_relasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_paket_soal');
            $table->unsignedBigInteger('id_soal');
            $table->timestamps();
            $table->foreign('id_paket_soal')->references('id')->on('paket_soal')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_soal')->references('id')->on('soal')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paket_soal_relasi');
    }
};
