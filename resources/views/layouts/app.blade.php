<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SKOTER') — Sistem Koperasi Terpadu</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --navy:      #19376D;
            --navy-dark: #0B2545;
            --navy-mid:  #1A4A8A;
            --gold:      #F5A623;
            --gold-light:#FFF3DC;
            --emerald:   #10B981;
            --emerald-light: #D1FAE5;
            --red:       #EF4444;
            --red-light: #FEE2E2;
            --blue-light:#EFF6FF;
            --gray-50:   #F9FAFB;
            --gray-100:  #F3F4F6;
            --gray-200:  #E5E7EB;
            --gray-300:  #D1D5DB;
            --gray-500:  #6B7280;
            --gray-700:  #374151;
            --gray-900:  #111827;
            --white:     #FFFFFF;
            --sidebar-w: 260px;
        }

        * { margin:0; padding:0; box-sizing:border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--gray-50);
            color: var(--gray-900);
            display: flex;
            min-height: 100vh;
        }

        /* ── Sidebar ── */
        .sidebar {
            width: var(--sidebar-w);
            background: linear-gradient(160deg, var(--navy-dark) 0%, var(--navy) 60%, var(--navy-mid) 100%);
            min-height: 100vh;
            position: fixed;
            top: 0; left: 0;
            display: flex;
            flex-direction: column;
            z-index: 100;
            box-shadow: 4px 0 20px rgba(11,37,69,.35);
        }

        .sidebar-brand {
            padding: 28px 24px 20px;
            border-bottom: 1px solid rgba(255,255,255,.1);
        }
        .sidebar-brand h1 {
            font-family: 'Poppins', sans-serif;
            font-size: 24px;
            font-weight: 700;
            color: #fff;
            letter-spacing: 1px;
        }
        .sidebar-brand p {
            font-size: 11px;
            color: rgba(255,255,255,.55);
            margin-top: 2px;
            letter-spacing: .5px;
        }

        .sidebar-user {
            padding: 16px 20px;
            margin: 12px 16px;
            background: rgba(255,255,255,.08);
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .sidebar-user .avatar {
            width: 38px; height: 38px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--gold), #e8941a);
            display: flex; align-items: center; justify-content: center;
            font-size: 15px; font-weight: 700; color: #fff;
            flex-shrink: 0;
        }
        .sidebar-user .user-info .name {
            font-size: 13px; font-weight: 600; color: #fff;
        }
        .sidebar-user .user-info .role {
            font-size: 11px; color: rgba(255,255,255,.5);
            text-transform: capitalize;
        }

        .sidebar-nav { flex: 1; padding: 8px 0; overflow-y: auto; }

        .nav-section-label {
            font-size: 10px;
            font-weight: 600;
            color: rgba(255,255,255,.35);
            letter-spacing: 1.2px;
            text-transform: uppercase;
            padding: 16px 24px 6px;
        }

        .nav-item {
            display: flex; align-items: center; gap: 12px;
            padding: 11px 20px 11px 24px;
            margin: 2px 12px;
            border-radius: 10px;
            text-decoration: none;
            color: rgba(255,255,255,.7);
            font-size: 13.5px;
            font-weight: 500;
            transition: all .2s ease;
            position: relative;
        }
        .nav-item:hover {
            background: rgba(255,255,255,.1);
            color: #fff;
        }
        .nav-item.active {
            background: rgba(255,255,255,.15);
            color: #fff;
            font-weight: 600;
        }
        .nav-item.active::before {
            content: '';
            position: absolute;
            left: -12px; top: 50%;
            transform: translateY(-50%);
            width: 4px; height: 20px;
            background: var(--gold);
            border-radius: 0 4px 4px 0;
        }
        .nav-item svg { width: 18px; height: 18px; flex-shrink: 0; }
        .nav-badge {
            margin-left: auto;
            background: var(--red);
            color: #fff;
            font-size: 10px;
            font-weight: 700;
            padding: 1px 7px;
            border-radius: 20px;
            min-width: 20px;
            text-align: center;
        }

        .sidebar-footer {
            padding: 16px;
            border-top: 1px solid rgba(255,255,255,.08);
        }
        .logout-btn {
            display: flex; align-items: center; gap: 10px;
            width: 100%;
            padding: 10px 16px;
            border-radius: 10px;
            background: rgba(239,68,68,.15);
            border: 1px solid rgba(239,68,68,.25);
            color: #fca5a5;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            transition: all .2s;
        }
        .logout-btn:hover { background: rgba(239,68,68,.25); color: #fff; }

        /* ── Main ── */
        .main-wrapper {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .topbar {
            background: #fff;
            border-bottom: 1px solid var(--gray-200);
            padding: 0 32px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky; top: 0;
            z-index: 50;
        }
        .topbar-title {
            font-family: 'Poppins', sans-serif;
            font-size: 18px;
            font-weight: 600;
            color: var(--navy-dark);
        }
        .topbar-right {
            display: flex; align-items: center; gap: 12px;
        }
        .topbar-date {
            font-size: 12px; color: var(--gray-500);
        }

        .page-content {
            padding: 28px 32px;
            flex: 1;
        }

        /* ── Cards ── */
        .card {
            background: #fff;
            border-radius: 16px;
            border: 1px solid var(--gray-200);
            padding: 24px;
            box-shadow: 0 1px 4px rgba(0,0,0,.04);
        }
        .card-title {
            font-family: 'Poppins', sans-serif;
            font-size: 15px;
            font-weight: 600;
            color: var(--gray-900);
            margin-bottom: 16px;
            display: flex; align-items: center; gap: 8px;
        }

        /* ── Stat cards ── */
        .stat-grid { display: grid; gap: 20px; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); margin-bottom: 28px; }
        .stat-card {
            background: #fff;
            border-radius: 16px;
            border: 1px solid var(--gray-200);
            padding: 22px;
            display: flex; align-items: center; gap: 16px;
            box-shadow: 0 1px 4px rgba(0,0,0,.04);
            transition: transform .2s, box-shadow .2s;
        }
        .stat-card:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0,0,0,.08); }
        .stat-icon {
            width: 52px; height: 52px;
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
        }
        .stat-icon.blue   { background: var(--blue-light); }
        .stat-icon.gold   { background: var(--gold-light); }
        .stat-icon.green  { background: var(--emerald-light); }
        .stat-icon.red    { background: var(--red-light); }
        .stat-label { font-size: 12px; color: var(--gray-500); margin-bottom: 4px; }
        .stat-value { font-family: 'Poppins',sans-serif; font-size: 20px; font-weight: 700; color: var(--gray-900); }
        .stat-value.sm { font-size: 16px; }

        /* ── Badges ── */
        .badge {
            display: inline-flex; align-items: center;
            padding: 3px 10px; border-radius: 20px;
            font-size: 11.5px; font-weight: 600;
        }
        .badge-pending  { background: #FEF3C7; color: #92400E; }
        .badge-success  { background: var(--emerald-light); color: #065F46; }
        .badge-approved { background: var(--emerald-light); color: #065F46; }
        .badge-rejected { background: var(--red-light); color: #991B1B; }

        /* ── Table ── */
        .table-wrap { overflow-x: auto; border-radius: 12px; border: 1px solid var(--gray-200); }
        table { width: 100%; border-collapse: collapse; }
        thead th {
            background: var(--gray-50);
            padding: 12px 16px;
            text-align: left;
            font-size: 11px;
            font-weight: 600;
            color: var(--gray-500);
            letter-spacing: .6px;
            text-transform: uppercase;
            border-bottom: 1px solid var(--gray-200);
        }
        tbody td {
            padding: 14px 16px;
            font-size: 13.5px;
            color: var(--gray-700);
            border-bottom: 1px solid var(--gray-100);
        }
        tbody tr:last-child td { border-bottom: none; }
        tbody tr:hover { background: var(--gray-50); }

        /* ── Forms ── */
        .form-group { margin-bottom: 20px; }
        .form-label {
            display: block; font-size: 13px; font-weight: 500;
            color: var(--gray-700); margin-bottom: 6px;
        }
        .form-label span.req { color: var(--red); margin-left: 2px; }
        .form-control {
            width: 100%; padding: 10px 14px;
            border: 1.5px solid var(--gray-300);
            border-radius: 10px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            color: var(--gray-900);
            background: #fff;
            transition: border-color .2s, box-shadow .2s;
            outline: none;
        }
        .form-control:focus {
            border-color: var(--navy);
            box-shadow: 0 0 0 3px rgba(25,55,109,.08);
        }
        .form-control.is-invalid { border-color: var(--red); }
        .invalid-feedback { font-size: 12px; color: var(--red); margin-top: 4px; }
        textarea.form-control { resize: vertical; min-height: 100px; }
        select.form-control { cursor: pointer; }

        /* ── Buttons ── */
        .btn {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 10px 20px; border-radius: 10px;
            font-size: 13.5px; font-weight: 600;
            cursor: pointer; border: none;
            text-decoration: none;
            transition: all .2s;
        }
        .btn-primary {
            background: linear-gradient(135deg, var(--navy), var(--navy-mid));
            color: #fff;
            box-shadow: 0 3px 10px rgba(25,55,109,.25);
        }
        .btn-primary:hover { box-shadow: 0 6px 18px rgba(25,55,109,.35); transform: translateY(-1px); }
        .btn-success {
            background: linear-gradient(135deg, #059669, var(--emerald));
            color: #fff;
            box-shadow: 0 3px 10px rgba(16,185,129,.25);
        }
        .btn-success:hover { box-shadow: 0 6px 18px rgba(16,185,129,.35); transform: translateY(-1px); }
        .btn-danger {
            background: linear-gradient(135deg, #DC2626, var(--red));
            color: #fff;
            box-shadow: 0 3px 10px rgba(239,68,68,.25);
        }
        .btn-danger:hover { box-shadow: 0 6px 18px rgba(239,68,68,.35); transform: translateY(-1px); }
        .btn-outline {
            background: transparent;
            color: var(--navy);
            border: 1.5px solid var(--navy);
        }
        .btn-outline:hover { background: var(--navy); color: #fff; }
        .btn-sm { padding: 6px 14px; font-size: 12.5px; border-radius: 8px; }
        .btn-gold {
            background: linear-gradient(135deg, #e8941a, var(--gold));
            color: #fff;
            box-shadow: 0 3px 10px rgba(245,166,35,.3);
        }
        .btn-gold:hover { box-shadow: 0 6px 18px rgba(245,166,35,.4); transform: translateY(-1px); }

        /* ── Alerts ── */
        .alert {
            padding: 14px 18px; border-radius: 12px;
            margin-bottom: 20px; font-size: 13.5px;
            display: flex; align-items: center; gap: 10px;
        }
        .alert-success { background: var(--emerald-light); color: #065F46; border: 1px solid #A7F3D0; }
        .alert-error   { background: var(--red-light); color: #991B1B; border: 1px solid #FECACA; }
        .alert-warning { background: #FEF3C7; color: #92400E; border: 1px solid #FDE68A; }

        /* ── Pagination ── */
        .pagination-wrap { display: flex; justify-content: flex-end; margin-top: 16px; }
        .pagination { display: flex; gap: 4px; align-items: center; }
        .pagination a, .pagination span {
            display: inline-flex; align-items: center; justify-content: center;
            width: 34px; height: 34px; border-radius: 8px;
            font-size: 13px; font-weight: 500;
            border: 1px solid var(--gray-200);
            color: var(--gray-700); text-decoration: none;
            transition: all .15s;
        }
        .pagination a:hover { border-color: var(--navy); color: var(--navy); }
        .pagination .active span { background: var(--navy); color: #fff; border-color: var(--navy); }
        .pagination .disabled span { color: var(--gray-300); }

        /* ── Misc ── */
        .page-header { margin-bottom: 24px; }
        .page-header h2 { font-family:'Poppins',sans-serif; font-size:22px; font-weight:700; color:var(--navy-dark); }
        .page-header p  { font-size:13.5px; color:var(--gray-500); margin-top:3px; }
        .text-right { text-align: right; }
        .mt-4 { margin-top: 16px; }
        .mt-6 { margin-top: 24px; }
        .mb-4 { margin-bottom: 16px; }
        .flex { display: flex; }
        .items-center { align-items: center; }
        .justify-between { justify-content: space-between; }
        .gap-3 { gap: 12px; }
        .gap-4 { gap: 16px; }
        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .grid-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px; }
        .w-full { width: 100%; }

        /* ── Upload area ── */
        .upload-area {
            border: 2px dashed var(--gray-300);
            border-radius: 12px;
            padding: 32px;
            text-align: center;
            cursor: pointer;
            transition: all .2s;
        }
        .upload-area:hover { border-color: var(--navy); background: var(--blue-light); }
        .upload-area input[type=file] { display: none; }
        .upload-area p { font-size: 13px; color: var(--gray-500); margin-top: 8px; }
        .upload-area .icon { font-size: 32px; }
        .upload-label { font-size: 13.5px; font-weight: 600; color: var(--navy); cursor: pointer; }

        @media(max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .main-wrapper { margin-left: 0; }
            .grid-2, .grid-3 { grid-template-columns: 1fr; }
        }
    </style>
    @stack('styles')
</head>
<body>

{{-- Sidebar --}}
<aside class="sidebar">
    <div class="sidebar-brand">
        <h1>🏦 SKOTER</h1>
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
</body>
</html>
