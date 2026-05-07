<?php $__env->startSection('title', 'Dashboard Anggota'); ?>
<?php $__env->startSection('page-title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <h2>Selamat Datang, <?php echo e(auth()->user()->name); ?>! 👋</h2>
    <p>Berikut ringkasan simpanan dan pinjaman Anda</p>
</div>


<div class="stat-grid">
    <div class="stat-card">
        <div class="stat-icon blue">🏦</div>
        <div>
            <div class="stat-label">Total Simpanan</div>
            <div class="stat-value sm">Rp <?php echo e(number_format($totalSimpanan, 0, ',', '.')); ?></div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon gold">📌</div>
        <div>
            <div class="stat-label">Simpanan Pokok</div>
            <div class="stat-value sm">Rp <?php echo e(number_format($simpananPokok, 0, ',', '.')); ?></div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green">📅</div>
        <div>
            <div class="stat-label">Simpanan Wajib</div>
            <div class="stat-value sm">Rp <?php echo e(number_format($simpananWajib, 0, ',', '.')); ?></div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon blue">💰</div>
        <div>
            <div class="stat-label">Simpanan Sukarela</div>
            <div class="stat-value sm">Rp <?php echo e(number_format($simpananSukarela, 0, ',', '.')); ?></div>
        </div>
    </div>
</div>

<div class="grid-2">
    
    <div class="card">
        <div class="card-title">💳 Status Pinjaman</div>
        <?php if($pinjamanAktif): ?>
            <div style="background:#D1FAE5;border-radius:12px;padding:18px;margin-bottom:12px;">
                <div style="font-size:12px;color:#065F46;font-weight:600;margin-bottom:8px;">✅ Pinjaman Aktif</div>
                <div style="font-size:20px;font-weight:700;color:#065F46;font-family:'Poppins',sans-serif;">
                    Rp <?php echo e(number_format($pinjamanAktif->jumlah_pinjaman, 0, ',', '.')); ?>

                </div>
                <div style="font-size:12px;color:#059669;margin-top:4px;">
                    Tenor <?php echo e($pinjamanAktif->tenor); ?> bulan · Angsuran Rp <?php echo e(number_format($pinjamanAktif->angsuranPerBulan(), 0, ',', '.')); ?>/bln
                </div>
            </div>
        <?php elseif($pinjamanPending > 0): ?>
            <div style="background:#FEF3C7;border-radius:12px;padding:18px;margin-bottom:12px;">
                <div style="font-size:12px;color:#92400E;font-weight:600;margin-bottom:4px;">⏳ Menunggu Verifikasi</div>
                <div style="font-size:13px;color:#78350F;"><?php echo e($pinjamanPending); ?> pengajuan sedang diproses admin</div>
            </div>
        <?php else: ?>
            <div style="text-align:center;padding:24px 16px;color:#9CA3AF;">
                <div style="font-size:36px;margin-bottom:8px;">💳</div>
                <p style="font-size:13px;">Belum ada pinjaman aktif</p>
            </div>
        <?php endif; ?>
        <a href="<?php echo e(route('anggota.pinjaman.create')); ?>" class="btn btn-primary w-full" style="justify-content:center;">
            + Ajukan Pinjaman Baru
        </a>
    </div>

    
    <div class="card">
        <div class="card-title" style="justify-content:space-between;">
            📋 Riwayat Transaksi Terbaru
            <a href="<?php echo e(route('anggota.simpanan.index')); ?>" style="font-size:12px;color:#19376D;font-weight:500;text-decoration:none;">Lihat semua →</a>
        </div>
        <?php $__empty_1 = true; $__currentLoopData = $riwayatTerbaru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div style="display:flex;align-items:center;justify-content:space-between;padding:12px 0;border-bottom:1px solid #F3F4F6;">
                <div>
                    <div style="font-size:13.5px;font-weight:600;color:#111827;"><?php echo e($item->jenis_simpanan); ?></div>
                    <div style="font-size:12px;color:#6B7280;"><?php echo e($item->created_at->format('d M Y')); ?></div>
                </div>
                <div style="text-align:right;">
                    <div style="font-size:13.5px;font-weight:700;color:#19376D;">Rp <?php echo e(number_format($item->jumlah, 0, ',', '.')); ?></div>
                    <span class="badge <?php echo e($item->status === 'Success' ? 'badge-success' : 'badge-pending'); ?>">
                        <?php echo e($item->status); ?>

                    </span>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p style="font-size:13px;color:#9CA3AF;text-align:center;padding:20px 0;">Belum ada transaksi.</p>
        <?php endif; ?>
        <div class="mt-4">
            <a href="<?php echo e(route('anggota.simpanan.create')); ?>" class="btn btn-outline w-full" style="justify-content:center;">+ Bayar Simpanan</a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\MSI GF63\Dokumen\GitHub\projectPPLSI4707-C\PPLSI4707-C\resources\views\anggota\dashboard.blade.php ENDPATH**/ ?>