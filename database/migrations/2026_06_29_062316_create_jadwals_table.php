<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwals', function (Blueprint $table) {

            $table->id();

            $table->foreignId('film_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('studio_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->date('tanggal');

            $table->time('jam_tayang');

            $table->decimal('harga_tiket',10,2);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};