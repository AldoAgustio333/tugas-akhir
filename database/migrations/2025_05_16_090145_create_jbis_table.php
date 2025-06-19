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
        Schema::create('jbis', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('keahlian');
            $table->enum('jk', ['Laki-laki', 'Perempuan']);
            $table->string('no_hp');
            $table->string('ketersediaan');
            $table->string('jadwal');
            $table->text('alamat')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jbis');
    }
};
