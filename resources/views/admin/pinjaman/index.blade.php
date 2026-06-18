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
<div class="stat-grid" style="grid-template-columns:repeat(auto-fit,minmax(150px,1fr));max-width:560px;margin-bottom:20px;">
    <div class="stat-card">
        <div class="stat-icon gold">
            <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" width="22" height="22"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div class="stat-info"><div class="stat-label">Pending</div><div class="stat-value">{{ $pendingCount }}</div></div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green">
            <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" width="22" height="22"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div class="stat-info"><div class="stat-label">Disetujui</div><div class="stat-value">{{ $approvedCount }}</div></div>
    </div>
    <div class="stat-card">
        <div class="stat-icon red">
            <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" width="22" height="22"><path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div class="stat-info"><div class="stat-label">Ditolak</div><div class="stat-value">{{ $rejectedCount }}</div></div>
    </div>
</div>

{{-- Filter --}}
<div class="card" style="margin-bottom:16px;padding:14px 18px;">
    <div style="display:flex;gap:8px;align-items:center;flex-wrap:wrap;">
        <span style="font-size:13px;font-weight:500;color:var(--gray-500);">Filter:</span>
        @foreach(['Pending'=>'Pending','Approved'=>'Disetujui','Rejected'=>'Ditolak','all'=>'Semua'] as $val=>$label)
            <a href="{{ route('admin.pinjaman.index',['status'=>$val]) }}"
               style="padding:5px 14px;border-radius:20px;font-size:13px;font-weight:500;text-decoration:none;transition:all .15s;
                      {{ $status===$val ? 'background:var(--navy-light);color:#fff;' : 'background:var(--gray-100);color:var(--gray-600);border:1px solid var(--gray-200);' }}">
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
                        <td style="color:var(--gray-500);">{{ $pinjaman->firstItem() + $i }}</td>
                        <td>
                            <div style="font-weight:600;color:var(--gray-900);">{{ $p->user->name }}</div>
                            <div style="font-size:12px;color:var(--gray-500);">{{ $p->user->email }}</div>
                        </td>
                        <td style="font-weight:700;color:var(--navy-light);font-family:'JetBrains Mono',monospace;">
                            Rp {{ number_format($p->jumlah_pinjaman,0,',','.') }}
                        </td>
                        <td style="color:var(--gray-700);">{{ $p->tenor }} bln</td>
                        <td style="font-weight:600;color:var(--emerald);font-family:'JetBrains Mono',monospace;">
                            Rp {{ number_format($p->angsuranPerBulan(),0,',','.') }}
                        </td>
                        <td style="max-width:160px;">
                            <span style="font-size:12.5px;display:block;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;" title="{{ $p->tujuan_pinjaman }}">
                                {{ $p->tujuan_pinjaman }}
                            </span>
                        </td>
                        <td style="color:var(--gray-500);font-size:12.5px;">{{ $p->tanggal_pengajuan->format('d M Y') }}</td>
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
                            <a href="{{ route('admin.pinjaman.show',$p) }}" class="btn btn-sm {{ $p->isPending() ? 'btn-gold' : 'btn-outline' }}">
                                {{ $p->isPending() ? 'Putuskan' : 'Detail' }}
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" style="text-align:center;padding:48px;color:var(--gray-500);">
                            <svg style="margin:0 auto 12px;color:var(--gray-400);" width="40" height="40" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                            <div style="font-size:14px;font-weight:600;color:var(--gray-700);">Tidak ada data pengajuan pinjaman.</div>
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
