@extends('layouts.app')
@section('title', 'Status Pinjaman')
@section('page-title', 'Status Pinjaman')

@section('content')
<div class="page-header flex items-center justify-between">
    <div>
        <h2>Status Pinjaman</h2>
        <p>Pantau status pengajuan pinjaman Anda</p>
    </div>
    <a href="{{ route('anggota.pinjaman.create') }}" class="btn btn-primary">+ Ajukan Pinjaman</a>
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
                        <td style="color:#9CA3AF;">{{ $pinjaman->firstItem() + $i }}</td>
                        <td style="color:#6B7280;">{{ $p->tanggal_pengajuan->format('d M Y') }}</td>
                        <td style="font-weight:700;color:#19376D;font-family:'Poppins',sans-serif;">
                            Rp {{ number_format($p->jumlah_pinjaman, 0, ',', '.') }}
                        </td>
                        <td>{{ $p->tenor }} bln</td>
                        <td style="font-weight:600;color:#059669;">
                            Rp {{ number_format($p->angsuranPerBulan(), 0, ',', '.') }}
                        </td>
                        <td style="max-width:180px;">
                            <span style="font-size:13px;color:#374151;display:block;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;" title="{{ $p->tujuan_pinjaman }}">
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
                        <td style="font-size:12.5px;color:#6B7280;max-width:160px;">
                            {{ $p->catatan_admin ?? '—' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-align:center;padding:48px;color:#9CA3AF;">
                            <div style="font-size:40px;margin-bottom:10px;">💳</div>
                            <p>Belum ada pengajuan pinjaman.</p>
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
