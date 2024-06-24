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
        Schema::create('nilai_siswas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siswa_id')->constrained('siswas'); // Ensure 'siswas' table exists
            $table->unsignedBigInteger('pelajaran_id')->constrained('mata_pelajarans');
            $table->string('semester');
            $table->string('tahun_ajaran');
            $table->integer('KI1_1')->default(0);
            $table->integer('KI1_2')->default(0);
            $table->integer('KI1_3')->default(0);
            $table->integer('KI1_4')->default(0);
            $table->integer('KI1_5')->default(0);
            $table->integer('KI1_6')->default(0);

            $table->integer('KI2_1')->default(0);
            $table->integer('KI2_2')->default(0);
            $table->integer('KI2_3')->default(0);
            $table->integer('KI2_4')->default(0);
            $table->integer('KI2_5')->default(0);
            $table->integer('KI2_6')->default(0);

            $table->integer('KI3_1')->default(0);
            $table->integer('KI3_2')->default(0);
            $table->integer('KI3_3')->default(0);
            $table->integer('KI3_4')->default(0);
            $table->integer('KI3_5')->default(0);
            $table->integer('KI3_6')->default(0);

            $table->integer('KI4_1')->default(0);
            $table->integer('KI4_2')->default(0);
            $table->integer('KI4_3')->default(0);
            $table->integer('KI4_4')->default(0);
            $table->integer('KI4_5')->default(0);
            $table->integer('KI4_6')->default(0);

            $table->integer('UAS')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_siswas');
    }
};
