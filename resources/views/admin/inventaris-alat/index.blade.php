@extends('layouts.app')
@section('title', 'Manajemen Data Alat')
@section('page-title', 'Manajemen Data Alat')

@section('content')
<div class="page-header flex items-center justify-between">
    <div>
        <h2>Daftar Inventaris Alat</h2>
        <p>Kelola data dan status alat-alat yang disewakan</p>
    </div>
    <a href="{{ route('admin.inventaris-alat.create') }}" class="btn btn-primary">➕ Tambah Alat Baru</a>
</div>

{{-- Table --}}
<div class="card" style="padding:0;">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Gambar</th>
                    <th>Nama & Jenis</th>
                    <th>Harga Sewa / Hari</th>
                    <th>Stok</th>
                    <th>Status Alat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($alats as $i => $alat)
                    <tr>
                        <td style="color:#9CA3AF;">{{ $alats->firstItem() + $i }}</td>
                        <td>
                            @if($alat->gambar)
                                <img src="{{ asset('storage/' . $alat->gambar) }}" alt="{{ $alat->nama_alat }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;">
                            @else
                                <div style="width: 50px; height: 50px; background: #e5e7eb; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px;">📷</div>
                            @endif
                        </td>
                        <td>
                            <div style="font-weight:600;color:#111827;">{{ $alat->nama_alat }}</div>
                            <div style="font-size:12px;color:#6B7280;">Jenis: {{ $alat->jenis }}</div>
                        </td>
                        <td style="font-weight:700;color:#19376D;font-family:'Poppins',sans-serif;">
                            Rp {{ number_format($alat->harga_sewa, 0, ',', '.') }}
                        </td>
                        <td style="font-weight:600;">{{ $alat->stok }}</td>
                        <td>
                            @php
                                $statusBadge = [
                                    'tersedia' => 'badge-success',
                                    'dipinjam' => 'badge-pending',
                                    'maintenance' => 'badge-danger'
                                ][$alat->status] ?? 'badge-pending';
                            @endphp
                            <span class="badge {{ $statusBadge }}" style="text-transform: capitalize;">
                                {{ $alat->status }}
                            </span>
                        </td>
                        <td>
                            <div style="display:flex; gap: 8px;">
                                <a href="{{ route('admin.inventaris-alat.edit', $alat->id) }}" class="btn btn-sm btn-outline">✏️ Edit</a>
                                <form action="{{ route('admin.inventaris-alat.destroy', $alat->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus alat ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm" style="background: #fee2e2; color: #dc2626; border: none; padding: 6px 12px; border-radius: 6px; cursor: pointer;">🗑️ Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align:center;padding:48px;color:#9CA3AF;">
                            <div style="font-size:36px;margin-bottom:8px;">📦</div>
                            Tidak ada data alat tersedia.
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
