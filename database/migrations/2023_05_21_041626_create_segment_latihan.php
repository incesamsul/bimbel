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
        Schema::create('segment_latihan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('latihan_id');
            $table->dateTime('mulai')->nullable();
            $table->dateTime('selesai')->nullable();
            $table->time('durasi')->nullable();
            $table->enum('status', ['0', '1'])->default('0');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');;
            $table->foreign('latihan_id')->references('id')->on('latihan')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('segment_latihans');
    }
};
