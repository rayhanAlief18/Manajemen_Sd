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
        Schema::create('prestasis', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('gambar_thumbnail')->nullable(false);
            $table->string('gambar_prestasi')->nullable();
            $table->string('nama_prestasi')->nullable(false);
            $table->string('anggota')->nullable(false);
            $table->string('tingkat')->nullable(false);
            $table->date('tgl_prestasi')->nullable(false);
            $table->text('deskripsi')->nullable();
            $table->json('dokumentasi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestasis');
    }
};
