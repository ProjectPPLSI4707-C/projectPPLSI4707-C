<div class="nav-section-label">Menu Utama</div>

<a href="<?php echo e(route('anggota.dashboard')); ?>" class="nav-item <?php echo e(request()->routeIs('anggota.dashboard') ? 'active' : ''); ?>">
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
    Dashboard
</a>

<div class="nav-section-label">Simpanan</div>

<a href="<?php echo e(route('anggota.simpanan.index')); ?>" class="nav-item <?php echo e(request()->routeIs('anggota.simpanan.index') ? 'active' : ''); ?>">
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
    Riwayat Simpanan
</a>

<a href="<?php echo e(route('anggota.simpanan.create')); ?>" class="nav-item <?php echo e(request()->routeIs('anggota.simpanan.create') ? 'active' : ''); ?>">
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
    Bayar Simpanan
</a>

<div class="nav-section-label">Pinjaman</div>

<a href="<?php echo e(route('anggota.pinjaman.index')); ?>" class="nav-item <?php echo e(request()->routeIs('anggota.pinjaman.index') ? 'active' : ''); ?>">
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
    Status Pinjaman
</a>

<a href="<?php echo e(route('anggota.pinjaman.create')); ?>" class="nav-item <?php echo e(request()->routeIs('anggota.pinjaman.create') ? 'active' : ''); ?>">
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    Ajukan Pinjaman
</a>
<?php /**PATH C:\Users\MSI GF63\Dokumen\GitHub\projectPPLSI4707-C\PPLSI4707-C\resources\views/layouts/partials/sidebar-anggota.blade.php ENDPATH**/ ?>