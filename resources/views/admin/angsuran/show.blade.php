@extends('layouts.app')
@section('title', 'Detail Angsuran')
@section('page-title', 'Detail Angsuran')

@section('content')
<div class="page-header flex items-center justify-between">
    <div>
        <h2>Detail Pembayaran Angsuran</h2>
        <p>Tinjau bukti pembayaran sebelum melakukan verifikasi</p>
    </div>
    <a href="{{ route('admin.angsuran.index') }}" class="btn btn-outline">← Kembali</a>
</div>

<div class="grid-2" style="align-items:start;gap:24px;">
    <div style="display:flex;flex-direction:column;gap:20px;">
        <div class="card">
            <div class="card-title">🧾 Detail Pembayaran</div>
            @php
                $rows = [
                    ['Anggota',          $angsuran->user->name],
                    ['Email',            $angsuran->user->email],
                    ['Terkait Pinjaman', $angsuran->pinjaman->tujuan_pinjaman ?? 'Pinjaman tidak ditemukan'],
                    ['Jumlah Bayar',     'Rp ' . number_format($angsuran->jumlah, 0, ',', '.')],
                    ['Tanggal Bayar',    \Carbon\Carbon::parse($angsuran->tanggal_bayar)->format('d M Y')],
                    ['Status',           $angsuran->status],
                ];
            @endphp
            <table style="width:100%;border-collapse:collapse;">
                @foreach($rows as [$label, $value])
                    <tr style="border-bottom:1px solid #F3F4F6;">
                        <td style="padding:11px 0;font-size:13px;color:#6B7280;width:40%;">{{ $label }}</td>
                        <td style="padding:11px 0;font-size:13.5px;font-weight:600;color:#111827;">
                            @if($label === 'Status')
                                <span class="badge {{ $angsuran->status === 'Success' ? 'badge-approved' : 'badge-pending' }}">{{ $value }}</span>
                            @elseif($label === 'Jumlah Bayar')
                                <span style="font-family:'Poppins',sans-serif;color:#19376D;">{{ $value }}</span>
                            @else
                                {{ $value }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>

        @if($angsuran->status === 'Pending')
            <div class="card" style="border:1.5px solid #FDE68A;background:#FFFBEB;">
                <div class="card-title">⚡ Tindakan Verifikasi</div>
                <p style="font-size:13px;color:#92400E;margin-bottom:16px;">Pastikan bukti transfer sudah sesuai dengan nominal angsuran sebelum menekan tombol terima.</p>
                <form method="POST" action="{{ route('admin.angsuran.verify', $angsuran) }}">
                    @csrf @method('PATCH')
                    <button type="submit" class="btn btn-success w-full" style="justify-content:center;"
                            onclick="return confirm('Verifikasi pembayaran ini? Status akan diubah menjadi Success.')">
                        ✅ Terima Pembayaran
                    </button>
                </form>
            </div>
        @endif
    </div>

    <div style="display:flex;flex-direction:column;gap:20px;">
        <div class="card">
            <div class="card-title">📸 Bukti Transfer</div>
            @if($angsuran->bukti_bayar)
                <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($angsuran->bukti_bayar) }}" style="width:100%;border-radius:10px;border:1px solid #E5E7EB;" alt="Bukti Pembayaran">
            @else
                <div style="text-align:center;padding:40px 0;color:#9CA3AF;">
                    <div style="font-size:30px;margin-bottom:10px;">🚫</div>
                    Anggota tidak melampirkan bukti pembayaran.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
