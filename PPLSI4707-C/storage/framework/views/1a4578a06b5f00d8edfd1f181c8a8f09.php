<?php
    $pendingSimpanan = \App\Models\Simpanan::pending()->count();
    $pendingPinjaman = \App\Models\Pinjaman::pending()->count();
?>

<div class="nav-section-label">Menu Utama</div>

<a href="<?php echo e(route('admin.dashboard')); ?>" class="nav-item <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
    Dashboard
</a>

<div class="nav-section-label">Manajemen</div>

<a href="<?php echo e(route('admin.simpanan.index')); ?>" class="nav-item <?php echo e(request()->routeIs('admin.simpanan.*') ? 'active' : ''); ?>">
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
    Simpanan
    <?php if($pendingSimpanan > 0): ?>
        <span class="nav-badge"><?php echo e($pendingSimpanan); ?></span>
    <?php endif; ?>
</a>

<a href="<?php echo e(route('admin.pinjaman.index')); ?>" class="nav-item <?php echo e(request()->routeIs('admin.pinjaman.*') ? 'active' : ''); ?>">
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    Pinjaman
    <?php if($pendingPinjaman > 0): ?>
        <span class="nav-badge"><?php echo e($pendingPinjaman); ?></span>
    <?php endif; ?>
</a>
<?php /**PATH D:\PPLSI4707-C\projectPPLSI4707-C\PPLSI4707-C\resources\views/layouts/partials/sidebar-admin.blade.php ENDPATH**/ ?>