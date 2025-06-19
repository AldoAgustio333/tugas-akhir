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
         Schema::table('users', function (Blueprint $table) {
        $table->string('jk')->nullable()->after('email'); // jk = jenis kelamin
        $table->string('no_hp')->nullable()->after('jk');
        $table->string('status')->nullable()->after('no_hp'); // contoh: mahasiswa, dosen, dll
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['jk', 'no_hp', 'status']);
    });
    }
};
