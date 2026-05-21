@extends('layouts.app')
@section('title', 'Detail Pembayaran Angsuran')
@section('page-title', 'Detail Pembayaran')

@section('content')
<div class="page-header">
    <a href="{{ route('anggota.tagihan.index') }}" style="color:var(--gray-500);text-decoration:none;font-size:14px;display:inline-flex;align-items:center;margin-bottom:12px;">
        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="margin-right:4px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali ke Tagihan
    </a>
    <h2>🧾 E-Invoice Pembayaran Angsuran</h2>
    <p>Detail informasi pembayaran angsuran pinjaman Anda</p>
</div>

<div class="card" style="max-width: 600px; margin: 0 auto; padding: 32px;">
    <div style="text-align:center; margin-bottom: 24px; padding-bottom: 24px; border-bottom: 1px dashed var(--gray-300);">
        <div style="font-size: 48px; margin-bottom: 12px;">
            @if($angsuran->status === 'Success')
                ✅
            @elseif($angsuran->status === 'Pending')
                ⏳
            @else
                ❌
            @endif
        </div>
        <h3 style="font-family:'Poppins', sans-serif; font-size: 28px; color: var(--navy); margin-bottom: 8px;">
            Rp {{ number_format($angsuran->jumlah, 0, ',', '.') }}
        </h3>
        <span class="badge {{ $angsuran->status === 'Success' ? 'badge-success' : ($angsuran->status === 'Pending' ? 'badge-pending' : 'badge-rejected') }}" style="font-size: 14px; padding: 6px 12px;">
            Status: {{ $angsuran->status }}
        </span>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 24px;">
        <div>
            <div style="font-size: 12px; color: var(--gray-500); margin-bottom: 4px;">Tanggal Pembayaran</div>
            <div style="font-weight: 600; color: var(--gray-800);">{{ \Carbon\Carbon::parse($angsuran->tanggal_bayar)->locale('id')->isoFormat('D MMMM Y') }}</div>
        </div>
        <div>
            <div style="font-size: 12px; color: var(--gray-500); margin-bottom: 4px;">ID Pinjaman Terkait</div>
            <div style="font-weight: 600; color: var(--gray-800);">#PINJ-{{ str_pad($angsuran->pinjaman_id, 4, '0', STR_PAD_LEFT) }}</div>
        </div>
        <div>
            <div style="font-size: 12px; color: var(--gray-500); margin-bottom: 4px;">Sisa Angsuran</div>
            <div style="font-weight: 600; color: var(--gray-800);">{{ $sisaTenor }} Bulan Lagi</div>
        </div>
        <div>
            <div style="font-size: 12px; color: var(--gray-500); margin-bottom: 4px;">Sisa Tagihan Pinjaman</div>
            <div style="font-weight: 600; color: var(--red);">Rp {{ number_format($sisaTagihan, 0, ',', '.') }}</div>
        </div>
        <div>
            <div style="font-size: 12px; color: var(--gray-500); margin-bottom: 4px;">Metode Pembayaran</div>
            <div style="font-weight: 600; color: var(--gray-800);">Transfer Bank</div>
        </div>
        <div>
            <div style="font-size: 12px; color: var(--gray-500); margin-bottom: 4px;">Waktu Dicatat</div>
            <div style="font-weight: 600; color: var(--gray-800);">{{ $angsuran->created_at->locale('id')->isoFormat('D MMMM Y, HH:mm') }}</div>
        </div>
    </div>

    @if($angsuran->bukti_bayar)
    <div style="background: var(--gray-50); border-radius: 8px; padding: 16px; text-align: center; margin-bottom: 24px;">
        <div style="font-size: 12px; color: var(--gray-500); margin-bottom: 12px; font-weight: 600;">BUKTI PEMBAYARAN</div>
        <a href="{{ asset('storage/' . $angsuran->bukti_bayar) }}" target="_blank" style="display: inline-block; background: #fff; padding: 8px; border: 1px solid var(--gray-200); border-radius: 8px;">
            <img src="{{ asset('storage/' . $angsuran->bukti_bayar) }}" alt="Bukti Pembayaran" style="max-height: 200px; max-width: 100%; border-radius: 4px; object-fit: contain;">
        </a>
        <div style="font-size: 11px; color: var(--gray-400); margin-top: 8px;">Klik gambar untuk melihat lebih besar</div>
    </div>
    @endif

    <div style="text-align: center;">
        <button onclick="window.print()" class="btn btn-outline" style="display: inline-flex; align-items: center; justify-content: center;">
            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="margin-right: 8px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
            Cetak Invoice
        </button>
    </div>
</div>

<style>
@media print {
    body * {
        visibility: hidden;
    }
    .card, .card * {
        visibility: visible;
    }
    .card {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        max-width: 100%;
        margin: 0;
        padding: 20px;
        box-shadow: none;
        border: none;
    }
    .page-header, .btn, .sidebar, .navbar {
        display: none !important;
    }
}
</style>
@endsection
