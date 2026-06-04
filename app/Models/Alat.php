<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    protected $fillable = [
        'nama_alat',
        'deskripsi',
        'harga_sewa',
        'stok',
        'gambar',
    ];

    public function penyewaan()
    {
        return $this->hasMany(PenyewaanAlat::class);
    }
}
