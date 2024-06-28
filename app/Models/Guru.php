<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Guru extends Authenticatable
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
        'email',
        'password',
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
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
}
