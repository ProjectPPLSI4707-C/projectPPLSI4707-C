@extends('layouts.app')
@section('title', 'Detail Simpanan')
@section('page-title', 'Detail Simpanan')

@section('content')
<div class="page-header flex items-center justify-between">
    <div>
        <h2>Detail Simpanan</h2>
        <p>Tinjau bukti pembayaran dan verifikasi transaksi</p>
    </div>
    <a href="{{ route('admin.simpanan.index') }}" class="btn btn-outline">← Kembali</a>
</div>

<div class="grid-2" style="align-items:start;">
    {{-- Detail --}}
    <div style="display:flex;flex-direction:column;gap:20px;">
        <div class="card">
            <div class="card-title">📋 Informasi Transaksi</div>
            <table style="width:100%;border-collapse:collapse;">
                @php
                    $rows = [
                        ['Anggota',        $simpanan->user->name],
                        ['Email',          $simpanan->user->email],
                        ['Jenis Simpanan', $simpanan->jenis_simpanan],
                        ['Nominal',        'Rp ' . number_format($simpanan->jumlah, 0, ',', '.')],
                        ['Tanggal',        $simpanan->created_at->format('d M Y, H:i')],
                        ['Status',         $simpanan->status],
                    ];
                @endphp
                @foreach($rows as [$label, $value])
                    <tr style="border-bottom:1px solid #F3F4F6;">
                        <td style="padding:12px 0;font-size:13px;color:#6B7280;width:40%;">{{ $label }}</td>
                        <td style="padding:12px 0;font-size:13.5px;font-weight:600;color:#111827;">
                            @if($label === 'Status')
                                <span class="badge {{ $simpanan->status === 'Success' ? 'badge-success' : 'badge-pending' }}">{{ $value }}</span>
                            @elseif($label === 'Nominal')
                                <span style="font-family:'Poppins',sans-serif;font-size:16px;color:#19376D;">{{ $value }}</span>
                            @else
                                {{ $value }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>

        {{-- Riwayat Simpanan Anggota --}}
        <div class="card">
            <div class="card-title">📊 Riwayat Simpanan Anggota Ini</div>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Jenis</th>
                            <th>Nominal</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($riwayatUser as $r)
                            <tr style="{{ $r->id === $simpanan->id ? 'background:#EFF6FF;' : '' }}">
                                <td style="font-weight:600;">{{ $r->jenis_simpanan }}</td>
                                <td style="font-weight:700;color:#19376D;">Rp {{ number_format($r->jumlah, 0, ',', '.') }}</td>
                                <td style="color:#6B7280;font-size:12.5px;">{{ $r->created_at->format('d M Y') }}</td>
                                <td>
                                    <span class="badge {{ $r->status === 'Success' ? 'badge-success' : 'badge-pending' }}">{{ $r->status }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Bukti + Aksi --}}
    <div style="display:flex;flex-direction:column;gap:20px;">
        {{-- Bukti Bayar --}}
        <div class="card">
            <div class="card-title">📎 Bukti Pembayaran</div>
            @if($simpanan->bukti_bayar)
                @php $ext = pathinfo($simpanan->bukti_bayar, PATHINFO_EXTENSION); @endphp
                @if(in_array(strtolower($ext), ['jpg','jpeg','png']))
                    <img src="{{ $simpanan->bukti_url }}" alt="Bukti Bayar"
                         style="width:100%;border-radius:10px;border:1px solid #E5E7EB;">
                @else
                    <a href="{{ $simpanan->bukti_url }}" target="_blank" class="btn btn-outline w-full" style="justify-content:center;">
                        📄 Buka Dokumen PDF
                    </a>
                @endif
            @else
                <div style="text-align:center;padding:32px;color:#9CA3AF;">
                    <div style="font-size:36px;margin-bottom:8px;">🚫</div>
                    <p>Tidak ada bukti bayar</p>
                </div>
            @endif
        </div>

        {{-- Aksi Verifikasi --}}
        @if($simpanan->isPending())
            <div class="card" style="border:1.5px solid #FDE68A;background:#FFFBEB;">
                <div class="card-title">⚡ Verifikasi Transaksi</div>
                <p style="font-size:13px;color:#78350F;margin-bottom:16px;">
                    Pastikan bukti pembayaran valid sebelum memverifikasi transaksi ini.
                </p>
                <form method="POST" action="{{ route('admin.simpanan.verify', $simpanan) }}">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-success w-full" style="justify-content:center;"
                            onclick="return confirm('Verifikasi simpanan ini sebagai BERHASIL?')">
                        ✅ Verifikasi — Tandai Success
                    </button>
                </form>
            </div>
        @else
            <div class="card" style="background:#D1FAE5;border:1.5px solid #A7F3D0;">
                <div style="text-align:center;padding:16px;">
                    <div style="font-size:36px;margin-bottom:6px;">✅</div>
                    <div style="font-size:14px;font-weight:600;color:#065F46;">Transaksi Sudah Diverifikasi</div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
