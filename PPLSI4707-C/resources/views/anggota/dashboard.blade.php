@extends('layouts.app')

@section('title', 'Dashboard Anggota')
@section('page-title', 'Dashboard Saya')
@section('page-subtitle', 'Selamat datang, ' . auth()->user()->nama_lengkap)

@section('content')
    {{-- Welcome Banner --}}
    <div class="bg-gradient-to-r from-navy-800 via-navy-900 to-navy-950 rounded-2xl p-6 lg:p-8 mb-8 text-white relative overflow-hidden animate-fade-in">
        <div class="absolute top-0 right-0 w-64 h-64 bg-accent-500/10 rounded-full blur-3xl -mr-20 -mt-20"></div>
        <div class="relative z-10">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-16 h-16 bg-gradient-to-br from-accent-400 to-accent-600 rounded-2xl flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-accent-500/30">
                    {{ strtoupper(substr($user->nama_lengkap, 0, 2)) }}
                </div>
                <div>
                    <h2 class="text-xl lg:text-2xl font-bold">Halo, {{ explode(' ', $user->nama_lengkap)[0] }}! 👋</h2>
                    <p class="text-navy-300 text-sm">Selamat datang di Koperasi Simpan Pinjam</p>
                </div>
            </div>

            {{-- Status Info --}}
            <div class="flex items-center gap-2 mt-4">
                @if($user->status_keanggotaan === 'aktif')
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-accent-500/20 text-accent-300 text-xs font-semibold rounded-full">
                        <span class="w-2 h-2 bg-accent-400 rounded-full animate-pulse"></span>
                        Status: Aktif
                    </span>
                @elseif($user->status_keanggotaan === 'menunggu')
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-amber-500/20 text-amber-300 text-xs font-semibold rounded-full badge-pulse">
                        <span class="w-2 h-2 bg-amber-400 rounded-full"></span>
                        Status: Menunggu Verifikasi
                    </span>
                @else
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-red-500/20 text-red-300 text-xs font-semibold rounded-full">
                        <span class="w-2 h-2 bg-red-400 rounded-full"></span>
                        Status: Ditangguhkan
                    </span>
                @endif
                <span class="text-navy-400 text-xs">•</span>
                <span class="text-navy-400 text-xs">{{ $user->nomor_id_anggota }}</span>
            </div>
        </div>
    </div>

    {{-- Pending Verification Notice --}}
    @if($user->status_keanggotaan === 'menunggu')
        <div class="bg-amber-50 border-2 border-amber-200 rounded-2xl p-6 mb-8 animate-fade-in">
            <div class="flex items-start gap-3">
                <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-amber-900">Akun Menunggu Verifikasi</h4>
                    <p class="text-sm text-amber-700 mt-1">Akun Anda sedang dalam proses verifikasi oleh Admin. Setelah disetujui, Anda akan memiliki akses penuh ke layanan koperasi.</p>
                </div>
            </div>
        </div>
    @endif

    {{-- Profile Information --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Personal Info Card --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 animate-fade-in delay-100">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h3 class="text-base font-bold text-navy-900">Informasi Pribadi</h3>
                    <p class="text-sm text-slate-500">Data diri Anda</p>
                </div>
                <div class="w-10 h-10 bg-navy-50 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-navy-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex justify-between items-center py-2 border-b border-slate-50">
                    <span class="text-sm text-slate-500">Nama Lengkap</span>
                    <span class="text-sm font-semibold text-navy-900">{{ $user->nama_lengkap }}</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-slate-50">
                    <span class="text-sm text-slate-500">Email</span>
                    <span class="text-sm font-semibold text-navy-900">{{ $user->email }}</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-slate-50">
                    <span class="text-sm text-slate-500">No. KTP</span>
                    <span class="text-sm font-semibold text-navy-900">{{ $user->no_ktp ?? '-' }}</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-slate-50">
                    <span class="text-sm text-slate-500">No. Telepon</span>
                    <span class="text-sm font-semibold text-navy-900">{{ $user->no_telepon ?? '-' }}</span>
                </div>
                <div class="flex justify-between items-start py-2">
                    <span class="text-sm text-slate-500">Alamat</span>
                    <span class="text-sm font-semibold text-navy-900 text-right max-w-[60%]">{{ $user->alamat ?? '-' }}</span>
                </div>
            </div>
        </div>

        {{-- Membership Info Card --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 animate-fade-in delay-200">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h3 class="text-base font-bold text-navy-900">Keanggotaan</h3>
                    <p class="text-sm text-slate-500">Informasi keanggotaan Anda</p>
                </div>
                <div class="w-10 h-10 bg-accent-50 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-accent-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                    </svg>
                </div>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex justify-between items-center py-2 border-b border-slate-50">
                    <span class="text-sm text-slate-500">No. ID Anggota</span>
                    <span class="text-sm font-mono font-semibold text-navy-900 bg-navy-50 px-2 py-0.5 rounded-md">{{ $user->nomor_id_anggota }}</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-slate-50">
                    <span class="text-sm text-slate-500">Status</span>
                    @if($user->status_keanggotaan === 'aktif')
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-accent-50 text-accent-700 text-xs font-semibold rounded-full">
                            <span class="w-1.5 h-1.5 bg-accent-500 rounded-full"></span>
                            Aktif
                        </span>
                    @elseif($user->status_keanggotaan === 'menunggu')
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-amber-50 text-amber-700 text-xs font-semibold rounded-full">
                            <span class="w-1.5 h-1.5 bg-amber-500 rounded-full"></span>
                            Menunggu Verifikasi
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-red-50 text-red-700 text-xs font-semibold rounded-full">
                            <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span>
                            Ditangguhkan
                        </span>
                    @endif
                </div>
                <div class="flex justify-between items-center py-2 border-b border-slate-50">
                    <span class="text-sm text-slate-500">Tanggal Bergabung</span>
                    <span class="text-sm font-semibold text-navy-900">{{ $user->tanggal_bergabung ? $user->tanggal_bergabung->format('d F Y') : '-' }}</span>
                </div>
                <div class="flex justify-between items-center py-2">
                    <span class="text-sm text-slate-500">Role</span>
                    <span class="text-sm font-semibold text-navy-900 capitalize">{{ $user->role }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Info Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-6">
        <div class="card-hover bg-white rounded-2xl p-6 shadow-sm border border-slate-100 animate-fade-in delay-300">
            <div class="w-12 h-12 bg-navy-50 rounded-xl flex items-center justify-center mb-4">
                <svg class="w-6 h-6 text-navy-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h4 class="text-sm font-bold text-navy-900">Simpanan</h4>
            <p class="text-xs text-slate-500 mt-1">Fitur simpanan akan tersedia di Sprint 2</p>
        </div>

        <div class="card-hover bg-white rounded-2xl p-6 shadow-sm border border-slate-100 animate-fade-in delay-300">
            <div class="w-12 h-12 bg-accent-50 rounded-xl flex items-center justify-center mb-4">
                <svg class="w-6 h-6 text-accent-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
            <h4 class="text-sm font-bold text-navy-900">Pinjaman</h4>
            <p class="text-xs text-slate-500 mt-1">Fitur pinjaman akan tersedia di Sprint 2</p>
        </div>

        <div class="card-hover bg-white rounded-2xl p-6 shadow-sm border border-slate-100 animate-fade-in delay-400">
            <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center mb-4">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <h4 class="text-sm font-bold text-navy-900">Laporan</h4>
            <p class="text-xs text-slate-500 mt-1">Fitur laporan akan tersedia di Sprint 2</p>
        </div>
    </div>
@endsection
