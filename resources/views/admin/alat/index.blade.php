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
<div class="stat-grid" style="grid-template-columns: repeat(4, 1fr); margin-bottom: 28px;">
    <div class="stat-card">
        <div class="stat-icon blue">🔧</div>
        <div>
            <div class="stat-label">Total Penyewaan</div>
            <div class="stat-value">{{ $totalCount }}</div>
        </div>
    </div>
    <div class="stat-card" style="border: 1.5px solid #FDE68A;">
        <div class="stat-icon gold">⏳</div>
        <div>
            <div class="stat-label">Menunggu Konfirmasi</div>
            <div class="stat-value">{{ $pendingCount }}</div>
        </div>
    </div>
    <div class="stat-card" style="border: 1.5px solid #A7F3D0;">
        <div class="stat-icon green">✅</div>
        <div>
            <div class="stat-label">Disetujui / Aktif</div>
            <div class="stat-value">{{ $dibayarCount }}</div>
        </div>
    </div>
    <div class="stat-card" style="border: 1.5px solid #FECACA;">
        <div class="stat-icon red">❌</div>
        <div>
            <div class="stat-label">Ditolak</div>
            <div class="stat-value">{{ $ditolakCount }}</div>
        </div>
    </div>
</div>

{{-- Filter Tabs --}}
<div class="card" style="padding: 0; overflow: hidden;">
    <div style="display: flex; border-bottom: 1px solid var(--gray-200);">
        @php
            $tabs = [
                'all'     => ['label' => 'Semua',    'count' => $totalCount,   'color' => 'var(--navy)'],
                'pending' => ['label' => 'Pending',  'count' => $pendingCount, 'color' => '#92400E'],
                'dibayar' => ['label' => 'Disetujui','count' => $dibayarCount, 'color' => '#065F46'],
                'ditolak' => ['label' => 'Ditolak',  'count' => $ditolakCount, 'color' => '#991B1B'],
            ];
        @endphp
        @foreach($tabs as $key => $tab)
        <a href="{{ route('admin.alat.index', ['status' => $key]) }}"
           style="display:flex; align-items:center; gap:8px; padding:16px 24px; font-size:13.5px; font-weight:600;
                  text-decoration:none; border-bottom:3px solid {{ $status === $key ? 'var(--navy)' : 'transparent' }};
                  color:{{ $status === $key ? 'var(--navy-dark)' : 'var(--gray-500)' }};
                  background:{{ $status === $key ? 'var(--blue-light)' : 'transparent' }};
                  transition: all .2s;">
            {{ $tab['label'] }}
            <span style="background:{{ $status === $key ? 'var(--navy)' : 'var(--gray-200)' }};
                         color:{{ $status === $key ? '#fff' : 'var(--gray-600)' }};
                         padding:2px 8px; border-radius:20px; font-size:11px;">
                {{ $tab['count'] }}
            </span>
        </a>
        @endforeach
    </div>

    {{-- Table --}}
    <div class="table-wrap" style="border-radius: 0; border: none;">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Anggota</th>
                    <th>Alat</th>
                    <th>Tanggal Sewa</th>
                    <th>Total Harga</th>
                    <th>Bukti</th>
                    <th>Status Pembayaran</th>
                    <th>Status Alat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($penyewaans as $p)
                <tr>
                    <td style="color: var(--gray-500); font-size: 12px;">{{ $p->id }}</td>
                    <td>
                        <div style="font-weight: 600; color: var(--gray-900); font-size: 13.5px;">{{ $p->user->name }}</div>
                        <div style="font-size: 11.5px; color: var(--gray-500);">{{ $p->user->email }}</div>
                    </td>
                    <td>
                        <div style="font-weight: 600; color: var(--navy-dark); font-size: 13.5px;">{{ $p->alat->nama_alat }}</div>
                        <div style="font-size: 11.5px; color: var(--gray-500);">Rp {{ number_format($p->alat->harga_sewa, 0, ',', '.') }}/hari</div>
                    </td>
                    <td>
                        <div style="font-size: 13px; color: var(--gray-700);">
                            {{ \Carbon\Carbon::parse($p->tanggal_mulai)->isoFormat('D MMM Y') }}
                        </div>
                        <div style="font-size: 12px; color: var(--gray-500);">
                            s/d {{ \Carbon\Carbon::parse($p->tanggal_selesai)->isoFormat('D MMM Y') }}
                        </div>
                    </td>
                    <td>
                        <div style="font-weight: 700; color: var(--navy-dark); font-size: 14px;">
                            Rp {{ number_format($p->total_harga, 0, ',', '.') }}
                        </div>
                    </td>
                    <td>
                        @if($p->bukti_pembayaran)
                            <a href="{{ asset('storage/' . $p->bukti_pembayaran) }}" target="_blank"
                               style="display:inline-flex; align-items:center; gap:5px; font-size:12px;
                                      color: var(--navy); font-weight:600; text-decoration:none;
                                      background: var(--blue-light); padding:5px 10px; border-radius:8px;">
                                📄 Lihat
                            </a>
                        @else
                            <span style="font-size:12px; color:var(--gray-400);">Tidak ada</span>
                        @endif
                    </td>
                    <td>
                        @if($p->status_pembayaran === 'pending')
                            <span class="badge badge-pending">⏳ Pending</span>
                        @elseif($p->status_pembayaran === 'dibayar')
                            <span class="badge badge-success">✅ Disetujui</span>
                        @else
                            <span class="badge badge-rejected">❌ Ditolak</span>
                        @endif
                    </td>
                    <td>
                        @php
                            $alatStatus = $p->alat->status ?? 'tersedia';
                        @endphp
                        @if($alatStatus === 'tersedia')
                            <span class="badge" style="background:#D1FAE5; color:#065F46;">✔ Tersedia</span>
                        @elseif($alatStatus === 'dipinjam')
                            <span class="badge badge-pending">🔄 Dipinjam</span>
                        @else
                            <span class="badge" style="background:#E5E7EB; color:#374151;">🔧 Maintenance</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.alat.show', $p->id) }}" class="btn btn-sm btn-primary">
                            Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" style="text-align:center; padding:40px; color:var(--gray-500);">
                        <div style="font-size:32px; margin-bottom:8px;">📋</div>
                        <div style="font-size:14px; font-weight:600;">Tidak ada data penyewaan</div>
                        <div style="font-size:12px; margin-top:4px;">untuk filter yang dipilih.</div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($penyewaans->hasPages())
    <div style="padding: 16px 20px; border-top: 1px solid var(--gray-200);">
        <div class="pagination-wrap">
            {{ $penyewaans->links('pagination::bootstrap-4') }}
        </div>
    </div>
    @endif
</div>
@endsection
