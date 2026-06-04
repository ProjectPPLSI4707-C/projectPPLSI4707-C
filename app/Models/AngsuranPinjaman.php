<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AngsuranPinjaman extends Model
{
    protected $table = 'angsuran_pinjaman';

    protected $fillable = [
        'pinjaman_id',
        'user_id',
        'jumlah',
        'tanggal_bayar',
        'bukti_bayar',
        'status',
        'verified_at',
    ];

    protected function casts(): array
    {
        return [
            'jumlah'        => 'float',
            'tanggal_bayar' => 'date',
            'verified_at'   => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pinjaman()
    {
        return $this->belongsTo(Pinjaman::class);
    }

    public function getBuktiUrlAttribute(): ?string
    {
        return $this->bukti_bayar ? asset('storage/' . $this->bukti_bayar) : null;
    }
}
