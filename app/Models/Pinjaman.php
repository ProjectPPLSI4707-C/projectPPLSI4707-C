<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    protected $table = 'pinjaman';

    protected $fillable = [
        'user_id',
        'jumlah_pinjaman',
        'tenor',
        'bunga_pinjaman',
        'tujuan_pinjaman',
        'dokumen_pendukung',
        'status_pengajuan',
        'tanggal_pengajuan',
        'catatan_admin',
    ];

    protected function casts(): array
    {
        return [
            'jumlah_pinjaman'   => 'float',
            'tenor'             => 'integer',
            'bunga_pinjaman'    => 'float',
            'tanggal_pengajuan' => 'date',
        ];
    }

    // ─── Relations ─────────────────────────────────────────────────────────────

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function angsuran()
    {
        return $this->hasMany(AngsuranPinjaman::class);
    }

    // ─── Scopes ────────────────────────────────────────────────────────────────

    public function scopePending($query)
    {
        return $query->where('status_pengajuan', 'Pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status_pengajuan', 'Approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('status_pengajuan', 'Rejected');
    }

    // ─── Helpers ───────────────────────────────────────────────────────────────

    public function isPending(): bool
    {
        return $this->status_pengajuan === 'Pending';
    }

    public function isApproved(): bool
    {
        return $this->status_pengajuan === 'Approved';
    }

    public function isRejected(): bool
    {
        return $this->status_pengajuan === 'Rejected';
    }

    /**
     * Hitung angsuran per bulan (flat interest).
     * Angsuran = Pokok/Tenor + (Pokok * Bunga%)
     */
    public function angsuranPerBulan(): float
    {
        $pokok  = $this->jumlah_pinjaman / $this->tenor;
        $bunga  = $this->jumlah_pinjaman * ($this->bunga_pinjaman / 100);
        return round($pokok + $bunga, 2);
    }

    public function totalPengembalian(): float
    {
        return round($this->angsuranPerBulan() * $this->tenor, 2);
    }

    public function getDokumenUrlAttribute(): ?string
    {
        return $this->dokumen_pendukung ? asset('storage/' . $this->dokumen_pendukung) : null;
    }
}
