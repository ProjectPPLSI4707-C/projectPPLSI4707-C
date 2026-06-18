@extends('layouts.app')
@section('title', 'Manajemen Penyewaan Alat')
@section('page-title', 'Manajemen Penyewaan Alat')

@section('content')
<div class="page-header flex items-center justify-between">
    <div>
        <h2>Penyewaan Alat</h2>
        <p>Kelola semua permintaan sewa alat dari anggota koperasi.</p>
    </div>
</div>

{{-- Stat Cards --}}
<div class="stat-grid" style="grid-template-columns: repeat(auto-fit,minmax(160px,1fr));margin-bottom:24px;">
    <div class="stat-card">
        <div class="stat-icon blue">
            <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" width="22" height="22"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
        </div>
        <div class="stat-info"><div class="stat-label">Total Penyewaan</div><div class="stat-value">{{ $totalCount }}</div></div>
    </div>
    <div class="stat-card">
        <div class="stat-icon gold">
            <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" width="22" height="22"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div class="stat-info"><div class="stat-label">Menunggu Konfirmasi</div><div class="stat-value">{{ $pendingCount }}</div></div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green">
            <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" width="22" height="22"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div class="stat-info"><div class="stat-label">Disetujui / Aktif</div><div class="stat-value">{{ $dibayarCount }}</div></div>
    </div>
    <div class="stat-card">
        <div class="stat-icon red">
            <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" width="22" height="22"><path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div class="stat-info"><div class="stat-label">Ditolak</div><div class="stat-value">{{ $ditolakCount }}</div></div>
    </div>
</div>

{{-- Filter Tabs --}}
<div class="card" style="padding:0;overflow:hidden;">
    <div style="display:flex;border-bottom:1px solid var(--gray-200);overflow-x:auto;">
        @php
            $tabs = [
                'all'     => ['label' => 'Semua',    'count' => $totalCount],
                'pending' => ['label' => 'Pending',  'count' => $pendingCount],
                'dibayar' => ['label' => 'Disetujui','count' => $dibayarCount],
                'ditolak' => ['label' => 'Ditolak',  'count' => $ditolakCount],
            ];
        @endphp
        @foreach($tabs as $key => $tab)
        <a href="{{ route('admin.alat.index', ['status' => $key]) }}"
           style="display:flex;align-items:center;gap:7px;padding:14px 20px;font-size:13px;font-weight:600;
                  text-decoration:none;border-bottom:2.5px solid {{ $status === $key ? 'var(--primary)' : 'transparent' }};
                  color:{{ $status === $key ? 'var(--primary)' : 'var(--gray-500)' }};
                  background:transparent;transition:all .2s;white-space:nowrap;flex-shrink:0;">
            {{ $tab['label'] }}
            <span style="background:{{ $status === $key ? 'var(--primary)' : 'var(--gray-200)' }};
                         color:{{ $status === $key ? '#070e1a' : 'var(--gray-600)' }};
                         padding:2px 7px;border-radius:20px;font-size:11px;font-weight:700;">
                {{ $tab['count'] }}
            </span>
        </a>
        @endforeach
    </div>

    {{-- Table --}}
    <div class="table-wrap" style="border-radius:0;border:none;">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Anggota</th>
                    <th>Alat</th>
                    <th>Tanggal Sewa</th>
                    <th>Total Harga</th>
                    <th>Bukti</th>
                    <th>Status Bayar</th>
                    <th>Status Alat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($penyewaans as $p)
                <tr>
                    <td style="color:var(--gray-500);font-size:12px;">{{ $p->id }}</td>
                    <td>
                        <div style="font-weight:600;color:var(--gray-900);font-size:13.5px;">{{ $p->user->name }}</div>
                        <div style="font-size:11.5px;color:var(--gray-500);">{{ $p->user->email }}</div>
                    </td>
                    <td>
                        <div style="font-weight:600;color:var(--gray-800);font-size:13.5px;">{{ $p->alat->nama_alat }}</div>
                        <div style="font-size:11.5px;color:var(--gray-500);">Rp {{ number_format($p->alat->harga_sewa,0,',','.') }}/hari</div>
                    </td>
                    <td>
                        <div style="font-size:13px;color:var(--gray-700);">{{ \Carbon\Carbon::parse($p->tanggal_mulai)->isoFormat('D MMM Y') }}</div>
                        <div style="font-size:12px;color:var(--gray-500);">s/d {{ \Carbon\Carbon::parse($p->tanggal_selesai)->isoFormat('D MMM Y') }}</div>
                    </td>
                    <td>
                        <div style="font-weight:700;color:var(--gray-900);font-family:'JetBrains Mono',monospace;font-size:13.5px;">
                            Rp {{ number_format($p->total_harga,0,',','.') }}
                        </div>
                    </td>
                    <td>
                        @if($p->bukti_pembayaran)
                            <a href="{{ asset('storage/'.$p->bukti_pembayaran) }}" target="_blank"
                               style="display:inline-flex;align-items:center;gap:5px;font-size:12px;
                                      color:var(--navy-light);font-weight:600;text-decoration:none;
                                      background:var(--blue-light);padding:5px 10px;border-radius:8px;">
                                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/></svg>
                                Lihat
                            </a>
                        @else
                            <span style="font-size:12px;color:var(--gray-400);">Tidak ada</span>
                        @endif
                    </td>
                    <td>
                        @if($p->status_pembayaran === 'pending')
                            <span class="badge badge-pending">Pending</span>
                        @elseif($p->status_pembayaran === 'dibayar')
                            <span class="badge badge-success">Disetujui</span>
                        @else
                            <span class="badge badge-rejected">Ditolak</span>
                        @endif
                    </td>
                    <td>
                        @php $alatStatus = $p->alat->status ?? 'tersedia'; @endphp
                        @if($alatStatus === 'tersedia')
                            <span class="badge badge-success">Tersedia</span>
                        @elseif($alatStatus === 'dipinjam')
                            <span class="badge badge-pending">Dipinjam</span>
                        @else
                            <span class="badge" style="background:var(--gray-100);color:var(--gray-600);border:1px solid var(--gray-200);">Maintenance</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.alat.show', $p->id) }}" class="btn btn-sm btn-primary">Detail</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" style="text-align:center;padding:48px;color:var(--gray-500);">
                        <svg style="margin:0 auto 12px;color:var(--gray-400);" width="40" height="40" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        <div style="font-size:14px;font-weight:600;color:var(--gray-700);">Tidak ada data penyewaan</div>
                        <div style="font-size:12px;margin-top:4px;">untuk filter yang dipilih.</div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($penyewaans->hasPages())
    <div style="padding:14px 20px;border-top:1px solid var(--gray-200);">
        {{ $penyewaans->links('pagination::bootstrap-4') }}
    </div>
    @endif
</div>
@endsection
