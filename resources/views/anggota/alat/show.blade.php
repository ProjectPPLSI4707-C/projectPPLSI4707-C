@extends('layouts.app')

@section('title', 'Detail Alat')
@section('page-title', 'Detail Alat')

@section('content')
<div class="page-header flex items-center justify-between">
    <div>
        <h2>{{ $alat->nama_alat }}</h2>
        <p>Lihat detail ketersediaan dan form penyewaan alat.</p>
    </div>
    <a href="{{ route('anggota.alat.index') }}" class="btn btn-outline">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="16" height="16"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali
    </a>
</div>

<div class="grid-2">
    <!-- Detail Alat -->
    <div class="card">
        <div class="card-title">Informasi Alat</div>
        
        <div style="height: 250px; background: var(--gray-100); border-radius: 12px; margin-bottom: 20px; overflow: hidden; display: flex; align-items: center; justify-content: center;">
            @if($alat->gambar)
                <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($alat->gambar) }}" alt="{{ $alat->nama_alat }}" style="width: 100%; height: 100%; object-fit: cover;">
            @else
                <svg style="color: var(--gray-400); width: 64px; height: 64px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            @endif
        </div>

        <div style="font-size: 14px; color: var(--gray-700); line-height: 1.6; margin-bottom: 20px;">
            {{ $alat->deskripsi }}
        </div>

        <div class="flex items-center gap-4 mt-4 pt-4" style="border-top: 1px solid var(--gray-100);">
            <div style="flex: 1;">
                <div style="font-size: 11px; color: var(--gray-500); font-weight: 600; text-transform: uppercase;">Stok Tersedia</div>
                <div style="font-size: 16px; font-weight: 600; color: var(--gray-900);">{{ $alat->stok }} Unit</div>
            </div>
            <div style="flex: 1; text-align: right;">
                <div style="font-size: 11px; color: var(--gray-500); font-weight: 600; text-transform: uppercase;">Harga Sewa</div>
                <div style="font-size: 18px; font-weight: 700; color: var(--gold);">Rp {{ number_format($alat->harga_sewa, 0, ',', '.') }} <span style="font-size: 12px; font-weight: 500; color: var(--gray-500);">/hari</span></div>
            </div>
        </div>
        <div class="mt-4" style="padding-top:12px;">
            @php $alatStatus = $alat->status ?? 'tersedia'; @endphp
            @if($alatStatus === 'tersedia')
                <span class="badge" style="background:#D1FAE5; color:#065F46;">✔ Tersedia untuk disewa</span>
            @elseif($alatStatus === 'dipinjam')
                <span class="badge badge-pending">🔄 Sedang Dipinjam</span>
            @else
                <span class="badge" style="background:#E5E7EB; color:#374151;">🔧 Sedang Maintenance</span>
            @endif
        </div>

        <div class="mt-6 pt-4" style="border-top: 1px solid var(--gray-200);">
            <h3 style="font-size: 14px; font-weight: 600; margin-bottom: 12px;">Jadwal Terpesan (Tidak Tersedia)</h3>
            @if($jadwalPenyewaan->count() > 0)
                <ul style="list-style: none; padding: 0;">
                @foreach($jadwalPenyewaan as $jadwal)
                    <li style="padding: 10px 12px; background: var(--gray-50); border-radius: 8px; margin-bottom: 8px; font-size: 13px; color: var(--gray-700); display: flex; justify-content: space-between; align-items: center;">
                        <span>{{ \Carbon\Carbon::parse($jadwal->tanggal_mulai)->isoFormat('D MMM Y') }} - {{ \Carbon\Carbon::parse($jadwal->tanggal_selesai)->isoFormat('D MMM Y') }}</span>
                        <span class="badge {{ $jadwal->status_pembayaran == 'dibayar' ? 'badge-success' : 'badge-pending' }}">
                            {{ ucfirst($jadwal->status_pembayaran) }}
                        </span>
                    </li>
                @endforeach
                </ul>
            @else
                <p style="font-size: 13px; color: var(--gray-500);">Belum ada jadwal terpesan. Alat tersedia.</p>
            @endif
        </div>
    </div>

    <!-- Form Sewa -->
    <div class="card">
        <div class="card-title">Formulir Penyewaan</div>

        @php $alatStatus = $alat->status ?? 'tersedia'; @endphp
        @if($alatStatus === 'maintenance')
        {{-- Blokir jika maintenance --}}
        <div class="alert alert-warning" style="flex-direction:column; align-items:flex-start; gap:6px;">
            <div style="font-weight:700; font-size:14px;">🔧 Alat Sedang Dalam Pemeliharaan</div>
            <div style="font-size:13px;">Maaf, alat ini sedang dalam masa pemeliharaan dan tidak dapat disewa saat ini. Silakan coba lagi nanti atau pilih alat lain.</div>
        </div>
        <a href="{{ route('anggota.alat.index') }}" class="btn btn-outline w-full" style="justify-content:center; margin-top:8px;">
            ← Lihat Alat Lainnya
        </a>
        @else
        <form action="{{ route('anggota.alat.sewa', $alat->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label class="form-label">Tanggal Mulai <span class="req">*</span></label>
                <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control @error('tanggal_mulai') is-invalid @enderror" value="{{ old('tanggal_mulai') }}" required min="{{ date('Y-m-d') }}">
                @error('tanggal_mulai') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Tanggal Selesai <span class="req">*</span></label>
                <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control @error('tanggal_selesai') is-invalid @enderror" value="{{ old('tanggal_selesai') }}" required min="{{ date('Y-m-d') }}">
                @error('tanggal_selesai') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <div style="background: var(--blue-light); padding: 16px; border-radius: 12px; border: 1px dashed var(--navy-mid);">
                    <div style="font-size: 12px; color: var(--gray-500); font-weight: 600; text-transform: uppercase; margin-bottom: 4px;">Total Biaya</div>
                    <div id="total_biaya_display" style="font-size: 24px; font-weight: 700; color: var(--navy-dark);">Rp 0</div>
                    <div style="font-size: 11px; color: var(--gray-500); margin-top: 4px;" id="durasi_display">0 hari</div>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Bukti Pembayaran <span class="req">*</span></label>
                <p style="font-size: 12px; color: var(--gray-500); margin-bottom: 12px;">Silakan transfer sejumlah <strong style="color:var(--gray-900);">Total Biaya</strong> ke rekening koperasi (BCA 123456789 a/n SKOTER) dan unggah bukti transfer.</p>
                <label class="upload-area w-full" style="display: block;">
                    <div class="icon">📄</div>
                    <div class="upload-label mt-2">Pilih file / Drag & drop</div>
                    <p>Format JPG, PNG (Max. 2MB)</p>
                    <input type="file" name="bukti_pembayaran" required accept="image/*">
                </label>
                @error('bukti_pembayaran') <div class="invalid-feedback" style="display:block;">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn btn-primary w-full" style="justify-content: center; padding: 14px;">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="18" height="18"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Ajukan Penyewaan
            </button>
        </form>
        @endif
    </div>
</div>

@push('scripts')
<script>
    const hargasewa = {{ $alat->harga_sewa }};
    const tglMulai = document.getElementById('tanggal_mulai');
    const tglSelesai = document.getElementById('tanggal_selesai');
    const totalDisplay = document.getElementById('total_biaya_display');
    const durasiDisplay = document.getElementById('durasi_display');

    function hitungTotal() {
        if(tglMulai.value && tglSelesai.value) {
            const start = new Date(tglMulai.value);
            const end = new Date(tglSelesai.value);
            
            if(end >= start) {
                const diffTime = Math.abs(end - start);
                let diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                diffDays = diffDays === 0 ? 1 : diffDays; // Minimal 1 hari
                
                const total = diffDays * hargasewa;
                
                durasiDisplay.innerText = diffDays + ' hari';
                totalDisplay.innerText = 'Rp ' + total.toLocaleString('id-ID');
            } else {
                durasiDisplay.innerText = 'Tanggal tidak valid';
                totalDisplay.innerText = 'Rp 0';
            }
        }
    }

    tglMulai.addEventListener('change', () => {
        tglSelesai.min = tglMulai.value;
        if(tglSelesai.value && tglSelesai.value < tglMulai.value) {
            tglSelesai.value = tglMulai.value;
        }
        hitungTotal();
    });
    
    tglSelesai.addEventListener('change', hitungTotal);
</script>
@endpush
@endsection
