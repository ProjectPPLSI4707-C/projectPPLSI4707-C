<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    // ─── Helpers ───────────────────────────────────────────────────────────────

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isAnggota(): bool
    {
        return $this->role === 'anggota';
    }

    // ─── Relations ─────────────────────────────────────────────────────────────

    public function simpanan()
    {
        return $this->hasMany(Simpanan::class);
    }

    public function pinjaman()
    {
        return $this->hasMany(Pinjaman::class);
    }

    public function angsuranPinjaman()
    {
        return $this->hasMany(AngsuranPinjaman::class);
    }

    // ─── Aggregates ────────────────────────────────────────────────────────────

    public function totalSimpanan(): float
    {
        return $this->simpanan()->where('status', 'Success')->sum('jumlah');
    }

    public function totalSimpananByJenis(string $jenis): float
    {
        return $this->simpanan()
            ->where('jenis_simpanan', $jenis)
            ->where('status', 'Success')
            ->sum('jumlah');
    }
}
