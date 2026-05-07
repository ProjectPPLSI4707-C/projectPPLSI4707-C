@extends('layouts.app')
@section('title', 'Detail Pinjaman')
@section('page-title', 'Detail Pinjaman')

@section('content')
<div class="page-header flex items-center justify-between">
    <div>
        <h2>Detail Pengajuan Pinjaman</h2>
        <p>Tinjau detail dan riwayat simpanan anggota sebelum memberi keputusan</p>
    </div>
    <a href="{{ route('admin.pinjaman.index') }}" class="btn btn-outline">← Kembali</a>
</div>

<div class="grid-2" style="align-items:start;gap:24px;">

    {{-- Kolom Kiri --}}
    <div style="display:flex;flex-direction:column;gap:20px;">

        {{-- Info Pinjaman --}}
        <div class="card">
            <div class="card-title">💳 Detail Pinjaman</div>
            @php
                $rows = [
                    ['Anggota',          $pinjaman->user->name],
                    ['Email',            $pinjaman->user->email],
                    ['Jumlah Pinjaman',  'Rp ' . number_format($pinjaman->jumlah_pinjaman, 0, ',', '.')],
                    ['Tenor',            $pinjaman->tenor . ' Bulan'],
                    ['Bunga',            $pinjaman->bunga_pinjaman . '% / bulan (flat)'],
                    ['Angsuran/Bulan',   'Rp ' . number_format($pinjaman->angsuranPerBulan(), 0, ',', '.')],
                    ['Total Pengembalian','Rp ' . number_format($pinjaman->totalPengembalian(), 0, ',', '.')],
                    ['Total Bunga',      'Rp ' . number_format($pinjaman->totalPengembalian() - $pinjaman->jumlah_pinjaman, 0, ',', '.')],
                    ['Tanggal Pengajuan',$pinjaman->tanggal_pengajuan->format('d M Y')],
                    ['Status',           $pinjaman->status_pengajuan],
                ];
            @endphp
            <table style="width:100%;border-collapse:collapse;">
                @foreach($rows as [$label, $value])
                    <tr style="border-bottom:1px solid #F3F4F6;">
                        <td style="padding:11px 0;font-size:13px;color:#6B7280;width:42%;">{{ $label }}</td>
                        <td style="padding:11px 0;font-size:13.5px;font-weight:600;color:#111827;">
                            @if($label === 'Status')
                                @php $bc = match($pinjaman->status_pengajuan) { 'Approved'=>'badge-approved','Rejected'=>'badge-rejected',default=>'badge-pending' }; @endphp
                                <span class="badge {{ $bc }}">{{ $value }}</span>
                            @elseif(in_array($label, ['Jumlah Pinjaman','Angsuran/Bulan','Total Pengembalian','Total Bunga']))
                                <span style="font-family:'Poppins',sans-serif;color:#19376D;">{{ $value }}</span>
                            @else
                                {{ $value }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>

        {{-- Tujuan --}}
        <div class="card">
            <div class="card-title">📝 Tujuan Pinjaman</div>
            <p style="font-size:14px;color:#374151;line-height:1.7;">{{ $pinjaman->tujuan_pinjaman }}</p>
        </div>

        {{-- Dokumen --}}
        @if($pinjaman->dokumen_pendukung)
            <div class="card">
                <div class="card-title">📁 Dokumen Pendukung</div>
                @php $ext = pathinfo($pinjaman->dokumen_pendukung, PATHINFO_EXTENSION); @endphp
                @if(in_array(strtolower($ext), ['jpg','jpeg','png']))
                    <img src="{{ $pinjaman->dokumen_url }}" style="width:100%;border-radius:10px;border:1px solid #E5E7EB;" alt="Dokumen">
                @else
                    <a href="{{ $pinjaman->dokumen_url }}" target="_blank" class="btn btn-outline w-full" style="justify-content:center;">📄 Buka Dokumen PDF</a>
                @endif
            </div>
        @endif

        {{-- Catatan Admin (jika sudah diproses) --}}
        @if(!$pinjaman->isPending() && $pinjaman->catatan_admin)
            <div class="card" style="background:{{ $pinjaman->isApproved() ? '#D1FAE5' : '#FEE2E2' }};border:1.5px solid {{ $pinjaman->isApproved() ? '#A7F3D0' : '#FECACA' }};">
                <div class="card-title" style="color:{{ $pinjaman->isApproved() ? '#065F46' : '#991B1B' }};">
                    {{ $pinjaman->isApproved() ? '✅ Keputusan: Disetujui' : '❌ Keputusan: Ditolak' }}
                </div>
                <p style="font-size:13.5px;color:{{ $pinjaman->isApproved() ? '#065F46' : '#991B1B' }};">{{ $pinjaman->catatan_admin }}</p>
            </div>
        @endif
    </div>

    {{-- Kolom Kanan --}}
    <div style="display:flex;flex-direction:column;gap:20px;">

        {{-- Ringkasan Simpanan --}}
        <div class="card" style="border:1.5px solid #BFDBFE;background:#EFF6FF;">
            <div class="card-title" style="color:#1E40AF;">🏦 Ringkasan Simpanan Anggota</div>
            <p style="font-size:12px;color:#3B82F6;margin-bottom:14px;">Gunakan ini sebagai bahan pertimbangan kelayakan pinjaman.</p>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:16px;">
                @foreach(['Pokok' => [$simpananPokok, '📌'], 'Wajib' => [$simpananWajib, '📅'], 'Sukarela' => [$simpananSukarela, '💰']] as $jenis => [$total, $icon])
                    <div style="background:#fff;border-radius:10px;padding:14px;border:1px solid #DBEAFE;">
                        <div style="font-size:18px;margin-bottom:4px;">{{ $icon }}</div>
                        <div style="font-size:11px;color:#3B82F6;font-weight:600;">{{ $jenis }}</div>
                        <div style="font-size:15px;font-weight:700;color:#1E40AF;font-family:'Poppins',sans-serif;">
                            Rp {{ number_format($total, 0, ',', '.') }}
                        </div>
                    </div>
                @endforeach
                <div style="background:#1E40AF;border-radius:10px;padding:14px;">
                    <div style="font-size:11px;color:#BFDBFE;font-weight:600;">Total Simpanan</div>
                    <div style="font-size:15px;font-weight:700;color:#fff;font-family:'Poppins',sans-serif;">
                        Rp {{ number_format($totalSimpanan, 0, ',', '.') }}
                    </div>
                </div>
            </div>

            {{-- Rasio --}}
            @if($totalSimpanan > 0)
                @php $rasio = round($pinjaman->jumlah_pinjaman / $totalSimpanan, 2); @endphp
                <div style="background:#fff;border-radius:10px;padding:14px;border:1px solid #DBEAFE;">
                    <div style="font-size:12px;color:#6B7280;margin-bottom:6px;">Rasio Pinjaman vs Simpanan</div>
                    <div style="font-size:20px;font-weight:700;color:{{ $rasio <= 3 ? '#059669' : ($rasio <= 5 ? '#D97706' : '#DC2626') }};font-family:'Poppins',sans-serif;">
                        {{ $rasio }}x
                    </div>
                    <div style="font-size:11px;color:#6B7280;margin-top:3px;">
                        @if($rasio <= 3) ✅ Rasio aman
                        @elseif($rasio <= 5) ⚠️ Rasio cukup tinggi
                        @else ❌ Rasio sangat tinggi
                        @endif
                    </div>
                </div>
            @endif
        </div>

        {{-- Riwayat Simpanan --}}
        <div class="card">
            <div class="card-title">📋 Riwayat Simpanan (10 Terakhir)</div>
            <div class="table-wrap">
                <table>
                    <thead><tr><th>Jenis</th><th>Nominal</th><th>Status</th></tr></thead>
                    <tbody>
                        @foreach($riwayatSimpanan->take(10) as $s)
                            <tr>
                                <td style="font-weight:600;">{{ $s->jenis_simpanan }}</td>
                                <td style="font-weight:700;color:#19376D;">Rp {{ number_format($s->jumlah, 0, ',', '.') }}</td>
                                <td><span class="badge {{ $s->status === 'Success' ? 'badge-success' : 'badge-pending' }}">{{ $s->status }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Aksi Keputusan --}}
        @if($pinjaman->isPending())
            <div class="card" style="border:1.5px solid #FDE68A;background:#FFFBEB;">
                <div class="card-title">⚡ Beri Keputusan</div>

                {{-- Approve --}}
                <form method="POST" action="{{ route('admin.pinjaman.approve', $pinjaman) }}" style="margin-bottom:16px;">
                    @csrf @method('PATCH')
                    <div class="form-group">
                        <label class="form-label">Catatan Persetujuan</label>
                        <input type="text" name="catatan_admin" class="form-control"
                               placeholder="Misal: Disetujui, simpanan mencukupi."
                               value="{{ old('catatan_admin', 'Pengajuan disetujui.') }}">
                    </div>
                    <button type="submit" class="btn btn-success w-full" style="justify-content:center;"
                            onclick="return confirm('Setujui pengajuan pinjaman ini?')">
                        ✅ Setujui Pinjaman
                    </button>
                </form>

                <hr style="border:none;border-top:1px dashed #FDE68A;margin-bottom:16px;">

                {{-- Reject --}}
                <form method="POST" action="{{ route('admin.pinjaman.reject', $pinjaman) }}">
                    @csrf @method('PATCH')
                    <div class="form-group">
                        <label class="form-label">Alasan Penolakan <span class="req">*</span></label>
                        <textarea name="catatan_admin" class="form-control {{ $errors->has('catatan_admin') ? 'is-invalid' : '' }}"
                                  placeholder="Jelaskan alasan penolakan..." rows="3">{{ old('catatan_admin') }}</textarea>
                        @error('catatan_admin')
                            <div class="invalid-feedback" style="display:block;">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-danger w-full" style="justify-content:center;"
                            onclick="return confirm('Tolak pengajuan pinjaman ini?')">
                        ❌ Tolak Pinjaman
                    </button>
                </form>
            </div>
        @endif
    </div>
</div>
@endsection
