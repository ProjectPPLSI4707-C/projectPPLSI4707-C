<?php $__env->startSection('title', 'Dashboard Admin'); ?>
<?php $__env->startSection('page-title', 'Dashboard Admin'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <h2>Dashboard Administrator</h2>
    <p>Ringkasan aktivitas koperasi dan pengajuan yang perlu ditangani</p>
</div>


<div class="stat-grid">
    <div class="stat-card">
        <div class="stat-icon blue">👥</div>
        <div>
            <div class="stat-label">Total Anggota</div>
            <div class="stat-value"><?php echo e($totalAnggota); ?></div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green">🏦</div>
        <div>
            <div class="stat-label">Total Dana Simpanan</div>
            <div class="stat-value sm">Rp <?php echo e(number_format($totalSimpananAll, 0, ',', '.')); ?></div>
        </div>
    </div>
    <div class="stat-card" style="border:1.5px solid #FDE68A;">
        <div class="stat-icon gold">⏳</div>
        <div>
            <div class="stat-label">Simpanan Pending</div>
            <div class="stat-value"><?php echo e($pendingSimpanan); ?></div>
            <?php if($pendingSimpanan > 0): ?>
                <a href="<?php echo e(route('admin.simpanan.index')); ?>" style="font-size:11.5px;color:#F5A623;font-weight:600;text-decoration:none;">Verifikasi →</a>
            <?php endif; ?>
        </div>
    </div>
    <div class="stat-card" style="border:1.5px solid #FDE68A;">
        <div class="stat-icon red">⏳</div>
        <div>
            <div class="stat-label">Pinjaman Pending</div>
            <div class="stat-value"><?php echo e($pendingPinjaman); ?></div>
            <?php if($pendingPinjaman > 0): ?>
                <a href="<?php echo e(route('admin.pinjaman.index')); ?>" style="font-size:11.5px;color:#EF4444;font-weight:600;text-decoration:none;">Tinjau →</a>
            <?php endif; ?>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green">💳</div>
        <div>
            <div class="stat-label">Total Pinjaman Aktif</div>
            <div class="stat-value sm">Rp <?php echo e(number_format($totalPinjamanAktif, 0, ',', '.')); ?></div>
        </div>
    </div>
</div>

<div class="grid-2">
    
    <div class="card">
        <div class="card-title" style="justify-content:space-between;">
            <span>⏳ Simpanan Menunggu Verifikasi</span>
            <a href="<?php echo e(route('admin.simpanan.index')); ?>" style="font-size:12px;color:#19376D;text-decoration:none;font-weight:500;">Lihat semua →</a>
        </div>
        <?php $__empty_1 = true; $__currentLoopData = $recentSimpanan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div style="display:flex;align-items:center;justify-content:space-between;padding:12px 0;border-bottom:1px solid #F3F4F6;">
                <div>
                    <div style="font-size:13.5px;font-weight:600;color:#111827;"><?php echo e($s->user->name); ?></div>
                    <div style="font-size:12px;color:#6B7280;"><?php echo e($s->jenis_simpanan); ?> · <?php echo e($s->created_at->diffForHumans()); ?></div>
                </div>
                <div style="text-align:right;">
                    <div style="font-size:13px;font-weight:700;color:#19376D;">Rp <?php echo e(number_format($s->jumlah, 0, ',', '.')); ?></div>
                    <a href="<?php echo e(route('admin.simpanan.show', $s)); ?>" class="btn btn-sm btn-primary" style="margin-top:4px;">Verifikasi</a>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div style="text-align:center;padding:28px;color:#9CA3AF;">
                <div style="font-size:32px;">✅</div>
                <p style="font-size:13px;margin-top:6px;">Tidak ada simpanan pending</p>
            </div>
        <?php endif; ?>
    </div>

    
    <div class="card">
        <div class="card-title" style="justify-content:space-between;">
            <span>💳 Pinjaman Menunggu Keputusan</span>
            <a href="<?php echo e(route('admin.pinjaman.index')); ?>" style="font-size:12px;color:#19376D;text-decoration:none;font-weight:500;">Lihat semua →</a>
        </div>
        <?php $__empty_1 = true; $__currentLoopData = $recentPinjaman; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div style="display:flex;align-items:center;justify-content:space-between;padding:12px 0;border-bottom:1px solid #F3F4F6;">
                <div>
                    <div style="font-size:13.5px;font-weight:600;color:#111827;"><?php echo e($p->user->name); ?></div>
                    <div style="font-size:12px;color:#6B7280;"><?php echo e($p->tenor); ?> bln · <?php echo e($p->tanggal_pengajuan->format('d M Y')); ?></div>
                </div>
                <div style="text-align:right;">
                    <div style="font-size:13px;font-weight:700;color:#19376D;">Rp <?php echo e(number_format($p->jumlah_pinjaman, 0, ',', '.')); ?></div>
                    <a href="<?php echo e(route('admin.pinjaman.show', $p)); ?>" class="btn btn-sm btn-gold" style="margin-top:4px;">Tinjau</a>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div style="text-align:center;padding:28px;color:#9CA3AF;">
                <div style="font-size:32px;">✅</div>
                <p style="font-size:13px;margin-top:6px;">Tidak ada pinjaman pending</p>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\MSI GF63\Dokumen\GitHub\projectPPLSI4707-C\PPLSI4707-C\resources\views\admin\dashboard.blade.php ENDPATH**/ ?>