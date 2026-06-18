@extends('layouts.app')
@section('title', 'SHU Saya')
@section('page-title', 'SHU Saya')

@section('content')
<div class="page-header">
    <h2>SHU Saya</h2>
    <p>Riwayat Sisa Hasil Usaha yang telah Anda terima</p>
</div>

@if($latest)
    {{-- Stat Cards for Latest Year --}}
    <div style="font-size:13px;font-weight:700;color:var(--gray-500);text-transform:uppercase;letter-spacing:.5px;margin-bottom:12px;">
        SHU Tahun {{ $latest->tahun }}
    </div>
    <div class="stat-grid">
        <div class="stat-card">
            <div class="stat-icon blue">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="22" height="22"><path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            </div>
            <div class="stat-info">
                <div class="stat-label">Jasa Modal</div>
                <div class="stat-value sm">Rp {{ number_format($latest->jasa_modal, 0, ',', '.') }}</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon green">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="22" height="22"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
            </div>
            <div class="stat-info">
                <div class="stat-label">Jasa Usaha</div>
                <div class="stat-value sm">Rp {{ number_format($latest->jasa_usaha, 0, ',', '.') }}</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon gold">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="22" height="22"><path stroke-linecap="round" stroke-linejoin="round" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/><path stroke-linecap="round" stroke-linejoin="round" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/></svg>
            </div>
            <div class="stat-info">
                <div class="stat-label">Total SHU {{ $latest->tahun }}</div>
                <div class="stat-value sm">Rp {{ number_format($latest->total_shu, 0, ',', '.') }}</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon purple">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="22" height="22"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div class="stat-info">
                <div class="stat-label">Total Sepanjang Masa</div>
                <div class="stat-value sm">Rp {{ number_format($totalSepanjangMasa, 0, ',', '.') }}</div>
            </div>
        </div>
    </div>

    {{-- Detail Card --}}
    <div class="card" style="margin-bottom:24px;">
        <div class="card-title">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="18" height="18"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
            Detail Perhitungan SHU {{ $latest->tahun }}
        </div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
            <div style="background:var(--gray-100);border-radius:12px;padding:16px;">
                <div style="font-size:11px;color:var(--gray-500);text-transform:uppercase;letter-spacing:.5px;margin-bottom:6px;">Total Simpanan Anda</div>
                <div style="font-size:16px;font-weight:700;color:var(--gray-900);font-family:'JetBrains Mono',monospace;">Rp {{ number_format($latest->total_simpanan_anggota, 0, ',', '.') }}</div>
            </div>
            <div style="background:var(--gray-100);border-radius:12px;padding:16px;">
                <div style="font-size:11px;color:var(--gray-500);text-transform:uppercase;letter-spacing:.5px;margin-bottom:6px;">Total Transaksi Anda</div>
                <div style="font-size:16px;font-weight:700;color:var(--gray-900);font-family:'JetBrains Mono',monospace;">Rp {{ number_format($latest->total_transaksi_anggota, 0, ',', '.') }}</div>
            </div>
        </div>
        <div style="margin-top:12px;font-size:12px;color:var(--gray-500);">
            @if($latest->distributed_at)
                Didistribusikan pada: {{ $latest->distributed_at->format('d M Y, H:i') }}
            @endif
        </div>
    </div>

    {{-- History Table --}}
    @if($distributions->count() > 1)
    <div class="card">
        <div class="card-title">Riwayat SHU</div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Tahun</th>
                        <th>Jasa Modal</th>
                        <th>Jasa Usaha</th>
                        <th>Total SHU</th>
                        <th>Tanggal Distribusi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($distributions as $d)
                        <tr>
                            <td style="font-weight:700;color:var(--gray-900);">{{ $d->tahun }}</td>
                            <td style="font-family:'JetBrains Mono',monospace;">Rp {{ number_format($d->jasa_modal, 0, ',', '.') }}</td>
                            <td style="font-family:'JetBrains Mono',monospace;">Rp {{ number_format($d->jasa_usaha, 0, ',', '.') }}</td>
                            <td style="font-family:'JetBrains Mono',monospace;font-weight:700;color:var(--gray-900);">Rp {{ number_format($d->total_shu, 0, ',', '.') }}</td>
                            <td style="font-size:12px;color:var(--gray-500);">{{ $d->distributed_at?->format('d M Y') ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

@else
    {{-- Empty State --}}
    <div class="card" style="text-align:center;padding:48px;">
        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="48" height="48" style="display:block;margin:0 auto 16px;color:var(--gray-400);opacity:0.5;"><path stroke-linecap="round" stroke-linejoin="round" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/><path stroke-linecap="round" stroke-linejoin="round" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/></svg>
        <p style="font-size:16px;font-weight:600;color:var(--gray-600);margin-bottom:8px;">Belum Ada SHU</p>
        <p style="font-size:13px;color:var(--gray-500);max-width:400px;margin:0 auto;">SHU Anda akan tampil di sini setelah admin mendistribusikan Sisa Hasil Usaha koperasi.</p>
    </div>
@endif
@endsection
