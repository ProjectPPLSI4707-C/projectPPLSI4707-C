@extends('layouts.app')

@section('title', 'Katalog Alat')
@section('page-title', 'Katalog Alat')

@section('content')
<div class="page-header flex items-center justify-between">
    <div>
        <h2>Katalog Alat Pertanian</h2>
        <p>Cari dan sewa alat yang Anda butuhkan untuk keperluan pertanian.</p>
    </div>
    
    <form action="{{ route('anggota.alat.index') }}" method="GET" class="flex gap-3">
        <input type="text" name="search" class="form-control" placeholder="Cari alat..." value="{{ request('search') }}" style="width: 250px;">
        <button type="submit" class="btn btn-primary">Cari</button>
    </form>
</div>

@if($alats->count() > 0)
<div class="grid-3 mt-6">
    @foreach($alats as $alat)
    <div class="card" style="display: flex; flex-direction: column;">
        <div style="height: 180px; background: var(--gray-100); border-radius: 12px; margin-bottom: 16px; overflow: hidden; display: flex; align-items: center; justify-content: center;">
            @if($alat->gambar)
                <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($alat->gambar) }}" alt="{{ $alat->nama_alat }}" style="width: 100%; height: 100%; object-fit: cover;">
            @else
                <svg style="color: var(--gray-400); width: 48px; height: 48px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            @endif
        </div>
        <h3 style="font-size: 15px; font-weight: 600; color: var(--gray-900); margin-bottom: 6px;">{{ $alat->nama_alat }}</h3>
        @php $alatStatus = $alat->status ?? 'tersedia'; @endphp
        @if($alatStatus === 'tersedia')
            <span class="badge badge-success" style="margin-bottom:8px;">Tersedia</span>
        @elseif($alatStatus === 'dipinjam')
            <span class="badge badge-pending" style="margin-bottom:8px;">Dipinjam</span>
        @else
            <span class="badge" style="background:var(--gray-100);color:var(--gray-600);border:1px solid var(--gray-200);margin-bottom:8px;">Maintenance</span>
        @endif
        <p style="font-size: 13px; color: var(--gray-500); line-height: 1.5; margin-bottom: 16px; flex: 1;">
            {{ Str::limit($alat->deskripsi, 80) }}
        </p>
        <div class="flex items-center justify-between mt-auto pt-4" style="border-top: 1px solid var(--gray-100);">
            <div>
                <div style="font-size: 11px; color: var(--gray-500); font-weight: 600; text-transform: uppercase;">Harga Sewa</div>
                <div style="font-size: 15px; font-weight: 700; color: var(--gold);">Rp {{ number_format($alat->harga_sewa, 0, ',', '.') }} <span style="font-size: 11px; font-weight: 500; color: var(--gray-500);">/hari</span></div>
            </div>
            <a href="{{ route('anggota.alat.show', $alat->id) }}" class="btn btn-outline btn-sm">Lihat Detail</a>
        </div>
    </div>
    @endforeach
</div>

<div class="pagination-wrap">
    {{ $alats->links('pagination::bootstrap-4') }}
</div>

@else
<div class="card text-center" style="padding: 40px;">
    <svg style="margin: 0 auto 16px; color: var(--gray-400); width: 64px; height: 64px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
    <h3 style="font-size: 16px; font-weight: 600; color: var(--gray-900); margin-bottom: 8px;">Tidak ada alat yang ditemukan</h3>
    <p style="font-size: 13.5px; color: var(--gray-500);">Cobalah dengan kata kunci lain atau periksa kembali nanti.</p>
</div>
@endif

@endsection
