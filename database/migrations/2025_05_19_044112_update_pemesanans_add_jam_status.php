<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePemesanansAddJamStatus extends Migration
{
    public function up()
    {
        Schema::table('pemesanans', function (Blueprint $table) {
            $table->time('jam_awal')->nullable();
            $table->time('jam_akhir')->nullable();
            $table->integer('durasi_jam')->nullable();
            $table->integer('biaya')->nullable();
            $table->enum('status', ['pending', 'disetujui', 'ditolak'])->default('pending');
        });
    }

    public function down()
    {
        Schema::table('pemesanans', function (Blueprint $table) {
            $table->dropColumn(['jam_awal', 'jam_akhir', 'durasi_jam', 'biaya', 'status']);
        });
    }
}
