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
        <div class="stat-icon blue">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="22" height="22"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
        </div>
        <div>
            <div class="stat-label">Total Anggota</div>
            <div class="stat-value">{{ $totalAnggota }}</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="22" height="22"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V10M12 21V10M5 21V10M3 7l9-4 9 4M4 10h16M3 21h18"/></svg>
        </div>
        <div>
            <div class="stat-label">Total Dana Simpanan</div>
            <div class="stat-value sm">Rp {{ number_format($totalSimpananAll, 0, ',', '.') }}</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon gold">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="22" height="22"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div>
            <div class="stat-label">Simpanan Pending</div>
            <div style="display:flex; align-items:baseline; gap:8px;">
                <div class="stat-value">{{ $pendingSimpanan }}</div>
                @if($pendingSimpanan > 0)
                    <a href="{{ route('admin.simpanan.index') }}" style="font-size:12px;color:var(--primary);font-weight:600;text-decoration:none;">Verifikasi &rarr;</a>
                @endif
            </div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon red">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="22" height="22"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
        </div>
        <div>
            <div class="stat-label">Pinjaman Pending</div>
            <div style="display:flex; align-items:baseline; gap:8px;">
                <div class="stat-value">{{ $pendingPinjaman }}</div>
                @if($pendingPinjaman > 0)
                    <a href="{{ route('admin.pinjaman.index') }}" style="font-size:12px;color:var(--primary);font-weight:600;text-decoration:none;">Tinjau &rarr;</a>
                @endif
            </div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="22" height="22"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
        </div>
        <div>
            <div class="stat-label">Total Pinjaman Aktif</div>
            <div class="stat-value sm">Rp {{ number_format($totalPinjamanAktif, 0, ',', '.') }}</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon purple">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="22" height="22"><path stroke-linecap="round" stroke-linejoin="round" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/><path stroke-linecap="round" stroke-linejoin="round" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/></svg>
        </div>
        <div>
            <div class="stat-label">SHU Tahun Berjalan</div>
            <div class="stat-value sm">Rp {{ number_format($totalShuTahunIni, 0, ',', '.') }}</div>
        </div>
    </div>
</div>

<div class="grid-2">
    {{-- Simpanan Pending --}}
    <div class="card">
        <div class="card-title" style="justify-content:space-between;">
            <span>Simpanan Menunggu Verifikasi</span>
            <a href="{{ route('admin.simpanan.index') }}" style="font-size:13px;color:var(--primary);text-decoration:none;font-weight:600;">Lihat semua &rarr;</a>
        </div>
        @forelse($recentSimpanan as $s)
            <div style="display:flex;align-items:center;justify-content:space-between;padding:14px 0;border-bottom:1px solid var(--gray-200);">
                <div>
                    <div style="font-size:14px;font-weight:600;color:var(--gray-900);">{{ $s->user->name }}</div>
                    <div style="font-size:12px;color:var(--gray-500);margin-top:2px;">{{ $s->jenis_simpanan }} · {{ $s->created_at->diffForHumans() }}</div>
                </div>
                <div style="text-align:right;">
                    <div style="font-size:15px;font-weight:700;color:var(--gray-800);font-family:'JetBrains Mono',monospace;">Rp {{ number_format($s->jumlah, 0, ',', '.') }}</div>
                    <a href="{{ route('admin.simpanan.show', $s) }}" class="btn btn-sm btn-primary" style="margin-top:6px; font-size: 11px; padding: 6px 12px;">Verifikasi</a>
                </div>
            </div>
        @empty
            <div style="text-align:center;padding:36px;color:var(--gray-500);">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="32" height="32" style="display:block;margin:0 auto 8px;color:var(--emerald);"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <p style="font-size:13px;font-weight:550;">Tidak ada simpanan pending</p>
            </div>
        @endforelse
    </div>

    {{-- Pinjaman Pending --}}
    <div class="card">
        <div class="card-title" style="justify-content:space-between;">
            <span>Pinjaman Menunggu Keputusan</span>
            <a href="{{ route('admin.pinjaman.index') }}" style="font-size:13px;color:var(--primary);text-decoration:none;font-weight:600;">Lihat semua &rarr;</a>
        </div>
        @forelse($recentPinjaman as $p)
            <div style="display:flex;align-items:center;justify-content:space-between;padding:14px 0;border-bottom:1px solid var(--gray-200);">
                <div>
                    <div style="font-size:14px;font-weight:600;color:var(--gray-900);">{{ $p->user->name }}</div>
                    <div style="font-size:12px;color:var(--gray-500);margin-top:2px;">{{ $p->tenor }} bln · {{ $p->tanggal_pengajuan->format('d M Y') }}</div>
                </div>
                <div style="text-align:right;">
                    <div style="font-size:15px;font-weight:700;color:var(--gray-800);font-family:'JetBrains Mono',monospace;">Rp {{ number_format($p->jumlah_pinjaman, 0, ',', '.') }}</div>
                    <a href="{{ route('admin.pinjaman.show', $p) }}" class="btn btn-sm btn-gold" style="margin-top:6px; font-size: 11px; padding: 6px 12px;">Tinjau</a>
                </div>
            </div>
        @empty
            <div style="text-align:center;padding:36px;color:var(--gray-500);">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="32" height="32" style="display:block;margin:0 auto 8px;color:var(--emerald);"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <p style="font-size:13px;font-weight:550;">Tidak ada pinjaman pending</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
