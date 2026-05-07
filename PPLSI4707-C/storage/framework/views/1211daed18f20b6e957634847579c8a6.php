<?php $__env->startSection('title', 'Bayar Simpanan'); ?>
<?php $__env->startSection('page-title', 'Bayar Simpanan'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header flex items-center justify-between">
    <div>
        <h2>Bayar Simpanan</h2>
        <p>Pilih jenis simpanan dan unggah bukti pembayaran</p>
    </div>
    <a href="<?php echo e(route('anggota.simpanan.index')); ?>" class="btn btn-outline">← Kembali</a>
</div>

<div style="max-width:640px;">
    <div class="card">
        <div class="card-title">📋 Form Pembayaran Simpanan</div>

        <form method="POST" action="<?php echo e(route('anggota.simpanan.store')); ?>" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>

            
            <div class="form-group">
                <label class="form-label">Jenis Simpanan <span class="req">*</span></label>
                <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:12px;">
                    <?php $__currentLoopData = ['Pokok' => ['📌','Simpanan awal keanggotaan, dibayar sekali'], 'Wajib' => ['📅','Dibayar rutin setiap bulan'], 'Sukarela' => ['💰','Dapat dibayar kapan saja']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jenis => [$icon, $desc]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <label style="cursor:pointer;">
                            <input type="radio" name="jenis_simpanan" value="<?php echo e($jenis); ?>"
                                   <?php echo e(old('jenis_simpanan') === $jenis ? 'checked' : ''); ?>

                                   style="display:none;" class="jenis-radio">
                            <div class="jenis-card" data-jenis="<?php echo e($jenis); ?>"
                                 style="border:2px solid #E5E7EB;border-radius:12px;padding:16px;text-align:center;transition:all .2s;user-select:none;">
                                <div style="font-size:28px;margin-bottom:6px;"><?php echo e($icon); ?></div>
                                <div style="font-size:13px;font-weight:600;color:#111827;"><?php echo e($jenis); ?></div>
                                <div style="font-size:11px;color:#6B7280;margin-top:4px;line-height:1.4;"><?php echo e($desc); ?></div>
                            </div>
                        </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php $__errorArgs = ['jenis_simpanan'];
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

            
            <div class="form-group">
                <label class="form-label" for="jumlah">Jumlah Pembayaran <span class="req">*</span></label>
                <div style="position:relative;">
                    <span style="position:absolute;left:14px;top:50%;transform:translateY(-50%);font-size:14px;color:#6B7280;font-weight:500;">Rp</span>
                    <input type="number" id="jumlah" name="jumlah"
                           class="form-control <?php echo e($errors->has('jumlah') ? 'is-invalid' : ''); ?>"
                           style="padding-left:40px;"
                           value="<?php echo e(old('jumlah')); ?>"
                           placeholder="0"
                           min="1000" step="1000">
                </div>
                <?php $__errorArgs = ['jumlah'];
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

            
            <div class="form-group">
                <label class="form-label">Bukti Pembayaran <span class="req">*</span></label>
                <div class="upload-area" id="upload-area" onclick="document.getElementById('bukti_bayar').click()">
                    <input type="file" id="bukti_bayar" name="bukti_bayar"
                           accept=".jpg,.jpeg,.png,.pdf"
                           onchange="previewFile(this)">
                    <div id="upload-placeholder">
                        <div class="icon">📎</div>
                        <label class="upload-label">Klik untuk memilih file</label>
                        <p>JPG, PNG, atau PDF · Maks. 2 MB</p>
                    </div>
                    <div id="upload-preview" style="display:none;">
                        <div style="font-size:32px;">✅</div>
                        <p id="file-name" style="font-weight:600;color:#059669;margin-top:6px;font-size:13px;"></p>
                        <p style="font-size:12px;color:#6B7280;">Klik untuk mengganti</p>
                    </div>
                </div>
                <?php $__errorArgs = ['bukti_bayar'];
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

            <div style="display:flex;gap:12px;margin-top:8px;">
                <button type="submit" class="btn btn-primary" style="flex:1;justify-content:center;">
                    ✅ Kirim Pembayaran
                </button>
                <a href="<?php echo e(route('anggota.simpanan.index')); ?>" class="btn btn-outline">Batal</a>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    // Jenis selection highlight
    document.querySelectorAll('.jenis-radio').forEach(radio => {
        radio.addEventListener('change', () => {
            document.querySelectorAll('.jenis-card').forEach(c => {
                c.style.borderColor = '#E5E7EB';
                c.style.background  = '#fff';
            });
            const card = radio.parentElement.querySelector('.jenis-card');
            card.style.borderColor = '#19376D';
            card.style.background  = '#EFF6FF';
        });
        // Init state
        if (radio.checked) {
            const card = radio.parentElement.querySelector('.jenis-card');
            card.style.borderColor = '#19376D';
            card.style.background  = '#EFF6FF';
        }
    });

    function previewFile(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            document.getElementById('upload-placeholder').style.display = 'none';
            document.getElementById('upload-preview').style.display     = 'block';
            document.getElementById('file-name').textContent = file.name;
        }
    }
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\MSI GF63\Dokumen\GitHub\projectPPLSI4707-C\PPLSI4707-C\resources\views/anggota/simpanan/create.blade.php ENDPATH**/ ?>