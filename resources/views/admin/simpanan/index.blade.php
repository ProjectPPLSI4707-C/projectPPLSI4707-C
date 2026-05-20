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
<div class="stat-grid" style="grid-template-columns:repeat(2,1fr);max-width:420px;margin-bottom:20px;">
    <div class="stat-card">
        <div class="stat-icon gold">⏳</div>
        <div>
            <div class="stat-label">Pending</div>
            <div class="stat-value">{{ $pendingCount }}</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green">✅</div>
        <div>
            <div class="stat-label">Terverifikasi</div>
            <div class="stat-value">{{ $successCount }}</div>
        </div>
    </div>
</div>

{{-- Filter --}}
<div class="card" style="margin-bottom:20px;padding:16px 20px;">
    <div style="display:flex;gap:12px;align-items:center;flex-wrap:wrap;">
        <span style="font-size:13px;font-weight:500;color:#374151;">Status:</span>
        @foreach(['Pending' => '⏳ Pending', 'Success' => '✅ Terverifikasi', 'all' => '📋 Semua'] as $val => $label)
            <a href="{{ route('admin.simpanan.index', array_merge(request()->query(), ['status' => $val])) }}"
               style="padding:6px 16px;border-radius:20px;font-size:13px;font-weight:500;text-decoration:none;transition:all .15s;
                      {{ $status === $val ? 'background:#19376D;color:#fff;' : 'background:#F3F4F6;color:#374151;' }}">
                {{ $label }}
            </a>
        @endforeach

        <span style="font-size:13px;font-weight:500;color:#374151;margin-left:12px;">Jenis:</span>
        @foreach(['' => 'Semua', 'Pokok' => 'Pokok', 'Wajib' => 'Wajib', 'Sukarela' => 'Sukarela'] as $val => $label)
            <a href="{{ route('admin.simpanan.index', array_merge(request()->query(), ['jenis' => $val])) }}"
               style="padding:6px 16px;border-radius:20px;font-size:13px;font-weight:500;text-decoration:none;transition:all .15s;
                      {{ $jenis === $val || ($val === '' && !$jenis) ? 'background:#19376D;color:#fff;' : 'background:#F3F4F6;color:#374151;' }}">
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
                        <td style="color:#9CA3AF;">{{ $simpanan->firstItem() + $i }}</td>
                        <td>
                            <div style="font-weight:600;color:#111827;">{{ $s->user->name }}</div>
                            <div style="font-size:12px;color:#6B7280;">{{ $s->user->email }}</div>
                        </td>
                        <td>
                            <span style="font-weight:600;">{{ $s->jenis_simpanan }}</span>
                        </td>
                        <td style="font-weight:700;color:#19376D;font-family:'Poppins',sans-serif;">
                            Rp {{ number_format($s->jumlah, 0, ',', '.') }}
                        </td>
                        <td style="color:#6B7280;font-size:13px;">{{ $s->created_at->format('d M Y') }}</td>
                        <td>
                            @if($s->bukti_bayar)
                                <a href="{{ $s->bukti_url }}" target="_blank" class="btn btn-sm btn-outline">📎 Lihat</a>
                            @else
                                <span style="color:#D1D5DB;font-size:12px;">—</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge {{ $s->status === 'Success' ? 'badge-success' : 'badge-pending' }}">
                                {{ $s->status }}
                            </span>
                        </td>
                        <td>
                            @if($s->isPending())
                                <a href="{{ route('admin.simpanan.show', $s) }}" class="btn btn-sm btn-primary">Detail & Verifikasi</a>
                            @else
                                <a href="{{ route('admin.simpanan.show', $s) }}" class="btn btn-sm btn-outline">Detail</a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-align:center;padding:48px;color:#9CA3AF;">
                            <div style="font-size:36px;margin-bottom:8px;">📭</div>
                            Tidak ada data simpanan.
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
