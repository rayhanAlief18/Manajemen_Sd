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
        Schema::create('pembayaran_spps', function (Blueprint $table) {
            $table->id();
            $table->integer('kd_bayar')->unique();
            $table->unsignedBigInteger('siswa_id');
            $table->string('bulan');
            $table->year('tahun');
            $table->decimal('jumlah_pembayaran', 10, 2);
            $table->string('bukti_pembayaran');
            $table->string('status')->default('belum lunas');
            $table->string('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran_spps');
    }
};
