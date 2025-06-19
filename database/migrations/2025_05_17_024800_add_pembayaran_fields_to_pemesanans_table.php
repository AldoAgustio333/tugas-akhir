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
        Schema::table('pemesanans', function (Blueprint $table) {
            $table->string('metode_pembayaran')->nullable(); // virtual wallet, e-wallet, dll
            $table->string('jenis_pembayaran')->nullable();  // dana, seabank, gopay
            $table->string('bukti_pembayaran')->nullable();  // path gambar
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pemesanans', function (Blueprint $table) {
            //
        });
    }
};
