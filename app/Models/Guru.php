<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $fillable = [
        'foto',
        'nama_guru',
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
        'jabatan',
        'kelas_id',
        'role',
        'status'
    ];
}
