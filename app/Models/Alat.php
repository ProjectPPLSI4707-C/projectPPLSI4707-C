<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    const STATUS_TERSEDIA    = 'tersedia';
    const STATUS_DIPINJAM    = 'dipinjam';
    const STATUS_MAINTENANCE = 'maintenance';

    protected $fillable = [
        'nama_alat',
        'deskripsi',
        'harga_sewa',
        'stok',
        'gambar',
        'status',
    ];

    public function penyewaan()
    {
        return $this->hasMany(PenyewaanAlat::class);
    }
}
