@extends('layouts.app')
@use('Illuminate\Support\Facades\Storage')
@section('title', 'Edit Profil')
@section('page-title', 'Pengaturan Profil')
@php
    $storedInPublicUploads = filled($user->profile_photo) && str_starts_with($user->profile_photo, 'uploads/');
    $hasProfilePhoto = $storedInPublicUploads
        ? file_exists(public_path($user->profile_photo))
        : (filled($user->profile_photo) && Storage::disk('public')->exists($user->profile_photo));
    $profilePhotoUrl = $hasProfilePhoto
        ? ($storedInPublicUploads
            ? asset($user->profile_photo) . '?v=' . md5($user->profile_photo)
            : route('anggota.profile.photo', ['v' => md5($user->profile_photo)]))
        : null;
@endphp

@push('styles')
<style>
    .profile-container {
        max-width: 800px;
    }

    /* ── Profile Header Card ── */
    .profile-header {
        background: linear-gradient(135deg, var(--navy-dark) 0%, var(--navy) 50%, var(--navy-mid) 100%);
        border-radius: 20px;
        padding: 32px;
        color: #fff;
        display: flex;
        align-items: center;
        gap: 24px;
        margin-bottom: 28px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 8px 32px rgba(11, 37, 69, .3);
    }
    .profile-header::before {
        content: '';
        position: absolute;
        top: -40%; right: -10%;
        width: 300px; height: 300px;
        background: radial-gradient(circle, rgba(245,166,35,.15) 0%, transparent 70%);
        border-radius: 50%;
    }
    .profile-header::after {
        content: '';
        position: absolute;
        bottom: -50%; left: 20%;
        width: 200px; height: 200px;
        background: radial-gradient(circle, rgba(255,255,255,.06) 0%, transparent 70%);
        border-radius: 50%;
    }

    .profile-avatar-wrapper {
        position: relative;
        z-index: 1;
    }
    .profile-avatar {
        width: 90px; height: 90px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--gold), #e8941a);
        display: flex; align-items: center; justify-content: center;
        font-size: 36px; font-weight: 700; color: #fff;
        font-family: 'Poppins', sans-serif;
        border: 4px solid rgba(255,255,255,.25);
        box-shadow: 0 4px 16px rgba(0,0,0,.2);
        overflow: hidden;
        flex-shrink: 0;
    }
    .profile-avatar img {
        width: 100%; height: 100%;
        object-fit: cover;
    }
    .profile-avatar-badge {
        position: absolute;
        bottom: 2px; right: 2px;
        width: 28px; height: 28px;
        background: var(--emerald);
        border: 3px solid var(--navy-dark);
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
    }
    .profile-avatar-badge svg { width: 12px; height: 12px; color: #fff; }

    .profile-header-info { z-index: 1; }
    .profile-header-info h2 {
        font-family: 'Poppins', sans-serif;
        font-size: 22px;
        font-weight: 700;
        margin-bottom: 4px;
        color: var(--gray-900);
    }
    .profile-header-info .email {
        font-size: 13px;
        color: var(--gray-500);
        margin-bottom: 8px;
    }
    .profile-role-badge {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 4px 14px;
        background: rgba(245,166,35,.2);
        border: 1px solid rgba(245,166,35,.35);
        border-radius: 20px;
        font-size: 11.5px;
        font-weight: 600;
        color: var(--gold);
        text-transform: capitalize;
    }

    /* ── Light Mode Overrides ── */
    body.light-mode .profile-header {
        background: linear-gradient(135deg, #0B2545 0%, #19376D 50%, #1a4a8a 100%);
    }
    body.light-mode .profile-header-info h2 {
        color: #FFFFFF;
    }
    body.light-mode .profile-header-info .email {
        color: rgba(255,255,255,.75);
    }

    /* ── Section Cards ── */
    .profile-section {
        background: var(--surface);
        border-radius: 16px;
        border: 1px solid var(--gray-200);
        margin-bottom: 24px;
        box-shadow: 0 1px 4px rgba(0,0,0,.04);
        overflow: hidden;
    }
    .profile-section-header {
        padding: 20px 24px;
        border-bottom: 1px solid var(--gray-200);
        display: flex; align-items: center; gap: 10px;
    }
    .profile-section-header h3 {
        font-family: 'Poppins', sans-serif;
        font-size: 15px;
        font-weight: 600;
        color: var(--gray-900);
    }
    .profile-section-header .icon {
        width: 36px; height: 36px;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 16px;
        flex-shrink: 0;
    }
    .icon-blue { background: var(--blue-light); }
    .icon-gold { background: var(--gold-light); }

    .profile-section-body {
        padding: 24px;
    }

    /* ── Photo Upload ── */
    .photo-upload-area {
        display: flex; align-items: center; gap: 20px;
        padding: 16px;
        border: 2px dashed var(--gray-300);
        border-radius: 14px;
        transition: all .25s ease;
    }
    .photo-upload-area:hover {
        border-color: var(--navy);
        background: var(--blue-light);
    }
    .photo-upload-preview {
        width: 72px; height: 72px;
        border-radius: 50%;
        background: var(--gray-100);
        display: flex; align-items: center; justify-content: center;
        overflow: hidden;
        flex-shrink: 0;
        border: 2px solid var(--gray-200);
    }
    .photo-upload-preview img {
        width: 100%; height: 100%;
        object-fit: cover;
    }
    .photo-upload-preview .placeholder {
        font-size: 28px; color: var(--gray-300);
    }
    .photo-upload-info h4 {
        font-size: 13.5px; font-weight: 600;
        color: var(--gray-900); margin-bottom: 4px;
    }
    .photo-upload-info p {
        font-size: 12px; color: var(--gray-500);
        margin-bottom: 8px;
    }
    .photo-upload-info input[type="file"] { display: none; }
    .photo-upload-btn {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 6px 14px;
        background: var(--blue-light);
        color: var(--navy);
        border: 1px solid rgba(25,55,109,.15);
        border-radius: 8px;
        font-size: 12px; font-weight: 600;
        cursor: pointer;
        transition: all .2s;
    }
    .photo-upload-btn:hover {
        background: var(--navy);
        color: #fff;
    }

    /* ── Form Grid ── */
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }
    .form-grid .full-width {
        grid-column: 1 / -1;
    }

    /* ── Divider ── */
    .section-divider {
        height: 1px;
        background: var(--gray-200);
        margin: 20px 0;
    }

    /* ── Password Strength Indicator ── */
    .password-strength {
        margin-top: 6px;
        height: 4px;
        border-radius: 4px;
        background: var(--gray-200);
        overflow: hidden;
    }
    .password-strength-bar {
        height: 100%;
        border-radius: 4px;
        transition: width .3s, background .3s;
        width: 0%;
    }
    .strength-weak { width: 33% !important; background: var(--red); }
    .strength-medium { width: 66% !important; background: var(--gold); }
    .strength-strong { width: 100% !important; background: var(--emerald); }

    .password-hint {
        font-size: 11px;
        color: var(--gray-500);
        margin-top: 4px;
    }

    /* ── Submit Actions ── */
    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        padding-top: 8px;
    }

    @media(max-width: 768px) {
        .profile-header { flex-direction: column; text-align: center; }
        .form-grid { grid-template-columns: 1fr; }
        .photo-upload-area { flex-direction: column; text-align: center; }
    }
</style>
@endpush

@section('content')
<div class="profile-container">

    {{-- Profile Header --}}
    <div class="profile-header">
        <div class="profile-avatar-wrapper">
            <div class="profile-avatar">
                @if($hasProfilePhoto)
                    <img src="{{ $profilePhotoUrl }}" alt="{{ $user->name }}">
                @else
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                @endif
            </div>
            <div class="profile-avatar-badge">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
            </div>
        </div>
        <div class="profile-header-info">
            <h2>{{ $user->name }}</h2>
            <div class="email">{{ $user->email }}</div>
            <div class="profile-role-badge">
                ⭐ {{ ucfirst($user->role) }}
            </div>
        </div>
    </div>

    {{-- Profile Information Form --}}
    <div class="profile-section">
        <div class="profile-section-header">
            <div class="icon icon-blue">👤</div>
            <h3>Informasi Profil</h3>
        </div>
        <div class="profile-section-body">
            <form method="POST" action="{{ route('anggota.profile.update') }}" enctype="multipart/form-data" id="profileForm">
                @csrf
                @method('PUT')

                {{-- Photo Upload --}}
                <div class="form-group">
                    <label class="form-label">Foto Profil</label>
                    <div class="photo-upload-area" id="photoDropZone">
                        <div class="photo-upload-preview" id="photoPreview">
                            @if($hasProfilePhoto)
                                <img src="{{ $profilePhotoUrl }}" alt="Foto Profil" id="previewImage">
                            @else
                                <div class="placeholder" id="previewPlaceholder">📷</div>
                                <img src="" alt="Foto Profil" id="previewImage" style="display:none;">
                            @endif
                        </div>
                        <div class="photo-upload-info">
                            <h4>Unggah Foto Profil</h4>
                            <p>Format JPG, JPEG, atau PNG. Maksimal 2 MB.</p>
                            <input type="file" name="profile_photo" id="profilePhotoInput" accept="image/jpeg,image/png,image/jpg">
                            <label for="profilePhotoInput" class="photo-upload-btn">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="14" height="14"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                Pilih Foto
                            </label>
                        </div>
                    </div>
                    @error('profile_photo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="section-divider"></div>

                {{-- Name & Email --}}
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label" for="name">Nama Lengkap <span class="req">*</span></label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="email">Email <span class="req">*</span></label>
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Phone & Address --}}
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label" for="phone">Nomor Telepon</label>
                        <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror"
                               value="{{ old('phone', $user->phone) }}" placeholder="Contoh: 08123456789">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="address">Alamat</label>
                        <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror"
                                  rows="3" placeholder="Masukkan alamat lengkap Anda">{{ old('address', $user->address) }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary" id="btnUpdateProfile">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="16" height="16"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Password Change Form --}}
    <div class="profile-section">
        <div class="profile-section-header">
            <div class="icon icon-gold">🔒</div>
            <h3>Ubah Password</h3>
        </div>
        <div class="profile-section-body">
            <form method="POST" action="{{ route('anggota.profile.password') }}" id="passwordForm">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label class="form-label" for="current_password">Password Saat Ini <span class="req">*</span></label>
                    <input type="password" name="current_password" id="current_password"
                           class="form-control @error('current_password') is-invalid @enderror" required>
                    @error('current_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label" for="password">Password Baru <span class="req">*</span></label>
                        <input type="password" name="password" id="password"
                               class="form-control @error('password') is-invalid @enderror" required>
                        <div class="password-strength">
                            <div class="password-strength-bar" id="passwordStrengthBar"></div>
                        </div>
                        <div class="password-hint" id="passwordHint">Minimal 8 karakter</div>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="password_confirmation">Konfirmasi Password Baru <span class="req">*</span></label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                               class="form-control" required>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-gold" id="btnUpdatePassword">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="16" height="16"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                        Ubah Password
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    // ── Photo preview ──
    const photoInput = document.getElementById('profilePhotoInput');
    const previewImage = document.getElementById('previewImage');
    const previewPlaceholder = document.getElementById('previewPlaceholder');

    if (photoInput) {
        photoInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(ev) {
                    previewImage.src = ev.target.result;
                    previewImage.style.display = 'block';
                    if (previewPlaceholder) previewPlaceholder.style.display = 'none';
                };
                reader.readAsDataURL(file);
            }
        });
    }

    // ── Drag and drop ──
    const dropZone = document.getElementById('photoDropZone');
    if (dropZone) {
        ['dragenter', 'dragover'].forEach(evt => {
            dropZone.addEventListener(evt, e => {
                e.preventDefault();
                dropZone.style.borderColor = 'var(--navy)';
                dropZone.style.background = 'var(--blue-light)';
            });
        });
        ['dragleave', 'drop'].forEach(evt => {
            dropZone.addEventListener(evt, e => {
                e.preventDefault();
                dropZone.style.borderColor = '';
                dropZone.style.background = '';
            });
        });
        dropZone.addEventListener('drop', e => {
            const files = e.dataTransfer.files;
            if (files.length) {
                photoInput.files = files;
                photoInput.dispatchEvent(new Event('change'));
            }
        });
    }

    // ── Password strength indicator ──
    const passwordInput = document.getElementById('password');
    const strengthBar = document.getElementById('passwordStrengthBar');
    const passwordHint = document.getElementById('passwordHint');

    if (passwordInput) {
        passwordInput.addEventListener('input', function() {
            const val = this.value;
            strengthBar.className = 'password-strength-bar';

            if (val.length === 0) {
                passwordHint.textContent = 'Minimal 8 karakter';
                return;
            }

            let score = 0;
            if (val.length >= 8) score++;
            if (/[A-Z]/.test(val) && /[a-z]/.test(val)) score++;
            if (/[0-9]/.test(val)) score++;
            if (/[^A-Za-z0-9]/.test(val)) score++;

            if (score <= 1) {
                strengthBar.classList.add('strength-weak');
                passwordHint.textContent = 'Lemah — tambahkan huruf besar, angka & simbol';
            } else if (score <= 2) {
                strengthBar.classList.add('strength-medium');
                passwordHint.textContent = 'Sedang — tambahkan variasi karakter';
            } else {
                strengthBar.classList.add('strength-strong');
                passwordHint.textContent = 'Kuat ✓';
            }
        });
    }
</script>
@endpush
