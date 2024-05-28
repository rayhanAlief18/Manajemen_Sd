<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;
    protected  $fillable = [
        'id_mapel',
        'id_guru',
        'id_kelas',
        'jam_mulai',
        'jam_selesai',
        'jumlah_sesi',
        'durasi_Sesi',
        'hari',
    ];
}
