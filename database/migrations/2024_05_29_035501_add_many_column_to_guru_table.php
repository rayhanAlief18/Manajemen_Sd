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
            Schema::table('gurus', function (Blueprint $table) {
                $table->unsignedBigInteger('kelas_id')->nullable()->after('nama_guru');
                // Menambahkan foreign key constraint
                $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('set null');
                $table->string('tempat_lahir')->nullable();
                $table->date('tanggal_lahir')->nullable();
                $table->string('nik', 16)->nullable();
                $table->string('no_kk', 16)->nullable();
                $table->string('agama')->nullable();
                $table->string('jenis_kelamin')->nullable();
                $table->string('nomor_npwp')->nullable();
                $table->string('gelar_depan')->nullable();
                $table->string('gelar_belakang')->nullable();
                $table->string('nomor_telepon')->nullable();
                $table->string('nomor_hp')->nullable();
                $table->string('jenjang')->nullable();
                $table->year('tahun_lulus')->nullable();
                $table->string('jurusan')->nullable();
                $table->string('role')->nullable()->default('orang tua');
                $table->string('status')->nullable()->default('non aktif');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
            Schema::table('gurus', function (Blueprint $table) {
                $table->dropColumn([
                    'tempat_lahir',
                    'tanggal_lahir',
                    'nik',
                    'no_kk',
                    'agama',
                    'jenis_kelamin',
                    'nomor_npwp',
                    'gelar_depan',
                    'gelar_belakang',
                    'nomor_telepon',
                    'nomor_hp',
                    'jenjang',
                    'tahun_lulus',
                    'jurusan',
                    'kelas',
                    'role',
                    'status',
                ]);
                // Menghapus foreign key constraint
                $table->dropForeign(['kelas_id']);
                // Menghapus kolom
                $table->dropColumn('kelas_id');
            });
    }
};
