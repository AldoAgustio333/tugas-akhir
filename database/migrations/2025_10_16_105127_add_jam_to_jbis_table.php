<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('jbis', function (Blueprint $table) {
            $table->string('jam')->nullable()->after('jadwal');
        });
    }

    public function down(): void
    {
        Schema::table('jbis', function (Blueprint $table) {
            $table->dropColumn('jam');
        });
    }
};


