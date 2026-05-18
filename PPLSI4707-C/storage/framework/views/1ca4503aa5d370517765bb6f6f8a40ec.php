
<?php $__env->startSection('title', 'Verifikasi Pinjaman'); ?>
<?php $__env->startSection('page-title', 'Verifikasi Pinjaman'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header flex items-center justify-between">
    <div>
        <h2>Manajemen Pinjaman</h2>
        <p>Tinjau dan putuskan pengajuan pinjaman anggota</p>
    </div>
</div>


<div class="stat-grid" style="grid-template-columns:repeat(3,1fr);max-width:600px;margin-bottom:20px;">
    <div class="stat-card"><div class="stat-icon gold">⏳</div><div><div class="stat-label">Pending</div><div class="stat-value"><?php echo e($pendingCount); ?></div></div></div>
    <div class="stat-card"><div class="stat-icon green">✅</div><div><div class="stat-label">Disetujui</div><div class="stat-value"><?php echo e($approvedCount); ?></div></div></div>
    <div class="stat-card"><div class="stat-icon red">❌</div><div><div class="stat-label">Ditolak</div><div class="stat-value"><?php echo e($rejectedCount); ?></div></div></div>
</div>


<div class="card" style="margin-bottom:20px;padding:16px 20px;">
    <div style="display:flex;gap:12px;align-items:center;flex-wrap:wrap;">
        <span style="font-size:13px;font-weight:500;color:#374151;">Filter:</span>
        <?php $__currentLoopData = ['Pending' => '⏳ Pending', 'Approved' => '✅ Disetujui', 'Rejected' => '❌ Ditolak', 'all' => '📋 Semua']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('admin.pinjaman.index', ['status' => $val])); ?>"
               style="padding:6px 16px;border-radius:20px;font-size:13px;font-weight:500;text-decoration:none;transition:all .15s;
                      <?php echo e($status === $val ? 'background:#19376D;color:#fff;' : 'background:#F3F4F6;color:#374151;'); ?>">
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
                    <th>Jumlah Pinjaman</th>
                    <th>Tenor</th>
                    <th>Angsuran/Bln</th>
                    <th>Tujuan</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $pinjaman; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td style="color:#9CA3AF;"><?php echo e($pinjaman->firstItem() + $i); ?></td>
                        <td>
                            <div style="font-weight:600;color:#111827;"><?php echo e($p->user->name); ?></div>
                            <div style="font-size:12px;color:#6B7280;"><?php echo e($p->user->email); ?></div>
                        </td>
                        <td style="font-weight:700;color:#19376D;font-family:'Poppins',sans-serif;">
                            Rp <?php echo e(number_format($p->jumlah_pinjaman, 0, ',', '.')); ?>

                        </td>
                        <td><?php echo e($p->tenor); ?> bln</td>
                        <td style="font-weight:600;color:#059669;">
                            Rp <?php echo e(number_format($p->angsuranPerBulan(), 0, ',', '.')); ?>

                        </td>
                        <td style="max-width:160px;">
                            <span style="font-size:12.5px;display:block;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;" title="<?php echo e($p->tujuan_pinjaman); ?>">
                                <?php echo e($p->tujuan_pinjaman); ?>

                            </span>
                        </td>
                        <td style="color:#6B7280;font-size:12.5px;"><?php echo e($p->tanggal_pengajuan->format('d M Y')); ?></td>
                        <td>
                            <?php
                                $bc = match($p->status_pengajuan) {
                                    'Approved' => 'badge-approved',
                                    'Rejected' => 'badge-rejected',
                                    default    => 'badge-pending',
                                };
                            ?>
                            <span class="badge <?php echo e($bc); ?>"><?php echo e($p->status_pengajuan); ?></span>
                        </td>
                        <td>
                            <a href="<?php echo e(route('admin.pinjaman.show', $p)); ?>" class="btn btn-sm <?php echo e($p->isPending() ? 'btn-gold' : 'btn-outline'); ?>">
                                <?php echo e($p->isPending() ? 'Putuskan' : 'Detail'); ?>

                            </a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="9" style="text-align:center;padding:48px;color:#9CA3AF;">
                            <div style="font-size:36px;margin-bottom:8px;">📭</div>
                            Tidak ada data pengajuan pinjaman.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php if($pinjaman->hasPages()): ?>
    <div class="pagination-wrap"><?php echo e($pinjaman->appends(request()->query())->links()); ?></div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\PPLSI4707-C\projectPPLSI4707-C\PPLSI4707-C\resources\views/admin/pinjaman/index.blade.php ENDPATH**/ ?>