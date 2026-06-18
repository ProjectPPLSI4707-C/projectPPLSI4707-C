@extends('layouts.app')
@section('title', 'Bayar Simpanan')
@section('page-title', 'Bayar Simpanan')

@section('content')
<div class="page-header flex items-center justify-between">
    <div>
        <h2>Bayar Simpanan</h2>
        <p>Pilih jenis simpanan dan unggah bukti pembayaran</p>
    </div>
    <a href="{{ route('anggota.simpanan.index') }}" class="btn btn-outline">← Kembali</a>
</div>


<div style="display: flex; justify-content: center; align-items: flex-start; min-height: 70vh; padding-top: 20px;">
    <div style="width: 100%;">
        <div class="card">
            <div class="card-title">📋 Form Pembayaran Simpanan</div>

            <form method="POST" action="{{ route('anggota.simpanan.store') }}" enctype="multipart/form-data">
                @csrf

                {{-- Pilih Jenis --}}
                <div class="form-group">
                    <label class="form-label">Jenis Simpanan <span class="req">*</span></label>
                    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:12px;">
                        @foreach(['Pokok' => ['📌','Simpanan awal keanggotaan, dibayar sekali'], 'Wajib' => ['📅','Dibayar rutin setiap bulan'], 'Sukarela' => ['💰','Dapat dibayar kapan saja']] as $jenis => [$icon, $desc])
                            <label style="cursor:pointer;">
                                <input type="radio" name="jenis_simpanan" value="{{ $jenis }}"
                                       {{ old('jenis_simpanan') === $jenis ? 'checked' : '' }}
                                       style="display:none;" class="jenis-radio">
                                <div class="jenis-card" data-jenis="{{ $jenis }}"
                                     style="border:2px solid #E5E7EB;border-radius:12px;padding:16px;text-align:center;transition:all .2s;user-select:none; height: 100%;">
                                    <div style="font-size:28px;margin-bottom:6px;">{{ $icon }}</div>
                                    <div style="font-size:13px;font-weight:600;color:#111827;">{{ $jenis }}</div>
                                    <div style="font-size:11px;color:#6B7280;margin-top:4px;line-height:1.4;">{{ $desc }}</div>
                                </div>
                            </label>
                        @endforeach
                    </div>
                    @error('jenis_simpanan')
                        <div class="invalid-feedback" style="display:block;">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Jumlah --}}
                <div class="form-group">
                    <label class="form-label" for="jumlah">Jumlah Pembayaran <span class="req">*</span></label>
                    <div style="position:relative;">
                        <span style="position:absolute;left:14px;top:50%;transform:translateY(-50%);font-size:14px;color:#6B7280;font-weight:500;">Rp</span>
                        <input type="number" id="jumlah" name="jumlah"
                               class="form-control {{ $errors->has('jumlah') ? 'is-invalid' : '' }}"
                               style="padding-left:40px; width: 100%;"
                               value="{{ old('jumlah') }}"
                               placeholder="0"
                               min="1000" step="1000">
                    </div>
                    @error('jumlah')
                        <div class="invalid-feedback" style="display:block;">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Upload Bukti --}}
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

                <div style="display:flex;gap:12px;margin-top:24px;">
                    <button type="submit" class="btn btn-primary" style="flex:1;justify-content:center; padding: 12px;">
                        ✅ Kirim Pembayaran
                    </button>
                    <a href="{{ route('anggota.simpanan.index') }}" class="btn btn-outline" style="padding: 12px 24px;">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Jenis selection highlight
    document.querySelectorAll('.jenis-radio').forEach(radio => {
        radio.addEventListener('change', () => {
            document.querySelectorAll('.jenis-card').forEach(c => {
                c.style.borderColor = '#E5E7EB';
                c.style.background  = '#fff';
            });
            const card = radio.parentElement.querySelector('.jenis-card');
            card.style.borderColor = '#19376D';
            card.style.background  = '#EFF6FF';
        });
        // Init state
        if (radio.checked) {
            const card = radio.parentElement.querySelector('.jenis-card');
            card.style.borderColor = '#19376D';
            card.style.background  = '#EFF6FF';
        }
    });

    function previewFile(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            document.getElementById('upload-placeholder').style.display = 'none';
            document.getElementById('upload-preview').style.display     = 'block';
            document.getElementById('file-name').textContent = file.name;
        }
    }
</script>
@endpush
