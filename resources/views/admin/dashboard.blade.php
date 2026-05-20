@extends('layouts.app')
@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Admin')

@section('content')
<div class="page-header">
    <h2>Dashboard Administrator</h2>
    <p>Ringkasan aktivitas koperasi dan pengajuan yang perlu ditangani</p>
</div>

{{-- Stat Cards --}}
<div class="stat-grid">
    <div class="stat-card">
        <div class="stat-icon blue">👥</div>
        <div>
            <div class="stat-label">Total Anggota</div>
            <div class="stat-value">{{ $totalAnggota }}</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green">🏦</div>
        <div>
            <div class="stat-label">Total Dana Simpanan</div>
            <div class="stat-value sm">Rp {{ number_format($totalSimpananAll, 0, ',', '.') }}</div>
        </div>
    </div>
    <div class="stat-card" style="border:1.5px solid #FDE68A;">
        <div class="stat-icon gold">⏳</div>
        <div>
            <div class="stat-label">Simpanan Pending</div>
            <div class="stat-value">{{ $pendingSimpanan }}</div>
            @if($pendingSimpanan > 0)
                <a href="{{ route('admin.simpanan.index') }}" style="font-size:11.5px;color:#F5A623;font-weight:600;text-decoration:none;">Verifikasi →</a>
            @endif
        </div>
    </div>
    <div class="stat-card" style="border:1.5px solid #FDE68A;">
        <div class="stat-icon red">⏳</div>
        <div>
            <div class="stat-label">Pinjaman Pending</div>
            <div class="stat-value">{{ $pendingPinjaman }}</div>
            @if($pendingPinjaman > 0)
                <a href="{{ route('admin.pinjaman.index') }}" style="font-size:11.5px;color:#EF4444;font-weight:600;text-decoration:none;">Tinjau →</a>
            @endif
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green">💳</div>
        <div>
            <div class="stat-label">Total Pinjaman Aktif</div>
            <div class="stat-value sm">Rp {{ number_format($totalPinjamanAktif, 0, ',', '.') }}</div>
        </div>
    </div>
</div>

<div class="grid-2">
    {{-- Simpanan Pending --}}
    <div class="card">
        <div class="card-title" style="justify-content:space-between;">
            <span>⏳ Simpanan Menunggu Verifikasi</span>
            <a href="{{ route('admin.simpanan.index') }}" style="font-size:12px;color:#19376D;text-decoration:none;font-weight:500;">Lihat semua →</a>
        </div>
        @forelse($recentSimpanan as $s)
            <div style="display:flex;align-items:center;justify-content:space-between;padding:12px 0;border-bottom:1px solid #F3F4F6;">
                <div>
                    <div style="font-size:13.5px;font-weight:600;color:#111827;">{{ $s->user->name }}</div>
                    <div style="font-size:12px;color:#6B7280;">{{ $s->jenis_simpanan }} · {{ $s->created_at->diffForHumans() }}</div>
                </div>
                <div style="text-align:right;">
                    <div style="font-size:13px;font-weight:700;color:#19376D;">Rp {{ number_format($s->jumlah, 0, ',', '.') }}</div>
                    <a href="{{ route('admin.simpanan.show', $s) }}" class="btn btn-sm btn-primary" style="margin-top:4px;">Verifikasi</a>
                </div>
            </div>
        @empty
            <div style="text-align:center;padding:28px;color:#9CA3AF;">
                <div style="font-size:32px;">✅</div>
                <p style="font-size:13px;margin-top:6px;">Tidak ada simpanan pending</p>
            </div>
        @endforelse
    </div>

    {{-- Pinjaman Pending --}}
    <div class="card">
        <div class="card-title" style="justify-content:space-between;">
            <span>💳 Pinjaman Menunggu Keputusan</span>
            <a href="{{ route('admin.pinjaman.index') }}" style="font-size:12px;color:#19376D;text-decoration:none;font-weight:500;">Lihat semua →</a>
        </div>
        @forelse($recentPinjaman as $p)
            <div style="display:flex;align-items:center;justify-content:space-between;padding:12px 0;border-bottom:1px solid #F3F4F6;">
                <div>
                    <div style="font-size:13.5px;font-weight:600;color:#111827;">{{ $p->user->name }}</div>
                    <div style="font-size:12px;color:#6B7280;">{{ $p->tenor }} bln · {{ $p->tanggal_pengajuan->format('d M Y') }}</div>
                </div>
                <div style="text-align:right;">
                    <div style="font-size:13px;font-weight:700;color:#19376D;">Rp {{ number_format($p->jumlah_pinjaman, 0, ',', '.') }}</div>
                    <a href="{{ route('admin.pinjaman.show', $p) }}" class="btn btn-sm btn-gold" style="margin-top:4px;">Tinjau</a>
                </div>
            </div>
        @empty
            <div style="text-align:center;padding:28px;color:#9CA3AF;">
                <div style="font-size:32px;">✅</div>
                <p style="font-size:13px;margin-top:6px;">Tidak ada pinjaman pending</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
