@extends('layouts.app')
@section('title', 'Ajukan Pinjaman')
@section('page-title', 'Ajukan Pinjaman')

@push('styles')
<style>
    .simulator-card {
        background: linear-gradient(135deg, #0B2545 0%, #19376D 60%, #1A4A8A 100%);
        border-radius: 16px;
        padding: 28px;
        color: #fff;
        position: sticky;
        top: 80px;
    }
    .simulator-title {
        font-family: 'Poppins', sans-serif;
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .sim-input-group { margin-bottom: 18px; }
    .sim-label {
        font-size: 12px;
        font-weight: 500;
        color: rgba(255,255,255,.7);
        margin-bottom: 6px;
        display: block;
    }
    .sim-input {
        width: 100%;
        padding: 10px 14px;
        background: rgba(255,255,255,.12);
        border: 1.5px solid rgba(255,255,255,.2);
        border-radius: 10px;
        color: #fff;
        font-size: 14px;
        font-family: 'Inter', sans-serif;
        outline: none;
        transition: border-color .2s;
    }
    .sim-input:focus { border-color: rgba(245,166,35,.7); }
    .sim-input::placeholder { color: rgba(255,255,255,.4); }
    .sim-result {
        background: rgba(255,255,255,.1);
        border-radius: 12px;
        padding: 18px;
        margin-top: 6px;
    }
    .sim-result-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 7px 0;
        border-bottom: 1px solid rgba(255,255,255,.08);
        font-size: 13px;
    }
    .sim-result-row:last-child { border-bottom: none; }
    .sim-result-label { color: rgba(255,255,255,.7); }
    .sim-result-value { font-weight: 700; color: #fff; font-family: 'Poppins', sans-serif; }
    .sim-result-value.gold { color: #F5A623; font-size: 18px; }
    .sim-note {
        font-size: 11px;
        color: rgba(255,255,255,.45);
        margin-top: 12px;
        line-height: 1.6;
    }
    .sim-loading { text-align: center; padding: 20px; color: rgba(255,255,255,.5); font-size: 13px; }
    .range-input { width: 100%; accent-color: #F5A623; margin-top: 8px; }
    .range-labels { display: flex; justify-content: space-between; font-size: 11px; color: rgba(255,255,255,.5); margin-top: 4px; }
</style>
@endpush

@section('content')
<div class="page-header flex items-center justify-between">
    <div>
        <h2>Ajukan Pinjaman</h2>
        <p>Simulasikan terlebih dahulu, lalu isi form pengajuan</p>
    </div>
    <a href="{{ route('anggota.pinjaman.index') }}" class="btn btn-outline">← Kembali</a>
</div>

<div style="display:grid;grid-template-columns:1fr 360px;gap:24px;align-items:start;">

    {{-- Form Pengajuan --}}
    <div class="card">
        <div class="card-title">📝 Form Pengajuan Pinjaman</div>

        <form method="POST" action="{{ route('anggota.pinjaman.store') }}" enctype="multipart/form-data" id="pinjaman-form">
            @csrf

            <div class="grid-2">
                <div class="form-group">
                    <label class="form-label" for="jumlah_pinjaman">Jumlah Pinjaman <span class="req">*</span></label>
                    <div style="position:relative;">
                        <span style="position:absolute;left:14px;top:50%;transform:translateY(-50%);font-size:14px;color:#6B7280;font-weight:500;">Rp</span>
                        <input type="number" id="jumlah_pinjaman" name="jumlah_pinjaman"
                               class="form-control {{ $errors->has('jumlah_pinjaman') ? 'is-invalid' : '' }}"
                               style="padding-left:40px;"
                               value="{{ old('jumlah_pinjaman') }}"
                               placeholder="500.000" min="500000" step="100000">
                    </div>
                    @error('jumlah_pinjaman')
                        <div class="invalid-feedback" style="display:block;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="tenor">Tenor (Bulan) <span class="req">*</span></label>
                    <select id="tenor" name="tenor" class="form-control {{ $errors->has('tenor') ? 'is-invalid' : '' }}">
                        <option value="">-- Pilih Tenor --</option>
                        @foreach([3,6,12,18,24,36,48,60] as $t)
                            <option value="{{ $t }}" {{ old('tenor') == $t ? 'selected' : '' }}>{{ $t }} Bulan</option>
                        @endforeach
                    </select>
                    @error('tenor')
                        <div class="invalid-feedback" style="display:block;">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="tujuan_pinjaman">Tujuan / Alasan Pinjaman <span class="req">*</span></label>
                <textarea id="tujuan_pinjaman" name="tujuan_pinjaman"
                          class="form-control {{ $errors->has('tujuan_pinjaman') ? 'is-invalid' : '' }}"
                          placeholder="Jelaskan tujuan pinjaman Anda (min. 20 karakter)..." rows="4">{{ old('tujuan_pinjaman') }}</textarea>
                @error('tujuan_pinjaman')
                    <div class="invalid-feedback" style="display:block;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Dokumen Pendukung <span style="font-weight:400;color:#9CA3AF;">(Opsional)</span></label>
                <div class="upload-area" onclick="document.getElementById('dokumen_pendukung').click()">
                    <input type="file" id="dokumen_pendukung" name="dokumen_pendukung"
                           accept=".jpg,.jpeg,.png,.pdf" onchange="previewDokumen(this)">
                    <div id="dok-placeholder">
                        <div class="icon">📁</div>
                        <label class="upload-label">Klik untuk unggah dokumen</label>
                        <p>KTP, slip gaji, atau dokumen pendukung lainnya · Maks. 5 MB</p>
                    </div>
                    <div id="dok-preview" style="display:none;">
                        <div style="font-size:28px;">✅</div>
                        <p id="dok-name" style="font-weight:600;color:#059669;font-size:13px;margin-top:6px;"></p>
                    </div>
                </div>
                @error('dokumen_pendukung')
                    <div class="invalid-feedback" style="display:block;">{{ $message }}</div>
                @enderror
            </div>

            {{-- Info bunga --}}
            <div style="background:#EFF6FF;border:1px solid #BFDBFE;border-radius:10px;padding:14px 16px;margin-bottom:20px;">
                <div style="font-size:13px;color:#1E40AF;font-weight:600;margin-bottom:4px;">ℹ️ Informasi Bunga</div>
                <div style="font-size:12.5px;color:#3B82F6;">Bunga flat <strong>1% per bulan</strong> dari pokok pinjaman. Total angsuran = (Pokok ÷ Tenor) + (Pokok × 1%).</div>
            </div>

            <button type="submit" class="btn btn-primary w-full" style="justify-content:center;padding:13px;">
                🚀 Ajukan Pinjaman
            </button>
        </form>
    </div>

    {{-- Simulator Widget --}}
    <div class="simulator-card">
        <div class="simulator-title">🧮 Simulasi Angsuran</div>

        <div class="sim-input-group">
            <label class="sim-label">Jumlah Pinjaman</label>
            <input type="number" id="sim-jumlah" class="sim-input"
                   placeholder="Contoh: 5000000" min="0" step="100000">
        </div>

        <div class="sim-input-group">
            <label class="sim-label">Tenor: <strong id="tenor-label">12</strong> bulan</label>
            <input type="range" id="sim-tenor" class="range-input" min="1" max="60" value="12">
            <div class="range-labels"><span>1 bln</span><span>60 bln</span></div>
        </div>

        <div class="sim-result" id="sim-result">
            <div class="sim-result-row">
                <span class="sim-result-label">Angsuran/Bulan</span>
                <span class="sim-result-value gold" id="r-angsuran">Rp 0</span>
            </div>
            <div class="sim-result-row">
                <span class="sim-result-label">Total Bunga</span>
                <span class="sim-result-value" id="r-bunga">Rp 0</span>
            </div>
            <div class="sim-result-row">
                <span class="sim-result-label">Total Pengembalian</span>
                <span class="sim-result-value" id="r-total">Rp 0</span>
            </div>
        </div>

        <p class="sim-note">* Simulasi menggunakan bunga flat 1%/bulan. Nilai aktual dapat berbeda berdasarkan kebijakan koperasi.</p>

        <button type="button" id="pakai-simulasi"
                style="width:100%;margin-top:16px;padding:11px;border-radius:10px;background:rgba(245,166,35,.25);border:1.5px solid rgba(245,166,35,.5);color:#F5A623;font-size:13px;font-weight:600;cursor:pointer;transition:all .2s;"
                onmouseover="this.style.background='rgba(245,166,35,.4)'"
                onmouseout="this.style.background='rgba(245,166,35,.25)'">
            ✅ Gunakan Angka Ini di Form
        </button>
    </div>
</div>
@endsection

@push('scripts')
<script>
const fmt = n => 'Rp ' + Math.round(n).toLocaleString('id-ID');

let debounceTimer;
function hitungSimulasi() {
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(async () => {
        const jumlah = parseFloat(document.getElementById('sim-jumlah').value) || 0;
        const tenor  = parseInt(document.getElementById('sim-tenor').value)   || 12;

        if (jumlah <= 0) {
            document.getElementById('r-angsuran').textContent = 'Rp 0';
            document.getElementById('r-bunga').textContent    = 'Rp 0';
            document.getElementById('r-total').textContent    = 'Rp 0';
            return;
        }

        try {
            const res  = await fetch('{{ route('anggota.pinjaman.simulasi') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                },
                body: JSON.stringify({ jumlah, tenor }),
            });
            const data = await res.json();
            document.getElementById('r-angsuran').textContent = fmt(data.angsuran);
            document.getElementById('r-bunga').textContent    = fmt(data.total_bunga);
            document.getElementById('r-total').textContent    = fmt(data.total);
        } catch(e) {
            console.error(e);
        }
    }, 400);
}

document.getElementById('sim-jumlah').addEventListener('input', hitungSimulasi);
document.getElementById('sim-tenor').addEventListener('input', function() {
    document.getElementById('tenor-label').textContent = this.value;
    hitungSimulasi();
});

// Pakai angka simulasi di form utama
document.getElementById('pakai-simulasi').addEventListener('click', () => {
    const jumlah = document.getElementById('sim-jumlah').value;
    const tenor  = document.getElementById('sim-tenor').value;
    if (jumlah) document.getElementById('jumlah_pinjaman').value = jumlah;
    const sel = document.getElementById('tenor');
    // Pilih opsi terdekat
    let closest = null, diff = Infinity;
    for (const opt of sel.options) {
        const d = Math.abs(parseInt(opt.value || 0) - parseInt(tenor));
        if (d < diff) { diff = d; closest = opt; }
    }
    if (closest) closest.selected = true;
    document.getElementById('jumlah_pinjaman').scrollIntoView({ behavior: 'smooth' });
});

// Sync form → simulator
document.getElementById('jumlah_pinjaman').addEventListener('input', function() {
    document.getElementById('sim-jumlah').value = this.value;
    hitungSimulasi();
});
document.getElementById('tenor').addEventListener('change', function() {
    if (this.value) {
        document.getElementById('sim-tenor').value = this.value;
        document.getElementById('tenor-label').textContent = this.value;
        hitungSimulasi();
    }
});

function previewDokumen(input) {
    if (input.files && input.files[0]) {
        document.getElementById('dok-placeholder').style.display = 'none';
        document.getElementById('dok-preview').style.display     = 'block';
        document.getElementById('dok-name').textContent = input.files[0].name;
    }
}
</script>
@endpush
