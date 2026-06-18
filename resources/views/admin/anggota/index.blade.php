@extends('layouts.app')
@section('title', 'Manajemen Anggota')
@section('page-title', 'Manajemen Anggota')

@section('content')
<div class="page-header flex items-center justify-between">
    <div>
        <h2>Manajemen Anggota</h2>
        <p>Kelola data anggota koperasi</p>
    </div>
</div>

{{-- Search --}}
<div class="card" style="margin-bottom:16px;padding:14px 18px;">
    <form method="GET" action="{{ route('admin.anggota.index') }}" style="display:flex;gap:10px;align-items:center;flex-wrap:wrap;">
        <div style="flex:1;min-width:200px;">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama, email, telepon, atau alamat..." class="form-control" style="padding:9px 14px;font-size:13.5px;">
        </div>
        <button type="submit" class="btn btn-primary btn-sm" style="gap:5px;">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="14" height="14"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            Cari
        </button>
        @if(request('q'))
            <a href="{{ route('admin.anggota.index') }}" class="btn btn-outline btn-sm">Reset</a>
        @endif
    </form>
</div>

{{-- Table --}}
<div class="card" style="padding:0;">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Alamat</th>
                    <th>Terdaftar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($anggota as $i => $a)
                    <tr>
                        <td style="color:var(--gray-500);">{{ $anggota->firstItem() + $i }}</td>
                        <td>
                            <div style="font-weight:600;color:var(--gray-900);">{{ $a->name }}</div>
                        </td>
                        <td style="color:var(--gray-600);font-size:13px;">{{ $a->email }}</td>
                        <td style="color:var(--gray-600);font-size:13px;">{{ $a->phone ?? '—' }}</td>
                        <td style="color:var(--gray-600);font-size:13px;max-width:180px;">{{ $a->address ?? '—' }}</td>
                        <td style="color:var(--gray-500);font-size:13px;white-space:nowrap;">{{ $a->created_at->format('d M Y') }}</td>
                        <td>
                            <div style="display:flex;gap:6px;align-items:center;">
                                <a href="{{ route('admin.anggota.edit', $a) }}" class="btn btn-sm btn-primary" style="gap:4px;">
                                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="12" height="12"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('admin.anggota.destroy', $a) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus anggota {{ addslashes($a->name) }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" style="gap:4px;">
                                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="12" height="12"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align:center;padding:48px;color:var(--gray-500);">
                            <svg style="margin:0 auto 12px;color:var(--gray-400);" width="40" height="40" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <div style="font-size:14px;font-weight:600;color:var(--gray-700);">
                                @if(request('q'))
                                    Tidak ada anggota yang cocok dengan pencarian "{{ request('q') }}".
                                @else
                                    Belum ada anggota terdaftar.
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if($anggota->hasPages())
    <div class="pagination-wrap">{{ $anggota->appends(request()->query())->links() }}</div>
@endif
@endsection
