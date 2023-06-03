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
        Schema::create('keuangans', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('cafe_id');
            $table->foreignId('reservation_id')->nullable();
            $table->date('tanggal');
            $table->string('jenis_data');
            $table->integer('nominal');
            $table->integer('jumlah');
            $table->string('keterangan');
            // $table->integer('total');
            $table->integer('jumlah_pengeluaran')->default('0');
            $table->integer('jumlah_pemasukkan')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keuangans');
    }
};
