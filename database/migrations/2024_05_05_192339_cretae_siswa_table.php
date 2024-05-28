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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('NISN')->nullable()->unique();
            $table->bigInteger('NIK')->nullable()->unique();
            $table->bigInteger('NO_KK')->nullable();
            $table->integer('NIS')->nullable()->unique();
            $table->string('foto_siswa');
            $table->string('nama_siswa');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['Laki', 'Perempuan']);
            $table->string('agama')->nullable();
            $table->string('tempat')->nullable();
            $table->integer('anak_ke')->nullable();
            $table->foreignId('kelas_id')->constrained('kelas')->default(1)->onDelete('cascade');
            $table->string('wali_siswa');
            $table->enum('semester', ['Semester 1', 'Semester 2', ''])->default('Semester 1');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        //
    }
};
