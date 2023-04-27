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
        Schema::create('cafes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nama_cafe');
            $table->string('alamat_cafe');
            $table->string('kecamatan');
            $table->string('kota');
            $table->string('gambar_cafe');
            $table->string('deskripsi_cafe');
            $table->string('gambar_qris');
            $table->foreignId('admin_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cafes');
    }
};
