@extends('layouts.app')
@section('title', 'Dashboard Anggota')
@section('page-title', 'Dashboard')

@section('content')
<div class="page-header">
    <h2>Selamat Datang, {{ auth()->user()->name }}! 👋</h2>
    <p>Berikut ringkasan simpanan dan pinjaman Anda</p>
</div>

{{-- Stat Cards --}}
<div class="stat-grid">
    <div class="stat-card">
        <div class="stat-icon blue">🏦</div>
        <div>
            <div class="stat-label">Total Simpanan</div>
            <div class="stat-value sm">Rp {{ number_format($totalSimpanan, 0, ',', '.') }}</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon gold">📌</div>
        <div>
            <div class="stat-label">Simpanan Pokok</div>
            <div class="stat-value sm">Rp {{ number_format($simpananPokok, 0, ',', '.') }}</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green">📅</div>
        <div>
            <div class="stat-label">Simpanan Wajib</div>
            <div class="stat-value sm">Rp {{ number_format($simpananWajib, 0, ',', '.') }}</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon blue">💰</div>
        <div>
            <div class="stat-label">Simpanan Sukarela</div>
            <div class="stat-value sm">Rp {{ number_format($simpananSukarela, 0, ',', '.') }}</div>
        </div>
    </div>
</div>

<div class="grid-2">
    {{-- Status Pinjaman --}}
    <div class="card">
        <div class="card-title">💳 Status Pinjaman</div>
        @if($pinjamanAktif)
            <div style="background:#D1FAE5;border-radius:12px;padding:18px;margin-bottom:12px;">
                <div style="font-size:12px;color:#065F46;font-weight:600;margin-bottom:8px;">✅ Pinjaman Aktif</div>
                <div style="font-size:20px;font-weight:700;color:#065F46;font-family:'Poppins',sans-serif;">
                    Rp {{ number_format($pinjamanAktif->jumlah_pinjaman, 0, ',', '.') }}
                </div>
                <div style="font-size:12px;color:#059669;margin-top:4px;">
                    Tenor {{ $pinjamanAktif->tenor }} bulan · Angsuran Rp {{ number_format($pinjamanAktif->angsuranPerBulan(), 0, ',', '.') }}/bln
                </div>
            </div>
        @elseif($pinjamanPending > 0)
            <div style="background:#FEF3C7;border-radius:12px;padding:18px;margin-bottom:12px;">
                <div style="font-size:12px;color:#92400E;font-weight:600;margin-bottom:4px;">⏳ Menunggu Verifikasi</div>
                <div style="font-size:13px;color:#78350F;">{{ $pinjamanPending }} pengajuan sedang diproses admin</div>
            </div>
        @else
            <div style="text-align:center;padding:24px 16px;color:#9CA3AF;">
                <div style="font-size:36px;margin-bottom:8px;">💳</div>
                <p style="font-size:13px;">Belum ada pinjaman aktif</p>
            </div>
        @endif
        <a href="{{ route('anggota.pinjaman.create') }}" class="btn btn-primary w-full" style="justify-content:center;">
            + Ajukan Pinjaman Baru
        </a>
    </div>

    {{-- Riwayat Terbaru --}}
    <div class="card">
        <div class="card-title" style="justify-content:space-between;">
            📋 Riwayat Transaksi Terbaru
            <a href="{{ route('anggota.simpanan.index') }}" style="font-size:12px;color:#19376D;font-weight:500;text-decoration:none;">Lihat semua →</a>
        </div>
        @forelse($riwayatTerbaru as $item)
            <div style="display:flex;align-items:center;justify-content:space-between;padding:12px 0;border-bottom:1px solid #F3F4F6;">
                <div>
                    <div style="font-size:13.5px;font-weight:600;color:#111827;">{{ $item->jenis_simpanan }}</div>
                    <div style="font-size:12px;color:#6B7280;">{{ $item->created_at->format('d M Y') }}</div>
                </div>
                <div style="text-align:right;">
                    <div style="font-size:13.5px;font-weight:700;color:#19376D;">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</div>
                    <span class="badge {{ $item->status === 'Success' ? 'badge-success' : 'badge-pending' }}">
                        {{ $item->status }}
                    </span>
                </div>
            </div>
        @empty
            <p style="font-size:13px;color:#9CA3AF;text-align:center;padding:20px 0;">Belum ada transaksi.</p>
        @endforelse
        <div class="mt-4">
            <a href="{{ route('anggota.simpanan.create') }}" class="btn btn-outline w-full" style="justify-content:center;">+ Bayar Simpanan</a>
        </div>
    </div>
</div>
@endsection
