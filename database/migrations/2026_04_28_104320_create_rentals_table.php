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
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            // Pastikan tabel 'motors' sudah ada sebelum baris ini dieksekusi
            $table->foreignId('motor_id')->constrained('motors')->onDelete('cascade');
            $table->date('tanggal_sewa');
            $table->date('tanggal_kembali');
            $table->integer('total_harga');
            $table->enum('status', ['pending', 'dibayar', 'selesai'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};
