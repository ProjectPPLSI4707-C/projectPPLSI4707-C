@extends('layouts.app')
@use('Illuminate\Support\Facades\Storage')
@section('title', 'Lihat Profil')
@section('page-title', 'Detail Profil')

@php
    $storedInPublicUploads = filled($user->profile_photo) && str_starts_with($user->profile_photo, 'uploads/');
    $hasProfilePhoto = $storedInPublicUploads
        ? file_exists(public_path($user->profile_photo))
        : (filled($user->profile_photo) && Storage::disk('public')->exists($user->profile_photo));
    $profilePhotoUrl = $hasProfilePhoto
        ? ($storedInPublicUploads
            ? asset($user->profile_photo) . '?v=' . md5($user->profile_photo)
            : \Illuminate\Support\Facades\Storage::disk('public')->url($user->profile_photo) . '?v=' . md5($user->profile_photo))
        : null;
@endphp

@push('styles')
<style>
    .profile-container { max-width: 800px; }
    .profile-header {
        background: linear-gradient(135deg, var(--navy-dark) 0%, var(--navy) 50%, var(--navy-mid) 100%);
        border-radius: 20px; padding: 32px; color: #fff; display: flex; align-items: center; gap: 24px;
        margin-bottom: 28px; position: relative; overflow: hidden; box-shadow: 0 8px 32px rgba(11, 37, 69, .3);
    }
    .profile-header::before {
        content: ''; position: absolute; top: -40%; right: -10%; width: 300px; height: 300px;
        background: radial-gradient(circle, rgba(245,166,35,.15) 0%, transparent 70%); border-radius: 50%;
    }
    .profile-header::after {
        content: ''; position: absolute; bottom: -50%; left: 20%; width: 200px; height: 200px;
        background: radial-gradient(circle, rgba(255,255,255,.06) 0%, transparent 70%); border-radius: 50%;
    }
    .profile-avatar-wrapper { position: relative; z-index: 1; }
    .profile-avatar {
        width: 90px; height: 90px; border-radius: 50%; background: linear-gradient(135deg, var(--gold), #e8941a);
        display: flex; align-items: center; justify-content: center; font-size: 36px; font-weight: 700; color: #fff;
        border: 4px solid rgba(255,255,255,.25); box-shadow: 0 4px 16px rgba(0,0,0,.2); overflow: hidden; flex-shrink: 0;
    }
    .profile-avatar img { width: 100%; height: 100%; object-fit: cover; }
    .profile-avatar-badge {
        position: absolute; bottom: 2px; right: 2px; width: 28px; height: 28px; background: var(--emerald);
        border: 3px solid var(--navy-dark); border-radius: 50%; display: flex; align-items: center; justify-content: center;
    }
    .profile-avatar-badge svg { width: 12px; height: 12px; color: #fff; }
    .profile-header-info { z-index: 1; }
    .profile-header-info h2 { font-size: 22px; font-weight: 700; margin-bottom: 4px; color: var(--gray-900); }
    .profile-header-info .email { font-size: 13px; color: var(--gray-500); margin-bottom: 8px; }
    .profile-role-badge {
        display: inline-flex; align-items: center; gap: 5px; padding: 4px 14px; background: rgba(245,166,35,.2);
        border: 1px solid rgba(245,166,35,.35); border-radius: 20px; font-size: 11.5px; font-weight: 600; color: var(--gold); text-transform: capitalize;
    }
    body.light-mode .profile-header { background: linear-gradient(135deg, #0B2545 0%, #19376D 50%, #1a4a8a 100%); }
    body.light-mode .profile-header-info h2 { color: #FFFFFF; }
    body.light-mode .profile-header-info .email { color: rgba(255,255,255,.75); }
    .profile-section {
        background: var(--surface); border-radius: 16px; border: 1px solid var(--gray-200); margin-bottom: 24px;
        box-shadow: 0 1px 4px rgba(0,0,0,.04); overflow: hidden;
    }
    .profile-section-header { padding: 20px 24px; border-bottom: 1px solid var(--gray-200); display: flex; align-items: center; gap: 10px; }
    .profile-section-header h3 { font-size: 15px; font-weight: 600; color: var(--gray-900); }
    .profile-section-header .icon {
        width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 16px; flex-shrink: 0;
    }
    .icon-blue { background: var(--blue-light); }
    .profile-section-body { padding: 24px; }
    .data-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
    .data-item { margin-bottom: 18px; }
    .data-item .label { display: block; font-size: 12px; font-weight: 600; color: var(--gray-500); margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.5px; }
    .data-item .value { font-size: 15px; font-weight: 500; color: var(--gray-900); }
    .data-grid .full-width { grid-column: 1 / -1; }
    @media (max-width: 640px) {
        .data-grid { grid-template-columns: 1fr; }
        .profile-header { flex-direction: column; text-align: center; }
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
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            </div>
        </div>
        <div class="profile-header-info">
            <h2>{{ $user->name }}</h2>
            <div class="email">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="14" height="14" style="display:inline; margin-right:4px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                {{ $user->email }}
            </div>
            <div class="profile-role-badge">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="14" height="14"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                {{ ucfirst($user->role) }}
            </div>
        </div>
    </div>

    {{-- Profile Information Detail --}}
    <div class="profile-section">
        <div class="profile-section-header">
            <div class="icon icon-blue">👤</div>
            <h3>Informasi Pribadi</h3>
        </div>
        <div class="profile-section-body">
            <div class="data-grid">
                <div class="data-item full-width">
                    <span class="label">Nama Lengkap</span>
                    <span class="value">{{ $user->name }}</span>
                </div>
                <div class="data-item">
                    <span class="label">Alamat Email</span>
                    <span class="value">{{ $user->email }}</span>
                </div>
                <div class="data-item">
                    <span class="label">Nomor Telepon</span>
                    <span class="value">{{ $user->phone ?: '-' }}</span>
                </div>
                <div class="data-item full-width">
                    <span class="label">Alamat</span>
                    <span class="value">{{ $user->address ?: '-' }}</span>
                </div>
            </div>
            <div style="margin-top: 24px;">
                <a href="{{ route('anggota.profile.edit') }}" class="btn btn-outline">Edit Profil</a>
            </div>
        </div>
    </div>

</div>
@endsection
