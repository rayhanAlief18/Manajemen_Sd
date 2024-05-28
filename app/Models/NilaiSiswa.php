<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiSiswa extends Model
{
    use HasFactory;
    protected $table = 'nilai_siswas';

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
    // Definisikan relasi dengan MataPelajaran
    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class);
    }
}
