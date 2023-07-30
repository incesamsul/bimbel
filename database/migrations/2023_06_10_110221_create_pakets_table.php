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
        Schema::create('paket', function (Blueprint $table) {
            $table->id();
            $table->string('nama_paket');
            $table->string('link_telegram')->nullable();
            $table->string('paket_video')->nullable();
            $table->string('paket_text')->nullable();
            $table->string('paket_tryout')->nullable();
            $table->string('paket_latihan')->nullable();
            $table->integer('harga');
            $table->string('tampilkan');
            $table->string('list_paket');
            $table->enum('jenis_paket', ['bimbel', 'non_bimbel']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paket');
    }
};
