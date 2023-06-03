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
        Schema::create('katalogs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nama_fasilitas');
            $table->integer('harga');
            $table->string('deskripsi_fasilitas');
            $table->string('gambar_fasilitas');
            $table->string('persediaan');
            $table->json('fasilitas');
            $table->foreignId('cafe_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('katalogs');
    }
};
