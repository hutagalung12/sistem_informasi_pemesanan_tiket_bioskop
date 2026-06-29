<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('films', function (Blueprint $table) {

            $table->id();

            $table->string('judul');

            $table->string('genre');

            $table->integer('durasi');

            $table->date('tanggal_tayang');

            $table->string('poster')->nullable();

            $table->text('sinopsis');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('films');
    }
};