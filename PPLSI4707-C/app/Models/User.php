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

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nomor_id_anggota',
        'nama_lengkap',
        'email',
        'password',
        'no_ktp',
        'no_telepon',
        'alamat',
        'role',
        'status_keanggotaan',
        'tanggal_bergabung',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'tanggal_bergabung' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Check if user is an admin.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is an anggota (member).
     */
    public function isAnggota(): bool
    {
        return $this->role === 'anggota';
    }

    /**
     * Check if user membership is active.
     */
    public function isAktif(): bool
    {
        return $this->status_keanggotaan === 'aktif';
    }

    /**
     * Generate a unique member ID.
     */
    public static function generateNomorId(): string
    {
        $year = date('Y');
        $lastUser = static::whereYear('created_at', $year)
            ->orderBy('id', 'desc')
            ->first();

        $sequence = $lastUser ? ((int) substr($lastUser->nomor_id_anggota, -4)) + 1 : 1;

        return sprintf('#SL-%s-%04d', $year, $sequence);
    }

    /**
     * Boot method to auto-generate nomor_id_anggota.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            if (empty($user->nomor_id_anggota)) {
                $user->nomor_id_anggota = static::generateNomorId();
            }
        });
    }
}
