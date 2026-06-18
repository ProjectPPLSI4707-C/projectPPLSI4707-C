@extends('layouts.app')
@section('title', 'Status Pinjaman')
@section('page-title', 'Status Pinjaman')

@section('content')
<div class="page-header" style="display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:12px;">
    <div>
        <h2>Status Pinjaman</h2>
        <p>Pantau status pengajuan pinjaman Anda</p>
    </div>
    <a href="{{ route('anggota.pinjaman.create') }}" class="btn btn-primary">
        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
        Ajukan Pinjaman
    </a>
</div>

<div class="card" style="padding:0;">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Jumlah Pinjaman</th>
                    <th>Tenor</th>
                    <th>Angsuran/Bulan</th>
                    <th>Tujuan</th>
                    <th>Status</th>
                    <th>Catatan Admin</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pinjaman as $i => $p)
                    <tr>
                        <td style="color:var(--gray-500);">{{ $pinjaman->firstItem() + $i }}</td>
                        <td style="color:var(--gray-500);font-size:13px;">{{ $p->tanggal_pengajuan->format('d M Y') }}</td>
                        <td style="font-weight:700;color:var(--navy-light);font-family:'JetBrains Mono',monospace;font-size:13.5px;">
                            Rp {{ number_format($p->jumlah_pinjaman,0,',','.') }}
                        </td>
                        <td style="color:var(--gray-700);">{{ $p->tenor }} bln</td>
                        <td style="font-weight:600;color:var(--emerald);font-family:'JetBrains Mono',monospace;font-size:13px;">
                            Rp {{ number_format($p->angsuranPerBulan(),0,',','.') }}
                        </td>
                        <td style="max-width:180px;">
                            <span style="font-size:13px;color:var(--gray-700);display:block;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;" title="{{ $p->tujuan_pinjaman }}">
                                {{ $p->tujuan_pinjaman }}
                            </span>
                        </td>
                        <td>
                            @php
                                $badgeClass = match($p->status_pengajuan) {
                                    'Approved' => 'badge-approved',
                                    'Rejected' => 'badge-rejected',
                                    default    => 'badge-pending',
                                };
                                $label = match($p->status_pengajuan) {
                                    'Approved' => 'Disetujui',
                                    'Rejected' => 'Ditolak',
                                    default    => 'Diajukan',
                                };
                            @endphp
                            <span class="badge {{ $badgeClass }}">{{ $label }}</span>
                        </td>
                        <td style="font-size:12.5px;color:var(--gray-500);max-width:160px;">
                            {{ $p->catatan_admin ?? '—' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-align:center;padding:48px;color:var(--gray-500);">
                            <svg style="margin:0 auto 12px;color:var(--gray-400);" width="44" height="44" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                            </svg>
                            <div style="font-size:14px;font-weight:600;color:var(--gray-700);margin-bottom:4px;">Belum ada pengajuan pinjaman.</div>
                            <div style="margin-top:14px;">
                                <a href="{{ route('anggota.pinjaman.create') }}" class="btn btn-primary btn-sm">Ajukan Pinjaman Sekarang</a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if($pinjaman->hasPages())
    <div class="pagination-wrap">{{ $pinjaman->links() }}</div>
@endif
@endsection
