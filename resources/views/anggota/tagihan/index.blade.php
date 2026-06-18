@extends('layouts.app')
@section('title', 'Informasi Tagihan')
@section('page-title', 'Informasi Tagihan')

@section('content')
<div class="page-header">
    <h2>Informasi Tagihan</h2>
    <p>Pantau tagihan simpanan wajib dan angsuran pinjaman Anda</p>
</div>

{{-- ── Summary Cards ── --}}
<div class="stat-grid">
    <div class="stat-card">
        <div class="stat-icon red">
            <svg width="24" height="24" fill="none" stroke="#EF4444" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z"/></svg>
        </div>
        <div>
            <div class="stat-label">Total Tagihan Tertunggak</div>
            <div class="stat-value sm" style="color:var(--red);">Rp {{ number_format($totalTagihan, 0, ',', '.') }}</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon gold">
            <svg width="24" height="24" fill="none" stroke="#F5A623" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div>
            <div class="stat-label">Simpanan Wajib Tertunggak</div>
            <div class="stat-value sm">Rp {{ number_format($totalSimpananWajibTertunggak, 0, ',', '.') }}</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon blue">
            <svg width="24" height="24" fill="none" stroke="#19376D" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-2m2-4h.01M3 12h18"/></svg>
        </div>
        <div>
            <div class="stat-label">Angsuran Pinjaman Tertunggak</div>
            <div class="stat-value sm">Rp {{ number_format($totalAngsuranTertunggak, 0, ',', '.') }}</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green">
            <svg width="24" height="24" fill="none" stroke="#10B981" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div>
            <div class="stat-label">Pinjaman Aktif</div>
            <div class="stat-value sm">{{ count($angsuranTagihan) }} Pinjaman</div>
        </div>
    </div>
</div>

{{-- ── Simpanan Wajib Schedule ── --}}
<div class="card mb-4" style="margin-bottom:24px;">
    <div class="card-title" style="justify-content:space-between;">
        <span>
            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:inline;vertical-align:middle;margin-right:6px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            Tagihan Simpanan Wajib — {{ now()->year }}
        </span>
        <span style="font-size:12px;color:var(--gray-500);font-weight:400;">
            Rp {{ number_format($jumlahWajibPerBulan, 0, ',', '.') }} / bulan
        </span>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Bulan</th>
                    <th>Jumlah Tagihan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($simpananWajibSchedule as $sw)
                    <tr>
                        <td style="font-weight:600;">{{ $sw['bulan'] }}</td>
                        <td style="font-family:'JetBrains Mono',monospace;font-weight:600;color:var(--navy-light);">
                            Rp {{ number_format($sw['jumlah'], 0, ',', '.') }}
                        </td>
                        <td>
                            @if($sw['status'] === 'Lunas')
                                <span class="badge badge-success">
                                    <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="margin-right:3px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                    Lunas
                                </span>
                            @elseif($sw['status'] === 'Menunggu Verifikasi')
                                <span class="badge badge-pending">
                                    <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="margin-right:3px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    Menunggu Verifikasi
                                </span>
                            @else
                                <span class="badge badge-rejected">
                                    <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="margin-right:3px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                    Belum Bayar
                                </span>
                            @endif
                        </td>
                        <td>
                            @if($sw['status'] === 'Belum Bayar')
                                <a href="{{ route('anggota.simpanan.create') }}" class="btn btn-primary btn-sm">
                                    Bayar Sekarang
                                </a>
                            @elseif($sw['status'] === 'Lunas')
                                <span style="font-size:12px;color:var(--gray-500);">—</span>
                            @else
                                <span style="font-size:11px;color:var(--gray-500);font-style:italic;">Sedang diproses</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- ── Angsuran Pinjaman ── --}}
@forelse($angsuranTagihan as $at)
    <div class="card" style="margin-bottom:24px;">
        <div class="card-title" style="justify-content:space-between;flex-wrap:wrap;gap:12px;">
            <span>
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:inline;vertical-align:middle;margin-right:6px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-2"/></svg>
                Angsuran Pinjaman — Rp {{ number_format($at['pinjaman']->jumlah_pinjaman, 0, ',', '.') }}
            </span>
            <span class="badge badge-approved" style="font-size:12px;">
                Disetujui {{ $at['pinjaman']->tanggal_pengajuan->format('d M Y') }}
            </span>
        </div>

        {{-- Pinjaman Info Cards --}}
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:14px;margin-bottom:20px;">
            <div class="tagihan-info-box">
                <div class="tagihan-info-label">Total Pinjaman</div>
                <div class="tagihan-info-value navy">Rp {{ number_format($at['pinjaman']->jumlah_pinjaman, 0, ',', '.') }}</div>
            </div>
            <div class="tagihan-info-box">
                <div class="tagihan-info-label">Total Pengembalian</div>
                <div class="tagihan-info-value">Rp {{ number_format($at['total_pengembalian'], 0, ',', '.') }}</div>
            </div>
            <div class="tagihan-info-box">
                <div class="tagihan-info-label">Angsuran / Bulan</div>
                <div class="tagihan-info-value emerald">Rp {{ number_format($at['angsuran_per_bulan'], 0, ',', '.') }}</div>
            </div>
            <div class="tagihan-info-box">
                <div class="tagihan-info-label">Sisa Tagihan</div>
                <div class="tagihan-info-value red">Rp {{ number_format($at['sisa_tagihan'], 0, ',', '.') }}</div>
            </div>
        </div>

        {{-- Progress Bar --}}
        <div style="margin-bottom:20px;">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:6px;">
                <span style="font-size:12px;font-weight:600;color:var(--gray-700);">Progres Pembayaran</span>
                <span style="font-size:12px;font-weight:700;color:var(--navy-light);">{{ $at['progress'] }}%</span>
            </div>
            <div class="progress-bar-track">
                <div class="progress-bar-fill" style="width:{{ $at['progress'] }}%"></div>
            </div>
            <div style="display:flex;justify-content:space-between;margin-top:6px;">
                <span style="font-size:11px;color:var(--gray-500);">{{ $at['angsuran_dibayar'] }} dari {{ $at['total_tenor'] }} angsuran terbayar</span>
                <span style="font-size:11px;color:var(--gray-500);">Sisa {{ $at['sisa_tenor'] }} angsuran</span>
            </div>
        </div>

        {{-- Jadwal Angsuran Table --}}
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Angsuran Ke</th>
                        <th>Jatuh Tempo</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($at['jadwal'] as $jadwal)
                        <tr class="{{ $jadwal['status'] === 'Jatuh Tempo' ? 'row-overdue' : '' }}">
                            <td style="font-weight:600;color:var(--gray-700);">
                                <span class="angsuran-num">{{ $jadwal['ke'] }}</span>
                            </td>
                            <td style="color:var(--gray-700);">{{ $jadwal['jatuh_tempo'] }}</td>
                            <td style="font-family:'JetBrains Mono',monospace;font-weight:600;color:var(--navy-light);">
                                Rp {{ number_format($jadwal['jumlah'], 0, ',', '.') }}
                            </td>
                            <td>
                                @if($jadwal['status'] === 'Lunas')
                                    <span class="badge badge-success">
                                        <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="margin-right:3px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                        Lunas
                                    </span>
                                @elseif($jadwal['status'] === 'Menunggu Verifikasi')
                                    <span class="badge badge-pending">
                                        <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="margin-right:3px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        Menunggu Verifikasi
                                    </span>
                                @elseif($jadwal['status'] === 'Jatuh Tempo')
                                    <span class="badge badge-rejected" style="animation:pulse-red 2s infinite;">
                                        <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="margin-right:3px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                        Jatuh Tempo
                                    </span>
                                @else
                                    <span class="badge" style="background:var(--gray-100);color:var(--gray-500);">
                                        Belum Bayar
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Action Button --}}
        @if($at['sisa_tenor'] > 0)
            <div style="margin-top:16px;display:flex;justify-content:flex-end;">
                <a href="{{ route('anggota.angsuran.create') }}" class="btn btn-success">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-2m4-2a2 2 0 01-2 2h-2a2 2 0 01-2-2m6 0a2 2 0 00-2-2h-2a2 2 0 00-2 2m6 0v2m-6-2v2"/></svg>
                    Bayar Angsuran
                </a>
            </div>
        @endif
    </div>
@empty
    {{-- No active loans --}}
    <div class="card" style="margin-bottom:24px;">
        <div class="card-title">
            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="margin-right:6px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-2"/></svg>
            Angsuran Pinjaman
        </div>
        <div style="text-align:center;padding:40px 16px;color:var(--gray-500);">
            <svg style="margin:0 auto 14px;color:var(--gray-400);" width="48" height="48" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
            <p style="font-size:14px;font-weight:500;margin-bottom:4px;">Tidak ada pinjaman aktif</p>
            <p style="font-size:12.5px;color:var(--gray-400);">Anda belum memiliki pinjaman yang disetujui saat ini.</p>
        </div>
    </div>
@endforelse

@endsection

@push('styles')
<style>
    /* ── Tagihan Info Boxes ── */
    .tagihan-info-box {
        background: var(--gray-50);
        border: 1px solid var(--gray-200);
        border-radius: 12px;
        padding: 16px;
        transition: transform .2s, box-shadow .2s;
    }
    .tagihan-info-box:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,.06);
    }
    .tagihan-info-label {
        font-size: 11px;
        font-weight: 600;
        color: var(--gray-500);
        text-transform: uppercase;
        letter-spacing: .5px;
        margin-bottom: 6px;
    }
    .tagihan-info-value {
        font-family: 'Poppins', sans-serif;
        font-size: 15px;
        font-weight: 700;
        color: var(--gray-900);
    }
    .tagihan-info-value.navy    { color: var(--navy-light); }
    .tagihan-info-value.emerald { color: var(--emerald); }
    .tagihan-info-value.red     { color: var(--red); }

    /* ── Progress Bar ── */
    .progress-bar-track {
        width: 100%;
        height: 10px;
        background: var(--gray-200);
        border-radius: 10px;
        overflow: hidden;
    }
    .progress-bar-fill {
        height: 100%;
        background: linear-gradient(90deg, var(--navy), var(--emerald));
        border-radius: 10px;
        transition: width .8s ease;
        position: relative;
    }
    .progress-bar-fill::after {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,.3), transparent);
        animation: shimmer 2s infinite;
    }

    /* ── Angsuran Number Badge ── */
    .angsuran-num {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        border-radius: 8px;
        background: var(--blue-light);
        font-size: 12px;
        font-weight: 700;
        color: var(--navy);
    }

    /* ── Overdue Row ── */
    .row-overdue {
        background: #FEF2F2 !important;
    }
    .row-overdue:hover {
        background: #FEE2E2 !important;
    }

    /* ── Animations ── */
    @keyframes shimmer {
        0%   { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }
    @keyframes pulse-red {
        0%, 100% { opacity: 1; }
        50%      { opacity: .7; }
    }
</style>
@endpush
