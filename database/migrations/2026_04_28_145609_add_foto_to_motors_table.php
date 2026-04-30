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
    Schema::table('motors', function (Blueprint $table) {
        // Menambahkan kolom foto setelah kolom harga_sewa
        $table->string('foto')->nullable()->after('harga_sewa');
    });
}

public function down(): void
{
    Schema::table('motors', function (Blueprint $table) {
        $table->dropColumn('foto');
    });
}
};
