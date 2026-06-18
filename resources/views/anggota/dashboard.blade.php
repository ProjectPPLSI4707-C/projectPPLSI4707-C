@extends('layouts.app')
@section('title', 'Dashboard Anggota')
@section('page-title', 'Dashboard')

@section('content')
<div class="page-header">
    <h2>Selamat Datang, {{ auth()->user()->name }}</h2>
    <p>Berikut ringkasan simpanan dan pinjaman Anda</p>
</div>

{{-- Stat Cards --}}
<div class="stat-grid">
    <div class="stat-card">
        <div class="stat-icon blue">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="22" height="22"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V10M12 21V10M5 21V10M3 7l9-4 9 4M4 10h16M3 21h18"/></svg>
        </div>
        <div>
            <div class="stat-label">Total Simpanan</div>
            <div class="stat-value sm">Rp {{ number_format($totalSimpanan, 0, ',', '.') }}</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon gold">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="22" height="22"><path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/></svg>
        </div>
        <div>
            <div class="stat-label">Simpanan Pokok</div>
            <div class="stat-value sm">Rp {{ number_format($simpananPokok, 0, ',', '.') }}</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="22" height="22"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        </div>
        <div>
            <div class="stat-label">Simpanan Wajib</div>
            <div class="stat-value sm">Rp {{ number_format($simpananWajib, 0, ',', '.') }}</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon blue">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="22" height="22"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div>
            <div class="stat-label">Simpanan Sukarela</div>
            <div class="stat-value sm">Rp {{ number_format($simpananSukarela, 0, ',', '.') }}</div>
        </div>
    </div>
    @if($shuTerbaru)
    <div class="stat-card">
        <div class="stat-icon purple">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="22" height="22"><path stroke-linecap="round" stroke-linejoin="round" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/><path stroke-linecap="round" stroke-linejoin="round" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/></svg>
        </div>
        <div>
            <div class="stat-label">SHU Tahun {{ $shuTerbaru->tahun }}</div>
            <div class="stat-value sm">Rp {{ number_format($shuTerbaru->total_shu, 0, ',', '.') }}</div>
        </div>
    </div>
    @endif
</div>

<div class="grid-2">
    {{-- Status Pinjaman --}}
    <div class="card">
        <div class="card-title">Status Pinjaman</div>
        @if($pinjamanAktif)
            <div style="background:var(--gold-light);border-radius:12px;padding:24px;margin-bottom:20px;border:1px solid rgba(245, 166, 35, 0.15);">
                <div style="font-size:13px;color:var(--primary);font-weight:700;margin-bottom:8px;text-transform:uppercase;letter-spacing:0.5px;">Pinjaman Aktif</div>
                <div style="font-size:24px;font-weight:700;color:var(--gray-900);font-family:'JetBrains Mono',sans-serif;">
                    Rp {{ number_format($pinjamanAktif->jumlah_pinjaman, 0, ',', '.') }}
                </div>
                <div style="font-size:13px;color:var(--gray-550);margin-top:12px;font-weight:500;">
                    Tenor {{ $pinjamanAktif->tenor }} bulan · Angsuran <span style="font-weight:700;color:var(--gray-900);">Rp {{ number_format($pinjamanAktif->angsuranPerBulan(), 0, ',', '.') }}/bln</span>
                </div>
            </div>
        @elseif($pinjamanPending > 0)
            <div style="background:var(--gold-light);border-radius:12px;padding:24px;margin-bottom:20px;border:1px solid rgba(245, 166, 35, 0.1);">
                <div style="font-size:13px;color:var(--primary);font-weight:700;margin-bottom:6px;text-transform:uppercase;letter-spacing:0.5px;">Menunggu Verifikasi</div>
                <div style="font-size:14px;color:var(--gray-700);font-weight:550;">{{ $pinjamanPending }} pengajuan sedang diproses oleh admin</div>
            </div>
        @else
            <div style="text-align:center;padding:36px 16px;color:var(--gray-500);">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="36" height="36" style="display:block;margin:0 auto 8px;opacity:0.6;color:var(--gray-400);"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                <p style="font-size:13px;font-weight:550;margin-bottom:16px;">Belum ada pinjaman aktif</p>
            </div>
        @endif
        <a href="{{ route('anggota.pinjaman.create') }}" class="btn btn-primary w-full" style="justify-content:center;">
            Ajukan Pinjaman Baru
        </a>
    </div>

    {{-- Riwayat Terbaru --}}
    <div class="card">
        <div class="card-title" style="justify-content:space-between;">
            Riwayat Transaksi Terbaru
            <a href="{{ route('anggota.simpanan.index') }}" style="font-size:13px;color:var(--primary);font-weight:600;text-decoration:none;">Lihat semua &rarr;</a>
        </div>
        @forelse($riwayatTerbaru as $item)
            @php
                $labelTransaksi = isset($item->jenis_simpanan)
                    ? $item->jenis_simpanan
                    : ('Angsuran Pinjaman #' . $item->pinjaman_id);
            @endphp
            <div style="display:flex;align-items:center;justify-content:space-between;padding:12px 0;border-bottom:1px solid var(--gray-200);">
                <div>
                    <div style="font-size:14px;font-weight:600;color:var(--gray-800);">{{ $labelTransaksi }}</div>
                    <div style="font-size:12px;color:var(--gray-500);margin-top:2px;">{{ $item->created_at->format('d M Y') }}</div>
                </div>
                <div style="text-align:right;">
                    <div style="font-size:15px;font-weight:700;color:var(--gray-900);font-family:'JetBrains Mono',monospace;">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</div>
                    <span class="badge {{ $item->status === 'Success' ? 'badge-success' : 'badge-pending' }}" style="margin-top:4px;">
                        {{ $item->status }}
                    </span>
                </div>
            </div>
        @empty
            <div style="text-align:center;padding:36px;color:var(--gray-500);">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="32" height="32" style="display:block;margin:0 auto 8px;opacity:0.6;"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                <p style="font-size:13px;font-weight:550;margin-bottom:16px;">Belum ada transaksi</p>
            </div>
        @endforelse
        <div class="mt-4">
            <a href="{{ route('anggota.simpanan.create') }}" class="btn btn-outline w-full" style="justify-content:center;">Bayar Simpanan</a>
        </div>
    </div>
</div>
@endsection
