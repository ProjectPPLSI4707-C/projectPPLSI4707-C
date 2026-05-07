<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login — SKOTER</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body, html { height: 100%; font-family: 'Poppins', sans-serif; }

        .login-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* Left panel */
        .login-left {
            flex: 1;
            background: linear-gradient(160deg, #0B2545 0%, #19376D 55%, #1A4A8A 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 60px 48px;
            position: relative;
            overflow: hidden;
        }
        .login-left::before {
            content: '';
            position: absolute;
            width: 400px; height: 400px;
            border-radius: 50%;
            background: rgba(255,255,255,.04);
            top: -100px; right: -100px;
        }
        .login-left::after {
            content: '';
            position: absolute;
            width: 300px; height: 300px;
            border-radius: 50%;
            background: rgba(245,166,35,.08);
            bottom: -80px; left: -80px;
        }
        .brand-logo {
            font-size: 56px;
            font-weight: 800;
            color: #fff;
            letter-spacing: 3px;
            position: relative;
            z-index: 1;
            text-shadow: 0 4px 20px rgba(0,0,0,.3);
        }
        .brand-logo span { color: #F5A623; }
        .brand-sub {
            font-size: 14px;
            color: rgba(255,255,255,.65);
            margin-top: 8px;
            letter-spacing: 2px;
            text-transform: uppercase;
            position: relative; z-index: 1;
        }
        .brand-desc {
            margin-top: 40px;
            text-align: center;
            position: relative; z-index: 1;
        }
        .brand-desc p {
            font-size: 14px;
            color: rgba(255,255,255,.7);
            line-height: 1.7;
            max-width: 340px;
        }
        .features {
            margin-top: 40px;
            display: flex;
            flex-direction: column;
            gap: 14px;
            position: relative; z-index: 1;
        }
        .feature-item {
            display: flex; align-items: center; gap: 12px;
            color: rgba(255,255,255,.8);
            font-size: 13px;
        }
        .feature-icon {
            width: 34px; height: 34px;
            background: rgba(255,255,255,.1);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: 16px;
            flex-shrink: 0;
        }

        /* Right panel */
        .login-right {
            width: 480px;
            background: #F9FAFB;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px 40px;
        }
        .login-card {
            width: 100%;
            max-width: 380px;
        }
        .login-card h2 {
            font-size: 26px;
            font-weight: 700;
            color: #0B2545;
            margin-bottom: 6px;
        }
        .login-card .subtitle {
            font-size: 13px;
            color: #6B7280;
            margin-bottom: 32px;
        }

        .form-group { margin-bottom: 18px; }
        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            color: #374151;
            margin-bottom: 6px;
        }
        .form-control {
            width: 100%;
            padding: 11px 14px;
            border: 1.5px solid #D1D5DB;
            border-radius: 10px;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            color: #111827;
            background: #fff;
            outline: none;
            transition: border-color .2s, box-shadow .2s;
        }
        .form-control:focus {
            border-color: #19376D;
            box-shadow: 0 0 0 3px rgba(25,55,109,.1);
        }
        .form-control.is-invalid { border-color: #EF4444; }
        .invalid-feedback { font-size: 12px; color: #EF4444; margin-top: 4px; display: block; }

        .password-wrapper { position: relative; }
        .password-toggle {
            position: absolute; right: 12px; top: 50%;
            transform: translateY(-50%);
            cursor: pointer; font-size: 16px;
            background: none; border: none;
            color: #6B7280;
        }

        .btn-login {
            width: 100%;
            padding: 13px;
            background: linear-gradient(135deg, #0B2545, #19376D);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            margin-top: 8px;
            box-shadow: 0 4px 14px rgba(25,55,109,.35);
            transition: all .2s;
        }
        .btn-login:hover {
            box-shadow: 0 8px 20px rgba(25,55,109,.45);
            transform: translateY(-1px);
        }

        .demo-box {
            margin-top: 28px;
            background: #EFF6FF;
            border: 1px solid #BFDBFE;
            border-radius: 10px;
            padding: 14px 16px;
        }
        .demo-box p { font-size: 11.5px; color: #1E40AF; font-weight: 600; margin-bottom: 6px; }
        .demo-box .demo-item { font-size: 12px; color: #3B82F6; margin-bottom: 3px; }

        @media(max-width: 768px) {
            .login-left { display: none; }
            .login-right { width: 100%; }
        }
    </style>
</head>
<body>
<div class="login-wrapper">
    
    <div class="login-left">
        <div class="brand-logo">SK<span>O</span>TER</div>
        <div class="brand-sub">Sistem Koperasi Terpadu</div>
        <div class="brand-desc">
            <p>Platform manajemen koperasi digital yang mudah, aman, dan transparan untuk seluruh anggota.</p>
        </div>
        <div class="features">
            <div class="feature-item">
                <div class="feature-icon">🏦</div>
                <span>Kelola Simpanan Pokok, Wajib & Sukarela</span>
            </div>
            <div class="feature-item">
                <div class="feature-icon">💳</div>
                <span>Pengajuan & Simulasi Pinjaman Online</span>
            </div>
            <div class="feature-item">
                <div class="feature-icon">✅</div>
                <span>Verifikasi Transparan oleh Admin</span>
            </div>
        </div>
    </div>

    
    <div class="login-right">
        <div class="login-card">
            <h2>Selamat Datang!</h2>
            <p class="subtitle">Masuk ke akun SKOTER Anda</p>

            <?php if($errors->any()): ?>
                <div style="background:#FEE2E2;border:1px solid #FECACA;border-radius:10px;padding:12px 14px;margin-bottom:16px;font-size:13px;color:#991B1B;">
                    <?php echo e($errors->first()); ?>

                </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('login.post')); ?>" id="login-form">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label class="form-label" for="email">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control <?php echo e($errors->has('email') ? 'is-invalid' : ''); ?>"
                        value="<?php echo e(old('email')); ?>"
                        placeholder="contoh@email.com"
                        autocomplete="email"
                        required
                    >
                </div>
                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <div class="password-wrapper">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control"
                            placeholder="••••••••"
                            autocomplete="current-password"
                            required
                        >
                        <button type="button" class="password-toggle" onclick="togglePassword()" id="toggle-btn">👁</button>
                    </div>
                </div>
                <button type="submit" class="btn-login">Masuk</button>
            </form>

            <div class="demo-box">
                <p>🔑 Akun Demo</p>
                <div class="demo-item">👨‍💼 Admin: admin@skoter.id / password</div>
                <div class="demo-item">👤 Anggota: budi@skoter.id / password</div>
            </div>
        </div>
    </div>
</div>

<script>
function togglePassword() {
    const pw  = document.getElementById('password');
    const btn = document.getElementById('toggle-btn');
    if (pw.type === 'password') { pw.type = 'text'; btn.textContent = '🙈'; }
    else                         { pw.type = 'password'; btn.textContent = '👁'; }
}
</script>
</body>
</html><?php /**PATH C:\Users\MSI GF63\Dokumen\GitHub\projectPPLSI4707-C\PPLSI4707-C\resources\views/auth/login.blade.php ENDPATH**/ ?>