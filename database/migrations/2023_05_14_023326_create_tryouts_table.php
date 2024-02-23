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
        Schema::create('tryout', function (Blueprint $table) {
            $table->id();
            $table->string('nama_tryout');
            $table->unsignedBigInteger('kelas_id');
            $table->integer('durasi');
            $table->enum('pembahasan', ['1', '0']);
            $table->dateTime('mulai');
            $table->timestamps();
            $table->foreign('kelas_id')->references('id')->on('kelas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tryout');
    }
};
