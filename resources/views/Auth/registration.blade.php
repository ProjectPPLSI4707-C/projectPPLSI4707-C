<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi — SKOTER</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body, html { height: 100%; font-family: 'Poppins', sans-serif; }

        .register-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* Left panel */
        .register-left {
            flex: 1.2;
            background: linear-gradient(160deg, #0B2545 0%, #19376D 55%, #1A4A8A 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 60px 48px;
            position: relative;
            overflow: hidden;
        }
        .register-left::before {
            content: '';
            position: absolute;
            width: 400px; height: 400px;
            border-radius: 50%;
            background: rgba(255,255,255,.04);
            top: -100px; right: -100px;
        }
        .register-left::after {
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
        .register-right {
            width: 540px;
            background: #F9FAFB;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px 40px;
        }
        .register-card {
            width: 100%;
            max-width: 440px;
        }
        .register-card h2 {
            font-size: 26px;
            font-weight: 700;
            color: #0B2545;
            margin-bottom: 6px;
        }
        .register-card .subtitle {
            font-size: 13px;
            color: #6B7280;
            margin-bottom: 24px;
        }

        .form-group { margin-bottom: 16px; }
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

        .btn-register {
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
        .btn-register:hover {
            box-shadow: 0 8px 20px rgba(25,55,109,.45);
            transform: translateY(-1px);
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            font-size: 13px;
            color: #6B7280;
        }
        .login-link a {
            color: #19376D;
            text-decoration: none;
            font-weight: 600;
        }
        .login-link a:hover {
            text-decoration: underline;
        }

        @media(max-width: 992px) {
            .register-left { display: none; }
            .register-right { width: 100%; }
        }
    </style>
</head>
<body>
<div class="register-wrapper">
    {{-- Left --}}
    <div class="register-left">
        <div class="brand-logo">SK<span>O</span>TER</div>
        <div class="brand-sub">Sistem Koperasi Terpadu</div>
        <div class="brand-desc">
            <p>Bergabunglah bersama kami untuk menikmati kemudahan layanan koperasi terintegrasi di genggaman Anda.</p>
        </div>
        <div class="features">
            <div class="feature-item">
                <div class="feature-icon">📝</div>
                <span>Pendaftaran Cepat & Tanpa Ribet</span>
            </div>
            <div class="feature-item">
                <div class="feature-icon">🛡️</div>
                <span>Keamanan Data & Privasi Terjamin</span>
            </div>
            <div class="feature-item">
                <div class="feature-icon">🤝</div>
                <span>Akses Penuh Layanan Simpan Pinjam</span>
            </div>
        </div>
    </div>

    {{-- Right --}}
    <div class="register-right">
        <div class="register-card">
            <h2>Registrasi Anggota</h2>
            <p class="subtitle">Buat akun SKOTER baru Anda</p>

            <form method="POST" action="{{ route('register.post') }}">
                @csrf
                
                {{-- Nama Lengkap --}}
                <div class="form-group">
                    <label class="form-label" for="name">Nama Lengkap</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                        value="{{ old('name') }}"
                        placeholder="Nama Lengkap Anda"
                        required
                    >
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="form-group">
                    <label class="form-label" for="email">Alamat Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                        value="{{ old('email') }}"
                        placeholder="contoh@email.com"
                        required
                    >
                    @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Nomor Telepon --}}
                <div class="form-group">
                    <label class="form-label" for="phone">Nomor Telepon</label>
                    <input
                        type="text"
                        id="phone"
                        name="phone"
                        class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                        value="{{ old('phone') }}"
                        placeholder="0812xxxxxxxx"
                        required
                    >
                    @error('phone')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                        placeholder="••••••••"
                        required
                    >
                    @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Konfirmasi Password --}}
                <div class="form-group">
                    <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        class="form-control"
                        placeholder="••••••••"
                        required
                    >
                </div>

                <button type="submit" class="btn-register">Registrasi</button>
            </form>

            <div class="login-link">
                Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>