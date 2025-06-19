<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('fakultas')->nullable()->after('npm');
        $table->string('program_studi')->nullable()->after('fakultas');
        $table->string('kelas')->nullable()->after('program_studi');
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['fakultas', 'program_studi', 'kelas']);
    });
}

};
