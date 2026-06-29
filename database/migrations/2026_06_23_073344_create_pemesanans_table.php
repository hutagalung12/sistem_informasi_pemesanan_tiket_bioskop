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
        Schema::create('pemesanans', function (Blueprint $table) {

            $table->id();

            // Relasi User
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            // Relasi Film
            $table->foreignId('film_id')
                  ->constrained('films')
                  ->cascadeOnDelete();

            // Relasi Jadwal
            $table->foreignId('jadwal_id')
                  ->constrained('jadwals')
                  ->cascadeOnDelete();

            // Relasi Kursi
            $table->foreignId('kursi_id')
                  ->nullable()
                  ->constrained('kursis')
                  ->nullOnDelete();

            // Data pemesanan
            $table->integer('jumlah_tiket')->default(1);

            $table->decimal('total_harga', 12, 2);

            // Status
            $table->enum('status', [
                'pending',
                'dibayar',
                'berhasil',
                'dibatalkan'
            ])->default('pending');

            // Pembayaran
            $table->string('metode_pembayaran')->nullable();

            $table->string('kode_pembayaran')->nullable();

            $table->timestamp('expired_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanans');
    }
};