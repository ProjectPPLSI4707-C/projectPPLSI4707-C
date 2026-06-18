<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi — SKOTER</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body, html { height: 100%; font-family: 'Inter', sans-serif; background-color: #070e17; color: #fff; overflow-x: hidden; }

        .register-wrapper {
            display: flex;
            min-height: 100vh;
            width: 100%;
        }

        /* Left side - Cinematic Brand Section */
        .register-left {
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
        
        .register-left::before {
            content: '';
            position: absolute;
            width: 500px; height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(245, 166, 35, 0.05) 0%, transparent 70%);
            top: -200px; right: -150px;
            pointer-events: none;
        }

        .register-left::after {
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

        /* Right side - Register Form Panel */
        .register-right {
            width: 540px;
            background: #070E1A;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px 40px;
            position: relative;
        }

        .register-card {
            width: 100%;
            max-width: 440px;
            z-index: 2;
        }
        .register-card h2 {
            font-size: 28px;
            font-weight: 700;
            color: #FFFFFF;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }
        .register-card .subtitle {
            font-size: 14px;
            color: #94A3B8;
            margin-bottom: 24px;
        }

        .form-group { margin-bottom: 16px; }
        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #CBD5E1;
            margin-bottom: 6px;
        }
        .form-control {
            width: 100%;
            padding: 11px 14px;
            border: 1.5px solid #1e2f4c;
            border-radius: 10px;
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

        .btn-register {
            width: 100%;
            padding: 13px 20px;
            background: linear-gradient(135deg, #e8941a, #F5A623);
            color: #070e17;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            margin-top: 8px;
            box-shadow: 0 4px 14px rgba(245,166,35,.25);
            transition: all .25s ease;
        }
        .btn-register:hover {
            box-shadow: 0 6px 20px rgba(245,166,35,.35);
            transform: translateY(-1px);
        }
        .btn-register:active {
            transform: translateY(0);
        }

        .login-link {
            text-align: center;
            margin-top: 24px;
            font-size: 13.5px;
            color: #94A3B8;
        }
        .login-link a {
            color: #F5A623;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }
        .login-link a:hover {
            color: #e8941a;
            text-decoration: underline;
        }

        @media(max-width: 992px) {
            .register-left { display: none; }
            .register-right { width: 100%; padding: 32px 24px; }
        }
    </style>
</head>
<body>
<div class="register-wrapper">
    {{-- Left Section --}}
    <div class="register-left">
        <div class="brand-logo">SK<span>O</span>TER</div>
        <div class="brand-sub">Sistem Koperasi Terpadu</div>
        <div class="brand-desc">
            <p>Bergabunglah bersama ribuan anggota koperasi lainnya dan rasakan ekosistem koperasi digital paling aman, cepat, dan terpercaya.</p>
        </div>
        <div class="features">
            <div class="feature-item">
                <div class="feature-icon">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="20" height="20"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                </div>
                <span>Pengisian Data Anggota yang Singkat & Praktis</span>
            </div>
            <div class="feature-item">
                <div class="feature-icon">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="20" height="20"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <span>Standar Keamanan Enkripsi Data Tertinggi</span>
            </div>
            <div class="feature-item">
                <div class="feature-icon">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="20" height="20"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
                <span>Terhubung Instan dengan Ribuan Rekan Koperasi</span>
            </div>
        </div>
    </div>

    {{-- Right Section --}}
    <div class="register-right">
        <div class="register-card">
            <h2>Pendaftaran Anggota</h2>
            <p class="subtitle">Buat akun untuk memulai layanan koperasi Anda</p>

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
                        placeholder="Masukkan nama lengkap Anda"
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
                    <label class="form-label" for="password">Kata Sandi</label>
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
                    <label class="form-label" for="password_confirmation">Konfirmasi Kata Sandi</label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        class="form-control"
                        placeholder="••••••••"
                        required
                    >
                </div>

                <button type="submit" class="btn-register">Daftar Sekarang</button>
            </form>

            <div class="login-link">
                Sudah memiliki akun? <a href="{{ route('login') }}">Masuk di sini</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>