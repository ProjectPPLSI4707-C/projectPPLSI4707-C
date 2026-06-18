@extends('layouts.app')
@section('title', 'Buat Konfigurasi SHU')
@section('page-title', 'Buat Konfigurasi SHU')

@section('content')
<div class="page-header">
    <h2>Buat Konfigurasi SHU Baru</h2>
    <p>Tentukan parameter distribusi SHU tahunan</p>
</div>

<div class="grid-2">
    {{-- Form --}}
    <div class="card">
        <div class="card-title">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="18" height="18"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            Konfigurasi SHU
        </div>
        <form action="{{ route('admin.shu.store') }}" method="POST" id="shuForm">
            @csrf
            <div class="form-group">
                <label class="form-label">Tahun <span class="req">*</span></label>
                <input type="number" name="tahun" class="form-control @error('tahun') is-invalid @enderror"
                       value="{{ old('tahun', now()->year) }}" min="2020" max="2099" required id="inputTahun">
                @error('tahun')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Total SHU (Rp) <span class="req">*</span></label>
                <input type="number" name="total_shu" class="form-control @error('total_shu') is-invalid @enderror"
                       value="{{ old('total_shu') }}" min="1" step="1" required placeholder="Contoh: 60000000" id="inputTotalShu">
                @error('total_shu')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div style="border:1px solid var(--gray-200);border-radius:12px;padding:18px;margin-bottom:18px;background:var(--gray-100);">
                <div style="font-size:13px;font-weight:700;color:var(--gray-900);margin-bottom:14px;">Persentase Pembagian</div>

                <div class="form-group">
                    <label class="form-label">Dana Cadangan (%) <span class="req">*</span></label>
                    <input type="number" name="persen_cadangan" class="form-control persen-input @error('persen_cadangan') is-invalid @enderror"
                           value="{{ old('persen_cadangan', 40) }}" min="0" max="100" step="0.01" required>
                    @error('persen_cadangan')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Jasa Modal (%) <span class="req">*</span></label>
                    <input type="number" name="persen_jasa_modal" class="form-control persen-input @error('persen_jasa_modal') is-invalid @enderror"
                           value="{{ old('persen_jasa_modal', 30) }}" min="0" max="100" step="0.01" required>
                    @error('persen_jasa_modal')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label">Jasa Usaha (%) <span class="req">*</span></label>
                    <input type="number" name="persen_jasa_usaha" class="form-control persen-input @error('persen_jasa_usaha') is-invalid @enderror"
                           value="{{ old('persen_jasa_usaha', 30) }}" min="0" max="100" step="0.01" required>
                    @error('persen_jasa_usaha')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div style="margin-top:14px;padding:10px 14px;border-radius:8px;font-size:13px;font-weight:700;" id="totalPersenInfo">
                    Total: 100%
                </div>
            </div>

            <div style="display:flex;gap:12px;">
                <button type="submit" class="btn btn-primary" id="submitBtn">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="16" height="16"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    Simpan Konfigurasi
                </button>
                <a href="{{ route('admin.shu.index') }}" class="btn btn-outline">Kembali</a>
            </div>
        </form>
    </div>

    {{-- Preview --}}
    <div class="card">
        <div class="card-title">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="18" height="18"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
            Preview Pembagian
        </div>

        <div style="text-align:center;margin-bottom:20px;">
            <div style="font-size:12px;color:var(--gray-500);margin-bottom:6px;">Total SHU</div>
            <div style="font-size:28px;font-weight:700;color:var(--gray-900);font-family:'JetBrains Mono',monospace;" id="previewTotal">Rp 0</div>
        </div>

        <div style="display:flex;flex-direction:column;gap:12px;">
            <div style="background:var(--gold-light);border-radius:12px;padding:16px;border:1px solid rgba(245,166,35,.15);">
                <div style="font-size:11px;color:var(--gold);font-weight:700;text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px;">Dana Cadangan</div>
                <div style="font-size:18px;font-weight:700;color:var(--gray-900);font-family:'JetBrains Mono',monospace;" id="previewCadangan">Rp 0</div>
                <div style="font-size:11px;color:var(--gray-500);margin-top:4px;" id="previewCadanganPersen">40% dari Total SHU</div>
            </div>
            <div style="background:var(--blue-light);border-radius:12px;padding:16px;border:1px solid rgba(59,130,246,.15);">
                <div style="font-size:11px;color:var(--navy-light);font-weight:700;text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px;">Dana Jasa Modal</div>
                <div style="font-size:18px;font-weight:700;color:var(--gray-900);font-family:'JetBrains Mono',monospace;" id="previewModal">Rp 0</div>
                <div style="font-size:11px;color:var(--gray-500);margin-top:4px;" id="previewModalPersen">30% dari Total SHU</div>
            </div>
            <div style="background:var(--emerald-light);border-radius:12px;padding:16px;border:1px solid rgba(16,185,129,.15);">
                <div style="font-size:11px;color:var(--emerald);font-weight:700;text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px;">Dana Jasa Usaha</div>
                <div style="font-size:18px;font-weight:700;color:var(--gray-900);font-family:'JetBrains Mono',monospace;" id="previewUsaha">Rp 0</div>
                <div style="font-size:11px;color:var(--gray-500);margin-top:4px;" id="previewUsahaPersen">30% dari Total SHU</div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('.persen-input');
    const totalInfo = document.getElementById('totalPersenInfo');
    const totalShuInput = document.getElementById('inputTotalShu');
    const submitBtn = document.getElementById('submitBtn');

    function formatRp(val) {
        return 'Rp ' + Math.round(val).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

    function updatePreview() {
        const totalShu = parseFloat(totalShuInput.value) || 0;
        const cadangan = parseFloat(document.querySelector('[name="persen_cadangan"]').value) || 0;
        const modal = parseFloat(document.querySelector('[name="persen_jasa_modal"]').value) || 0;
        const usaha = parseFloat(document.querySelector('[name="persen_jasa_usaha"]').value) || 0;
        const total = cadangan + modal + usaha;

        // Update total percentage indicator
        if (Math.abs(total - 100) < 0.01) {
            totalInfo.textContent = 'Total: ' + total.toFixed(2) + '% ✓';
            totalInfo.style.background = 'var(--emerald-light)';
            totalInfo.style.color = 'var(--emerald)';
            submitBtn.disabled = false;
            submitBtn.style.opacity = '1';
        } else {
            totalInfo.textContent = 'Total: ' + total.toFixed(2) + '% — harus 100%';
            totalInfo.style.background = 'var(--red-light)';
            totalInfo.style.color = 'var(--red)';
            submitBtn.disabled = true;
            submitBtn.style.opacity = '0.5';
        }

        // Update preview
        document.getElementById('previewTotal').textContent = formatRp(totalShu);
        document.getElementById('previewCadangan').textContent = formatRp(totalShu * cadangan / 100);
        document.getElementById('previewCadanganPersen').textContent = cadangan + '% dari Total SHU';
        document.getElementById('previewModal').textContent = formatRp(totalShu * modal / 100);
        document.getElementById('previewModalPersen').textContent = modal + '% dari Total SHU';
        document.getElementById('previewUsaha').textContent = formatRp(totalShu * usaha / 100);
        document.getElementById('previewUsahaPersen').textContent = usaha + '% dari Total SHU';
    }

    inputs.forEach(function(input) { input.addEventListener('input', updatePreview); });
    totalShuInput.addEventListener('input', updatePreview);
    updatePreview();
});
</script>
@endpush
