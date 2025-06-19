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
    Schema::table('jbis', function (Blueprint $table) {
        $table->enum('layanan', ['Gratis', 'Berbayar'])->default('Gratis')->after('foto');
    });
}

public function down()
{
    Schema::table('jbis', function (Blueprint $table) {
        $table->dropColumn('layanan');
    });
}
};
