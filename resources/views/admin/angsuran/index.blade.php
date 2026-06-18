@extends('layouts.app')
@section('title', 'Verifikasi Angsuran')
@section('page-title', 'Verifikasi Angsuran')

@section('content')
<div class="page-header flex items-center justify-between">
    <div>
        <h2>Manajemen Pembayaran Angsuran</h2>
        <p>Tinjau dan verifikasi bukti pembayaran angsuran dari anggota</p>
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
        <div class="stat-info"><div class="stat-label">Selesai</div><div class="stat-value">{{ $successCount }}</div></div>
    </div>
</div>

{{-- Filter --}}
<div class="card" style="margin-bottom:16px;padding:14px 18px;">
    <div style="display:flex;gap:8px;align-items:center;flex-wrap:wrap;">
        <span style="font-size:13px;font-weight:500;color:var(--gray-500);">Filter:</span>
        @foreach(['Pending'=>'Pending','Success'=>'Success','all'=>'Semua'] as $val=>$label)
            <a href="{{ route('admin.angsuran.index',['status'=>$val]) }}"
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
                    <th>Tujuan Pinjaman</th>
                    <th>Jumlah Bayar</th>
                    <th>Tanggal Bayar</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($angsurans as $i => $a)
                    <tr>
                        <td style="color:var(--gray-500);">{{ $angsurans->firstItem() + $i }}</td>
                        <td>
                            <div style="font-weight:600;color:var(--gray-900);">{{ $a->user->name }}</div>
                            <div style="font-size:12px;color:var(--gray-500);">{{ $a->user->email }}</div>
                        </td>
                        <td style="max-width:160px;">
                            <span style="font-size:12.5px;display:block;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;color:var(--gray-700);" title="{{ $a->pinjaman->tujuan_pinjaman ?? '-' }}">
                                {{ $a->pinjaman->tujuan_pinjaman ?? '-' }}
                            </span>
                        </td>
                        <td style="font-weight:700;color:var(--navy-light);font-family:'JetBrains Mono',monospace;">
                            Rp {{ number_format($a->jumlah,0,',','.') }}
                        </td>
                        <td style="color:var(--gray-500);font-size:12.5px;">{{ \Carbon\Carbon::parse($a->tanggal_bayar)->format('d M Y') }}</td>
                        <td>
                            <span class="badge {{ $a->status==='Success' ? 'badge-approved' : 'badge-pending' }}">{{ $a->status }}</span>
                        </td>
                        <td>
                            <a href="{{ route('admin.angsuran.show',$a) }}" class="btn btn-sm {{ $a->status==='Pending' ? 'btn-gold' : 'btn-outline' }}">
                                {{ $a->status==='Pending' ? 'Periksa' : 'Detail' }}
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align:center;padding:48px;color:var(--gray-500);">
                            <svg style="margin:0 auto 12px;color:var(--gray-400);" width="40" height="40" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                            <div style="font-size:14px;font-weight:600;color:var(--gray-700);">Tidak ada data angsuran.</div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if($angsurans->hasPages())
    <div class="pagination-wrap">{{ $angsurans->appends(request()->query())->links() }}</div>
@endif
@endsection