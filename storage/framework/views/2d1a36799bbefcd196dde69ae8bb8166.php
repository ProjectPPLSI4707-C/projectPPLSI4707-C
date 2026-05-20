<?php $__env->startSection('title', 'Verifikasi Simpanan'); ?>
<?php $__env->startSection('page-title', 'Verifikasi Simpanan'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header flex items-center justify-between">
    <div>
        <h2>Manajemen Simpanan</h2>
        <p>Verifikasi pembayaran simpanan anggota</p>
    </div>
</div>


<div class="stat-grid" style="grid-template-columns:repeat(2,1fr);max-width:420px;margin-bottom:20px;">
    <div class="stat-card">
        <div class="stat-icon gold">⏳</div>
        <div>
            <div class="stat-label">Pending</div>
            <div class="stat-value"><?php echo e($pendingCount); ?></div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green">✅</div>
        <div>
            <div class="stat-label">Terverifikasi</div>
            <div class="stat-value"><?php echo e($successCount); ?></div>
        </div>
    </div>
</div>


<div class="card" style="margin-bottom:20px;padding:16px 20px;">
    <div style="display:flex;gap:12px;align-items:center;flex-wrap:wrap;">
        <span style="font-size:13px;font-weight:500;color:#374151;">Status:</span>
        <?php $__currentLoopData = ['Pending' => '⏳ Pending', 'Success' => '✅ Terverifikasi', 'all' => '📋 Semua']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('admin.simpanan.index', array_merge(request()->query(), ['status' => $val]))); ?>"
               style="padding:6px 16px;border-radius:20px;font-size:13px;font-weight:500;text-decoration:none;transition:all .15s;
                      <?php echo e($status === $val ? 'background:#19376D;color:#fff;' : 'background:#F3F4F6;color:#374151;'); ?>">
                <?php echo e($label); ?>

            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <span style="font-size:13px;font-weight:500;color:#374151;margin-left:12px;">Jenis:</span>
        <?php $__currentLoopData = ['' => 'Semua', 'Pokok' => 'Pokok', 'Wajib' => 'Wajib', 'Sukarela' => 'Sukarela']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('admin.simpanan.index', array_merge(request()->query(), ['jenis' => $val]))); ?>"
               style="padding:6px 16px;border-radius:20px;font-size:13px;font-weight:500;text-decoration:none;transition:all .15s;
                      <?php echo e($jenis === $val || ($val === '' && !$jenis) ? 'background:#19376D;color:#fff;' : 'background:#F3F4F6;color:#374151;'); ?>">
                <?php echo e($label); ?>

            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>


<div class="card" style="padding:0;">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Anggota</th>
                    <th>Jenis Simpanan</th>
                    <th>Nominal</th>
                    <th>Tanggal</th>
                    <th>Bukti</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $simpanan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td style="color:#9CA3AF;"><?php echo e($simpanan->firstItem() + $i); ?></td>
                        <td>
                            <div style="font-weight:600;color:#111827;"><?php echo e($s->user->name); ?></div>
                            <div style="font-size:12px;color:#6B7280;"><?php echo e($s->user->email); ?></div>
                        </td>
                        <td>
                            <span style="font-weight:600;"><?php echo e($s->jenis_simpanan); ?></span>
                        </td>
                        <td style="font-weight:700;color:#19376D;font-family:'Poppins',sans-serif;">
                            Rp <?php echo e(number_format($s->jumlah, 0, ',', '.')); ?>

                        </td>
                        <td style="color:#6B7280;font-size:13px;"><?php echo e($s->created_at->format('d M Y')); ?></td>
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
                        <td>
                            <?php if($s->isPending()): ?>
                                <a href="<?php echo e(route('admin.simpanan.show', $s)); ?>" class="btn btn-sm btn-primary">Detail & Verifikasi</a>
                            <?php else: ?>
                                <a href="<?php echo e(route('admin.simpanan.show', $s)); ?>" class="btn btn-sm btn-outline">Detail</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="8" style="text-align:center;padding:48px;color:#9CA3AF;">
                            <div style="font-size:36px;margin-bottom:8px;">📭</div>
                            Tidak ada data simpanan.
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\SEMESTER 5\github\projectPPLSI4707-C\resources\views/admin/simpanan/index.blade.php ENDPATH**/ ?>