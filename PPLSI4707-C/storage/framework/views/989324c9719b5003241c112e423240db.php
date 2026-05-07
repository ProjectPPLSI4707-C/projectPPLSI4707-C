<?php $__env->startSection('title', 'Daftar — Koperasi Simpan Pinjam'); ?>

<?php $__env->startSection('content'); ?>
    <h2 class="text-xl font-bold text-navy-900 mb-1">Daftar Anggota Baru</h2>
    <p class="text-slate-500 text-sm mb-6">Isi formulir berikut untuk mendaftar sebagai anggota koperasi</p>

    <form method="POST" action="<?php echo e(route('register')); ?>" class="space-y-4">
        <?php echo csrf_field(); ?>

        
        <div>
            <label for="nama_lengkap" class="block text-sm font-medium text-navy-800 mb-1.5">Nama Lengkap</label>
            <input type="text" id="nama_lengkap" name="nama_lengkap" value="<?php echo e(old('nama_lengkap')); ?>" required autofocus
                   class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-navy-900 placeholder-slate-400 focus:outline-none focus:border-accent-500 focus:ring-1 focus:ring-accent-500 transition-all"
                   placeholder="Masukkan nama lengkap">
            <?php $__errorArgs = ['nama_lengkap'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="mt-1 text-xs text-red-600"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        
        <div>
            <label for="email" class="block text-sm font-medium text-navy-800 mb-1.5">Email</label>
            <input type="email" id="email" name="email" value="<?php echo e(old('email')); ?>" required
                   class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-navy-900 placeholder-slate-400 focus:outline-none focus:border-accent-500 focus:ring-1 focus:ring-accent-500 transition-all"
                   placeholder="nama@email.com">
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="mt-1 text-xs text-red-600"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="password" class="block text-sm font-medium text-navy-800 mb-1.5">Password</label>
                <input type="password" id="password" name="password" required
                       class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-navy-900 placeholder-slate-400 focus:outline-none focus:border-accent-500 focus:ring-1 focus:ring-accent-500 transition-all"
                       placeholder="Min. 8 karakter">
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mt-1 text-xs text-red-600"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-navy-800 mb-1.5">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required
                       class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-navy-900 placeholder-slate-400 focus:outline-none focus:border-accent-500 focus:ring-1 focus:ring-accent-500 transition-all"
                       placeholder="Ulangi password">
            </div>
        </div>

        
        <div>
            <label for="no_ktp" class="block text-sm font-medium text-navy-800 mb-1.5">No. KTP</label>
            <input type="text" id="no_ktp" name="no_ktp" value="<?php echo e(old('no_ktp')); ?>" required
                   class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-navy-900 placeholder-slate-400 focus:outline-none focus:border-accent-500 focus:ring-1 focus:ring-accent-500 transition-all"
                   placeholder="16 digit nomor KTP">
            <?php $__errorArgs = ['no_ktp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="mt-1 text-xs text-red-600"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        
        <div>
            <label for="no_telepon" class="block text-sm font-medium text-navy-800 mb-1.5">No. Telepon</label>
            <input type="text" id="no_telepon" name="no_telepon" value="<?php echo e(old('no_telepon')); ?>" required
                   class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-navy-900 placeholder-slate-400 focus:outline-none focus:border-accent-500 focus:ring-1 focus:ring-accent-500 transition-all"
                   placeholder="08xxxxxxxxxx">
            <?php $__errorArgs = ['no_telepon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="mt-1 text-xs text-red-600"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        
        <div>
            <label for="alamat" class="block text-sm font-medium text-navy-800 mb-1.5">Alamat</label>
            <textarea id="alamat" name="alamat" rows="3" required
                      class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-navy-900 placeholder-slate-400 focus:outline-none focus:border-accent-500 focus:ring-1 focus:ring-accent-500 transition-all resize-none"
                      placeholder="Masukkan alamat lengkap"><?php echo e(old('alamat')); ?></textarea>
            <?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="mt-1 text-xs text-red-600"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        
        <div class="p-3 bg-blue-50 border border-blue-200 rounded-xl text-blue-700 text-xs">
            <div class="flex items-start gap-2">
                <svg class="w-4 h-4 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>Setelah pendaftaran, akun Anda akan berstatus <strong>"Menunggu Verifikasi"</strong> hingga disetujui oleh Admin.</span>
            </div>
        </div>

        
        <button type="submit" class="btn-shine w-full py-2.5 bg-gradient-to-r from-accent-600 to-accent-700 hover:from-accent-500 hover:to-accent-600 text-white font-semibold rounded-xl shadow-lg shadow-accent-600/30 transition-all duration-300 text-sm">
            Daftar Sekarang
        </button>
    </form>

    
    <div class="mt-6 text-center">
        <p class="text-sm text-slate-500">
            Sudah punya akun?
            <a href="<?php echo e(route('login')); ?>" class="text-accent-600 hover:text-accent-700 font-semibold transition-colors">
                Masuk di sini
            </a>
        </p>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guest', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\PPLSI4707-C\projectPPLSI4707-C\PPLSI4707-C\resources\views/auth/register.blade.php ENDPATH**/ ?>