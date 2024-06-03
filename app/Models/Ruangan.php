<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ruangan extends Model
{
    use HasFactory;

    protected $table = "ruangans";
    protected $primaryKey = "id";
    protected $keyType = "integer";

    public $incrementing = true;
    public $timestamps = false;

    public function barangs(): HasMany
    {
        return $this->hasMany(Barang::class, 'ruangan_id', 'id');
    }

    protected $fillable = [
        "nama",
        "deskripsi",
        "lantai"
    ];
}
