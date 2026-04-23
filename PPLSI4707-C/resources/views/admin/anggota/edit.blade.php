@extends('layouts.app')

@section('title', 'Edit Anggota — ' . $anggota->nama_lengkap)
@section('page-title', 'Edit Data Anggota')
@section('page-subtitle', $anggota->nomor_id_anggota)

@section('content')
    {{-- Back Button --}}
    <div class="mb-6">
        <a href="{{ route('admin.anggota.show', $anggota->id) }}" class="inline-flex items-center gap-2 text-sm text-slate-600 hover:text-navy-800 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Detail Anggota
        </a>
    </div>

    <div class="max-w-2xl">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 animate-fade-in">
            <div class="px-6 py-4 border-b border-slate-100">
                <h3 class="text-base font-bold text-navy-900">Edit Informasi Anggota</h3>
                <p class="text-sm text-slate-500">Perbarui data anggota di bawah ini</p>
            </div>

            <form method="POST" action="{{ route('admin.anggota.update', $anggota->id) }}" class="p-6 space-y-5">
                @csrf
                @method('PUT')

                {{-- Nama Lengkap --}}
                <div>
                    <label for="nama_lengkap" class="block text-sm font-medium text-navy-800 mb-1.5">Nama Lengkap</label>
                    <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', $anggota->nama_lengkap) }}" required
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-navy-900 placeholder-slate-400 focus:outline-none focus:border-accent-500 focus:ring-1 focus:ring-accent-500 transition-all">
                    @error('nama_lengkap')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-navy-800 mb-1.5">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $anggota->email) }}" required
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-navy-900 placeholder-slate-400 focus:outline-none focus:border-accent-500 focus:ring-1 focus:ring-accent-500 transition-all">
                    @error('email')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- No. KTP --}}
                <div>
                    <label for="no_ktp" class="block text-sm font-medium text-navy-800 mb-1.5">No. KTP</label>
                    <input type="text" id="no_ktp" name="no_ktp" value="{{ old('no_ktp', $anggota->no_ktp) }}" required
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-navy-900 placeholder-slate-400 focus:outline-none focus:border-accent-500 focus:ring-1 focus:ring-accent-500 transition-all">
                    @error('no_ktp')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- No. Telepon --}}
                <div>
                    <label for="no_telepon" class="block text-sm font-medium text-navy-800 mb-1.5">No. Telepon</label>
                    <input type="text" id="no_telepon" name="no_telepon" value="{{ old('no_telepon', $anggota->no_telepon) }}" required
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-navy-900 placeholder-slate-400 focus:outline-none focus:border-accent-500 focus:ring-1 focus:ring-accent-500 transition-all">
                    @error('no_telepon')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Alamat --}}
                <div>
                    <label for="alamat" class="block text-sm font-medium text-navy-800 mb-1.5">Alamat</label>
                    <textarea id="alamat" name="alamat" rows="3" required
                              class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-navy-900 placeholder-slate-400 focus:outline-none focus:border-accent-500 focus:ring-1 focus:ring-accent-500 transition-all resize-none">{{ old('alamat', $anggota->alamat) }}</textarea>
                    @error('alamat')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Status Keanggotaan --}}
                <div>
                    <label for="status_keanggotaan" class="block text-sm font-medium text-navy-800 mb-1.5">Status Keanggotaan</label>
                    <select id="status_keanggotaan" name="status_keanggotaan" required
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-navy-900 focus:outline-none focus:border-accent-500 focus:ring-1 focus:ring-accent-500 transition-all">
                        <option value="aktif" {{ old('status_keanggotaan', $anggota->status_keanggotaan) === 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="menunggu" {{ old('status_keanggotaan', $anggota->status_keanggotaan) === 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="ditangguhkan" {{ old('status_keanggotaan', $anggota->status_keanggotaan) === 'ditangguhkan' ? 'selected' : '' }}>Ditangguhkan</option>
                    </select>
                    @error('status_keanggotaan')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Buttons --}}
                <div class="flex items-center gap-3 pt-4 border-t border-slate-100">
                    <button type="submit" class="btn-shine px-6 py-2.5 bg-gradient-to-r from-accent-600 to-accent-700 hover:from-accent-500 hover:to-accent-600 text-white text-sm font-semibold rounded-xl shadow-lg shadow-accent-600/30 transition-all duration-300">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.anggota.show', $anggota->id) }}" class="px-6 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-medium rounded-xl transition-colors">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
