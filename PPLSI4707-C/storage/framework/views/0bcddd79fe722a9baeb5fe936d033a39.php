<?php $__env->startSection('title', 'Status Pinjaman'); ?>
<?php $__env->startSection('page-title', 'Status Pinjaman'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header flex items-center justify-between">
    <div>
        <h2>Status Pinjaman</h2>
        <p>Pantau status pengajuan pinjaman Anda</p>
    </div>
    <a href="<?php echo e(route('anggota.pinjaman.create')); ?>" class="btn btn-primary">+ Ajukan Pinjaman</a>
</div>

<div class="card" style="padding:0;">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Jumlah Pinjaman</th>
                    <th>Tenor</th>
                    <th>Angsuran/Bulan</th>
                    <th>Tujuan</th>
                    <th>Status</th>
                    <th>Catatan Admin</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $pinjaman; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td style="color:#9CA3AF;"><?php echo e($pinjaman->firstItem() + $i); ?></td>
                        <td style="color:#6B7280;"><?php echo e($p->tanggal_pengajuan->format('d M Y')); ?></td>
                        <td style="font-weight:700;color:#19376D;font-family:'Poppins',sans-serif;">
                            Rp <?php echo e(number_format($p->jumlah_pinjaman, 0, ',', '.')); ?>

                        </td>
                        <td><?php echo e($p->tenor); ?> bln</td>
                        <td style="font-weight:600;color:#059669;">
                            Rp <?php echo e(number_format($p->angsuranPerBulan(), 0, ',', '.')); ?>

                        </td>
                        <td style="max-width:180px;">
                            <span style="font-size:13px;color:#374151;display:block;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;" title="<?php echo e($p->tujuan_pinjaman); ?>">
                                <?php echo e($p->tujuan_pinjaman); ?>

                            </span>
                        </td>
                        <td>
                            <?php
                                $badgeClass = match($p->status_pengajuan) {
                                    'Approved' => 'badge-approved',
                                    'Rejected' => 'badge-rejected',
                                    default    => 'badge-pending',
                                };
                                $label = match($p->status_pengajuan) {
                                    'Approved' => 'Disetujui',
                                    'Rejected' => 'Ditolak',
                                    default    => 'Diajukan',
                                };
                            ?>
                            <span class="badge <?php echo e($badgeClass); ?>"><?php echo e($label); ?></span>
                        </td>
                        <td style="font-size:12.5px;color:#6B7280;max-width:160px;">
                            <?php echo e($p->catatan_admin ?? '—'); ?>

                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="8" style="text-align:center;padding:48px;color:#9CA3AF;">
                            <div style="font-size:40px;margin-bottom:10px;">💳</div>
                            <p>Belum ada pengajuan pinjaman.</p>
                            <div style="margin-top:14px;">
                                <a href="<?php echo e(route('anggota.pinjaman.create')); ?>" class="btn btn-primary btn-sm">Ajukan Pinjaman Sekarang</a>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php if($pinjaman->hasPages()): ?>
    <div class="pagination-wrap"><?php echo e($pinjaman->links()); ?></div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\MSI GF63\Dokumen\GitHub\projectPPLSI4707-C\PPLSI4707-C\resources\views\anggota\pinjaman\index.blade.php ENDPATH**/ ?>