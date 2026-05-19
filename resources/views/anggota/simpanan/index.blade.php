@extends('layouts.app')
@section('title', 'Riwayat Simpanan')
@section('page-title', 'Riwayat Simpanan')

@section('content')
<div class="page-header flex items-center justify-between">
    <div>
        <h2>Riwayat Simpanan</h2>
        <p>Daftar seluruh transaksi simpanan Anda</p>
    </div>
    <a href="{{ route('anggota.simpanan.create') }}" class="btn btn-primary">+ Bayar Simpanan</a>
</div>

{{-- Summary Cards --}}
<div class="stat-grid" style="grid-template-columns: repeat(3, 1fr); margin-bottom: 24px;">
    <div class="stat-card">
        <div class="stat-icon gold">📌</div>
        <div>
            <div class="stat-label">Simpanan Pokok</div>
            <div class="stat-value sm">Rp {{ number_format($totalPokok, 0, ',', '.') }}</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green">📅</div>
        <div>
            <div class="stat-label">Simpanan Wajib</div>
            <div class="stat-value sm">Rp {{ number_format($totalWajib, 0, ',', '.') }}</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon blue">💰</div>
        <div>
            <div class="stat-label">Simpanan Sukarela</div>
            <div class="stat-value sm">Rp {{ number_format($totalSukarela, 0, ',', '.') }}</div>
        </div>
    </div>
</div>

{{-- Filter --}}
<div class="card" style="margin-bottom: 20px; padding: 16px 20px;">
    <form method="GET" style="display:flex;gap:12px;align-items:center;flex-wrap:wrap;">
        <label style="font-size:13px;font-weight:500;color:#374151;">Filter Jenis:</label>
        @foreach(['', 'Pokok', 'Wajib', 'Sukarela'] as $j)
            <a href="{{ route('anggota.simpanan.index', $j ? ['jenis' => $j] : []) }}"
               style="padding:6px 16px;border-radius:20px;font-size:13px;font-weight:500;text-decoration:none;transition:all .15s;
                      {{ $jenis === $j || ($j === '' && !$jenis) ? 'background:#19376D;color:#fff;' : 'background:#F3F4F6;color:#374151;' }}">
                {{ $j ?: 'Semua' }}
            </a>
        @endforeach
    </form>
</div>

{{-- Table --}}
<div class="card" style="padding:0;">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Jenis Simpanan</th>
                    <th>Tanggal</th>
                    <th>Nominal</th>
                    <th>Bukti</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($simpanan as $i => $s)
                    <tr>
                        <td style="color:#9CA3AF;">{{ $simpanan->firstItem() + $i }}</td>
                        <td>
                            <span style="font-weight:600;color:#111827;">{{ $s->jenis_simpanan }}</span>
                        </td>
                        <td style="color:#6B7280;">{{ $s->created_at->format('d M Y, H:i') }}</td>
                        <td style="font-weight:700;color:#19376D;font-family:'Poppins',sans-serif;">
                            Rp {{ number_format($s->jumlah, 0, ',', '.') }}
                        </td>
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
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align:center;padding:40px;color:#9CA3AF;">
                            <div style="font-size:36px;margin-bottom:8px;">📭</div>
                            Belum ada transaksi simpanan.
                            <div style="margin-top:12px;">
                                <a href="{{ route('anggota.simpanan.create') }}" class="btn btn-primary btn-sm">Bayar Simpanan Sekarang</a>
                            </div>
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
