@extends('layouts.app')
@section('title', 'Manajemen Data Alat')
@section('page-title', 'Manajemen Data Alat')

@section('content')
<div class="page-header" style="display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:12px;">
    <div>
        <h2>Daftar Inventaris Alat</h2>
        <p>Kelola data dan status alat-alat yang disewakan</p>
    </div>
    <a href="{{ route('admin.inventaris-alat.create') }}" class="btn btn-primary">
        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
        Tambah Alat Baru
    </a>
</div>

{{-- Table --}}
<div class="card" style="padding:0;">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Gambar</th>
                    <th>Nama &amp; Jenis</th>
                    <th>Harga Sewa / Hari</th>
                    <th>Stok</th>
                    <th>Status Alat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($alats as $i => $alat)
                    <tr>
                        <td style="color:var(--gray-500);">{{ $alats->firstItem() + $i }}</td>
                        <td>
                            @if($alat->gambar)
                                <img src="{{ asset($alat->gambar) }}" alt="{{ $alat->nama_alat }}"
                                     style="width:48px;height:48px;object-fit:cover;border-radius:8px;">
                            @else
                                <div style="width:48px;height:48px;background:var(--gray-100);border-radius:8px;display:flex;align-items:center;justify-content:center;border:1px solid var(--gray-200);">
                                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" style="color:var(--gray-400);"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                            @endif
                        </td>
                        <td>
                            <div style="font-weight:600;color:var(--gray-900);">{{ $alat->nama_alat }}</div>
                            <div style="font-size:12px;color:var(--gray-500);">Jenis: {{ $alat->jenis }}</div>
                        </td>
                        <td style="font-weight:700;color:var(--navy-light);font-family:'JetBrains Mono',monospace;">
                            Rp {{ number_format($alat->harga_sewa,0,',','.') }}
                        </td>
                        <td style="font-weight:600;color:var(--gray-800);">{{ $alat->stok }}</td>
                        <td>
                            @php
                                $statusBadge = [
                                    'tersedia'    => 'badge-success',
                                    'dipinjam'    => 'badge-pending',
                                    'maintenance' => 'badge-rejected',
                                ][$alat->status] ?? 'badge-pending';
                            @endphp
                            <span class="badge {{ $statusBadge }}" style="text-transform:capitalize;">{{ $alat->status }}</span>
                        </td>
                        <td>
                            <div style="display:flex;gap:6px;flex-wrap:wrap;">
                                <a href="{{ route('admin.inventaris-alat.edit',$alat->id) }}" class="btn btn-sm btn-outline">
                                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                    Edit
                                </a>
                                <form action="{{ route('admin.inventaris-alat.destroy',$alat->id) }}" method="POST"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus alat ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align:center;padding:48px;color:var(--gray-500);">
                            <svg style="margin:0 auto 12px;color:var(--gray-400);" width="40" height="40" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                            <div style="font-size:14px;font-weight:600;color:var(--gray-700);">Tidak ada data alat tersedia.</div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if($alats->hasPages())
    <div class="pagination-wrap">{{ $alats->links() }}</div>
@endif
@endsection
