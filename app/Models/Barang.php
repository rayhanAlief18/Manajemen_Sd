<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Barang extends Model
{
    use HasFactory;

    protected $table = "barangs";
    protected $primaryKey = "id";
    protected $keyType = "integer";

    public $incrementing = true;
    public $timestamps = false;

    public function ruangan(): BelongsTo
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id', 'id');
    }

    protected $fillable = [
        "nama",
        "barang_baik",
        "barang_rusak",
        "deskripsi",
        "ruangan_id"
    ];
}
