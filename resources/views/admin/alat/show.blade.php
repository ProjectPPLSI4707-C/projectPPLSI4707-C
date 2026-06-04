@extends('layouts.app')
@section('title', 'Detail Penyewaan Alat')
@section('page-title', 'Detail Penyewaan Alat')

@section('content')
<div class="page-header flex items-center justify-between">
    <div>
        <h2>Detail Penyewaan #{{ $penyewaan->id }}</h2>
        <p>Review informasi penyewaan alat dan ambil tindakan yang diperlukan.</p>
    </div>
    <a href="{{ route('admin.alat.index') }}" class="btn btn-outline">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="16" height="16"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali
    </a>
</div>

{{-- Status Banner --}}
@php
    $sp = $penyewaan->status_pembayaran;
    $bannerStyle = $sp === 'pending'
        ? 'background:#FEF3C7; border:1px solid #FDE68A; color:#92400E;'
        : ($sp === 'dibayar'
            ? 'background:#D1FAE5; border:1px solid #A7F3D0; color:#065F46;'
            : 'background:#FEE2E2; border:1px solid #FECACA; color:#991B1B;');
    $bannerIcon = $sp === 'pending' ? '⏳' : ($sp === 'dibayar' ? '✅' : '❌');
    $bannerLabel = $sp === 'pending' ? 'Menunggu Konfirmasi' : ($sp === 'dibayar' ? 'Telah Disetujui' : 'Ditolak');
@endphp
<div style="{{ $bannerStyle }} padding:14px 20px; border-radius:12px; margin-bottom:24px;
             display:flex; align-items:center; justify-content:space-between;">
    <div style="display:flex; align-items:center; gap:10px; font-weight:600; font-size:14px;">
        <span style="font-size:20px;">{{ $bannerIcon }}</span>
        Status Pembayaran: {{ $bannerLabel }}
    </div>
    <div style="font-size:12px; opacity:0.8;">
        Diajukan {{ $penyewaan->created_at->diffForHumans() }}
    </div>
</div>

<div class="grid-2" style="gap:24px;">

    {{-- Kolom Kiri: Info Penyewaan + Aksi --}}
    <div style="display:flex; flex-direction:column; gap:20px;">

        {{-- Info Anggota --}}
        <div class="card">
            <div class="card-title">👤 Informasi Anggota</div>
            <div style="display:flex; flex-direction:column; gap:12px;">
                <div style="display:flex; align-items:center; gap:14px;">
                    <div style="width:48px; height:48px; border-radius:50%; background:linear-gradient(135deg,var(--navy),var(--navy-mid));
                                display:flex; align-items:center; justify-content:center; color:#fff; font-weight:700; font-size:18px; flex-shrink:0;">
                        {{ strtoupper(substr($penyewaan->user->name, 0, 1)) }}
                    </div>
                    <div>
                        <div style="font-weight:700; font-size:15px; color:var(--gray-900);">{{ $penyewaan->user->name }}</div>
                        <div style="font-size:12.5px; color:var(--gray-500);">{{ $penyewaan->user->email }}</div>
                        @if($penyewaan->user->phone)
                        <div style="font-size:12.5px; color:var(--gray-500);">📱 {{ $penyewaan->user->phone }}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Info Alat --}}
        <div class="card">
            <div class="card-title">🔧 Informasi Alat</div>
            <div style="display:flex; gap:16px; align-items:flex-start;">
                @if($penyewaan->alat->gambar)
                    <img src="{{ asset('storage/' . $penyewaan->alat->gambar) }}"
                         style="width:80px; height:80px; object-fit:cover; border-radius:10px; flex-shrink:0;" alt="Foto Alat">
                @else
                    <div style="width:80px; height:80px; background:var(--gray-100); border-radius:10px; display:flex; align-items:center;
                                justify-content:center; flex-shrink:0; color:var(--gray-400); font-size:28px;">🔧</div>
                @endif
                <div style="flex:1;">
                    <div style="font-weight:700; font-size:15px; color:var(--navy-dark); margin-bottom:6px;">
                        {{ $penyewaan->alat->nama_alat }}
                    </div>
                    <div style="font-size:12.5px; color:var(--gray-500); margin-bottom:10px; line-height:1.5;">
                        {{ Str::limit($penyewaan->alat->deskripsi, 120) }}
                    </div>
                    <div style="display:flex; gap:12px;">
                        <div>
                            <div style="font-size:10px; color:var(--gray-500); font-weight:600; text-transform:uppercase;">Harga/Hari</div>
                            <div style="font-size:14px; font-weight:700; color:var(--gold);">
                                Rp {{ number_format($penyewaan->alat->harga_sewa, 0, ',', '.') }}
                            </div>
                        </div>
                        <div>
                            <div style="font-size:10px; color:var(--gray-500); font-weight:600; text-transform:uppercase;">Status Alat</div>
                            @php $alatStatus = $penyewaan->alat->status ?? 'tersedia'; @endphp
                            @if($alatStatus === 'tersedia')
                                <span class="badge" style="background:#D1FAE5; color:#065F46; margin-top:2px;">✔ Tersedia</span>
                            @elseif($alatStatus === 'dipinjam')
                                <span class="badge badge-pending" style="margin-top:2px;">🔄 Dipinjam</span>
                            @else
                                <span class="badge" style="background:#E5E7EB; color:#374151; margin-top:2px;">🔧 Maintenance</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Detail Transaksi --}}
        <div class="card">
            <div class="card-title">📋 Detail Transaksi</div>
            <div style="display:flex; flex-direction:column; gap:10px;">
                @php
                    $mulai    = \Carbon\Carbon::parse($penyewaan->tanggal_mulai);
                    $selesai  = \Carbon\Carbon::parse($penyewaan->tanggal_selesai);
                    $durasi   = max(1, $mulai->diffInDays($selesai));
                @endphp
                <div style="display:flex; justify-content:space-between; padding:10px 0; border-bottom:1px solid var(--gray-100);">
                    <span style="font-size:13px; color:var(--gray-500);">Tanggal Mulai</span>
                    <span style="font-size:13px; font-weight:600; color:var(--gray-900);">{{ $mulai->isoFormat('dddd, D MMMM Y') }}</span>
                </div>
                <div style="display:flex; justify-content:space-between; padding:10px 0; border-bottom:1px solid var(--gray-100);">
                    <span style="font-size:13px; color:var(--gray-500);">Tanggal Selesai</span>
                    <span style="font-size:13px; font-weight:600; color:var(--gray-900);">{{ $selesai->isoFormat('dddd, D MMMM Y') }}</span>
                </div>
                <div style="display:flex; justify-content:space-between; padding:10px 0; border-bottom:1px solid var(--gray-100);">
                    <span style="font-size:13px; color:var(--gray-500);">Durasi Sewa</span>
                    <span style="font-size:13px; font-weight:600; color:var(--gray-900);">{{ $durasi }} hari</span>
                </div>
                @if($penyewaan->tanggal_kembali)
                <div style="display:flex; justify-content:space-between; padding:10px 0; border-bottom:1px solid var(--gray-100);">
                    <span style="font-size:13px; color:var(--gray-500);">Tanggal Dikembalikan</span>
                    <span style="font-size:13px; font-weight:600; color:#065F46;">
                        ✅ {{ \Carbon\Carbon::parse($penyewaan->tanggal_kembali)->isoFormat('D MMMM Y') }}
                    </span>
                </div>
                @endif
                <div style="display:flex; justify-content:space-between; padding:14px 0;">
                    <span style="font-size:14px; font-weight:600; color:var(--gray-900);">Total Pembayaran</span>
                    <span style="font-size:18px; font-weight:700; color:var(--navy-dark);">
                        Rp {{ number_format($penyewaan->total_harga, 0, ',', '.') }}
                    </span>
                </div>
            </div>
        </div>

    </div>

    {{-- Kolom Kanan: Bukti + Kontrol Admin --}}
    <div style="display:flex; flex-direction:column; gap:20px;">

        {{-- Bukti Pembayaran --}}
        <div class="card">
            <div class="card-title">🧾 Bukti Pembayaran</div>
            @if($penyewaan->bukti_pembayaran)
                <div style="border-radius:12px; overflow:hidden; border:1px solid var(--gray-200); cursor:pointer;"
                     onclick="document.getElementById('modalBukti').style.display='flex'">
                    <img src="{{ asset('storage/' . $penyewaan->bukti_pembayaran) }}"
                         alt="Bukti Pembayaran"
                         style="width:100%; max-height:320px; object-fit:contain; display:block; background:var(--gray-50);">
                </div>
                <div style="text-align:center; margin-top:8px;">
                    <a href="{{ asset('storage/' . $penyewaan->bukti_pembayaran) }}" target="_blank"
                       style="font-size:12px; color:var(--navy); font-weight:600; text-decoration:none;">
                        🔗 Buka di tab baru
                    </a>
                </div>

                {{-- Modal Zoom Bukti --}}
                <div id="modalBukti" onclick="this.style.display='none'"
                     style="display:none; position:fixed; inset:0; background:rgba(0,0,0,.85); z-index:9999;
                            align-items:center; justify-content:center; cursor:zoom-out;">
                    <img src="{{ asset('storage/' . $penyewaan->bukti_pembayaran) }}"
                         style="max-width:90vw; max-height:90vh; border-radius:12px; box-shadow:0 20px 60px rgba(0,0,0,.5);"
                         alt="Bukti Pembayaran Zoom">
                </div>
            @else
                <div style="text-align:center; padding:32px; color:var(--gray-400);">
                    <div style="font-size:36px; margin-bottom:8px;">📄</div>
                    <div style="font-size:13px;">Tidak ada bukti pembayaran diunggah</div>
                </div>
            @endif
        </div>

        {{-- Tombol Aksi Approve / Reject --}}
        @if($penyewaan->status_pembayaran === 'pending')
        <div class="card">
            <div class="card-title">⚡ Tindakan Admin</div>
            <p style="font-size:13px; color:var(--gray-500); margin-bottom:16px;">
                Verifikasi bukti pembayaran di atas, lalu pilih tindakan yang sesuai.
            </p>
            <div class="flex gap-3">
                <form action="{{ route('admin.alat.approve', $penyewaan->id) }}" method="POST" style="flex:1;"
                      onsubmit="return confirm('Setujui penyewaan ini? Status alat akan berubah menjadi Dipinjam.')">
                    @csrf @method('PATCH')
                    <button type="submit" class="btn btn-success w-full" style="justify-content:center;">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="16" height="16"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Setujui (Approve)
                    </button>
                </form>
                <form action="{{ route('admin.alat.reject', $penyewaan->id) }}" method="POST" style="flex:1;"
                      onsubmit="return confirm('Tolak penyewaan ini? Tindakan ini tidak dapat dibatalkan.')">
                    @csrf @method('PATCH')
                    <button type="submit" class="btn btn-danger w-full" style="justify-content:center;">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="16" height="16"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        Tolak (Reject)
                    </button>
                </form>
            </div>
        </div>
        @endif

        {{-- Pencatatan Pengembalian Alat --}}
        @if($penyewaan->status_pembayaran === 'dibayar' && !$penyewaan->tanggal_kembali)
        <div class="card" style="border: 1.5px solid #A7F3D0;">
            <div class="card-title" style="color:#065F46;">📦 Catat Pengembalian Alat</div>
            <p style="font-size:13px; color:var(--gray-500); margin-bottom:16px;">
                Setelah anggota mengembalikan alat secara fisik, catat tanggal pengembalian di sini.
                Status alat akan otomatis berubah menjadi <strong>Tersedia</strong>.
            </p>
            <form action="{{ route('admin.alat.return', $penyewaan->id) }}" method="POST"
                  onsubmit="return confirm('Konfirmasi pengembalian alat ini?')">
                @csrf
                <div class="form-group">
                    <label class="form-label">Tanggal Kembali <span class="req">*</span></label>
                    <input type="date" name="tanggal_kembali" class="form-control @error('tanggal_kembali') is-invalid @enderror"
                           value="{{ old('tanggal_kembali', date('Y-m-d')) }}" required>
                    @error('tanggal_kembali') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <button type="submit" class="btn btn-success w-full" style="justify-content:center;">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="16" height="16"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/></svg>
                    Konfirmasi Pengembalian
                </button>
            </form>
        </div>
        @elseif($penyewaan->tanggal_kembali)
        <div class="card" style="border: 1.5px solid #A7F3D0; background: #F0FDF4;">
            <div style="display:flex; align-items:center; gap:12px;">
                <span style="font-size:28px;">✅</span>
                <div>
                    <div style="font-weight:700; color:#065F46; font-size:14px;">Alat Sudah Dikembalikan</div>
                    <div style="font-size:12.5px; color:#059669;">
                        Tanggal kembali: {{ \Carbon\Carbon::parse($penyewaan->tanggal_kembali)->isoFormat('D MMMM Y') }}
                    </div>
                </div>
            </div>
        </div>
        @endif

        {{-- Ubah Status Alat Secara Manual --}}
        <div class="card" style="border:1.5px solid var(--gray-200);">
            <div class="card-title">⚙️ Ubah Status Operasional Alat</div>
            <p style="font-size:12.5px; color:var(--gray-500); margin-bottom:14px;">
                Ubah status alat <strong>{{ $penyewaan->alat->nama_alat }}</strong> secara manual jika diperlukan.
            </p>
            <form action="{{ route('admin.alat.status', $penyewaan->id) }}" method="POST">
                @csrf @method('PATCH')
                <div class="form-group" style="margin-bottom:14px;">
                    <label class="form-label">Status Alat</label>
                    <select name="status" class="form-control">
                        <option value="tersedia"    {{ ($penyewaan->alat->status ?? 'tersedia') === 'tersedia'    ? 'selected' : '' }}>✔ Tersedia</option>
                        <option value="dipinjam"    {{ ($penyewaan->alat->status ?? 'tersedia') === 'dipinjam'    ? 'selected' : '' }}>🔄 Dipinjam</option>
                        <option value="maintenance" {{ ($penyewaan->alat->status ?? 'tersedia') === 'maintenance' ? 'selected' : '' }}>🔧 Maintenance</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-sm" onsubmit="return confirm('Ubah status alat ini?')">
                    Simpan Status
                </button>
            </form>
        </div>

    </div>
</div>
@endsection
