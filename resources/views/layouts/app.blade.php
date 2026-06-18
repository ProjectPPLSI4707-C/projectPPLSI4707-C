<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SKOTER') — Sistem Koperasi Terpadu</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* ══════════════════════════════════════════════════
           DESIGN TOKENS — DARK MODE (default)
           ══════════════════════════════════════════════════ */
        :root {
            --primary:        #F5A623;
            --primary-dark:   #e8941a;
            --navy-light:     #3B82F6;
            --navy-dark:      #070E1A;
            --gold:           #F5A623;
            --gold-light:     rgba(245, 166, 35, 0.10);
            --emerald:        #10B981;
            --emerald-light:  rgba(16, 185, 129, 0.12);
            --red:            #EF4444;
            --red-light:      rgba(239, 68, 68, 0.12);
            --blue-light:     rgba(59, 130, 246, 0.12);

            /* Shade ladder — dark */
            --bg:             #070E1A;
            --surface:        #0D1B32;
            --surface-raised: #11213C;
            --border:         #1A2F50;
            --border-form:    #28436E;
            --text-muted4:    #64748B;
            --text-muted3:    #94A3B8;
            --text-muted2:    #CBD5E1;
            --text-muted1:    #E2E8F0;
            --text-main:      #F8FAFC;
            --text-white:     #FFFFFF;

            /* Aliases kept for backward-compat */
            --gray-50:        var(--bg);
            --gray-100:       var(--surface-raised);
            --gray-200:       var(--border);
            --gray-300:       var(--border-form);
            --gray-400:       var(--text-muted4);
            --gray-500:       var(--text-muted3);
            --gray-600:       var(--text-muted2);
            --gray-700:       var(--text-muted1);
            --gray-800:       var(--text-main);
            --gray-900:       var(--text-white);
            --white:          var(--surface);

            --sidebar-w: 264px;
            --body-bg:        var(--bg);
            --body-text-main: var(--text-white);
            --body-text-muted:var(--text-muted3);
        }

        /* ══════════════════════════════════════════════════
           LIGHT MODE OVERRIDES
           ══════════════════════════════════════════════════ */
        body.light-mode {
            --bg:             #F8FAFC;
            --surface:        #FFFFFF;
            --surface-raised: #F1F5F9;
            --border:         rgba(11, 37, 69, 0.20);
            --border-form:    rgba(11, 37, 69, 0.30);
            --text-muted4:    #64748B;
            --text-muted3:    #475569;
            --text-muted2:    #334155;
            --text-muted1:    #1E293B;
            --text-main:      #0B2545;
            --text-white:     #0B2545;

            --gray-50:        var(--bg);
            --gray-100:       var(--surface-raised);
            --gray-200:       var(--border);
            --gray-300:       var(--border-form);
            --gray-400:       var(--text-muted4);
            --gray-500:       var(--text-muted3);
            --gray-600:       var(--text-muted2);
            --gray-700:       var(--text-muted1);
            --gray-800:       var(--text-main);
            --gray-900:       var(--text-main);
            --white:          var(--surface);

            --gold-light:     rgba(245, 166, 35, 0.07);
            --emerald-light:  rgba(16, 185, 129, 0.08);
            --red-light:      rgba(239, 68, 68, 0.08);
            --blue-light:     rgba(59, 130, 246, 0.08);

            --body-bg:        var(--bg);
            --body-text-main: var(--text-main);
            --body-text-muted:var(--text-muted3);
        }

        /* ══════════════════════════════════════════════════
           GLOBAL RESET — text overflow safe everywhere
           ══════════════════════════════════════════════════ */
        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            min-width: 0;            /* prevents flex children from escaping */
        }

        html { font-size: 16px; }

        body {
            font-family: 'Inter', ui-sans-serif, system-ui, -apple-system, sans-serif;
            background: var(--body-bg);
            color: var(--body-text-muted);
            display: flex;
            min-height: 100vh;
            transition: background-color 0.3s ease, color 0.3s ease;
            overflow-x: hidden;
        }

        /* Safe text — no overflow */
        p, span, div, td, th, li, h1, h2, h3, h4, h5, h6, a, label, button {
            word-wrap: break-word;
            overflow-wrap: break-word;
            max-width: 100%;
        }

        /* ══════════════════════════════════════════════════
           SIDEBAR OVERLAY (mobile)
           ══════════════════════════════════════════════════ */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.55);
            z-index: 99;
            backdrop-filter: blur(2px);
        }
        .sidebar-overlay.active { display: block; }

        /* ══════════════════════════════════════════════════
           SIDEBAR
           ══════════════════════════════════════════════════ */
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
            transition: transform 0.3s cubic-bezier(.4,0,.2,1), box-shadow 0.3s ease;
        }

        .sidebar-brand {
            padding: 28px 20px 20px;
            border-bottom: 1px solid var(--gray-200);
            flex-shrink: 0;
        }
        .sidebar-brand h1 {
            font-size: 22px;
            font-weight: 700;
            color: var(--gray-900);
            letter-spacing: 0.5px;
            display: inline-block;
        }
        .sidebar-brand h1 span { color: var(--gold); }
        .sidebar-brand p {
            font-size: 12px;
            color: var(--gray-500);
            margin-top: 4px;
        }

        .sidebar-user {
            padding: 12px;
            margin: 12px;
            background: var(--gray-100);
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
            border: 1px solid var(--gray-200);
            flex-shrink: 0;
            overflow: hidden;
        }
        .sidebar-user .avatar {
            width: 38px; height: 38px;
            border-radius: 50%;
            background: var(--navy-light);
            display: flex; align-items: center; justify-content: center;
            font-size: 14px; font-weight: 700; color: #fff;
            flex-shrink: 0;
            box-shadow: 0 4px 10px rgba(59, 130, 246, 0.3);
        }
        .sidebar-user .user-info {
            overflow: hidden;
            flex: 1;
        }
        .sidebar-user .user-info .name {
            font-size: 13px; font-weight: 600; color: var(--gray-900);
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }
        .sidebar-user .user-info .role {
            font-size: 11px; color: var(--gray-500);
            text-transform: capitalize;
        }

        .sidebar-nav {
            flex: 1;
            padding: 6px 8px 16px;
            overflow-y: auto;
            overflow-x: hidden;
            scrollbar-width: thin;
            scrollbar-color: var(--gray-200) transparent;
        }
        .sidebar-nav::-webkit-scrollbar { width: 4px; }
        .sidebar-nav::-webkit-scrollbar-track { background: transparent; }
        .sidebar-nav::-webkit-scrollbar-thumb { background: var(--gray-200); border-radius: 4px; }

        .nav-section-label {
            font-size: 10px;
            font-weight: 600;
            color: var(--gray-500);
            letter-spacing: .08em;
            text-transform: uppercase;
            padding: 20px 14px 6px;
            white-space: nowrap;
        }

        .nav-item {
            display: flex; align-items: center; gap: 10px;
            padding: 10px 14px;
            margin: 2px 0;
            border-radius: 10px;
            text-decoration: none;
            color: var(--gray-500);
            font-size: 13.5px;
            font-weight: 500;
            transition: all .2s ease;
            position: relative;
            white-space: nowrap;
            overflow: hidden;
        }
        .nav-item .nav-label { overflow: hidden; text-overflow: ellipsis; flex: 1; }
        .nav-item:hover { background: var(--gray-100); color: var(--gray-900); }
        .nav-item.active {
            background: var(--gold);
            color: #070E1A;
            font-weight: 600;
            box-shadow: 0 4px 14px rgba(245, 166, 35, 0.25);
        }
        .nav-item svg { width: 16px; height: 16px; flex-shrink: 0; opacity: .8; }
        .nav-item.active svg { opacity: 1; }

        .nav-badge {
            margin-left: auto;
            background: var(--red);
            color: #fff;
            font-size: 10px;
            font-weight: 700;
            padding: 2px 6px;
            border-radius: 20px;
            min-width: 18px;
            text-align: center;
            flex-shrink: 0;
        }

        .sidebar-footer {
            padding: 12px;
            border-top: 1px solid var(--gray-200);
            flex-shrink: 0;
        }
        .logout-btn {
            display: flex; align-items: center; gap: 10px;
            width: 100%;
            padding: 10px 14px;
            border-radius: 10px;
            background: var(--gray-100);
            border: 1px solid var(--gray-200);
            color: var(--gray-700);
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all .2s;
        }
        .logout-btn:hover { background: var(--red-light); color: var(--red); border-color: rgba(239,68,68,.2); }

        /* ══════════════════════════════════════════════════
           MAIN WRAPPER & TOPBAR
           ══════════════════════════════════════════════════ */
        .main-wrapper {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            min-width: 0;
            transition: margin-left 0.3s ease;
        }

        .topbar {
            background: var(--white);
            border-bottom: 1px solid var(--gray-200);
            padding: 0 32px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky; top: 0;
            z-index: 50;
            gap: 12px;
            flex-shrink: 0;
        }

        .topbar-left {
            display: flex; align-items: center; gap: 12px;
            min-width: 0; flex: 1;
        }

        /* Hamburger */
        .hamburger-btn {
            display: none;
            background: transparent;
            border: none;
            cursor: pointer;
            color: var(--gray-500);
            padding: 6px;
            border-radius: 8px;
            flex-shrink: 0;
            transition: all .2s;
        }
        .hamburger-btn:hover { background: var(--gray-100); color: var(--gray-900); }
        .hamburger-btn svg { width: 22px; height: 22px; display: block; }

        .topbar-title {
            font-size: 16px;
            font-weight: 600;
            color: var(--gray-900);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .topbar-right {
            display: flex; align-items: center; gap: 8px;
            flex-shrink: 0;
        }
        .topbar-date {
            font-size: 12px; color: var(--gray-500);
            font-weight: 500;
            white-space: nowrap;
        }

        .page-content {
            padding: 32px 40px 56px;
            flex: 1;
            min-width: 0;
            max-width: 1440px;
            width: 100%;
        }

        /* ══════════════════════════════════════════════════
           CARDS
           ══════════════════════════════════════════════════ */
        .card {
            background: var(--white);
            border-radius: 16px;
            border: 1px solid var(--gray-200);
            padding: 24px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            min-width: 0;
        }
        .card-title {
            font-size: 15px;
            font-weight: 600;
            color: var(--gray-900);
            margin-bottom: 18px;
            display: flex; align-items: center; gap: 8px;
            flex-wrap: wrap;
        }

        /* ══════════════════════════════════════════════════
           STAT CARDS
           ══════════════════════════════════════════════════ */
        .stat-grid {
            display: grid;
            gap: 16px;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            margin-bottom: 28px;
        }
        .stat-card {
            background: var(--white);
            border-radius: 16px;
            border: 1px solid var(--gray-200);
            padding: 20px;
            display: flex; align-items: center; gap: 14px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            transition: transform .25s ease, border-color .25s ease;
            min-width: 0;
            overflow: hidden;
        }
        .stat-card:hover { transform: translateY(-2px); border-color: var(--primary); }
        .stat-icon {
            width: 46px; height: 46px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .stat-icon.blue   { background: var(--blue-light); color: var(--navy-light); }
        .stat-icon.gold   { background: var(--gold-light); color: var(--gold); }
        .stat-icon.green  { background: var(--emerald-light); color: var(--emerald); }
        .stat-icon.red    { background: var(--red-light); color: var(--red); }
        .stat-info { min-width: 0; flex: 1; overflow: hidden; }
        .stat-label { font-size: 12px; color: var(--gray-500); margin-bottom: 6px; font-weight: 500; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .stat-value { font-family: 'JetBrains Mono', monospace; font-size: 22px; font-weight: 700; color: var(--gray-900); letter-spacing: -0.5px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .stat-value.sm { font-size: 16px; }

        /* ══════════════════════════════════════════════════
           BADGES
           ══════════════════════════════════════════════════ */
        .badge {
            display: inline-flex; align-items: center;
            padding: 3px 10px; border-radius: 999px;
            font-size: 11px; font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            white-space: nowrap;
            flex-shrink: 0;
        }
        .badge-pending  { background: var(--gold-light); color: var(--gold); border: 1px solid rgba(245,166,35,.25); }
        .badge-success  { background: var(--emerald-light); color: var(--emerald); border: 1px solid rgba(16,185,129,.25); }
        .badge-approved { background: var(--emerald-light); color: var(--emerald); border: 1px solid rgba(16,185,129,.25); }
        .badge-rejected { background: var(--red-light); color: var(--red); border: 1px solid rgba(239,68,68,.25); }
        .badge-draft       { background: var(--blue-light); color: var(--navy-light); border: 1px solid rgba(59,130,246,.25); }
        .badge-distributed { background: var(--emerald-light); color: var(--emerald); border: 1px solid rgba(16,185,129,.25); }
        .stat-icon.purple   { background: rgba(139,92,246,.12); color: #8B5CF6; }

        /* ══════════════════════════════════════════════════
           TABLE
           ══════════════════════════════════════════════════ */
        .table-wrap { overflow-x: auto; border-radius: 12px; border: 1px solid var(--gray-200); -webkit-overflow-scrolling: touch; }
        table { width: 100%; border-collapse: collapse; min-width: 500px; }
        thead th {
            background: var(--gray-100);
            padding: 12px 16px;
            text-align: left;
            font-size: 11px; font-weight: 600;
            color: var(--gray-500);
            letter-spacing: .07em;
            text-transform: uppercase;
            border-bottom: 1px solid var(--gray-200);
            white-space: nowrap;
        }
        tbody td {
            padding: 14px 16px;
            font-size: 13.5px;
            color: var(--gray-600);
            border-bottom: 1px solid var(--gray-200);
            max-width: 240px;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        tbody tr:last-child td { border-bottom: none; }
        tbody tr:hover { background: var(--gray-100); }

        /* ══════════════════════════════════════════════════
           FORMS
           ══════════════════════════════════════════════════ */
        .form-group { margin-bottom: 18px; }
        .form-label {
            display: block; font-size: 13px; font-weight: 600;
            color: var(--gray-600); margin-bottom: 7px;
        }
        .form-label span.req { color: var(--red); margin-left: 2px; }
        .form-control {
            width: 100%; padding: 10px 14px;
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
        .invalid-feedback { font-size: 12px; color: var(--red); margin-top: 4px; display: block; }
        textarea.form-control { resize: vertical; min-height: 96px; }
        select.form-control { cursor: pointer; }

        /* ══════════════════════════════════════════════════
           BUTTONS
           ══════════════════════════════════════════════════ */
        .btn {
            display: inline-flex; align-items: center; justify-content: center; gap: 7px;
            padding: 10px 20px; border-radius: 999px;
            font-size: 13.5px; font-weight: 600;
            cursor: pointer; border: none;
            text-decoration: none;
            transition: all .22s ease;
            white-space: nowrap;
            flex-shrink: 0;
        }
        .btn-primary { background: var(--navy-light); color: #fff; box-shadow: 0 4px 12px rgba(59,130,246,.2); }
        .btn-primary:hover { background: #2563EB; transform: translateY(-1px); box-shadow: 0 6px 16px rgba(59,130,246,.3); }
        .btn-success { background: var(--emerald); color: #fff; box-shadow: 0 4px 12px rgba(16,185,129,.2); }
        .btn-success:hover { filter: brightness(1.1); transform: translateY(-1px); }
        .btn-danger  { background: var(--red); color: #fff; box-shadow: 0 4px 12px rgba(239,68,68,.2); }
        .btn-danger:hover  { filter: brightness(1.1); transform: translateY(-1px); }
        .btn-outline { background: transparent; color: var(--primary); border: 1.5px solid var(--primary); }
        .btn-outline:hover { background: var(--primary); color: #070e1a; transform: translateY(-1px); }
        .btn-gold    { background: var(--gold); color: #070E1A; box-shadow: 0 4px 12px rgba(245,166,35,.2); }
        .btn-gold:hover    { filter: brightness(1.1); transform: translateY(-1px); }
        .btn-sm { padding: 7px 14px; font-size: 12px; border-radius: 999px; }

        /* ══════════════════════════════════════════════════
           ALERTS
           ══════════════════════════════════════════════════ */
        .alert {
            padding: 14px 18px; border-radius: 12px;
            margin-bottom: 20px; font-size: 13.5px;
            display: flex; align-items: center; gap: 10px;
            font-weight: 550;
        }
        .alert svg { width: 18px; height: 18px; flex-shrink: 0; }
        .alert-success { background: #0F2C20; color: #32D74B; border-left: 4px solid var(--emerald); }
        .alert-error   { background: #3A1C1C; color: #FF453A; border-left: 4px solid var(--red); }
        .alert-warning { background: #3A2C1C; color: #FFA83A; border-left: 4px solid var(--gold); }
        /* Light mode alert overrides */
        body.light-mode .alert-success { background: #DCFCE7; color: #16A34A; }
        body.light-mode .alert-error   { background: #FEE2E2; color: #DC2626; }
        body.light-mode .alert-warning { background: #FEF9C3; color: #CA8A04; }

        /* ══════════════════════════════════════════════════
           PAGINATION — fully custom styled
           ══════════════════════════════════════════════════ */
        .pagination-wrap {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            margin-top: 20px;
            flex-wrap: wrap;
            gap: 8px;
        }

        /* Override the default Tailwind/Bootstrap pagination rendered by Laravel */
        .pagination-wrap nav,
        .pagination-wrap .pagination {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 4px;
        }

        /* Laravel default pagination links */
        .pagination-wrap nav [aria-label="Pagination Navigation"] {
            display: flex; align-items: center; gap: 4px;
        }
        .pagination-wrap span[aria-current="page"] > span,
        .pagination-wrap a[rel],
        .pagination-wrap nav span span,
        .pagination-wrap nav a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 36px;
            height: 36px;
            padding: 0 10px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 500;
            border: 1.5px solid var(--gray-200);
            color: var(--gray-500);
            text-decoration: none;
            transition: all .18s ease;
            background: transparent;
            white-space: nowrap;
        }
        .pagination-wrap nav a:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: var(--gold-light);
        }
        .pagination-wrap span[aria-current="page"] > span {
            background: var(--primary);
            color: #070e1a;
            border-color: var(--primary);
            font-weight: 700;
        }
        .pagination-wrap nav > div:first-child {
            font-size: 13px;
            color: var(--gray-500);
        }
        /* Disabled prev/next */
        .pagination-wrap nav span:not([aria-current]) > span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 36px;
            height: 36px;
            padding: 0 10px;
            border-radius: 10px;
            font-size: 13px;
            border: 1.5px solid var(--gray-200);
            color: var(--gray-400);
            opacity: 0.5;
        }

        /* Bootstrap-4 pagination (for views that use links('pagination::bootstrap-4')) */
        .pagination-wrap .pagination li .page-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 36px;
            height: 36px;
            padding: 0 10px;
            border-radius: 10px !important;
            font-size: 13px;
            font-weight: 500;
            border: 1.5px solid var(--gray-200) !important;
            color: var(--gray-500) !important;
            text-decoration: none;
            background: transparent !important;
            transition: all .18s ease;
            margin: 0 2px;
        }
        .pagination-wrap .pagination li.active .page-link {
            background: var(--primary) !important;
            border-color: var(--primary) !important;
            color: #070e1a !important;
            font-weight: 700;
        }
        .pagination-wrap .pagination li .page-link:hover {
            border-color: var(--primary) !important;
            color: var(--primary) !important;
            background: var(--gold-light) !important;
        }
        .pagination-wrap .pagination li.disabled .page-link {
            opacity: 0.45;
        }

        /* ══════════════════════════════════════════════════
           THEME TOGGLE BUTTON
           ══════════════════════════════════════════════════ */
        .theme-toggle-btn {
            background: transparent;
            border: 1.5px solid var(--gray-200);
            color: var(--gray-500);
            width: 36px; height: 36px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer;
            transition: all 0.25s ease;
            outline: none;
            flex-shrink: 0;
        }
        .theme-toggle-btn:hover {
            border-color: var(--primary);
            color: var(--primary);
            transform: scale(1.08) rotate(15deg);
        }

        /* ══════════════════════════════════════════════════
           MISC UTILITIES
           ══════════════════════════════════════════════════ */
        .page-header { margin-bottom: 28px; }
        .page-header h2 {
            font-size: clamp(20px, 3.5vw, 28px);
            font-weight: 700;
            color: var(--body-text-main);
            letter-spacing: -0.5px;
            transition: color 0.3s ease;
            overflow-wrap: break-word;
        }
        .page-header p  {
            font-size: 14px;
            color: var(--body-text-muted);
            margin-top: 6px;
            line-height: 1.6;
            transition: color 0.3s ease;
        }

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
            border: 2px dashed var(--gray-200);
            border-radius: 12px;
            padding: 28px;
            text-align: center;
            cursor: pointer;
            transition: all .25s ease;
            background: var(--gray-50);
        }
        .upload-area:hover { border-color: var(--primary); background: var(--gray-100); }
        .upload-area input[type=file] { display: none; }
        .upload-area p { font-size: 13px; color: var(--gray-500); margin-top: 6px; }
        .upload-label { font-size: 13px; font-weight: 600; color: var(--primary); cursor: pointer; }

        /* ── Inline color overrides for sub-page hardcoded styles ── */
        [style*="color:#111827"],[style*="color: #111827"] { color: var(--gray-800) !important; }
        [style*="color:#6B7280"],[style*="color: #6B7280"],
        [style*="color:#374151"],[style*="color: #374151"] { color: var(--gray-500) !important; }
        [style*="color:#9CA3AF"],[style*="color: #9CA3AF"] { color: var(--gray-400) !important; }
        [style*="border-bottom:1px solid #F3F4F6"],[style*="border-bottom: 1px solid #F3F4F6"],
        [style*="border-bottom:1px solid #E5E7EB"],[style*="border-bottom: 1px solid #E5E7EB"] {
            border-bottom: 1px solid var(--gray-200) !important;
        }
        [style*="background:#F3F4F6"],[style*="background: #F3F4F6"],
        [style*="background:#F9FAFB"],[style*="background: #F9FAFB"] { background: var(--gray-50) !important; }
        [style*="background:#fff"],[style*="background: #fff"],
        [style*="background:#FFFFFF"],[style*="background: #FFFFFF"] { background: var(--white) !important; }
        [style*="background:var(--blue-light)"],[style*="background: var(--blue-light)"] { background: var(--gold-light) !important; }

        /* ══════════════════════════════════════════════════
           RESPONSIVE — Tablet (≤ 1024px)
           ══════════════════════════════════════════════════ */
        @media (max-width: 1024px) {
            .topbar-date { display: none; }
            .page-content { padding: 24px 28px 48px; }
        }

        /* ══════════════════════════════════════════════════
           RESPONSIVE — Mobile (≤ 768px)
           ══════════════════════════════════════════════════ */
        @media (max-width: 768px) {
            :root { --sidebar-w: 260px; }

            .sidebar {
                transform: translateX(-100%);
                box-shadow: none;
            }
            .sidebar.open {
                transform: translateX(0);
                box-shadow: 4px 0 30px rgba(0,0,0,0.35);
            }

            .hamburger-btn { display: flex; }

            .main-wrapper { margin-left: 0; }

            .topbar { padding: 0 16px; height: 58px; }
            .topbar-date { display: none; }
            .topbar-title { font-size: 14px; }

            .page-content { padding: 20px 16px 40px; }
            .grid-2, .grid-3 { grid-template-columns: 1fr; }

            .stat-grid { grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 12px; }
            .stat-value { font-size: 18px; }
            .stat-value.sm { font-size: 14px; }

            .card { padding: 16px; border-radius: 12px; }
            .card-title { font-size: 14px; margin-bottom: 14px; }

            .btn { padding: 9px 16px; font-size: 13px; }
            .btn-sm { padding: 6px 12px; font-size: 11.5px; }

            .page-header h2 { font-size: 20px; }
            .page-header p  { font-size: 13px; }
        }

        /* ══════════════════════════════════════════════════
           RESPONSIVE — Small mobile (≤ 480px)
           ══════════════════════════════════════════════════ */
        @media (max-width: 480px) {
            .stat-grid { grid-template-columns: 1fr 1fr; }
            .stat-card { padding: 14px; gap: 10px; }
            .stat-icon { width: 38px; height: 38px; }
            .stat-value { font-size: 16px; }
            .stat-value.sm { font-size: 13px; }
        }
    </style>
    @stack('styles')
</head>
<body>
<script>
    (function() {
        if (localStorage.getItem('theme') === 'light') {
            document.body.classList.add('light-mode');
        }
    })();
</script>

{{-- Mobile Sidebar Overlay --}}
<div class="sidebar-overlay" id="sidebar-overlay"></div>

{{-- Sidebar --}}
<aside class="sidebar" id="main-sidebar">
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
        <div class="topbar-left">
            {{-- Hamburger --}}
            <button class="hamburger-btn" id="hamburger-btn" aria-label="Buka Menu">
                <svg id="ham-icon-open" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg id="ham-icon-close" style="display:none;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
            <div class="topbar-title">@yield('page-title', 'Dashboard')</div>
        </div>
        <div class="topbar-right">
            <span class="topbar-date">{{ now()->locale('id')->isoFormat('dddd, D MMMM Y') }}</span>
            <button id="theme-toggle" class="theme-toggle-btn" aria-label="Ubah Tema" title="Ubah Tema">
                <svg id="theme-sun" style="display:none;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="18" height="18">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m0-12.728l.707.707m12.728 12.728l.707.707M12 8a4 4 0 100 8 4 4 0 000-8z"/>
                </svg>
                <svg id="theme-moon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="18" height="18">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                </svg>
            </button>
        </div>
    </header>

    <main class="page-content">
        {{-- Flash messages --}}
        @if(session('success'))
            <div class="alert alert-success">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>
</div>

@stack('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    /* ── Theme Toggle ── */
    const themeBtn  = document.getElementById('theme-toggle');
    const sunIcon   = document.getElementById('theme-sun');
    const moonIcon  = document.getElementById('theme-moon');

    function applyTheme(mode) {
        if (mode === 'light') {
            document.body.classList.add('light-mode');
            sunIcon.style.display  = 'block';
            moonIcon.style.display = 'none';
        } else {
            document.body.classList.remove('light-mode');
            sunIcon.style.display  = 'none';
            moonIcon.style.display = 'block';
        }
    }

    applyTheme(localStorage.getItem('theme') || 'dark');

    themeBtn.addEventListener('click', function () {
        const next = document.body.classList.contains('light-mode') ? 'dark' : 'light';
        localStorage.setItem('theme', next);
        applyTheme(next);
    });

    /* ── Hamburger / Sidebar ── */
    const sidebar    = document.getElementById('main-sidebar');
    const overlay    = document.getElementById('sidebar-overlay');
    const hamBtn     = document.getElementById('hamburger-btn');
    const hamOpen    = document.getElementById('ham-icon-open');
    const hamClose   = document.getElementById('ham-icon-close');

    function openSidebar() {
        sidebar.classList.add('open');
        overlay.classList.add('active');
        hamOpen.style.display  = 'none';
        hamClose.style.display = 'block';
        document.body.style.overflow = 'hidden';
    }

    function closeSidebar() {
        sidebar.classList.remove('open');
        overlay.classList.remove('active');
        hamOpen.style.display  = 'block';
        hamClose.style.display = 'none';
        document.body.style.overflow = '';
    }

    hamBtn.addEventListener('click', function () {
        sidebar.classList.contains('open') ? closeSidebar() : openSidebar();
    });

    overlay.addEventListener('click', closeSidebar);

    /* Close sidebar when a nav link is clicked on mobile */
    sidebar.querySelectorAll('.nav-item').forEach(function (link) {
        link.addEventListener('click', function () {
            if (window.innerWidth <= 768) closeSidebar();
        });
    });

    /* Close on resize back to desktop */
    window.addEventListener('resize', function () {
        if (window.innerWidth > 768) closeSidebar();
    });
});
</script>
</body>
</html>
