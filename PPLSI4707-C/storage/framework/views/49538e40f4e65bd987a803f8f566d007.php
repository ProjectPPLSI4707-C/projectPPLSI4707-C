
<?php $__env->startSection('title', 'Riwayat Simpanan'); ?>
<?php $__env->startSection('page-title', 'Riwayat Simpanan'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header flex items-center justify-between">
    <div>
        <h2>Riwayat Simpanan</h2>
        <p>Daftar seluruh transaksi simpanan Anda</p>
    </div>
    <a href="<?php echo e(route('anggota.simpanan.create')); ?>" class="btn btn-primary">+ Bayar Simpanan</a>
</div>


<div class="stat-grid" style="grid-template-columns: repeat(3, 1fr); margin-bottom: 24px;">
    <div class="stat-card">
        <div class="stat-icon gold">📌</div>
        <div>
            <div class="stat-label">Simpanan Pokok</div>
            <div class="stat-value sm">Rp <?php echo e(number_format($totalPokok, 0, ',', '.')); ?></div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green">📅</div>
        <div>
            <div class="stat-label">Simpanan Wajib</div>
            <div class="stat-value sm">Rp <?php echo e(number_format($totalWajib, 0, ',', '.')); ?></div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon blue">💰</div>
        <div>
            <div class="stat-label">Simpanan Sukarela</div>
            <div class="stat-value sm">Rp <?php echo e(number_format($totalSukarela, 0, ',', '.')); ?></div>
        </div>
    </div>
</div>


<div class="card" style="margin-bottom: 20px; padding: 16px 20px;">
    <form method="GET" style="display:flex;gap:12px;align-items:center;flex-wrap:wrap;">
        <label style="font-size:13px;font-weight:500;color:#374151;">Filter Jenis:</label>
        <?php $__currentLoopData = ['', 'Pokok', 'Wajib', 'Sukarela']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('anggota.simpanan.index', $j ? ['jenis' => $j] : [])); ?>"
               style="padding:6px 16px;border-radius:20px;font-size:13px;font-weight:500;text-decoration:none;transition:all .15s;
                      <?php echo e($jenis === $j || ($j === '' && !$jenis) ? 'background:#19376D;color:#fff;' : 'background:#F3F4F6;color:#374151;'); ?>">
                <?php echo e($j ?: 'Semua'); ?>

            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </form>
</div>


<div class="card" style="padding:0;">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Jenis Simpanan</th>
                    <th>Tanggal</th>
                    <th>Nominal</th>
                    <th>Bukti</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $simpanan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td style="color:#9CA3AF;"><?php echo e($simpanan->firstItem() + $i); ?></td>
                        <td>
                            <span style="font-weight:600;color:#111827;"><?php echo e($s->jenis_simpanan); ?></span>
                        </td>
                        <td style="color:#6B7280;"><?php echo e($s->created_at->format('d M Y, H:i')); ?></td>
                        <td style="font-weight:700;color:#19376D;font-family:'Poppins',sans-serif;">
                            Rp <?php echo e(number_format($s->jumlah, 0, ',', '.')); ?>

                        </td>
                        <td>
                            <?php if($s->bukti_bayar): ?>
                                <a href="<?php echo e($s->bukti_url); ?>" target="_blank" class="btn btn-sm btn-outline">📎 Lihat</a>
                            <?php else: ?>
                                <span style="color:#D1D5DB;font-size:12px;">—</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <span class="badge <?php echo e($s->status === 'Success' ? 'badge-success' : 'badge-pending'); ?>">
                                <?php echo e($s->status); ?>

                            </span>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" style="text-align:center;padding:40px;color:#9CA3AF;">
                            <div style="font-size:36px;margin-bottom:8px;">📭</div>
                            Belum ada transaksi simpanan.
                            <div style="margin-top:12px;">
                                <a href="<?php echo e(route('anggota.simpanan.create')); ?>" class="btn btn-primary btn-sm">Bayar Simpanan Sekarang</a>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php if($simpanan->hasPages()): ?>
    <div class="pagination-wrap"><?php echo e($simpanan->appends(request()->query())->links()); ?></div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\PPLSI4707-C\projectPPLSI4707-C\PPLSI4707-C\resources\views/anggota/simpanan/index.blade.php ENDPATH**/ ?>