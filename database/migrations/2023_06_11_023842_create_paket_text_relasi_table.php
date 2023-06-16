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
        Schema::create('paket_text_relasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_paket_text');
            $table->unsignedBigInteger('id_materi_text');
            $table->timestamps();
            $table->foreign('id_paket_text')->references('id')->on('paket_text')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_materi_text')->references('id')->on('materi_text')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paket_text_relasi');
    }
};
