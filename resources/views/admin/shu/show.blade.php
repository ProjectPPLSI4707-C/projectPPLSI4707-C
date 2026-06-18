@extends('layouts.app')
@section('title', 'Detail SHU ' . $shuSetting->tahun)
@section('page-title', 'Detail SHU ' . $shuSetting->tahun)

@section('content')
<div class="page-header">
    <h2>Distribusi SHU Tahun {{ $shuSetting->tahun }}</h2>
    <p>Detail konfigurasi dan distribusi SHU kepada anggota</p>
</div>

{{-- Config Summary Cards --}}
<div class="stat-grid">
    <div class="stat-card">
        <div class="stat-icon gold">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="22" height="22"><path stroke-linecap="round" stroke-linejoin="round" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/><path stroke-linecap="round" stroke-linejoin="round" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/></svg>
        </div>
        <div class="stat-info">
            <div class="stat-label">Total SHU</div>
            <div class="stat-value sm">Rp {{ number_format($shuSetting->total_shu, 0, ',', '.') }}</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon red">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="22" height="22"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V10M12 21V10M5 21V10M3 7l9-4 9 4M4 10h16M3 21h18"/></svg>
        </div>
        <div class="stat-info">
            <div class="stat-label">Dana Cadangan ({{ $shuSetting->persen_cadangan }}%)</div>
            <div class="stat-value sm">Rp {{ number_format($shuSetting->danaCadangan(), 0, ',', '.') }}</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon blue">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="22" height="22"><path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
        </div>
        <div class="stat-info">
            <div class="stat-label">Dana Jasa Modal ({{ $shuSetting->persen_jasa_modal }}%)</div>
            <div class="stat-value sm">Rp {{ number_format($shuSetting->danaJasaModal(), 0, ',', '.') }}</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="22" height="22"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
        </div>
        <div class="stat-info">
            <div class="stat-label">Dana Jasa Usaha ({{ $shuSetting->persen_jasa_usaha }}%)</div>
            <div class="stat-value sm">Rp {{ number_format($shuSetting->danaJasaUsaha(), 0, ',', '.') }}</div>
        </div>
    </div>
</div>

{{-- Actions --}}
<div class="card" style="margin-bottom:24px;">
    <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;">
        <div>
            <div style="font-size:13px;color:var(--gray-500);margin-bottom:4px;">Status Distribusi</div>
            @if($shuSetting->status === 'distributed')
                <span class="badge badge-distributed" style="font-size:13px;padding:6px 14px;">✅ DISTRIBUTED</span>
            @elseif($shuSetting->status === 'approved')
                <span class="badge badge-approved" style="font-size:13px;padding:6px 14px;">✅ APPROVED</span>
            @elseif($shuSetting->status === 'draft')
                <span class="badge badge-draft" style="font-size:13px;padding:6px 14px;">📋 DRAFT</span>
            @else
                <span class="badge badge-pending" style="font-size:13px;padding:6px 14px;">⏳ BELUM GENERATE</span>
            @endif
        </div>
        <div style="display:flex;gap:10px;flex-wrap:wrap;">
            @if($shuSetting->status === 'belum_generate')
                <form action="{{ route('admin.shu.generate', $shuSetting) }}" method="POST" onsubmit="return confirm('Generate distribusi SHU untuk seluruh anggota?')">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="16" height="16"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                        Generate SHU
                    </button>
                </form>
            @elseif($shuSetting->status === 'draft')
                <form action="{{ route('admin.shu.generate', $shuSetting) }}" method="POST" onsubmit="return confirm('Re-generate distribusi SHU? Data distribusi sebelumnya akan dihitung ulang.')">
                    @csrf
                    <button type="submit" class="btn btn-outline btn-sm">Re-Generate</button>
                </form>
                <form action="{{ route('admin.shu.approve', $shuSetting) }}" method="POST" onsubmit="return confirm('Approve distribusi SHU ini?')">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-success">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="16" height="16"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        Approve SHU
                    </button>
                </form>
            @elseif($shuSetting->status === 'approved')
                <form action="{{ route('admin.shu.distribute', $shuSetting) }}" method="POST" onsubmit="return confirm('Distribusikan SHU ke seluruh anggota? Anggota akan dapat melihat SHU mereka.')">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-gold">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="16" height="16"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Distribusikan SHU
                    </button>
                </form>
            @endif

            @if($distributions->isNotEmpty())
                <a href="{{ route('admin.shu.export', $shuSetting) }}" class="btn btn-outline btn-sm">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="14" height="14"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Export CSV
                </a>
            @endif

            <a href="{{ route('admin.shu.index') }}" class="btn btn-outline btn-sm">← Kembali</a>
        </div>
    </div>
</div>

{{-- Distribution Table --}}
@if($distributions->isNotEmpty())
<div class="card">
    <div class="card-title" style="justify-content:space-between;">
        <span>Distribusi per Anggota ({{ $distributions->count() }} anggota)</span>
        <span style="font-size:13px;font-weight:700;color:var(--primary);font-family:'JetBrains Mono',monospace;">
            Total: Rp {{ number_format($totalDistributed, 0, ',', '.') }}
        </span>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Anggota</th>
                    <th>Total Simpanan</th>
                    <th>Total Transaksi</th>
                    <th>Jasa Modal</th>
                    <th>Jasa Usaha</th>
                    <th>Total SHU</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($distributions as $i => $d)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td style="font-weight:600;color:var(--gray-900);">{{ $d->user->name }}</td>
                        <td style="font-family:'JetBrains Mono',monospace;">Rp {{ number_format($d->total_simpanan_anggota, 0, ',', '.') }}</td>
                        <td style="font-family:'JetBrains Mono',monospace;">Rp {{ number_format($d->total_transaksi_anggota, 0, ',', '.') }}</td>
                        <td style="font-family:'JetBrains Mono',monospace;color:var(--navy-light);font-weight:600;">Rp {{ number_format($d->jasa_modal, 0, ',', '.') }}</td>
                        <td style="font-family:'JetBrains Mono',monospace;color:var(--emerald);font-weight:600;">Rp {{ number_format($d->jasa_usaha, 0, ',', '.') }}</td>
                        <td style="font-family:'JetBrains Mono',monospace;font-weight:700;color:var(--gray-900);">Rp {{ number_format($d->total_shu, 0, ',', '.') }}</td>
                        <td>
                            @if($d->status === 'distributed')
                                <span class="badge badge-distributed">DISTRIBUTED</span>
                            @elseif($d->status === 'approved')
                                <span class="badge badge-approved">APPROVED</span>
                            @else
                                <span class="badge badge-draft">DRAFT</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@else
    <div class="card" style="text-align:center;padding:48px;">
        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="40" height="40" style="display:block;margin:0 auto 12px;color:var(--gray-400);opacity:0.6;"><path stroke-linecap="round" stroke-linejoin="round" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/><path stroke-linecap="round" stroke-linejoin="round" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/></svg>
        <p style="font-size:14px;font-weight:600;color:var(--gray-500);margin-bottom:4px;">Belum ada data distribusi</p>
        <p style="font-size:13px;color:var(--gray-400);">Klik tombol "Generate SHU" untuk menghitung distribusi SHU seluruh anggota.</p>
    </div>
@endif
@endsection
