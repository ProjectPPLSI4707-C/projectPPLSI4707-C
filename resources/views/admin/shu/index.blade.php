@extends('layouts.app')
@section('title', 'Distribusi SHU')
@section('page-title', 'Distribusi SHU')

@section('content')
<div class="page-header">
    <h2>Distribusi SHU (Sisa Hasil Usaha)</h2>
    <p>Kelola dan distribusikan SHU koperasi kepada anggota</p>
</div>

{{-- Stat Cards --}}
<div class="stat-grid">
    <div class="stat-card">
        <div class="stat-icon gold">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="22" height="22"><path stroke-linecap="round" stroke-linejoin="round" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/><path stroke-linecap="round" stroke-linejoin="round" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/></svg>
        </div>
        <div class="stat-info">
            <div class="stat-label">SHU Tahun {{ $currentYear }}</div>
            <div class="stat-value sm">Rp {{ number_format($totalShuTahunIni, 0, ',', '.') }}</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="22" height="22"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div class="stat-info">
            <div class="stat-label">Sudah Didistribusikan</div>
            <div class="stat-value sm">Rp {{ number_format($distributed, 0, ',', '.') }}</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon blue">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="22" height="22"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        </div>
        <div class="stat-info">
            <div class="stat-label">Anggota Penerima</div>
            <div class="stat-value">{{ $penerima }}</div>
        </div>
    </div>
</div>

{{-- Actions --}}
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;flex-wrap:wrap;gap:12px;">
    <div class="card-title" style="margin-bottom:0;">Konfigurasi SHU per Tahun</div>
    <a href="{{ route('admin.shu.create') }}" class="btn btn-primary">
        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="16" height="16"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
        Buat Konfigurasi Baru
    </a>
</div>

{{-- Table --}}
<div class="card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Tahun</th>
                    <th>Total SHU</th>
                    <th>Cadangan</th>
                    <th>Jasa Modal</th>
                    <th>Jasa Usaha</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($settings as $s)
                    <tr>
                        <td style="font-weight:700;color:var(--gray-900);">{{ $s->tahun }}</td>
                        <td style="font-family:'JetBrains Mono',monospace;font-weight:600;color:var(--gray-800);">Rp {{ number_format($s->total_shu, 0, ',', '.') }}</td>
                        <td>{{ $s->persen_cadangan }}%</td>
                        <td>{{ $s->persen_jasa_modal }}%</td>
                        <td>{{ $s->persen_jasa_usaha }}%</td>
                        <td>
                            @if($s->status === 'distributed')
                                <span class="badge badge-distributed">DISTRIBUTED</span>
                            @elseif($s->status === 'approved')
                                <span class="badge badge-approved">APPROVED</span>
                            @elseif($s->status === 'draft')
                                <span class="badge badge-draft">DRAFT</span>
                            @else
                                <span class="badge badge-pending">BELUM GENERATE</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.shu.show', $s) }}" class="btn btn-sm btn-primary">Detail</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align:center;padding:36px;color:var(--gray-500);">
                            <p style="font-size:13px;font-weight:550;">Belum ada konfigurasi SHU</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
