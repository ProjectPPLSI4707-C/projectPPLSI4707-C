<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShuDistribution extends Model
{
    protected $table = 'shu_distributions';

    protected $fillable = [
        'user_id',
        'tahun',
        'total_simpanan_anggota',
        'total_transaksi_anggota',
        'jasa_modal',
        'jasa_usaha',
        'total_shu',
        'status',
        'distributed_at',
    ];

    protected function casts(): array
    {
        return [
            'total_simpanan_anggota'   => 'float',
            'total_transaksi_anggota'  => 'float',
            'jasa_modal'               => 'float',
            'jasa_usaha'               => 'float',
            'total_shu'                => 'float',
            'distributed_at'           => 'datetime',
        ];
    }

    // ─── Relations ─────────────────────────────────────────────────────────────

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ─── Scopes ────────────────────────────────────────────────────────────────

    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeDistributed($query)
    {
        return $query->where('status', 'distributed');
    }

    // ─── Helpers ───────────────────────────────────────────────────────────────

    public function isDraft(): bool
    {
        return $this->status === 'draft';
    }

    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    public function isDistributed(): bool
    {
        return $this->status === 'distributed';
    }
}
