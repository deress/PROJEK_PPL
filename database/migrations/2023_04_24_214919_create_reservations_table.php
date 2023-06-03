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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->datetime('tenggat_pembayaran');
            $table->foreignId('user_id');
            $table->foreignId('katalog_id');
            $table->foreignId('review_id')->nullable();
            $table->integer('jumlah_reservasi');
            $table->date('tanggal_reservasi');
            $table->time('jam_awal');
            $table->time('jam_akhir');
            $table->integer('harga_total');
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
