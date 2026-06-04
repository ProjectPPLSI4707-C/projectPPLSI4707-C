@extends('layouts.app')
@section('title', 'Riwayat Angsuran')
@section('page-title', 'Riwayat Angsuran')

@section('content')
<div class="page-header" style="margin-bottom: 24px;">
    <div>
        <h2>📜 Riwayat Angsuran</h2>
        <p>Pantau seluruh riwayat pembayaran angsuran dan status verifikasinya</p>
    </div>
    <a href="{{ route('anggota.angsuran.create') }}" class="btn btn-primary">
        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="margin-right:6px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Bayar Angsuran
    </a>
</div>

{{-- ── Summary Cards ── --}}
<div class="stat-grid" style="grid-template-columns: repeat(4, 1fr); margin-bottom: 24px;">
    <div class="stat-card hist-stat-card">
        <div class="stat-icon blue">
            <svg width="22" height="22" fill="none" stroke="#19376D" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
        </div>
        <div>
            <div class="stat-label">Total Pembayaran</div>
            <div class="stat-value" style="font-size:22px;">{{ $totalPembayaran }}</div>
        </div>
    </div>
    <div class="stat-card hist-stat-card">
        <div class="stat-icon green">
            <svg width="22" height="22" fill="none" stroke="#10B981" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div>
            <div class="stat-label">Terverifikasi</div>
            <div class="stat-value" style="font-size:22px;color:#10B981;">{{ $totalTerverifikasi }}</div>
        </div>
    </div>
    <div class="stat-card hist-stat-card">
        <div class="stat-icon gold">
            <svg width="22" height="22" fill="none" stroke="#F59E0B" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div>
            <div class="stat-label">Menunggu Verifikasi</div>
            <div class="stat-value" style="font-size:22px;color:#F59E0B;">{{ $totalPending }}</div>
        </div>
    </div>
    <div class="stat-card hist-stat-card">
        <div class="stat-icon green">
            <svg width="22" height="22" fill="none" stroke="#10B981" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div>
            <div class="stat-label">Total Terbayar (Verified)</div>
            <div class="stat-value sm" style="font-size:15px;color:#10B981;">Rp {{ number_format($totalNominal, 0, ',', '.') }}</div>
        </div>
    </div>
</div>

{{-- ── Progress per Pinjaman ── --}}
@if($pinjamanList->isNotEmpty())
<div class="card" style="margin-bottom:24px;">
    <div class="card-title">
        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="margin-right:6px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
        Progress Pelunasan per Pinjaman
    </div>
    <div style="display:flex;flex-direction:column;gap:20px;">
        @foreach($pinjamanList as $pinjaman)
            @php
                $sukses  = $pinjaman->angsuran->where('status', 'Success')->count();
                $pending = $pinjaman->angsuran->where('status', 'Pending')->count();
                $progress = $pinjaman->tenor > 0 ? round(($sukses / $pinjaman->tenor) * 100) : 0;
                $progPending = $pinjaman->tenor > 0 ? round((($sukses + $pending) / $pinjaman->tenor) * 100) : 0;
            @endphp
            <div style="border:1px solid var(--gray-200);border-radius:12px;padding:16px 20px;">
                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;flex-wrap:wrap;gap:8px;">
                    <div>
                        <div style="font-weight:700;color:var(--navy);font-size:14px;">
                            Pinjaman #PINJ-{{ str_pad($pinjaman->id, 4, '0', STR_PAD_LEFT) }}
                        </div>
                        <div style="font-size:12px;color:var(--gray-500);margin-top:2px;">
                            Rp {{ number_format($pinjaman->jumlah_pinjaman, 0, ',', '.') }} · {{ $pinjaman->tenor }} bulan · {{ $pinjaman->tanggal_pengajuan->format('d M Y') }}
                        </div>
                    </div>
                    <div style="text-align:right;">
                        <div style="font-size:13px;font-weight:700;color:var(--navy);">{{ $progress }}% Lunas</div>
                        <div style="font-size:11px;color:var(--gray-500);">{{ $sukses }}/{{ $pinjaman->tenor }} angsuran</div>
                    </div>
                </div>

                {{-- Progress bar: sukses (hijau) + pending (kuning) --}}
                <div class="hist-progress-track">
                    <div class="hist-progress-pending" style="width:{{ $progPending }}%;"></div>
                    <div class="hist-progress-fill" style="width:{{ $progress }}%;"></div>
                </div>
                <div style="display:flex;justify-content:space-between;margin-top:6px;flex-wrap:wrap;gap:4px;">
                    <div style="display:flex;gap:12px;align-items:center;">
                        <span style="font-size:11px;color:#10B981;display:inline-flex;align-items:center;gap:4px;">
                            <span style="width:10px;height:10px;border-radius:50%;background:#10B981;display:inline-block;"></span>
                            {{ $sukses }} Terverifikasi
                        </span>
                        @if($pending > 0)
                        <span style="font-size:11px;color:#F59E0B;display:inline-flex;align-items:center;gap:4px;">
                            <span style="width:10px;height:10px;border-radius:50%;background:#F59E0B;display:inline-block;"></span>
                            {{ $pending }} Pending
                        </span>
                        @endif
                    </div>
                    <span style="font-size:11px;color:var(--gray-500);">Sisa {{ $pinjaman->tenor - $sukses }} angsuran</span>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endif

{{-- ── Filter ── --}}
<div class="card" style="padding:14px 20px;margin-bottom:16px;">
    <div style="display:flex;gap:10px;align-items:center;flex-wrap:wrap;">
        <span style="font-size:13px;font-weight:600;color:var(--gray-700);">Filter Status:</span>
        @foreach(['all' => '📋 Semua', 'Pending' => '⏳ Pending', 'Success' => '✅ Success'] as $val => $label)
            <a href="{{ route('anggota.angsuran.history', ['status' => $val]) }}"
               style="padding:6px 18px;border-radius:20px;font-size:13px;font-weight:500;text-decoration:none;transition:all .15s;
                      {{ $filterStatus === $val ? 'background:var(--navy);color:#fff;' : 'background:var(--gray-100);color:var(--gray-700);' }}">
                {{ $label }}
            </a>
        @endforeach
        <span style="font-size:12px;color:var(--gray-400);margin-left:auto;">{{ $histori->count() }} data ditemukan</span>
    </div>
</div>

{{-- ── Tabel Histori ── --}}
<div class="card" style="padding:0;margin-bottom:24px;">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tanggal Bayar</th>
                    <th>Pinjaman</th>
                    <th>Nominal</th>
                    <th>Status</th>
                    <th>Diverifikasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($histori as $i => $h)
                    <tr class="hist-row {{ $h->status === 'Pending' ? 'hist-row-pending' : '' }}">
                        <td style="color:var(--gray-400);font-size:13px;">{{ $i + 1 }}</td>
                        <td>
                            <div style="font-weight:600;color:var(--gray-800);font-size:13.5px;">
                                {{ \Carbon\Carbon::parse($h->tanggal_bayar)->locale('id')->isoFormat('D MMMM Y') }}
                            </div>
                            <div style="font-size:11px;color:var(--gray-400);">
                                Diajukan {{ $h->created_at->locale('id')->isoFormat('D MMM Y, HH:mm') }}
                            </div>
                        </td>
                        <td>
                            <span style="font-weight:600;color:var(--navy);font-size:13px;">
                                #PINJ-{{ str_pad($h->pinjaman_id, 4, '0', STR_PAD_LEFT) }}
                            </span>
                            @if($h->pinjaman)
                            <div style="font-size:11px;color:var(--gray-500);max-width:140px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;" title="{{ $h->pinjaman->tujuan_pinjaman }}">
                                {{ $h->pinjaman->tujuan_pinjaman }}
                            </div>
                            @endif
                        </td>
                        <td>
                            <span style="font-family:'Poppins',sans-serif;font-weight:700;color:var(--navy);font-size:14px;">
                                Rp {{ number_format($h->jumlah, 0, ',', '.') }}
                            </span>
                        </td>
                        <td>
                            @if($h->status === 'Success')
                                <span class="badge badge-success" style="display:inline-flex;align-items:center;gap:5px;">
                                    <svg width="11" height="11" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                    Success
                                </span>
                            @else
                                <span class="badge badge-pending hist-badge-pulse" style="display:inline-flex;align-items:center;gap:5px;">
                                    <svg width="11" height="11" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    Pending
                                </span>
                            @endif
                        </td>
                        <td>
                            @if($h->status === 'Success' && $h->verified_at)
                                <div style="font-size:12px;color:var(--gray-700);font-weight:500;">
                                    {{ $h->verified_at->locale('id')->isoFormat('D MMM Y') }}
                                </div>
                                <div style="font-size:11px;color:var(--gray-400);">
                                    {{ $h->verified_at->isoFormat('HH:mm') }} WIB
                                </div>
                            @elseif($h->status === 'Pending')
                                <span style="font-size:12px;color:var(--gray-400);font-style:italic;">Menunggu admin</span>
                            @else
                                <span style="font-size:12px;color:var(--gray-400);">—</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('anggota.angsuran.show', $h->id) }}"
                               class="btn btn-outline btn-sm"
                               style="display:inline-flex;align-items:center;gap:5px;font-size:12px;">
                                <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align:center;padding:56px 0;color:var(--gray-400);">
                            <div style="font-size:40px;margin-bottom:10px;">📭</div>
                            <div style="font-weight:500;margin-bottom:4px;">Belum ada riwayat pembayaran angsuran</div>
                            <div style="font-size:12px;">
                                @if($filterStatus !== 'all')
                                    Tidak ada data dengan filter "{{ $filterStatus }}".
                                    <a href="{{ route('anggota.angsuran.history') }}" style="color:var(--navy);">Tampilkan semua</a>
                                @else
                                    Mulai bayar angsuran pertama Anda.
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection

@push('styles')
<style>
    /* ── Stat Cards ── */
    .hist-stat-card {
        transition: transform .2s, box-shadow .2s;
    }
    .hist-stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 24px rgba(0,0,0,.08);
    }

    /* ── Progress Bar ── */
    .hist-progress-track {
        position: relative;
        width: 100%;
        height: 10px;
        background: var(--gray-200);
        border-radius: 10px;
        overflow: hidden;
    }
    .hist-progress-pending {
        position: absolute;
        top: 0; left: 0;
        height: 100%;
        background: linear-gradient(90deg, #FCD34D, #FBBF24);
        border-radius: 10px;
        transition: width .8s ease;
    }
    .hist-progress-fill {
        position: absolute;
        top: 0; left: 0;
        height: 100%;
        background: linear-gradient(90deg, var(--navy), #10B981);
        border-radius: 10px;
        transition: width .8s ease;
    }
    .hist-progress-fill::after {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,.35), transparent);
        animation: shimmer 2s infinite;
    }

    /* ── Row Highlight ── */
    .hist-row-pending td {
        background: #FFFBEB;
    }
    .hist-row-pending:hover td {
        background: #FEF3C7 !important;
    }

    /* ── Badge Pulse ── */
    .hist-badge-pulse {
        animation: hist-pulse 2s ease-in-out infinite;
    }
    @keyframes hist-pulse {
        0%, 100% { opacity: 1; }
        50%       { opacity: .65; }
    }

    @keyframes shimmer {
        0%   { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }
</style>
@endpush
