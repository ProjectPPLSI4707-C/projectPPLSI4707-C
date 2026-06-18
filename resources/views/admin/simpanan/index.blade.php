@extends('layouts.app')
@section('title', 'Verifikasi Simpanan')
@section('page-title', 'Verifikasi Simpanan')

@section('content')
<div class="page-header flex items-center justify-between">
    <div>
        <h2>Manajemen Simpanan</h2>
        <p>Verifikasi pembayaran simpanan anggota</p>
    </div>
</div>

{{-- Stats --}}
<div class="stat-grid" style="grid-template-columns:repeat(auto-fit,minmax(160px,1fr));max-width:400px;margin-bottom:20px;">
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
        <div class="stat-info"><div class="stat-label">Terverifikasi</div><div class="stat-value">{{ $successCount }}</div></div>
    </div>
</div>

{{-- Filter --}}
<div class="card" style="margin-bottom:16px;padding:14px 18px;">
    <div style="display:flex;gap:8px;align-items:center;flex-wrap:wrap;">
        <span style="font-size:13px;font-weight:500;color:var(--gray-500);">Status:</span>
        @foreach(['Pending'=>'Pending','Success'=>'Terverifikasi','all'=>'Semua'] as $val=>$label)
            <a href="{{ route('admin.simpanan.index', array_merge(request()->query(),['status'=>$val])) }}"
               style="padding:5px 14px;border-radius:20px;font-size:13px;font-weight:500;text-decoration:none;transition:all .15s;
                      {{ $status===$val ? 'background:var(--navy-light);color:#fff;' : 'background:var(--gray-100);color:var(--gray-600);border:1px solid var(--gray-200);' }}">
                {{ $label }}
            </a>
        @endforeach

        <span style="font-size:13px;font-weight:500;color:var(--gray-500);margin-left:8px;">Jenis:</span>
        @foreach([''=>'Semua','Pokok'=>'Pokok','Wajib'=>'Wajib','Sukarela'=>'Sukarela'] as $val=>$label)
            <a href="{{ route('admin.simpanan.index', array_merge(request()->query(),['jenis'=>$val])) }}"
               style="padding:5px 14px;border-radius:20px;font-size:13px;font-weight:500;text-decoration:none;transition:all .15s;
                      {{ ($jenis===$val||($val===''&&!$jenis)) ? 'background:var(--navy-light);color:#fff;' : 'background:var(--gray-100);color:var(--gray-600);border:1px solid var(--gray-200);' }}">
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
                    <th>Jenis Simpanan</th>
                    <th>Nominal</th>
                    <th>Tanggal</th>
                    <th>Bukti</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($simpanan as $i => $s)
                    <tr>
                        <td style="color:var(--gray-500);">{{ $simpanan->firstItem() + $i }}</td>
                        <td>
                            <div style="font-weight:600;color:var(--gray-900);">{{ $s->user->name }}</div>
                            <div style="font-size:12px;color:var(--gray-500);">{{ $s->user->email }}</div>
                        </td>
                        <td><span style="font-weight:600;color:var(--gray-800);">{{ $s->jenis_simpanan }}</span></td>
                        <td style="font-weight:700;color:var(--navy-light);font-family:'JetBrains Mono',monospace;">
                            Rp {{ number_format($s->jumlah,0,',','.') }}
                        </td>
                        <td style="color:var(--gray-500);font-size:13px;">{{ $s->created_at->format('d M Y') }}</td>
                        <td>
                            @if($s->bukti_bayar)
                                <a href="{{ $s->bukti_url }}" target="_blank" class="btn btn-sm btn-outline" style="gap:5px;">
                                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/></svg>
                                    Lihat
                                </a>
                            @else
                                <span style="color:var(--gray-400);font-size:12px;">—</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge {{ $s->status==='Success' ? 'badge-success' : 'badge-pending' }}">{{ $s->status }}</span>
                        </td>
                        <td>
                            @if($s->isPending())
                                <a href="{{ route('admin.simpanan.show',$s) }}" class="btn btn-sm btn-primary">Verifikasi</a>
                            @else
                                <a href="{{ route('admin.simpanan.show',$s) }}" class="btn btn-sm btn-outline">Detail</a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-align:center;padding:48px;color:var(--gray-500);">
                            <svg style="margin:0 auto 12px;color:var(--gray-400);" width="40" height="40" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                            <div style="font-size:14px;font-weight:600;color:var(--gray-700);">Tidak ada data simpanan.</div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if($simpanan->hasPages())
    <div class="pagination-wrap">{{ $simpanan->appends(request()->query())->links() }}</div>
@endif
@endsection
