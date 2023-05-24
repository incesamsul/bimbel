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
        Schema::create('jawaban_tryout', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('segment_tryout_id');
            $table->unsignedBigInteger('soal_id');
            $table->string('jawaban');
            $table->enum('ragu', ['0', '1'])->default('0');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');;
            $table->foreign('segment_tryout_id')->references('id')->on('segment_tryout')->onDelete('cascade');;
            $table->foreign('soal_id')->references('id')->on('soal')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawaban_tryouts');
    }
};
