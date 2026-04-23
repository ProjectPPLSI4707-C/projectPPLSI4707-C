@extends('layouts.app')

@section('title', 'Detail Anggota — ' . $anggota->nama_lengkap)
@section('page-title', 'Detail Anggota')
@section('page-subtitle', $anggota->nomor_id_anggota)

@section('content')
    {{-- Back Button --}}
    <div class="mb-6">
        <a href="{{ route('admin.anggota') }}" class="inline-flex items-center gap-2 text-sm text-slate-600 hover:text-navy-800 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Daftar Anggota
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Profile Card — Fitur: Detail Data Anggota --}}
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden animate-fade-in">
                <div class="bg-gradient-to-br from-navy-800 to-navy-900 px-6 py-8 text-center">
                    <div class="w-20 h-20 bg-gradient-to-br from-accent-400 to-accent-600 rounded-full flex items-center justify-center text-white font-bold text-2xl mx-auto shadow-lg shadow-accent-500/30">
                        {{ strtoupper(substr($anggota->nama_lengkap, 0, 2)) }}
                    </div>
                    <h3 class="text-white font-bold text-lg mt-4">{{ $anggota->nama_lengkap }}</h3>
                    <p class="text-navy-300 text-sm mt-1">{{ $anggota->nomor_id_anggota }}</p>
                    <div class="mt-4">
                        @if($anggota->status_keanggotaan === 'aktif')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-accent-500/20 text-accent-300 text-xs font-semibold rounded-full">
                                <span class="w-2 h-2 bg-accent-400 rounded-full"></span>Aktif</span>
                        @elseif($anggota->status_keanggotaan === 'menunggu')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-amber-500/20 text-amber-300 text-xs font-semibold rounded-full badge-pulse">
                                <span class="w-2 h-2 bg-amber-400 rounded-full"></span>Menunggu Verifikasi</span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-red-500/20 text-red-300 text-xs font-semibold rounded-full">
                                <span class="w-2 h-2 bg-red-400 rounded-full"></span>Ditangguhkan</span>
                        @endif
                    </div>
                </div>

                {{-- Fitur: Hapus Data Anggota --}}
                <div class="p-6">
                    <form method="POST" action="{{ route('admin.anggota.delete', $anggota->id) }}"
                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus anggota ini? Tindakan ini tidak dapat dibatalkan.')"
                          class="pt-3 border-t border-slate-100">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full py-2.5 bg-red-50 hover:bg-red-100 text-red-600 text-sm font-medium rounded-xl transition-colors">
                            🗑️ Hapus Anggota
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Detail Information — Fitur: Detail Data Anggota --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Personal Information --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 animate-fade-in">
                <div class="px-6 py-4 border-b border-slate-100">
                    <h3 class="text-base font-bold text-navy-900">Informasi Pribadi</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Nama Lengkap</p>
                            <p class="text-sm font-semibold text-navy-900">{{ $anggota->nama_lengkap }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Email</p>
                            <p class="text-sm font-semibold text-navy-900">{{ $anggota->email }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">No. KTP</p>
                            <p class="text-sm font-semibold text-navy-900">{{ $anggota->no_ktp ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">No. Telepon</p>
                            <p class="text-sm font-semibold text-navy-900">{{ $anggota->no_telepon ?? '-' }}</p>
                        </div>
                        <div class="sm:col-span-2">
                            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Alamat</p>
                            <p class="text-sm font-semibold text-navy-900">{{ $anggota->alamat ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Membership Information --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 animate-fade-in">
                <div class="px-6 py-4 border-b border-slate-100">
                    <h3 class="text-base font-bold text-navy-900">Informasi Keanggotaan</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Nomor ID Anggota</p>
                            <p class="text-sm font-mono font-semibold text-navy-900 bg-navy-50 inline-block px-2 py-1 rounded-md">{{ $anggota->nomor_id_anggota }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Role</p>
                            <p class="text-sm font-semibold text-navy-900 capitalize">{{ $anggota->role }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Tanggal Bergabung</p>
                            <p class="text-sm font-semibold text-navy-900">{{ $anggota->tanggal_bergabung ? $anggota->tanggal_bergabung->format('d F Y') : '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Terakhir Diperbarui</p>
                            <p class="text-sm font-semibold text-navy-900">{{ $anggota->updated_at->format('d F Y, H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
