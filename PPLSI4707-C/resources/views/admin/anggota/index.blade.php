@extends('layouts.app')

@section('title', 'Manajemen Anggota')
@section('page-title', 'Manajemen Anggota')
@section('page-subtitle', 'Kelola data seluruh anggota koperasi')

@section('content')
    {{-- Members Table --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden animate-fade-in">
        <div class="px-6 py-4 border-b border-slate-100">
            <h3 class="text-base font-bold text-navy-900">Daftar Anggota</h3>
            <p class="text-sm text-slate-500">Total {{ $anggotaList->total() }} anggota ditemukan</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-slate-50/80">
                        <th class="text-left text-xs font-semibold text-slate-500 uppercase tracking-wider px-6 py-3">Anggota</th>
                        <th class="text-left text-xs font-semibold text-slate-500 uppercase tracking-wider px-6 py-3 hidden md:table-cell">ID Anggota</th>
                        <th class="text-left text-xs font-semibold text-slate-500 uppercase tracking-wider px-6 py-3">Status</th>
                        <th class="text-center text-xs font-semibold text-slate-500 uppercase tracking-wider px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($anggotaList as $anggota)
                        <tr class="table-row-hover">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-gradient-to-br from-navy-600 to-navy-800 rounded-full flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                                        {{ strtoupper(substr($anggota->nama_lengkap, 0, 1)) }}
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-sm font-medium text-navy-900 truncate">{{ $anggota->nama_lengkap }}</p>
                                        <p class="text-xs text-slate-500 truncate">{{ $anggota->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 hidden md:table-cell">
                                <span class="text-sm font-mono text-navy-700 bg-navy-50 px-2 py-1 rounded-md">{{ $anggota->nomor_id_anggota }}</span>
                            </td>
                            <td class="px-6 py-4">
                                @if($anggota->status_keanggotaan === 'aktif')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-accent-50 text-accent-700 text-xs font-semibold rounded-full">
                                        <span class="w-1.5 h-1.5 bg-accent-500 rounded-full"></span>Aktif</span>
                                @elseif($anggota->status_keanggotaan === 'menunggu')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-amber-50 text-amber-700 text-xs font-semibold rounded-full badge-pulse">
                                        <span class="w-1.5 h-1.5 bg-amber-500 rounded-full"></span>Menunggu</span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-red-50 text-red-700 text-xs font-semibold rounded-full">
                                        <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span>Ditangguhkan</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-1">
                                    {{-- Fitur: Detail Data Anggota --}}
                                    <a href="{{ route('admin.anggota.show', $anggota->id) }}" title="Lihat Detail"
                                       class="p-2 text-slate-400 hover:text-navy-600 hover:bg-navy-50 rounded-lg transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>

                                    {{-- Fitur: Hapus Data Anggota --}}
                                    <form method="POST" action="{{ route('admin.anggota.delete', $anggota->id) }}" class="inline"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus anggota {{ $anggota->nama_lengkap }}? Tindakan ini tidak dapat dibatalkan.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Hapus"
                                                class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center">
                                <p class="text-sm text-slate-500">Tidak ada data anggota ditemukan</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($anggotaList->hasPages())
            <div class="px-6 py-4 border-t border-slate-100">
                {{ $anggotaList->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
@endsection
