<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;

class Siswa extends Model implements AuthenticatableContract
{
    use HasFactory;

    use Authenticatable;

    protected $table = 'siswas';

    protected $fillable = [
        'NISN',
        'NIK',
        'NO_KK',
        'NIS',
        'nama_siswa',
        'foto_siswa',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'tempat',
        'anak_ke',
        'kelas_id',
        'wali_siswa',
        'email',
        'password',
        'semester',
    ];

    // Jika Anda menggunakan hashing password, pastikan untuk menghash password sebelum menyimpan
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
    public function pembayaranSPP()
    {
        return $this->hasMany(PembayaranSPP::class);
    }
    public function absensi()
    {
        return $this->hasMany(Absensi::class);
    }
}
