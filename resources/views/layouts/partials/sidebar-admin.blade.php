@php
    $pendingSimpanan = \App\Models\Simpanan::pending()->count();
    $pendingPinjaman = \App\Models\Pinjaman::pending()->count();
    $pendingAlat     = \App\Models\PenyewaanAlat::where('status_pembayaran', 'pending')->count();
@endphp

<div class="nav-section-label">Menu Utama</div>

<a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
    Dashboard
</a>

<div class="nav-section-label">Manajemen</div>

<a href="{{ route('admin.simpanan.index') }}" class="nav-item {{ request()->routeIs('admin.simpanan.*') ? 'active' : '' }}">
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
    Simpanan
    @if($pendingSimpanan > 0)
        <span class="nav-badge">{{ $pendingSimpanan }}</span>
    @endif
</a>

<a href="{{ route('admin.pinjaman.index') }}" class="nav-item {{ request()->routeIs('admin.pinjaman.*') ? 'active' : '' }}">
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    Pinjaman
    @if($pendingPinjaman > 0)
        <span class="nav-badge">{{ $pendingPinjaman }}</span>
    @endif
</a>

<a href="{{ route('admin.alat.index') }}" class="nav-item {{ request()->routeIs('admin.alat.*') ? 'active' : '' }}">
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
    Penyewaan Alat
    @if($pendingAlat > 0)
        <span class="nav-badge">{{ $pendingAlat }}</span>
    @endif
</a>

<a href="{{ route('admin.inventaris-alat.index') }}" class="nav-item {{ request()->routeIs('admin.inventaris-alat.*') ? 'active' : '' }}">
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
    Inventaris Alat
</a>

<a href="{{ route('admin.anggota.index') }}" class="nav-item {{ request()->routeIs('admin.anggota.*') ? 'active' : '' }}">
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
    Anggota
</a>

<div class="nav-section-label">Pembayaran</div>
<a href="{{ route('admin.angsuran.index') }}" class="nav-item {{ request()->routeIs('admin.angsuran.*') ? 'active' : '' }}">
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
    </svg>
    Verifikasi Angsuran
</a>