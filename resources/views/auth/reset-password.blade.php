<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <meta charset="UTF-8">
    <title>Atur Ulang Kata Sandi — SKOTER</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body, html { height: 100%; font-family: 'Inter', sans-serif; background-color: #070e17; color: #fff; overflow-x: hidden; }
        .login-wrapper { display: flex; min-height: 100vh; width: 100%; }
        .login-left { flex: 1.2; background: radial-gradient(circle at 40% 40%, #11223F 0%, #070E1A 100%); display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 60px 48px; position: relative; overflow: hidden; border-right: 1px solid rgba(255, 255, 255, 0.05); }
        .brand-logo { font-size: 50px; font-weight: 800; color: #fff; letter-spacing: 1.5px; }
        .brand-logo span { color: #F5A623; }
        .brand-sub { font-size: 13px; color: rgba(255,255,255,.5); margin-top: 8px; letter-spacing: 3px; text-transform: uppercase; font-weight: 600; }
        .brand-desc { margin-top: 32px; text-align: center; max-width: 380px; }
        .brand-desc p { font-size: 15px; color: #94A3B8; line-height: 1.6; }
        .login-right { width: 500px; background: #070E1A; display: flex; align-items: center; justify-content: center; padding: 48px 40px; }
        .login-card { width: 100%; max-width: 380px; z-index: 2; }
        .login-card h2 { font-size: 28px; font-weight: 700; color: #FFFFFF; margin-bottom: 8px; letter-spacing: -0.5px; }
        .login-card .subtitle { font-size: 14px; color: #94A3B8; margin-bottom: 32px; }
        .form-group { margin-bottom: 20px; }
        .form-label { display: block; font-size: 13px; font-weight: 600; color: #CBD5E1; margin-bottom: 8px; }
        .form-control { width: 100%; padding: 12px 16px; border: 1.5px solid #1e2f4c; border-radius: 12px; font-size: 14px; color: #fff; background: #0d1b32; outline: none; }
        .form-control:focus { border-color: #F5A623; }
        .btn-login { width: 100%; padding: 13px 20px; background: linear-gradient(135deg, #e8941a, #F5A623); color: #070e17; border: none; border-radius: 12px; font-size: 15px; font-weight: 700; cursor: pointer; margin-top: 8px; }
    </style>
</head>
<body>
<div class="login-wrapper">
    <div class="login-left">
        <div class="brand-logo">SK<span>O</span>TER</div>
        <div class="brand-sub">Sistem Koperasi Terpadu</div>
        <div class="brand-desc">
            <p>Silakan buat kata sandi baru yang kuat untuk menjaga keamanan akun koperasi Anda.</p>
        </div>
    </div>

    <div class="login-right">
        <div class="login-card">
            <h2>Kata Sandi Baru</h2>
            <p class="subtitle">Buat kata sandi baru untuk akun Anda</p>

            @if($errors->any())
                <div style="background:#3A1C1C;border-left:4px solid #EF4444;border-radius:8px;padding:14px;margin-bottom:20px;font-size:13.5px;color:#FF453A;font-weight:600;">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.reset.post') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label" for="password">Kata Sandi Baru</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Minimal 8 karakter" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="password_confirmation">Konfirmasi Kata Sandi Baru</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Ulangi kata sandi baru" required>
                </div>
                
                <button type="submit" class="btn-login">Simpan Kata Sandi</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
