<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Masuk — SKOTER</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body, html { height: 100%; font-family: 'Inter', sans-serif; background-color: #070e17; color: #fff; overflow-x: hidden; }

        .login-wrapper {
            display: flex;
            min-height: 100vh;
            width: 100%;
        }

        /* Left side - Cinematic Brand Section */
        .login-left {
            flex: 1.2;
            background: radial-gradient(circle at 40% 40%, #11223F 0%, #070E1A 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 60px 48px;
            position: relative;
            overflow: hidden;
            border-right: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        .login-left::before {
            content: '';
            position: absolute;
            width: 500px; height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(245, 166, 35, 0.05) 0%, transparent 70%);
            top: -200px; right: -150px;
            pointer-events: none;
        }

        .login-left::after {
            content: '';
            position: absolute;
            width: 400px; height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.04) 0%, transparent 70%);
            bottom: -150px; left: -100px;
            pointer-events: none;
        }

        .brand-logo {
            font-size: 50px;
            font-weight: 800;
            color: #fff;
            letter-spacing: 1.5px;
            position: relative;
            z-index: 2;
        }
        .brand-logo span { color: #F5A623; }
        
        .brand-sub {
            font-size: 13px;
            color: rgba(255,255,255,.5);
            margin-top: 8px;
            letter-spacing: 3px;
            text-transform: uppercase;
            font-weight: 600;
            position: relative; z-index: 2;
        }

        .brand-desc {
            margin-top: 32px;
            text-align: center;
            position: relative; z-index: 2;
            max-width: 380px;
        }
        .brand-desc p {
            font-size: 15px;
            color: #94A3B8;
            line-height: 1.6;
        }

        .features {
            margin-top: 48px;
            display: flex;
            flex-direction: column;
            gap: 20px;
            position: relative; z-index: 2;
            width: 100%;
            max-width: 360px;
        }
        .feature-item {
            display: flex; align-items: center; gap: 16px;
            color: #CBD5E1;
            font-size: 14px;
            background: rgba(255, 255, 255, 0.02);
            padding: 14px 18px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.04);
            transition: transform 0.2s;
        }
        .feature-item:hover {
            transform: translateY(-2px);
            border-color: rgba(245, 166, 35, 0.2);
        }
        .feature-icon {
            width: 36px; height: 36px;
            background: rgba(25, 55, 109, 0.3);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            color: #F5A623;
            flex-shrink: 0;
            border: 1px solid rgba(245, 166, 35, 0.1);
        }

        /* Right side - Login Form Panel */
        .login-right {
            width: 500px;
            background: #070E1A;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px 40px;
            position: relative;
        }

        .login-card {
            width: 100%;
            max-width: 380px;
            z-index: 2;
        }
        .login-card h2 {
            font-size: 28px;
            font-weight: 700;
            color: #FFFFFF;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }
        .login-card .subtitle {
            font-size: 14px;
            color: #94A3B8;
            margin-bottom: 32px;
        }

        .form-group { margin-bottom: 20px; }
        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #CBD5E1;
            margin-bottom: 8px;
        }
        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid #1e2f4c;
            border-radius: 12px;
            font-size: 14px;
            font-family: inherit;
            color: #fff;
            background: #0d1b32;
            outline: none;
            transition: border-color .2s, box-shadow .2s;
        }
        .form-control:focus {
            border-color: #F5A623;
            box-shadow: 0 0 0 3px rgba(245, 166, 35, 0.15);
        }
        .form-control::placeholder {
            color: #475569;
        }
        .form-control.is-invalid { border-color: #EF4444; }
        .invalid-feedback { font-size: 12px; color: #EF4444; margin-top: 4px; display: block; }

        .password-wrapper { position: relative; }
        .password-toggle {
            position: absolute; right: 14px; top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            background: none; border: none;
            color: #64748B;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .password-toggle:hover {
            color: #fff;
        }

        .btn-login {
            width: 100%;
            padding: 13px 20px;
            background: linear-gradient(135deg, #e8941a, #F5A623);
            color: #070e17;
            border: none;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            margin-top: 8px;
            box-shadow: 0 4px 14px rgba(245,166,35,.25);
            transition: all .25s ease;
        }
        .btn-login:hover {
            box-shadow: 0 6px 20px rgba(245,166,35,.35);
            transform: translateY(-1px);
        }
        .btn-login:active {
            transform: translateY(0);
        }

        .demo-box {
            margin-top: 28px;
            background: rgba(30, 58, 138, 0.2);
            border: 1px solid rgba(59, 130, 246, 0.2);
            border-radius: 12px;
            padding: 16px;
        }
        .demo-box .demo-title { 
            font-size: 12px; 
            color: #3B82F6; 
            font-weight: 700; 
            margin-bottom: 8px; 
            display: flex;
            align-items: center;
            gap: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .demo-box .demo-item { 
            font-size: 12.5px; 
            color: #93C5FD; 
            margin-bottom: 4px;
            font-family: monospace;
        }
        .demo-box .demo-item:last-child { margin-bottom: 0; }

        .register-link {
            text-align: center;
            margin-top: 24px;
            font-size: 13.5px;
            color: #94A3B8;
        }
        .register-link a {
            color: #F5A623;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }
        .register-link a:hover {
            color: #e8941a;
            text-decoration: underline;
        }

        @media(max-width: 868px) {
            .login-left { display: none; }
            .login-right { width: 100%; padding: 32px 24px; }
        }
    </style>
</head>
<body>
<div class="login-wrapper">
    {{-- Left Section --}}
    <div class="login-left">
        <div class="brand-logo">SK<span>O</span>TER</div>
        <div class="brand-sub">Sistem Koperasi Terpadu</div>
        <div class="brand-desc">
            <p>Platform finansial koperasi digital yang transparan, modern, dan memberikan kemudahan layanan bagi pengurus serta anggota.</p>
        </div>
        <div class="features">
            <div class="feature-item">
                <div class="feature-icon">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="20" height="20"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V10M12 21V10M5 21V10M3 7l9-4 9 4M4 10h16M3 21h18"/></svg>
                </div>
                <span>Kelola Simpanan Pokok, Wajib & Sukarela</span>
            </div>
            <div class="feature-item">
                <div class="feature-icon">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="20" height="20"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                </div>
                <span>Pengajuan & Simulasi Pinjaman Mandiri</span>
            </div>
            <div class="feature-item">
                <div class="feature-icon">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="20" height="20"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <span>Verifikasi Transaksi Cepat & Aman</span>
            </div>
        </div>
    </div>

    {{-- Right Section --}}
    <div class="login-right">
        <div class="login-card">
            <h2>Selamat Datang</h2>
            <p class="subtitle">Masuk menggunakan akun SKOTER Anda</p>

            @if($errors->any())
                <div style="background:#3A1C1C;border-left:4px solid #EF4444;border-radius:8px;padding:14px;margin-bottom:20px;font-size:13.5px;color:#FF453A;font-weight:600;">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.post') }}" id="login-form">
                @csrf
                <div class="form-group">
                    <label class="form-label" for="email">Alamat Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                        value="{{ old('email') }}"
                        placeholder="contoh@email.com"
                        autocomplete="email"
                        required
                    >
                </div>
                <div class="form-group">
                    {{-- 👇 INI ADALAH BAGIAN YANG DITAMBAHKAN 👇 --}}
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                        <label class="form-label" for="password" style="margin-bottom: 0;">Kata Sandi</label>
                        @if($errors->any())
                            <a href="{{ route('password.verify') }}" style="font-size: 12px; color: #F5A623; text-decoration: none; font-weight: 600;">Lupa Kata Sandi?</a>
                        @endif
                    </div>
                    {{-- 👆 BATAS BAGIAN YANG DITAMBAHKAN 👆 --}}
                    
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
                        <button type="button" class="password-toggle" onclick="togglePassword()" id="toggle-btn">
                            <svg id="eye-open" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="20" height="20"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            <svg id="eye-closed" style="display:none;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="20" height="20"><path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M3 3l18 18"/></svg>
                        </button>
                    </div>
                </div>
                <button type="submit" class="btn-login">Masuk</button>
            </form>

            <div class="register-link">
                Belum terdaftar? <a href="{{ route('register') }}">Buat Akun Anggota</a>
            </div>

        </div>
    </div>
</div>

<script>
function togglePassword() {
    const pw  = document.getElementById('password');
    const eyeOpen = document.getElementById('eye-open');
    const eyeClosed = document.getElementById('eye-closed');
    if (pw.type === 'password') { 
        pw.type = 'text'; 
        eyeOpen.style.display = 'none'; 
        eyeClosed.style.display = 'block'; 
    } else { 
        pw.type = 'password'; 
        eyeOpen.style.display = 'block'; 
        eyeClosed.style.display = 'none'; 
    }
}
</script>
</body>
</html>