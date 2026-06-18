<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SKOTER') — Sistem Koperasi Terpadu</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            /* Premium Dark Navy & Gold Palette */
            --primary:       #F5A623; /* Gold */
            --primary-dark:  #e8941a;
            --navy-light:    #3B82F6; /* Blue for primary actions */
            --navy-dark:     #070E1A; /* Base body background */
            --navy-mid:      #1E3A8A;
            --gold:          #F5A623;
            --gold-light:    rgba(245, 166, 35, 0.08);
            --emerald:       #10B981;
            --emerald-light: rgba(16, 185, 129, 0.12);
            --red:           #EF4444;
            --red-light:     rgba(239, 68, 68, 0.12);
            --blue-light:    rgba(59, 130, 246, 0.12);
            --gray-50:       #070E1A; /* Dark Background */
            --gray-100:      #11213C; /* Active / Hover */
            --gray-200:      #1A2F50; /* Borders */
            --gray-300:      #28436E; /* Form borders */
            --gray-400:      #64748B; /* Muted text */
            --gray-500:      #94A3B8; /* Secondary text */
            --gray-600:      #CBD5E1; /* Secondary labels */
            --gray-700:      #E2E8F0; /* Standard readable text */
            --gray-800:      #F8FAFC; /* Primary text / Highlights */
            --gray-900:      #FFFFFF; /* White */
            --white:         #0D1B32; /* Card / Surface background */
            --sidebar-w:     264px;

            /* Base canvas variables for Dark Mode */
            --body-bg:       #070E1A;
            --body-text-main: #FFFFFF;
            --body-text-muted: #94A3B8;
        }

        body.light-mode {
            --body-bg:       #FFFFFF;
            --body-text-main: #0F172A;
            --body-text-muted: #475569;
        }

        * { margin:0; padding:0; box-sizing:border-box; }

        body {
            font-family: 'Inter', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: var(--body-bg);
            color: var(--body-text-muted);
            display: flex;
            min-height: 100vh;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        /* ── Sidebar ── */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--white);
            height: 100vh;
            position: fixed;
            top: 0; left: 0;
            display: flex;
            flex-direction: column;
            z-index: 100;
            border-right: 1px solid var(--gray-200);
        }

        .sidebar-brand {
            padding: 32px 24px 24px;
            border-bottom: 1px solid var(--gray-200);
        }
        .sidebar-brand h1 {
            font-family: 'Inter', sans-serif;
            font-size: 22px;
            font-weight: 700;
            color: var(--gray-900);
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .sidebar-brand h1 span {
            color: var(--gold);
        }
        .sidebar-brand p {
            font-size: 12px;
            color: var(--gray-500);
            margin-top: 6px;
            letter-spacing: 0;
        }

        .sidebar-user {
            padding: 16px;
            margin: 16px;
            background: var(--gray-100);
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 12px;
            border: 1px solid var(--gray-200);
        }
        .sidebar-user .avatar {
            width: 40px; height: 40px;
            border-radius: 50%;
            background: var(--navy-light);
            display: flex; align-items: center; justify-content: center;
            font-size: 15px; font-weight: 700; color: #fff;
            flex-shrink: 0;
            box-shadow: 0 4px 10px rgba(59, 130, 246, 0.3);
        }
        .sidebar-user .user-info .name {
            font-size: 14px; font-weight: 600; color: var(--gray-900);
        }
        .sidebar-user .user-info .role {
            font-size: 12px; color: var(--gray-500);
            text-transform: capitalize;
        }

        .sidebar-nav { flex: 1; padding: 8px 8px 24px; overflow-y: auto; }

        .nav-section-label {
            font-size: 10px;
            font-weight: 600;
            color: var(--gray-500);
            letter-spacing: .08em;
            text-transform: uppercase;
            padding: 24px 16px 8px;
        }

        .nav-item {
            display: flex; align-items: center; gap: 10px;
            padding: 12px 16px;
            margin: 4px 0;
            border-radius: 12px;
            text-decoration: none;
            color: var(--gray-500);
            font-size: 14px;
            font-weight: 500;
            transition: all .25s ease;
            position: relative;
        }
        .nav-item:hover {
            background: var(--gray-100);
            color: var(--gray-900);
        }
        .nav-item.active {
            background: var(--gold);
            color: #070E1A;
            font-weight: 600;
            box-shadow: 0 4px 14px rgba(245, 166, 35, 0.25);
        }
        .nav-item svg { width: 17px; height: 17px; flex-shrink: 0; opacity: .78; }
        .nav-item.active svg { opacity: 1; }
        
        .nav-badge {
            margin-left: auto;
            background: var(--red);
            color: #fff;
            font-size: 10px;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 20px;
            min-width: 20px;
            text-align: center;
        }

        .sidebar-footer {
            padding: 16px;
            border-top: 1px solid var(--gray-200);
        }
        .logout-btn {
            display: flex; align-items: center; gap: 10px;
            width: 100%;
            padding: 11px 16px;
            border-radius: 12px;
            background: var(--gray-100);
            border: 1px solid var(--gray-200);
            color: var(--gray-700);
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all .2s;
        }
        .logout-btn:hover { background: var(--red-light); color: var(--red); border-color: rgba(239, 68, 68, 0.2); }

        /* ── Main ── */
        .main-wrapper {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .topbar {
            background: var(--white);
            border-bottom: 1px solid var(--gray-200);
            padding: 0 48px;
            height: 72px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky; top: 0;
            z-index: 50;
        }
        .topbar-title {
            font-family: 'Inter', sans-serif;
            font-size: 18px;
            font-weight: 600;
            color: var(--gray-900);
        }
        .topbar-right {
            display: flex; align-items: center; gap: 12px;
        }
        .topbar-date {
            font-size: 12px; color: var(--gray-500);
            font-weight: 500;
        }

        .page-content {
            padding: 40px 48px 64px;
            flex: 1;
            max-width: 1440px;
            width: 100%;
        }

        /* ── Cards ── */
        .card {
            background: var(--white);
            border-radius: 16px;
            border: 1px solid var(--gray-200);
            padding: 24px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .card-title {
            font-family: 'Inter', sans-serif;
            font-size: 16px;
            font-weight: 600;
            color: var(--gray-900);
            margin-bottom: 20px;
            display: flex; align-items: center; gap: 8px;
        }

        /* ── Stat cards ── */
        .stat-grid { display: grid; gap: 16px; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); margin-bottom: 32px; }
        .stat-card {
            background: var(--white);
            border-radius: 16px;
            border: 1px solid var(--gray-200);
            padding: 24px;
            display: flex; align-items: center; gap: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            transition: transform .25s ease, border-color .25s ease;
        }
        .stat-card:hover { transform: translateY(-2px); border-color: var(--primary); }
        .stat-icon {
            width: 48px; height: 48px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }
        .stat-icon.blue   { background: var(--blue-light); color: var(--navy-light); }
        .stat-icon.gold   { background: var(--gold-light); color: var(--gold); }
        .stat-icon.green  { background: var(--emerald-light); color: var(--emerald); }
        .stat-icon.red    { background: var(--red-light); color: var(--red); }
        .stat-label { font-size: 13px; color: var(--gray-500); margin-bottom: 8px; font-weight: 550; }
        .stat-value { font-family: 'JetBrains Mono', monospace; font-size: 26px; font-weight: 700; color: var(--gray-900); letter-spacing: -0.5px; }
        .stat-value.sm { font-size: 20px; }

        /* ── Badges ── */
        .badge {
            display: inline-flex; align-items: center;
            padding: 4px 12px; border-radius: 999px;
            font-size: 11px; font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .badge-pending  { background: var(--gold-light); color: var(--gold); border: 1px solid rgba(245, 166, 35, 0.2); }
        .badge-success  { background: var(--emerald-light); color: var(--emerald); border: 1px solid rgba(16, 185, 129, 0.2); }
        .badge-approved { background: var(--emerald-light); color: var(--emerald); border: 1px solid rgba(16, 185, 129, 0.2); }
        .badge-rejected { background: var(--red-light); color: var(--red); border: 1px solid rgba(239, 68, 68, 0.2); }

        /* ── Table ── */
        .table-wrap { overflow-x: auto; border-radius: 12px; border: 1px solid var(--gray-200); }
        table { width: 100%; border-collapse: collapse; }
        thead th {
            background: var(--gray-100);
            padding: 16px;
            text-align: left;
            font-size: 11px;
            font-weight: 600;
            color: var(--gray-500);
            letter-spacing: .08em;
            text-transform: uppercase;
            border-bottom: 1px solid var(--gray-200);
        }
        tbody td {
            padding: 16px;
            font-size: 14px;
            color: var(--gray-600);
            border-bottom: 1px solid var(--gray-200);
        }
        tbody tr:last-child td { border-bottom: none; }
        tbody tr:hover { background: var(--gray-100); }

        /* ── Forms ── */
        .form-group { margin-bottom: 20px; }
        .form-label {
            display: block; font-size: 13px; font-weight: 600;
            color: var(--gray-600); margin-bottom: 8px;
        }
        .form-label span.req { color: var(--red); margin-left: 2px; }
        .form-control {
            width: 100%; padding: 11px 14px;
            border: 1.5px solid var(--gray-300);
            border-radius: 10px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            color: var(--gray-900);
            background: var(--white);
            transition: border-color .2s, box-shadow .2s;
            outline: none;
        }
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(245, 166, 35, 0.15);
        }
        .form-control.is-invalid { border-color: var(--red); }
        .invalid-feedback { font-size: 12px; color: var(--red); margin-top: 4px; }
        textarea.form-control { resize: vertical; min-height: 100px; }
        select.form-control { cursor: pointer; }

        /* ── Buttons ── */
        .btn {
            display: inline-flex; align-items: center; justify-content: center; gap: 8px;
            padding: 11px 22px; border-radius: 999px;
            font-size: 14px; font-weight: 600;
            cursor: pointer; border: none;
            text-decoration: none;
            transition: all .25s ease;
        }
        .btn-primary {
            background: var(--navy-light);
            color: #fff;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.2);
        }
        .btn-primary:hover { background: #2563EB; transform: translateY(-1px); box-shadow: 0 6px 16px rgba(59, 130, 246, 0.3); }
        .btn-success {
            background: var(--emerald);
            color: #fff;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
        }
        .btn-success:hover { filter: brightness(1.1); transform: translateY(-1px); }
        .btn-danger {
            background: var(--red);
            color: #fff;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);
        }
        .btn-danger:hover { filter: brightness(1.1); transform: translateY(-1px); }
        .btn-outline {
            background: transparent;
            color: var(--primary);
            border: 1.5px solid var(--primary);
        }
        .btn-outline:hover { background: var(--primary); color: #070e1a; transform: translateY(-1px); }
        .btn-sm { padding: 8px 16px; font-size: 12.5px; border-radius: 999px; }
        .btn-gold {
            background: var(--gold);
            color: #070E1A;
            box-shadow: 0 4px 12px rgba(245, 166, 35, 0.2);
        }
        .btn-gold:hover { filter: brightness(1.1); transform: translateY(-1px); }

        /* ── Alerts / Notifications ── */
        .alert {
            padding: 16px 20px; border-radius: 12px;
            margin-bottom: 24px; font-size: 14px;
            display: flex; align-items: center; gap: 12px;
            font-weight: 550;
        }
        .alert-success { background: #0F2C20; color: #32D74B; border-left: 4px solid var(--emerald); }
        .alert-error   { background: #3A1C1C; color: #FF453A; border-left: 4px solid var(--red); }
        .alert-warning { background: #3A2C1C; color: #FFA83A; border-left: 4px solid var(--gold); }

        /* ── Pagination ── */
        .pagination-wrap { display: flex; justify-content: flex-end; margin-top: 16px; }
        .pagination { display: flex; gap: 4px; align-items: center; }
        .pagination a, .pagination span {
            display: inline-flex; align-items: center; justify-content: center;
            width: 34px; height: 34px; border-radius: 8px;
            font-size: 13px; font-weight: 500;
            border: 1px solid var(--gray-200);
            color: var(--gray-500); text-decoration: none;
            transition: all .15s;
        }
        .pagination a:hover { border-color: var(--primary); color: var(--primary); }
        .pagination .active span { background: var(--primary); color: #070e1a; border-color: var(--primary); font-weight: 600; }
        .pagination .disabled span { color: var(--gray-300); border-color: var(--gray-200); }

        /* ── Theme Toggle Button ── */
        .theme-toggle-btn {
            background: transparent;
            border: 1px solid var(--gray-200);
            color: var(--gray-500);
            width: 38px;
            height: 38px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.25s ease;
            outline: none;
            margin-left: 12px;
        }
        .theme-toggle-btn:hover {
            border-color: var(--primary);
            color: var(--primary);
            transform: scale(1.05) rotate(15deg);
        }

        /* ── Light Mode Pagination Override ── */
        body.light-mode .pagination a, body.light-mode .pagination span {
            border-color: #E2E8F0;
            color: #64748B;
        }
        body.light-mode .pagination a:hover {
            border-color: var(--primary);
            color: var(--primary);
        }
        body.light-mode .pagination .disabled span {
            color: #CBD5E1;
            border-color: #E2E8F0;
        }

        /* ── Misc ── */
        .page-header { margin-bottom: 32px; }
        .page-header h2 { font-family:'Inter',sans-serif; font-size:28px; font-weight:700; color:var(--body-text-main); letter-spacing:-0.5px; transition: color 0.3s ease; }
        .page-header p  { font-size:15px; color:var(--body-text-muted); margin-top:8px; line-height:1.6; transition: color 0.3s ease; }
        .text-right { text-align: right; }
        .mt-4 { margin-top: 16px; }
        .mt-6 { margin-top: 24px; }
        .mb-4 { margin-bottom: 16px; }
        .flex { display: flex; }
        .items-center { align-items: center; }
        .justify-between { justify-content: space-between; }
        .gap-3 { gap: 12px; }
        .gap-4 { gap: 16px; }
        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; }
        .grid-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 24px; }
        .w-full { width: 100%; }

        /* ── Upload area ── */
        .upload-area {
            border: 2.5px dashed var(--gray-200);
            border-radius: 12px;
            padding: 32px;
            text-align: center;
            cursor: pointer;
            transition: all .25s ease;
            background: var(--gray-50);
        }
        .upload-area:hover { border-color: var(--primary); background: var(--gray-100); }
        .upload-area input[type=file] { display: none; }
        .upload-area p { font-size: 13px; color: var(--gray-500); margin-top: 8px; }
        .upload-area .icon { font-size: 32px; }
        .upload-label { font-size: 13.5px; font-weight: 600; color: var(--primary); cursor: pointer; }

        /* Overrides for hardcoded inline colors in sub-pages for Dark Mode compatibility */
        [style*="color:#111827"], [style*="color: #111827"],
        [style*="color:var(--gray-900)"], [style*="color: var(--gray-900)"] {
            color: var(--gray-800) !important;
        }
        [style*="color:#6B7280"], [style*="color: #6B7280"],
        [style*="color:#374151"], [style*="color: #374151"] {
            color: var(--gray-500) !important;
        }
        [style*="color:#9CA3AF"], [style*="color: #9CA3AF"] {
            color: var(--gray-400) !important;
        }
        [style*="border-bottom:1px solid #F3F4F6"], [style*="border-bottom: 1px solid #F3F4F6"],
        [style*="border-bottom:1px solid #E5E7EB"], [style*="border-bottom: 1px solid #E5E7EB"] {
            border-bottom: 1px solid var(--gray-200) !important;
        }
        [style*="background:#F3F4F6"], [style*="background: #F3F4F6"],
        [style*="background:#F9FAFB"], [style*="background: #F9FAFB"] {
            background: var(--gray-50) !important;
        }
        [style*="background:#fff"], [style*="background: #fff"],
        [style*="background:#FFFFFF"], [style*="background: #FFFFFF"] {
            background: var(--white) !important;
        }
        [style*="background:var(--blue-light)"], [style*="background: var(--blue-light)"] {
            background: var(--gold-light) !important;
        }

        @media(max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .main-wrapper { margin-left: 0; }
            .topbar { padding: 0 24px; }
            .page-content { padding: 32px 24px 48px; }
            .grid-2, .grid-3 { grid-template-columns: 1fr; }
        }
    </style>
    @stack('styles')
</head>
<body>
<script>
    (function() {
        const theme = localStorage.getItem('theme') || 'dark';
        if (theme === 'light') {
            document.body.classList.add('light-mode');
        }
    })();
</script>

{{-- Sidebar --}}
<aside class="sidebar">
    <div class="sidebar-brand">
        <h1>SK<span>O</span>TER</h1>
        <p>Sistem Koperasi Terpadu</p>
    </div>

    <div class="sidebar-user">
        <div class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
        <div class="user-info">
            <div class="name">{{ auth()->user()->name }}</div>
            <div class="role">{{ ucfirst(auth()->user()->role) }}</div>
        </div>
    </div>

    <nav class="sidebar-nav">
        @if(auth()->user()->isAdmin())
            @include('layouts.partials.sidebar-admin')
        @else
            @include('layouts.partials.sidebar-anggota')
        @endif
    </nav>

    <div class="sidebar-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="16" height="16"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                Keluar
            </button>
        </form>
    </div>
</aside>

{{-- Main --}}
<div class="main-wrapper">
    <header class="topbar">
        <div class="topbar-title">@yield('page-title', 'Dashboard')</div>
        <div class="topbar-right">
            <span class="topbar-date">{{ now()->locale('id')->isoFormat('dddd, D MMMM Y') }}</span>
            <button id="theme-toggle" class="theme-toggle-btn" aria-label="Ubah Tema" title="Ubah Tema">
                <!-- Sun Icon -->
                <svg id="theme-sun" style="display:none;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="20" height="20"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m0-12.728l.707.707m12.728 12.728l.707.707M12 8a4 4 0 100 8 4 4 0 000-8z"/></svg>
                <!-- Moon Icon -->
                <svg id="theme-moon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="20" height="20"><path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
            </button>
        </div>
    </header>

    <main class="page-content">
        {{-- Flash messages --}}
        @if(session('success'))
            <div class="alert alert-success">✅ {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">❌ {{ session('error') }}</div>
        @endif

        @yield('content')
    </main>
</div>

@stack('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const themeToggleBtn = document.getElementById('theme-toggle');
        const sunIcon = document.getElementById('theme-sun');
        const moonIcon = document.getElementById('theme-moon');
        
        // Check local storage or preference
        const currentTheme = localStorage.getItem('theme') || 'dark';
        
        if (currentTheme === 'light') {
            sunIcon.style.display = 'block';
            moonIcon.style.display = 'none';
        } else {
            sunIcon.style.display = 'none';
            moonIcon.style.display = 'block';
        }
        
        themeToggleBtn.addEventListener('click', function() {
            if (document.body.classList.contains('light-mode')) {
                document.body.classList.remove('light-mode');
                localStorage.setItem('theme', 'dark');
                sunIcon.style.display = 'none';
                moonIcon.style.display = 'block';
            } else {
                document.body.classList.add('light-mode');
                localStorage.setItem('theme', 'light');
                sunIcon.style.display = 'block';
                moonIcon.style.display = 'none';
            }
        });
    });
</script>
</body>
</html>
