<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenyewaanAlat extends Model
{
    protected $fillable = [
        'user_id',
        'alat_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'total_harga',
        'status_pembayaran',
        'bukti_pembayaran',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function alat()
    {
        return $this->belongsTo(Alat::class);
    }
}
