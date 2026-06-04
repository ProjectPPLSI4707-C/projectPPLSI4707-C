@extends('layouts.app')
@section('title', 'Bayar Angsuran')
@section('page-title', 'Bayar Angsuran')

@section('content')
<div class="page-header flex items-center justify-between">
    <div>
        <h2>Bayar Angsuran</h2>
        <p>Input pembayaran angsuran pinjaman dan unggah bukti pembayaran</p>
    </div>
    <a href="{{ route('anggota.pinjaman.index') }}" class="btn btn-danger">Kembali</a>
</div>

<div style="width:100%;max-width:980px;margin:0 auto;">
    <div class="card">
        <div class="card-title">💳 Form Pembayaran Angsuran</div>

        @if($pinjaman->isEmpty())
            <div class="alert alert-warning">
                Anda belum memiliki pinjaman yang disetujui. Ajukan pinjaman terlebih dahulu untuk bisa membayar angsuran.
            </div>
            <a href="{{ route('anggota.pinjaman.create') }}" class="btn btn-primary">+ Ajukan Pinjaman</a>
        @else
            <form method="POST" action="{{ route('anggota.angsuran.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="pinjaman_id">Pilih Pinjaman <span class="req">*</span></label>
                    <select id="pinjaman_id" name="pinjaman_id" class="form-control {{ $errors->has('pinjaman_id') ? 'is-invalid' : '' }}">
                        <option value="">— Pilih Pinjaman —</option>
                        @foreach($pinjaman as $p)
                            <option value="{{ $p->id }}"
                                    data-angsuran="{{ $p->angsuranPerBulan() }}"
                                    {{ (string)old('pinjaman_id') === (string)$p->id ? 'selected' : '' }}>
                                Rp {{ number_format($p->jumlah_pinjaman, 0, ',', '.') }} · {{ $p->tenor }} bln · {{ $p->tanggal_pengajuan->format('d M Y') }}
                            </option>
                        @endforeach
                    </select>
                    @error('pinjaman_id')
                        <div class="invalid-feedback" style="display:block;">{{ $message }}</div>
                    @enderror
                    <div id="info-angsuran" style="margin-top:8px;font-size:12.5px;color:#6B7280;"></div>
                </div>

                <div class="grid-2">
                    <div class="form-group">
                        <label class="form-label" for="tanggal_bayar">Tanggal Pembayaran <span class="req">*</span></label>
                        <input type="date" id="tanggal_bayar" name="tanggal_bayar"
                               class="form-control {{ $errors->has('tanggal_bayar') ? 'is-invalid' : '' }}"
                               value="{{ old('tanggal_bayar') }}">
                        @error('tanggal_bayar')
                            <div class="invalid-feedback" style="display:block;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="jumlah">Jumlah Pembayaran <span class="req">*</span></label>
                        <div style="position:relative;">
                            <span style="position:absolute;left:14px;top:50%;transform:translateY(-50%);font-size:14px;color:#6B7280;font-weight:500;">Rp</span>
                            <input type="number" id="jumlah" name="jumlah"
                                   class="form-control {{ $errors->has('jumlah') ? 'is-invalid' : '' }}"
                                   style="padding-left:40px;"
                                   value="{{ old('jumlah') }}"
                                   placeholder="0"
                                   min="1" step="any">
                        </div>
                        @error('jumlah')
                            <div class="invalid-feedback" style="display:block;">{{ $message }}</div>
                        @enderror
                        <button type="button" id="btn-isi-otomatis" onclick="isiOtomatis()"
                                style="margin-top:6px;font-size:12px;padding:4px 12px;background:none;border:1px solid #6366F1;color:#6366F1;border-radius:6px;cursor:pointer;display:none;">
                            ⚡ Isi Otomatis sesuai Estimasi
                        </button>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Bukti Pembayaran <span class="req">*</span></label>
                    <div class="upload-area" id="upload-area" onclick="document.getElementById('bukti_bayar').click()">
                        <input type="file" id="bukti_bayar" name="bukti_bayar"
                               accept=".jpg,.jpeg,.png,.pdf"
                               onchange="previewFile(this)">
                        <div id="upload-placeholder">
                            <div class="icon">📎</div>
                            <label class="upload-label">Klik untuk memilih file</label>
                            <p>JPG, PNG, atau PDF · Maks. 2 MB</p>
                        </div>
                        <div id="upload-preview" style="display:none;">
                            <div style="font-size:32px;">✅</div>
                            <p id="file-name" style="font-weight:600;color:#059669;margin-top:6px;font-size:13px;"></p>
                            <p style="font-size:12px;color:#6B7280;">Klik untuk mengganti</p>
                        </div>
                    </div>
                    @error('bukti_bayar')
                        <div class="invalid-feedback" style="display:block;">{{ $message }}</div>
                    @enderror
                </div>

                <div style="display:flex;gap:12px;margin-top:8px;">
                    <button type="submit" class="btn btn-primary" style="flex:1;justify-content:center;">
                        ✅ Kirim Pembayaran
                    </button>
                    <a href="{{ route('anggota.pinjaman.index') }}" class="btn btn-outline">Batal</a>
                </div>
            </form>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    const selectPinjaman   = document.getElementById('pinjaman_id');
    const infoAngsuran     = document.getElementById('info-angsuran');
    const btnIsiOtomatis   = document.getElementById('btn-isi-otomatis');
    const inputJumlah      = document.getElementById('jumlah');

    function formatRupiah(value) {
        return new Intl.NumberFormat('id-ID', { maximumFractionDigits: 2 }).format(value);
    }

    function getAngsuranValue() {
        if (!selectPinjaman) return null;
        const selected = selectPinjaman.options[selectPinjaman.selectedIndex];
        return selected ? selected.getAttribute('data-angsuran') : null;
    }

    function updateInfo() {
        if (!selectPinjaman || !infoAngsuran) return;
        const angsuran = getAngsuranValue();

        if (!angsuran) {
            infoAngsuran.textContent = '';
            if (btnIsiOtomatis) btnIsiOtomatis.style.display = 'none';
            return;
        }

        infoAngsuran.textContent = 'Estimasi angsuran/bulan: Rp ' + formatRupiah(Number(angsuran));
        if (btnIsiOtomatis) btnIsiOtomatis.style.display = 'inline-block';
    }

    function isiOtomatis() {
        const angsuran = getAngsuranValue();
        if (angsuran && inputJumlah) {
            // Isi nilai persis dari estimasi, termasuk desimal (misal: 466666.67)
            inputJumlah.value = Number(angsuran);
        }
    }

    function previewFile(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            document.getElementById('upload-placeholder').style.display = 'none';
            document.getElementById('upload-preview').style.display     = 'block';
            document.getElementById('file-name').textContent = file.name;
        }
    }

    if (selectPinjaman) {
        selectPinjaman.addEventListener('change', updateInfo);
        updateInfo();
    }
</script>
@endpush
