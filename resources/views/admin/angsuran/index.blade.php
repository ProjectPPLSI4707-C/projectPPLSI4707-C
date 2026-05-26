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

<div class="stat-grid" style="grid-template-columns:repeat(2,1fr);max-width:400px;margin-bottom:20px;">
    <div class="stat-card"><div class="stat-icon gold">⏳</div><div><div class="stat-label">Pending</div><div class="stat-value">{{ $pendingCount }}</div></div></div>
    <div class="stat-card"><div class="stat-icon green">✅</div><div><div class="stat-label">Selesai (Success)</div><div class="stat-value">{{ $successCount }}</div></div></div>
</div>

<div class="card" style="margin-bottom:20px;padding:16px 20px;">
    <div style="display:flex;gap:12px;align-items:center;flex-wrap:wrap;">
        <span style="font-size:13px;font-weight:500;color:#374151;">Filter:</span>
        @foreach(['Pending' => '⏳ Pending', 'Success' => '✅ Success', 'all' => '📋 Semua'] as $val => $label)
            <a href="{{ route('admin.angsuran.index', ['status' => $val]) }}"
               style="padding:6px 16px;border-radius:20px;font-size:13px;font-weight:500;text-decoration:none;transition:all .15s;
                      {{ $status === $val ? 'background:#19376D;color:#fff;' : 'background:#F3F4F6;color:#374151;' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>
</div>

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
                        <td style="color:#9CA3AF;">{{ $angsurans->firstItem() + $i }}</td>
                        <td>
                            <div style="font-weight:600;color:#111827;">{{ $a->user->name }}</div>
                            <div style="font-size:12px;color:#6B7280;">{{ $a->user->email }}</div>
                        </td>
                        <td style="max-width:160px;">
                            <span style="font-size:12.5px;display:block;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;" title="{{ $a->pinjaman->tujuan_pinjaman ?? '-' }}">
                                {{ $a->pinjaman->tujuan_pinjaman ?? '-' }}
                            </span>
                        </td>
                        <td style="font-weight:700;color:#19376D;font-family:'Poppins',sans-serif;">
                            Rp {{ number_format($a->jumlah, 0, ',', '.') }}
                        </td>
                        <td style="color:#6B7280;font-size:12.5px;">{{ \Carbon\Carbon::parse($a->tanggal_bayar)->format('d M Y') }}</td>
                        <td>
                            <span class="badge {{ $a->status === 'Success' ? 'badge-approved' : 'badge-pending' }}">{{ $a->status }}</span>
                        </td>
                        <td>
                            <a href="{{ route('admin.angsuran.show', $a) }}" class="btn btn-sm {{ $a->status === 'Pending' ? 'btn-gold' : 'btn-outline' }}">
                                {{ $a->status === 'Pending' ? 'Periksa' : 'Detail' }}
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align:center;padding:48px;color:#9CA3AF;">
                            <div style="font-size:36px;margin-bottom:8px;">📭</div>
                            Tidak ada data angsuran.
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