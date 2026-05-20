<?php $__env->startSection('title', 'Detail Simpanan'); ?>
<?php $__env->startSection('page-title', 'Detail Simpanan'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header flex items-center justify-between">
    <div>
        <h2>Detail Simpanan</h2>
        <p>Tinjau bukti pembayaran dan verifikasi transaksi</p>
    </div>
    <a href="<?php echo e(route('admin.simpanan.index')); ?>" class="btn btn-outline">← Kembali</a>
</div>

<div class="grid-2" style="align-items:start;">
    
    <div style="display:flex;flex-direction:column;gap:20px;">
        <div class="card">
            <div class="card-title">📋 Informasi Transaksi</div>
            <table style="width:100%;border-collapse:collapse;">
                <?php
                    $rows = [
                        ['Anggota',        $simpanan->user->name],
                        ['Email',          $simpanan->user->email],
                        ['Jenis Simpanan', $simpanan->jenis_simpanan],
                        ['Nominal',        'Rp ' . number_format($simpanan->jumlah, 0, ',', '.')],
                        ['Tanggal',        $simpanan->created_at->format('d M Y, H:i')],
                        ['Status',         $simpanan->status],
                    ];
                ?>
                <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$label, $value]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr style="border-bottom:1px solid #F3F4F6;">
                        <td style="padding:12px 0;font-size:13px;color:#6B7280;width:40%;"><?php echo e($label); ?></td>
                        <td style="padding:12px 0;font-size:13.5px;font-weight:600;color:#111827;">
                            <?php if($label === 'Status'): ?>
                                <span class="badge <?php echo e($simpanan->status === 'Success' ? 'badge-success' : 'badge-pending'); ?>"><?php echo e($value); ?></span>
                            <?php elseif($label === 'Nominal'): ?>
                                <span style="font-family:'Poppins',sans-serif;font-size:16px;color:#19376D;"><?php echo e($value); ?></span>
                            <?php else: ?>
                                <?php echo e($value); ?>

                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
        </div>

        
        <div class="card">
            <div class="card-title">📊 Riwayat Simpanan Anggota Ini</div>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Jenis</th>
                            <th>Nominal</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $riwayatUser; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr style="<?php echo e($r->id === $simpanan->id ? 'background:#EFF6FF;' : ''); ?>">
                                <td style="font-weight:600;"><?php echo e($r->jenis_simpanan); ?></td>
                                <td style="font-weight:700;color:#19376D;">Rp <?php echo e(number_format($r->jumlah, 0, ',', '.')); ?></td>
                                <td style="color:#6B7280;font-size:12.5px;"><?php echo e($r->created_at->format('d M Y')); ?></td>
                                <td>
                                    <span class="badge <?php echo e($r->status === 'Success' ? 'badge-success' : 'badge-pending'); ?>"><?php echo e($r->status); ?></span>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    
    <div style="display:flex;flex-direction:column;gap:20px;">
        
        <div class="card">
            <div class="card-title">📎 Bukti Pembayaran</div>
            <?php if($simpanan->bukti_bayar): ?>
                <?php $ext = pathinfo($simpanan->bukti_bayar, PATHINFO_EXTENSION); ?>
                <?php if(in_array(strtolower($ext), ['jpg','jpeg','png'])): ?>
                    <img src="<?php echo e($simpanan->bukti_url); ?>" alt="Bukti Bayar"
                         style="width:100%;border-radius:10px;border:1px solid #E5E7EB;">
                <?php else: ?>
                    <a href="<?php echo e($simpanan->bukti_url); ?>" target="_blank" class="btn btn-outline w-full" style="justify-content:center;">
                        📄 Buka Dokumen PDF
                    </a>
                <?php endif; ?>
            <?php else: ?>
                <div style="text-align:center;padding:32px;color:#9CA3AF;">
                    <div style="font-size:36px;margin-bottom:8px;">🚫</div>
                    <p>Tidak ada bukti bayar</p>
                </div>
            <?php endif; ?>
        </div>

        
        <?php if($simpanan->isPending()): ?>
            <div class="card" style="border:1.5px solid #FDE68A;background:#FFFBEB;">
                <div class="card-title">⚡ Verifikasi Transaksi</div>
                <p style="font-size:13px;color:#78350F;margin-bottom:16px;">
                    Pastikan bukti pembayaran valid sebelum memverifikasi transaksi ini.
                </p>
                <form method="POST" action="<?php echo e(route('admin.simpanan.verify', $simpanan)); ?>">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                    <button type="submit" class="btn btn-success w-full" style="justify-content:center;"
                            onclick="return confirm('Verifikasi simpanan ini sebagai BERHASIL?')">
                        ✅ Verifikasi — Tandai Success
                    </button>
                </form>
            </div>
        <?php else: ?>
            <div class="card" style="background:#D1FAE5;border:1.5px solid #A7F3D0;">
                <div style="text-align:center;padding:16px;">
                    <div style="font-size:36px;margin-bottom:6px;">✅</div>
                    <div style="font-size:14px;font-weight:600;color:#065F46;">Transaksi Sudah Diverifikasi</div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\SEMESTER 5\github\projectPPLSI4707-C\resources\views/admin/simpanan/show.blade.php ENDPATH**/ ?>