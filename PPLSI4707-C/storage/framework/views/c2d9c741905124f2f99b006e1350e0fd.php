<?php $__env->startSection('title', 'Detail Pinjaman'); ?>
<?php $__env->startSection('page-title', 'Detail Pinjaman'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header flex items-center justify-between">
    <div>
        <h2>Detail Pengajuan Pinjaman</h2>
        <p>Tinjau detail dan riwayat simpanan anggota sebelum memberi keputusan</p>
    </div>
    <a href="<?php echo e(route('admin.pinjaman.index')); ?>" class="btn btn-outline">← Kembali</a>
</div>

<div class="grid-2" style="align-items:start;gap:24px;">

    
    <div style="display:flex;flex-direction:column;gap:20px;">

        
        <div class="card">
            <div class="card-title">💳 Detail Pinjaman</div>
            <?php
                $rows = [
                    ['Anggota',          $pinjaman->user->name],
                    ['Email',            $pinjaman->user->email],
                    ['Jumlah Pinjaman',  'Rp ' . number_format($pinjaman->jumlah_pinjaman, 0, ',', '.')],
                    ['Tenor',            $pinjaman->tenor . ' Bulan'],
                    ['Bunga',            $pinjaman->bunga_pinjaman . '% / bulan (flat)'],
                    ['Angsuran/Bulan',   'Rp ' . number_format($pinjaman->angsuranPerBulan(), 0, ',', '.')],
                    ['Total Pengembalian','Rp ' . number_format($pinjaman->totalPengembalian(), 0, ',', '.')],
                    ['Total Bunga',      'Rp ' . number_format($pinjaman->totalPengembalian() - $pinjaman->jumlah_pinjaman, 0, ',', '.')],
                    ['Tanggal Pengajuan',$pinjaman->tanggal_pengajuan->format('d M Y')],
                    ['Status',           $pinjaman->status_pengajuan],
                ];
            ?>
            <table style="width:100%;border-collapse:collapse;">
                <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$label, $value]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr style="border-bottom:1px solid #F3F4F6;">
                        <td style="padding:11px 0;font-size:13px;color:#6B7280;width:42%;"><?php echo e($label); ?></td>
                        <td style="padding:11px 0;font-size:13.5px;font-weight:600;color:#111827;">
                            <?php if($label === 'Status'): ?>
                                <?php $bc = match($pinjaman->status_pengajuan) { 'Approved'=>'badge-approved','Rejected'=>'badge-rejected',default=>'badge-pending' }; ?>
                                <span class="badge <?php echo e($bc); ?>"><?php echo e($value); ?></span>
                            <?php elseif(in_array($label, ['Jumlah Pinjaman','Angsuran/Bulan','Total Pengembalian','Total Bunga'])): ?>
                                <span style="font-family:'Poppins',sans-serif;color:#19376D;"><?php echo e($value); ?></span>
                            <?php else: ?>
                                <?php echo e($value); ?>

                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
        </div>

        
        <div class="card">
            <div class="card-title">📝 Tujuan Pinjaman</div>
            <p style="font-size:14px;color:#374151;line-height:1.7;"><?php echo e($pinjaman->tujuan_pinjaman); ?></p>
        </div>

        
        <?php if($pinjaman->dokumen_pendukung): ?>
            <div class="card">
                <div class="card-title">📁 Dokumen Pendukung</div>
                <?php $ext = pathinfo($pinjaman->dokumen_pendukung, PATHINFO_EXTENSION); ?>
                <?php if(in_array(strtolower($ext), ['jpg','jpeg','png'])): ?>
                    <img src="<?php echo e($pinjaman->dokumen_url); ?>" style="width:100%;border-radius:10px;border:1px solid #E5E7EB;" alt="Dokumen">
                <?php else: ?>
                    <a href="<?php echo e($pinjaman->dokumen_url); ?>" target="_blank" class="btn btn-outline w-full" style="justify-content:center;">📄 Buka Dokumen PDF</a>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        
        <?php if(!$pinjaman->isPending() && $pinjaman->catatan_admin): ?>
            <div class="card" style="background:<?php echo e($pinjaman->isApproved() ? '#D1FAE5' : '#FEE2E2'); ?>;border:1.5px solid <?php echo e($pinjaman->isApproved() ? '#A7F3D0' : '#FECACA'); ?>;">
                <div class="card-title" style="color:<?php echo e($pinjaman->isApproved() ? '#065F46' : '#991B1B'); ?>;">
                    <?php echo e($pinjaman->isApproved() ? '✅ Keputusan: Disetujui' : '❌ Keputusan: Ditolak'); ?>

                </div>
                <p style="font-size:13.5px;color:<?php echo e($pinjaman->isApproved() ? '#065F46' : '#991B1B'); ?>;"><?php echo e($pinjaman->catatan_admin); ?></p>
            </div>
        <?php endif; ?>
    </div>

    
    <div style="display:flex;flex-direction:column;gap:20px;">

        
        <div class="card" style="border:1.5px solid #BFDBFE;background:#EFF6FF;">
            <div class="card-title" style="color:#1E40AF;">🏦 Ringkasan Simpanan Anggota</div>
            <p style="font-size:12px;color:#3B82F6;margin-bottom:14px;">Gunakan ini sebagai bahan pertimbangan kelayakan pinjaman.</p>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:16px;">
                <?php $__currentLoopData = ['Pokok' => [$simpananPokok, '📌'], 'Wajib' => [$simpananWajib, '📅'], 'Sukarela' => [$simpananSukarela, '💰']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jenis => [$total, $icon]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div style="background:#fff;border-radius:10px;padding:14px;border:1px solid #DBEAFE;">
                        <div style="font-size:18px;margin-bottom:4px;"><?php echo e($icon); ?></div>
                        <div style="font-size:11px;color:#3B82F6;font-weight:600;"><?php echo e($jenis); ?></div>
                        <div style="font-size:15px;font-weight:700;color:#1E40AF;font-family:'Poppins',sans-serif;">
                            Rp <?php echo e(number_format($total, 0, ',', '.')); ?>

                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div style="background:#1E40AF;border-radius:10px;padding:14px;">
                    <div style="font-size:11px;color:#BFDBFE;font-weight:600;">Total Simpanan</div>
                    <div style="font-size:15px;font-weight:700;color:#fff;font-family:'Poppins',sans-serif;">
                        Rp <?php echo e(number_format($totalSimpanan, 0, ',', '.')); ?>

                    </div>
                </div>
            </div>

            
            <?php if($totalSimpanan > 0): ?>
                <?php $rasio = round($pinjaman->jumlah_pinjaman / $totalSimpanan, 2); ?>
                <div style="background:#fff;border-radius:10px;padding:14px;border:1px solid #DBEAFE;">
                    <div style="font-size:12px;color:#6B7280;margin-bottom:6px;">Rasio Pinjaman vs Simpanan</div>
                    <div style="font-size:20px;font-weight:700;color:<?php echo e($rasio <= 3 ? '#059669' : ($rasio <= 5 ? '#D97706' : '#DC2626')); ?>;font-family:'Poppins',sans-serif;">
                        <?php echo e($rasio); ?>x
                    </div>
                    <div style="font-size:11px;color:#6B7280;margin-top:3px;">
                        <?php if($rasio <= 3): ?> ✅ Rasio aman
                        <?php elseif($rasio <= 5): ?> ⚠️ Rasio cukup tinggi
                        <?php else: ?> ❌ Rasio sangat tinggi
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        
        <div class="card">
            <div class="card-title">📋 Riwayat Simpanan (10 Terakhir)</div>
            <div class="table-wrap">
                <table>
                    <thead><tr><th>Jenis</th><th>Nominal</th><th>Status</th></tr></thead>
                    <tbody>
                        <?php $__currentLoopData = $riwayatSimpanan->take(10); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td style="font-weight:600;"><?php echo e($s->jenis_simpanan); ?></td>
                                <td style="font-weight:700;color:#19376D;">Rp <?php echo e(number_format($s->jumlah, 0, ',', '.')); ?></td>
                                <td><span class="badge <?php echo e($s->status === 'Success' ? 'badge-success' : 'badge-pending'); ?>"><?php echo e($s->status); ?></span></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>

        
        <?php if($pinjaman->isPending()): ?>
            <div class="card" style="border:1.5px solid #FDE68A;background:#FFFBEB;">
                <div class="card-title">⚡ Beri Keputusan</div>

                
                <form method="POST" action="<?php echo e(route('admin.pinjaman.approve', $pinjaman)); ?>" style="margin-bottom:16px;">
                    <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                    <div class="form-group">
                        <label class="form-label">Catatan Persetujuan</label>
                        <input type="text" name="catatan_admin" class="form-control"
                               placeholder="Misal: Disetujui, simpanan mencukupi."
                               value="<?php echo e(old('catatan_admin', 'Pengajuan disetujui.')); ?>">
                    </div>
                    <button type="submit" class="btn btn-success w-full" style="justify-content:center;"
                            onclick="return confirm('Setujui pengajuan pinjaman ini?')">
                        ✅ Setujui Pinjaman
                    </button>
                </form>

                <hr style="border:none;border-top:1px dashed #FDE68A;margin-bottom:16px;">

                
                <form method="POST" action="<?php echo e(route('admin.pinjaman.reject', $pinjaman)); ?>">
                    <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                    <div class="form-group">
                        <label class="form-label">Alasan Penolakan <span class="req">*</span></label>
                        <textarea name="catatan_admin" class="form-control <?php echo e($errors->has('catatan_admin') ? 'is-invalid' : ''); ?>"
                                  placeholder="Jelaskan alasan penolakan..." rows="3"><?php echo e(old('catatan_admin')); ?></textarea>
                        <?php $__errorArgs = ['catatan_admin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback" style="display:block;"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <button type="submit" class="btn btn-danger w-full" style="justify-content:center;"
                            onclick="return confirm('Tolak pengajuan pinjaman ini?')">
                        ❌ Tolak Pinjaman
                    </button>
                </form>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\MSI GF63\Dokumen\GitHub\projectPPLSI4707-C\PPLSI4707-C\resources\views\admin\pinjaman\show.blade.php ENDPATH**/ ?>