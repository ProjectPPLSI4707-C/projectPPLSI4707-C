<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Simpanan extends Model
{
    protected $table = 'simpanan';

    protected $fillable = [
        'user_id',
        'jenis_simpanan',
        'jumlah',
        'bukti_bayar',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'jumlah' => 'float',
        ];
    }

    // ─── Relations ─────────────────────────────────────────────────────────────

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ─── Scopes ────────────────────────────────────────────────────────────────

    public function scopePending($query)
    {
        return $query->where('status', 'Pending');
    }

    public function scopeSuccess($query)
    {
        return $query->where('status', 'Success');
    }

    // ─── Helpers ───────────────────────────────────────────────────────────────

    public function isPending(): bool
    {
        return $this->status === 'Pending';
    }

    public function isSuccess(): bool
    {
        return $this->status === 'Success';
    }

    public function getBuktiUrlAttribute(): ?string
    {
        return $this->bukti_bayar ? asset('storage/' . $this->bukti_bayar) : null;
    }
}
