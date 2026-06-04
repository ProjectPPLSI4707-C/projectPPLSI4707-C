@extends('layouts.app')
@section('title', 'Verifikasi Pinjaman')
@section('page-title', 'Verifikasi Pinjaman')

@section('content')
<div class="page-header flex items-center justify-between">
    <div>
        <h2>Manajemen Pinjaman</h2>
        <p>Tinjau dan putuskan pengajuan pinjaman anggota</p>
    </div>
</div>

{{-- Stats --}}
<div class="stat-grid" style="grid-template-columns:repeat(3,1fr);max-width:600px;margin-bottom:20px;">
    <div class="stat-card"><div class="stat-icon gold">⏳</div><div><div class="stat-label">Pending</div><div class="stat-value">{{ $pendingCount }}</div></div></div>
    <div class="stat-card"><div class="stat-icon green">✅</div><div><div class="stat-label">Disetujui</div><div class="stat-value">{{ $approvedCount }}</div></div></div>
    <div class="stat-card"><div class="stat-icon red">❌</div><div><div class="stat-label">Ditolak</div><div class="stat-value">{{ $rejectedCount }}</div></div></div>
</div>

{{-- Filter --}}
<div class="card" style="margin-bottom:20px;padding:16px 20px;">
    <div style="display:flex;gap:12px;align-items:center;flex-wrap:wrap;">
        <span style="font-size:13px;font-weight:500;color:#374151;">Filter:</span>
        @foreach(['Pending' => '⏳ Pending', 'Approved' => '✅ Disetujui', 'Rejected' => '❌ Ditolak', 'all' => '📋 Semua'] as $val => $label)
            <a href="{{ route('admin.pinjaman.index', ['status' => $val]) }}"
               style="padding:6px 16px;border-radius:20px;font-size:13px;font-weight:500;text-decoration:none;transition:all .15s;
                      {{ $status === $val ? 'background:#19376D;color:#fff;' : 'background:#F3F4F6;color:#374151;' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>
</div>

{{-- Table --}}
<div class="card" style="padding:0;">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Anggota</th>
                    <th>Jumlah Pinjaman</th>
                    <th>Tenor</th>
                    <th>Angsuran/Bln</th>
                    <th>Tujuan</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pinjaman as $i => $p)
                    <tr>
                        <td style="color:#9CA3AF;">{{ $pinjaman->firstItem() + $i }}</td>
                        <td>
                            <div style="font-weight:600;color:#111827;">{{ $p->user->name }}</div>
                            <div style="font-size:12px;color:#6B7280;">{{ $p->user->email }}</div>
                        </td>
                        <td style="font-weight:700;color:#19376D;font-family:'Poppins',sans-serif;">
                            Rp {{ number_format($p->jumlah_pinjaman, 0, ',', '.') }}
                        </td>
                        <td>{{ $p->tenor }} bln</td>
                        <td style="font-weight:600;color:#059669;">
                            Rp {{ number_format($p->angsuranPerBulan(), 0, ',', '.') }}
                        </td>
                        <td style="max-width:160px;">
                            <span style="font-size:12.5px;display:block;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;" title="{{ $p->tujuan_pinjaman }}">
                                {{ $p->tujuan_pinjaman }}
                            </span>
                        </td>
                        <td style="color:#6B7280;font-size:12.5px;">{{ $p->tanggal_pengajuan->format('d M Y') }}</td>
                        <td>
                            @php
                                $bc = match($p->status_pengajuan) {
                                    'Approved' => 'badge-approved',
                                    'Rejected' => 'badge-rejected',
                                    default    => 'badge-pending',
                                };
                            @endphp
                            <span class="badge {{ $bc }}">{{ $p->status_pengajuan }}</span>
                        </td>
                        <td>
                            <a href="{{ route('admin.pinjaman.show', $p) }}" class="btn btn-sm {{ $p->isPending() ? 'btn-gold' : 'btn-outline' }}">
                                {{ $p->isPending() ? 'Putuskan' : 'Detail' }}
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" style="text-align:center;padding:48px;color:#9CA3AF;">
                            <div style="font-size:36px;margin-bottom:8px;">📭</div>
                            Tidak ada data pengajuan pinjaman.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if($pinjaman->hasPages())
    <div class="pagination-wrap">{{ $pinjaman->appends(request()->query())->links() }}</div>
@endif
@endsection
