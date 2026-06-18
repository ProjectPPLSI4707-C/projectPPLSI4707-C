<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShuSetting extends Model
{
    protected $table = 'shu_settings';

    protected $fillable = [
        'tahun',
        'total_shu',
        'persen_cadangan',
        'persen_jasa_modal',
        'persen_jasa_usaha',
        'generated_at',
    ];

    protected function casts(): array
    {
        return [
            'total_shu'          => 'float',
            'persen_cadangan'    => 'float',
            'persen_jasa_modal'  => 'float',
            'persen_jasa_usaha'  => 'float',
            'generated_at'       => 'datetime',
        ];
    }

    // ─── Relations ─────────────────────────────────────────────────────────────

    public function distributions()
    {
        return $this->hasMany(ShuDistribution::class, 'tahun', 'tahun');
    }

    // ─── Helpers ───────────────────────────────────────────────────────────────

    public function isGenerated(): bool
    {
        return $this->generated_at !== null;
    }

    public function danaCadangan(): float
    {
        return round($this->total_shu * $this->persen_cadangan / 100, 2);
    }

    public function danaJasaModal(): float
    {
        return round($this->total_shu * $this->persen_jasa_modal / 100, 2);
    }

    public function danaJasaUsaha(): float
    {
        return round($this->total_shu * $this->persen_jasa_usaha / 100, 2);
    }

    /**
     * Get the overall status based on distributions.
     */
    public function getStatusAttribute(): string
    {
        if (!$this->isGenerated()) {
            return 'belum_generate';
        }

        $distributions = $this->distributions;

        if ($distributions->isEmpty()) {
            return 'belum_generate';
        }

        if ($distributions->every(fn ($d) => $d->status === 'distributed')) {
            return 'distributed';
        }

        if ($distributions->every(fn ($d) => $d->status === 'approved')) {
            return 'approved';
        }

        return 'draft';
    }
}
