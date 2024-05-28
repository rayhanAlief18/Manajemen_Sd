<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    use HasFactory;

    protected $table = "prestasis";
    protected $primaryKey = "id";
    protected $keyType = "integer";

    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        "gambar_thumbnail",
        "gambar_prestasi",
        "nama_prestasi",
        "anggota",
        "tingkat",
        "tgl_prestasi",
        "deskripsi",
        "dokumentasi",
    ];
}
