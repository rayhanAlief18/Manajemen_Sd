<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranSpp extends Model
{
    use HasFactory;
    protected $table = 'pembayaran_spps';
    protected $fillable = [
        'kd_bayar',
        'siswa_id',
        'bulan',
        'tahun',
        'jumlah_pembayaran',
        'bukti_pembayaran',
        'status',
        'keterangan'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
