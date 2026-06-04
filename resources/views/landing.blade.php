<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SKOTER — Sistem Koperasi Terpadu. Platform manajemen koperasi digital yang mudah, aman, dan transparan untuk seluruh anggota.">
    <title>SKOTER — Sistem Koperasi Terpadu</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;420;500;550;600;700&display=swap" rel="stylesheet">
    <style>
        /* ── Reset & Root ─────────────────────────────────────────────── */
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            /* Website theme colors */
            --navy-dark:  #0B2545;
            --navy:       #19376D;
            --navy-mid:   #1A4A8A;
            --navy-light: #2563EB;
            --gold:       #F5A623;
            --gold-dark:  #e8941a;
            --gold-light: #FFF3DC;
            --emerald:    #10B981;
            --emerald-light: #D1FAE5;
            --red:        #EF4444;

            /* Canvas system (DESIGN.md adapted) */
            --canvas-night:          #0B2545;
            --canvas-night-elevated: #122e52;
            --canvas-light:          #FFFFFF;
            --canvas-cream:          #F9FAFB;

            /* Shade ladder */
            --shade-30: #d4d4d8;
            --shade-40: #a1a1aa;
            --shade-50: #71717a;
            --shade-60: #52525b;
            --shade-70: #3f3f46;

            /* Hairlines */
            --hairline-light: #e4e4e7;
            --hairline-dark:  rgba(255,255,255,.1);

            /* Text */
            --ink:        #111827;
            --on-dark:    #FFFFFF;

            /* Border radius (DESIGN.md) */
            --rounded-xs:   4px;
            --rounded-sm:   5px;
            --rounded-md:   8px;
            --rounded-lg:   12px;
            --rounded-xl:   20px;
            --rounded-pill: 9999px;

            /* Spacing */
            --sp-xxs: 2px;
            --sp-xs:  4px;
            --sp-sm:  8px;
            --sp-md:  12px;
            --sp-lg:  16px;
            --sp-xl:  24px;
            --sp-xxl: 32px;
            --sp-huge: 64px;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Helvetica, Arial, sans-serif;
            font-feature-settings: "ss03";
            color: var(--ink);
            background: var(--canvas-light);
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* ── Typography Scale (DESIGN.md adapted) ────────────────────── */
        .display-xxl {
            font-size: clamp(48px, 7vw, 96px);
            font-weight: 600;
            line-height: 1.0;
            letter-spacing: 1px;
        }
        .display-xl {
            font-size: clamp(36px, 5vw, 70px);
            font-weight: 600;
            line-height: 1.0;
            letter-spacing: 0;
        }
        .display-lg {
            font-size: clamp(32px, 4vw, 55px);
            font-weight: 600;
            line-height: 1.16;
        }
        .display-md {
            font-size: clamp(28px, 3.5vw, 48px);
            font-weight: 600;
            line-height: 1.14;
        }
        .heading-xl {
            font-size: 28px;
            font-weight: 700;
            line-height: 1.28;
            letter-spacing: 0.42px;
        }
        .heading-lg {
            font-size: 24px;
            font-weight: 600;
            line-height: 1.14;
            letter-spacing: 0.36px;
        }
        .heading-md {
            font-size: 20px;
            font-weight: 600;
            line-height: 1.4;
            letter-spacing: 0.3px;
        }
        .heading-sm {
            font-size: 18px;
            font-weight: 600;
            line-height: 1.25;
            letter-spacing: 0.72px;
        }
        .body-lg {
            font-size: 18px;
            font-weight: 550;
            line-height: 1.56;
        }
        .body-md {
            font-size: 16px;
            font-weight: 500;
            line-height: 1.5;
        }
        .caption {
            font-size: 14px;
            font-weight: 600;
            line-height: 1.49;
            letter-spacing: 0.28px;
        }
        .eyebrow-cap {
            font-size: 12px;
            font-weight: 600;
            line-height: 1.2;
            letter-spacing: 1.6px;
            text-transform: uppercase;
        }

        /* ── Elevation (DESIGN.md) ───────────────────────────────────── */
        .elevation-1 {
            box-shadow: 0 1px 2px rgba(255,255,255,0.05), inset 0 1px 0 rgba(255,255,255,0.04);
        }
        .elevation-3 {
            box-shadow:
                0 8px 8px rgba(0,0,0,0.1),
                0 4px 4px rgba(0,0,0,0.1),
                0 2px 2px rgba(0,0,0,0.1),
                0 0 0 1px rgba(0,0,0,0.06);
        }

        /* ── Buttons (DESIGN.md pill system) ──────────────────────────── */
        .btn-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 14px 28px;
            border-radius: var(--rounded-pill);
            font-size: 16px;
            font-weight: 500;
            font-family: inherit;
            font-feature-settings: "ss03";
            cursor: pointer;
            border: none;
            text-decoration: none;
            transition: all .25s cubic-bezier(.4,0,.2,1);
            white-space: nowrap;
        }
        .btn-pill:active { transform: scale(0.97); }

        .btn-primary-pill {
            background: linear-gradient(135deg, var(--gold-dark), var(--gold));
            color: #fff;
            box-shadow: 0 4px 16px rgba(245,166,35,.35);
        }
        .btn-primary-pill:hover {
            box-shadow: 0 8px 28px rgba(245,166,35,.45);
            transform: translateY(-2px);
        }

        .btn-navy-pill {
            background: linear-gradient(135deg, var(--navy-dark), var(--navy));
            color: #fff;
            box-shadow: 0 4px 16px rgba(25,55,109,.35);
        }
        .btn-navy-pill:hover {
            box-shadow: 0 8px 28px rgba(25,55,109,.45);
            transform: translateY(-2px);
        }

        .btn-outline-dark {
            background: transparent;
            color: var(--on-dark);
            border: 2px solid rgba(255,255,255,.4);
        }
        .btn-outline-dark:hover {
            border-color: #fff;
            background: rgba(255,255,255,.08);
            transform: translateY(-2px);
        }

        .btn-outline-light {
            background: transparent;
            color: var(--navy);
            border: 2px solid var(--navy);
        }
        .btn-outline-light:hover {
            background: var(--navy);
            color: #fff;
            transform: translateY(-2px);
        }

        /* ── Pill Tags ────────────────────────────────────────────────── */
        .pill-tag {
            display: inline-flex;
            align-items: center;
            padding: 6px 14px;
            border-radius: var(--rounded-pill);
            font-size: 12px;
            font-weight: 500;
            letter-spacing: 0.72px;
            text-transform: uppercase;
        }
        .pill-tag-gold {
            background: rgba(245,166,35,.15);
            color: var(--gold);
        }
        .pill-tag-emerald {
            background: rgba(16,185,129,.12);
            color: var(--emerald);
        }

        /* ── Container ────────────────────────────────────────────────── */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
        }
        .container-wide {
            max-width: 1440px;
            margin: 0 auto;
            padding: 0 24px;
        }

        /* ══════════════════════════════════════════════════════════════
           NAVBAR
           ══════════════════════════════════════════════════════════════ */
        .navbar {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 1000;
            padding: 0 32px;
            height: 72px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(11,37,69,.85);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border-bottom: 1px solid rgba(255,255,255,.06);
            transition: background .3s, box-shadow .3s;
        }
        .navbar.scrolled {
            background: rgba(11,37,69,.97);
            box-shadow: 0 4px 30px rgba(0,0,0,.3);
        }
        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 4px;
            text-decoration: none;
        }
        .navbar-brand .logo-icon {
            font-size: 28px;
        }
        .navbar-brand .logo-text {
            font-size: 22px;
            font-weight: 700;
            color: #fff;
            letter-spacing: 1.5px;
        }
        .navbar-brand .logo-text span {
            color: var(--gold);
        }

        .navbar-links {
            display: flex;
            align-items: center;
            gap: 32px;
            list-style: none;
        }
        .navbar-links a {
            color: rgba(255,255,255,.85);
            text-decoration: none;
            font-size: 18px;
            font-weight: 600;
            letter-spacing: 0.3px;
            transition: color .2s;
        }
        .navbar-links a:hover { color: #fff; }

        .navbar-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .navbar-actions .btn-pill {
            padding: 10px 22px;
            font-size: 14px;
        }

        /* Hamburger */
        .hamburger {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            background: none;
            border: none;
            padding: 4px;
        }
        .hamburger span {
            display: block;
            width: 24px;
            height: 2px;
            background: #fff;
            border-radius: 2px;
            transition: all .3s;
        }
        .hamburger.active span:nth-child(1) { transform: rotate(45deg) translate(5px, 5px); }
        .hamburger.active span:nth-child(2) { opacity: 0; }
        .hamburger.active span:nth-child(3) { transform: rotate(-45deg) translate(5px, -5px); }

        /* Mobile menu */
        .mobile-menu {
            display: none;
            position: fixed;
            top: 72px; left: 0; right: 0;
            background: var(--navy-dark);
            padding: 24px;
            border-bottom: 1px solid rgba(255,255,255,.08);
            z-index: 999;
        }
        .mobile-menu.active { display: block; }
        .mobile-menu a {
            display: block;
            color: rgba(255,255,255,.8);
            text-decoration: none;
            padding: 12px 0;
            font-size: 15px;
            font-weight: 500;
            border-bottom: 1px solid rgba(255,255,255,.06);
        }
        .mobile-menu a:last-child { border-bottom: none; }
        .mobile-menu .mobile-actions {
            display: flex;
            gap: 12px;
            margin-top: 16px;
        }
        .mobile-menu .mobile-actions .btn-pill {
            flex: 1;
            padding: 12px 20px;
            font-size: 14px;
        }

        /* ══════════════════════════════════════════════════════════════
           HERO — Cinematic Dark Track
           ══════════════════════════════════════════════════════════════ */
        .hero {
            position: relative;
            min-height: 100vh;
            background: linear-gradient(160deg, #060e1a 0%, var(--navy-dark) 35%, var(--navy) 70%, var(--navy-mid) 100%);
            display: flex;
            align-items: center;
            overflow: hidden;
            padding: 120px 0 80px;
        }

        /* Decorative orbs */
        .hero::before {
            content: '';
            position: absolute;
            width: 600px; height: 600px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(245,166,35,.08) 0%, transparent 70%);
            top: -150px; right: -100px;
            pointer-events: none;
        }
        .hero::after {
            content: '';
            position: absolute;
            width: 500px; height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(16,185,129,.06) 0%, transparent 70%);
            bottom: -100px; left: -150px;
            pointer-events: none;
        }

        .hero-grid-lines {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,.02) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,.02) 1px, transparent 1px);
            background-size: 80px 80px;
            pointer-events: none;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 64px;
            align-items: center;
        }

        .hero-text { max-width: 600px; }

        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 24px;
        }
        .hero-eyebrow .dot {
            width: 8px; height: 8px;
            border-radius: 50%;
            background: var(--emerald);
            animation: pulse-dot 2s infinite;
        }

        @keyframes pulse-dot {
            0%, 100% { opacity: 1; box-shadow: 0 0 0 0 rgba(16,185,129,.5); }
            50% { opacity: .8; box-shadow: 0 0 0 6px rgba(16,185,129,0); }
        }

        .hero-title {
            color: var(--on-dark);
            margin-bottom: 24px;
        }
        .hero-title .highlight {
            background: linear-gradient(135deg, var(--gold), #ffd48a);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-subtitle {
            color: rgba(255,255,255,.65);
            max-width: 480px;
            margin-bottom: 40px;
        }

        .hero-actions {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }

        /* Floating card on right */
        .hero-visual {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .floating-card {
            background: rgba(255,255,255,.06);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255,255,255,.1);
            border-radius: var(--rounded-xl);
            padding: 32px;
            width: 100%;
            max-width: 420px;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-12px); }
        }

        .floating-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }
        .floating-card-header .title {
            font-size: 14px;
            font-weight: 600;
            color: rgba(255,255,255,.9);
        }
        .floating-card-header .badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 10px;
            border-radius: var(--rounded-pill);
            background: rgba(16,185,129,.15);
            color: var(--emerald);
            font-size: 11px;
            font-weight: 600;
        }

        .mini-stat-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 24px;
        }
        .mini-stat {
            background: rgba(255,255,255,.05);
            border-radius: var(--rounded-lg);
            padding: 16px;
            border: 1px solid rgba(255,255,255,.06);
        }
        .mini-stat .label {
            font-size: 11px;
            color: rgba(255,255,255,.45);
            margin-bottom: 6px;
            letter-spacing: 0.3px;
            text-transform: uppercase;
            font-weight: 500;
        }
        .mini-stat .value {
            font-size: 22px;
            font-weight: 700;
            color: #fff;
            letter-spacing: -0.5px;
        }
        .mini-stat .value.gold { color: var(--gold); }
        .mini-stat .value.emerald { color: var(--emerald); }

        .floating-chart-bar {
            display: flex;
            align-items: flex-end;
            gap: 8px;
            height: 60px;
        }
        .chart-bar {
            flex: 1;
            border-radius: 4px 4px 0 0;
            transition: height .5s ease;
        }
        .chart-bar.navy  { background: rgba(26,74,138,.6); }
        .chart-bar.gold  { background: rgba(245,166,35,.5); }
        .chart-bar.green { background: rgba(16,185,129,.4); }

        /* Small orbiting badge */
        .orbit-badge {
            position: absolute;
            background: rgba(255,255,255,.1);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,.12);
            border-radius: var(--rounded-lg);
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: float 5s ease-in-out infinite reverse;
        }
        .orbit-badge-1 {
            top: -20px;
            right: -30px;
        }
        .orbit-badge-2 {
            bottom: -20px;
            left: -30px;
            animation-delay: -2.5s;
        }
        .orbit-badge .icon-circle {
            width: 36px; height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }
        .orbit-badge .icon-circle.gold-bg  { background: rgba(245,166,35,.2); }
        .orbit-badge .icon-circle.green-bg { background: rgba(16,185,129,.2); }
        .orbit-badge .orbit-text {
            font-size: 12px;
            font-weight: 600;
            color: rgba(255,255,255,.9);
        }
        .orbit-badge .orbit-sub {
            font-size: 10px;
            color: rgba(255,255,255,.45);
        }

        /* ══════════════════════════════════════════════════════════════
           TRUST STATS BAND
           ══════════════════════════════════════════════════════════════ */
        .trust-band {
            background: var(--canvas-light);
            border-bottom: 1px solid var(--hairline-light);
            padding: 64px 0;
        }
        .trust-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 32px;
            text-align: center;
        }
        .trust-item {}
        .trust-number {
            font-size: clamp(36px, 4vw, 52px);
            font-weight: 300;
            color: var(--navy-dark);
            letter-spacing: -1px;
            margin-bottom: 8px;
        }
        .trust-number .accent { color: var(--gold); }
        .trust-label {
            font-size: 14px;
            font-weight: 500;
            color: var(--shade-50);
            letter-spacing: 0.28px;
        }

        /* ══════════════════════════════════════════════════════════════
           FEATURES SECTION — Light Track
           ══════════════════════════════════════════════════════════════ */
        .features-section {
            background: var(--canvas-cream);
            padding: 128px 0;
        }

        .section-header {
            text-align: center;
            max-width: 600px;
            margin: 0 auto 64px;
        }
        .section-header .eyebrow-cap {
            color: var(--gold);
            margin-bottom: 16px;
        }
        .section-header .display-md {
            color: var(--navy-dark);
            margin-bottom: 16px;
        }
        .section-header .body-md {
            color: var(--shade-50);
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .feature-card {
            background: var(--canvas-light);
            border-radius: var(--rounded-lg);
            padding: 36px 28px;
            border: 1px solid var(--hairline-light);
            transition: all .3s cubic-bezier(.4,0,.2,1);
            position: relative;
            overflow: hidden;
        }
        .feature-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--gold), var(--emerald));
            opacity: 0;
            transition: opacity .3s;
        }
        .feature-card:hover {
            transform: translateY(-4px);
            box-shadow:
                0 8px 8px rgba(0,0,0,0.08),
                0 4px 4px rgba(0,0,0,0.06),
                0 2px 2px rgba(0,0,0,0.04),
                0 0 0 1px rgba(0,0,0,0.04);
        }
        .feature-card:hover::before { opacity: 1; }

        .feature-icon {
            width: 56px; height: 56px;
            border-radius: var(--rounded-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .feature-icon.navy-bg   { background: rgba(25,55,109,.08); }
        .feature-icon.gold-bg   { background: rgba(245,166,35,.1); }
        .feature-icon.green-bg  { background: rgba(16,185,129,.1); }
        .feature-icon.blue-bg   { background: rgba(37,99,235,.08); }
        .feature-icon.red-bg    { background: rgba(239,68,68,.08); }
        .feature-icon.purple-bg { background: rgba(139,92,246,.08); }

        .feature-card .heading-md {
            color: var(--navy-dark);
            margin-bottom: 12px;
        }
        .feature-card .body-md {
            color: var(--shade-50);
        }
        .feature-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 20px;
        }
        .feature-tag {
            padding: 4px 12px;
            border-radius: var(--rounded-pill);
            background: var(--canvas-cream);
            font-size: 12px;
            font-weight: 500;
            color: var(--shade-60);
            border: 1px solid var(--hairline-light);
        }

        /* ══════════════════════════════════════════════════════════════
           HOW IT WORKS
           ══════════════════════════════════════════════════════════════ */
        .how-section {
            background: var(--canvas-light);
            padding: 128px 0;
        }

        .steps-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 48px;
            position: relative;
        }
        /* Connector line */
        .steps-grid::before {
            content: '';
            position: absolute;
            top: 44px;
            left: calc(16.666% + 24px);
            right: calc(16.666% + 24px);
            height: 2px;
            background: linear-gradient(90deg, var(--gold), var(--emerald));
            opacity: .3;
        }

        .step-card {
            text-align: center;
            position: relative;
        }
        .step-number {
            width: 88px; height: 88px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            position: relative;
            z-index: 2;
        }
        .step-number .inner {
            width: 64px; height: 64px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: 700;
            color: #fff;
        }
        .step-number.navy .inner {
            background: linear-gradient(135deg, var(--navy-dark), var(--navy));
            box-shadow: 0 4px 20px rgba(25,55,109,.3);
        }
        .step-number.gold .inner {
            background: linear-gradient(135deg, var(--gold-dark), var(--gold));
            box-shadow: 0 4px 20px rgba(245,166,35,.3);
        }
        .step-number.green .inner {
            background: linear-gradient(135deg, #059669, var(--emerald));
            box-shadow: 0 4px 20px rgba(16,185,129,.3);
        }
        .step-number .ring {
            position: absolute;
            inset: 0;
            border-radius: 50%;
            border: 2px solid rgba(0,0,0,.06);
        }

        .step-card .heading-md {
            color: var(--navy-dark);
            margin-bottom: 8px;
        }
        .step-card .body-md {
            color: var(--shade-50);
            max-width: 280px;
            margin: 0 auto;
        }

        /* ══════════════════════════════════════════════════════════════
           DATA PREVIEW — Pistachio Band (adapted: emerald-light)
           ══════════════════════════════════════════════════════════════ */
        .preview-section {
            background: var(--emerald-light);
            padding: 128px 0;
        }

        .preview-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 48px;
            align-items: center;
        }

        .preview-text .eyebrow-cap {
            color: #059669;
            margin-bottom: 16px;
        }
        .preview-text .display-md {
            color: var(--navy-dark);
            margin-bottom: 16px;
        }
        .preview-text .body-lg {
            color: var(--shade-60);
            margin-bottom: 32px;
        }

        .preview-features {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        .preview-feature {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 15px;
            font-weight: 500;
            color: var(--navy-dark);
        }
        .preview-feature .check {
            width: 24px; height: 24px;
            border-radius: 50%;
            background: rgba(16,185,129,.15);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            color: var(--emerald);
            flex-shrink: 0;
        }

        /* Dashboard mockup card */
        .preview-mockup {
            background: var(--canvas-light);
            border-radius: var(--rounded-xl);
            overflow: hidden;
            box-shadow:
                0 25px 50px -12px rgba(0,0,0,.15),
                0 8px 8px rgba(0,0,0,0.06);
            border: 1px solid rgba(0,0,0,.06);
        }
        .mockup-toolbar {
            background: var(--canvas-cream);
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 8px;
            border-bottom: 1px solid var(--hairline-light);
        }
        .mockup-dot {
            width: 10px; height: 10px;
            border-radius: 50%;
        }
        .mockup-dot.red    { background: #EF4444; }
        .mockup-dot.yellow { background: #F59E0B; }
        .mockup-dot.green  { background: #10B981; }
        .mockup-toolbar .mockup-url {
            flex: 1;
            margin-left: 8px;
            background: var(--canvas-light);
            border-radius: var(--rounded-pill);
            padding: 4px 14px;
            font-size: 11px;
            color: var(--shade-40);
        }

        .mockup-body {
            padding: 24px;
        }
        .mockup-header-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .mockup-header-row .title {
            font-size: 16px;
            font-weight: 700;
            color: var(--navy-dark);
        }
        .mockup-mini-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-bottom: 20px;
        }
        .mockup-mini-stat {
            background: var(--canvas-cream);
            border-radius: var(--rounded-md);
            padding: 14px;
            border: 1px solid var(--hairline-light);
        }
        .mockup-mini-stat .s-label {
            font-size: 10px;
            color: var(--shade-40);
            margin-bottom: 4px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 500;
        }
        .mockup-mini-stat .s-value {
            font-size: 16px;
            font-weight: 700;
            color: var(--navy-dark);
        }
        .mockup-mini-stat .s-value.gold { color: var(--gold); }
        .mockup-mini-stat .s-value.green { color: var(--emerald); }

        /* Mini table */
        .mockup-table {
            width: 100%;
            border-collapse: collapse;
        }
        .mockup-table th {
            padding: 8px 12px;
            font-size: 10px;
            font-weight: 600;
            color: var(--shade-40);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            text-align: left;
            border-bottom: 1px solid var(--hairline-light);
            background: var(--canvas-cream);
        }
        .mockup-table td {
            padding: 10px 12px;
            font-size: 12px;
            color: var(--shade-60);
            border-bottom: 1px solid rgba(0,0,0,.03);
        }
        .mockup-table .badge-sm {
            display: inline-block;
            padding: 2px 8px;
            border-radius: var(--rounded-pill);
            font-size: 10px;
            font-weight: 600;
        }
        .mockup-table .badge-sm.success {
            background: var(--emerald-light);
            color: #065F46;
        }
        .mockup-table .badge-sm.pending {
            background: #FEF3C7;
            color: #92400E;
        }

        /* ══════════════════════════════════════════════════════════════
           CTA BAND — Dark Track
           ══════════════════════════════════════════════════════════════ */
        .cta-section {
            background: linear-gradient(160deg, #060e1a 0%, var(--navy-dark) 50%, var(--navy) 100%);
            padding: 128px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .cta-section::before {
            content: '';
            position: absolute;
            width: 500px; height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(245,166,35,.06) 0%, transparent 70%);
            top: -200px; left: 50%;
            transform: translateX(-50%);
            pointer-events: none;
        }
        .cta-content {
            position: relative;
            z-index: 2;
        }
        .cta-content .display-lg {
            color: var(--on-dark);
            margin-bottom: 16px;
        }
        .cta-content .display-lg .highlight {
            background: linear-gradient(135deg, var(--gold), #ffd48a);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .cta-content .body-lg {
            color: rgba(255,255,255,.55);
            max-width: 520px;
            margin: 0 auto 40px;
        }
        .cta-actions {
            display: flex;
            justify-content: center;
            gap: 16px;
            flex-wrap: wrap;
        }

        /* ══════════════════════════════════════════════════════════════
           FOOTER — Dark Track
           ══════════════════════════════════════════════════════════════ */
        .footer {
            background: #060e1a;
            padding: 80px 0 32px;
            color: rgba(255,255,255,.5);
            border-top: 1px solid rgba(255,255,255,.05);
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 48px;
            margin-bottom: 64px;
        }

        .footer-brand .logo-text {
            font-size: 22px;
            font-weight: 700;
            color: #fff;
            letter-spacing: 1.5px;
            margin-bottom: 12px;
        }
        .footer-brand .logo-text span { color: var(--gold); }
        .footer-brand p {
            font-size: 14px;
            line-height: 1.7;
            color: rgba(255,255,255,.4);
            max-width: 300px;
        }

        .footer-col h4 {
            font-size: 13px;
            font-weight: 600;
            color: rgba(255,255,255,.8);
            letter-spacing: 0.72px;
            text-transform: uppercase;
            margin-bottom: 20px;
        }
        .footer-col ul {
            list-style: none;
        }
        .footer-col ul li {
            margin-bottom: 12px;
        }
        .footer-col ul li a {
            color: rgba(255,255,255,.4);
            text-decoration: none;
            font-size: 14px;
            font-weight: 400;
            transition: color .2s;
        }
        .footer-col ul li a:hover { color: rgba(255,255,255,.8); }

        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,.06);
            padding-top: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .footer-bottom p {
            font-size: 13px;
            color: rgba(255,255,255,.3);
        }

        /* ══════════════════════════════════════════════════════════════
           ANIMATIONS
           ══════════════════════════════════════════════════════════════ */
        .fade-in-up {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity .8s cubic-bezier(.4,0,.2,1), transform .8s cubic-bezier(.4,0,.2,1);
        }
        .fade-in-up.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Count-up animation */
        .counter { display: inline-block; }

        /* ══════════════════════════════════════════════════════════════
           RESPONSIVE
           ══════════════════════════════════════════════════════════════ */

        /* Tablet */
        @media (max-width: 1023px) {
            .hero-content {
                grid-template-columns: 1fr;
                gap: 48px;
            }
            .hero-visual {
                order: -1;
            }
            .floating-card {
                max-width: 380px;
                margin: 0 auto;
            }
            .orbit-badge { display: none; }
            .feature-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .steps-grid::before { display: none; }
            .preview-grid {
                grid-template-columns: 1fr;
                gap: 40px;
            }
            .footer-grid {
                grid-template-columns: 1fr 1fr;
                gap: 32px;
            }
            .trust-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 24px;
            }
        }

        /* Mobile */
        @media (max-width: 767px) {
            .navbar-links,
            .navbar-actions { display: none; }
            .hamburger { display: flex; }

            .hero {
                padding: 100px 0 60px;
                min-height: auto;
            }
            .hero-actions {
                flex-direction: column;
            }
            .hero-actions .btn-pill { width: 100%; }

            .features-section,
            .how-section,
            .preview-section,
            .cta-section {
                padding: 80px 0;
            }
            .feature-grid {
                grid-template-columns: 1fr;
            }
            .steps-grid {
                grid-template-columns: 1fr;
                gap: 40px;
            }
            .steps-grid::before { display: none; }
            .trust-grid {
                grid-template-columns: 1fr 1fr;
            }
            .footer-grid {
                grid-template-columns: 1fr;
                gap: 24px;
            }
            .footer-bottom {
                flex-direction: column;
                gap: 12px;
                text-align: center;
            }
            .mockup-mini-stats {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .navbar { padding: 0 16px; }
            .container, .container-wide { padding: 0 16px; }
            .trust-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<!-- ═══════════════════════════════════════════════════════════════════
     NAVBAR
     ═══════════════════════════════════════════════════════════════════ -->
<nav class="navbar" id="navbar">
    <a href="{{ url('/') }}" class="navbar-brand">
        <span class="logo-text">SK<span>O</span>TER</span>
    </a>

    <ul class="navbar-links">
        <li><a href="#fitur">Fitur</a></li>
        <li><a href="#cara-kerja">Cara Kerja</a></li>
        <li><a href="#preview">Preview</a></li>
    </ul>

    <div class="navbar-actions">
        <a href="{{ route('login') }}" class="btn-pill btn-outline-dark" id="nav-login">Masuk</a>
        <a href="{{ route('register') }}" class="btn-pill btn-primary-pill" id="nav-register">Daftar Gratis</a>
    </div>

    <button class="hamburger" id="hamburger-btn" aria-label="Menu navigasi">
        <span></span><span></span><span></span>
    </button>
</nav>

<!-- Mobile Menu -->
<div class="mobile-menu" id="mobile-menu">
    <a href="#fitur">Fitur</a>
    <a href="#cara-kerja">Cara Kerja</a>
    <a href="#preview">Preview</a>
    <div class="mobile-actions">
        <a href="{{ route('login') }}" class="btn-pill btn-outline-dark">Masuk</a>
        <a href="{{ route('register') }}" class="btn-pill btn-primary-pill">Daftar</a>
    </div>
</div>

<!-- ═══════════════════════════════════════════════════════════════════
     HERO SECTION
     ═══════════════════════════════════════════════════════════════════ -->
<section class="hero" id="hero">
    <div class="hero-grid-lines"></div>
    <div class="container-wide">
        <div class="hero-content">
            <div class="hero-text">
                <div class="hero-eyebrow">
                    <span class="dot"></span>
                    <span class="eyebrow-cap pill-tag pill-tag-emerald">Platform Koperasi Digital</span>
                </div>
                <h1 class="hero-title display-xxl">
                    Kelola Koperasi<br>
                    Anda Secara<br>
                    <span class="highlight">Digital</span>
                </h1>
                <p class="hero-subtitle body-lg">
                    SKOTER memudahkan pengelolaan simpanan, pinjaman, dan angsuran
                    dalam satu platform yang aman, transparan, dan real-time.
                </p>
                <div class="hero-actions">
                    <a href="{{ route('register') }}" class="btn-pill btn-primary-pill" id="hero-cta-register">
                        Mulai Sekarang
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                    <a href="#fitur" class="btn-pill btn-outline-dark" id="hero-cta-learn">Pelajari Lebih Lanjut</a>
                </div>
            </div>

            <div class="hero-visual">
                <!-- Floating Dashboard Card -->
                <div class="floating-card">
                    <div class="floating-card-header">
                        <span class="title">📊 Dashboard Ringkasan</span>
                        <span class="badge"><span class="dot" style="width:6px;height:6px;margin:0;"></span> Live</span>
                    </div>
                    <div class="mini-stat-grid">
                        <div class="mini-stat">
                            <div class="label">Total Simpanan</div>
                            <div class="value gold">Rp 15.2 Jt</div>
                        </div>
                        <div class="mini-stat">
                            <div class="label">Pinjaman Aktif</div>
                            <div class="value emerald">Rp 8.5 Jt</div>
                        </div>
                        <div class="mini-stat">
                            <div class="label">Angsuran Lunas</div>
                            <div class="value">12</div>
                        </div>
                        <div class="mini-stat">
                            <div class="label">Sisa Tenor</div>
                            <div class="value">6 bln</div>
                        </div>
                    </div>
                    <div class="floating-chart-bar">
                        <div class="chart-bar navy"  style="height: 45%;"></div>
                        <div class="chart-bar gold"  style="height: 72%;"></div>
                        <div class="chart-bar green" style="height: 55%;"></div>
                        <div class="chart-bar navy"  style="height: 85%;"></div>
                        <div class="chart-bar gold"  style="height: 65%;"></div>
                        <div class="chart-bar green" style="height: 90%;"></div>
                        <div class="chart-bar navy"  style="height: 40%;"></div>
                        <div class="chart-bar gold"  style="height: 78%;"></div>
                    </div>
                </div>

                <!-- Orbiting badges -->
                <div class="orbit-badge orbit-badge-1">
                    <div class="icon-circle gold-bg">💰</div>
                    <div>
                        <div class="orbit-text">Simpanan Masuk</div>
                        <div class="orbit-sub">+Rp 500.000</div>
                    </div>
                </div>
                <div class="orbit-badge orbit-badge-2">
                    <div class="icon-circle green-bg">✅</div>
                    <div>
                        <div class="orbit-text">Pinjaman Disetujui</div>
                        <div class="orbit-sub">Rp 5.000.000</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════════
     TRUST STATS BAND
     ═══════════════════════════════════════════════════════════════════ -->
<section class="trust-band">
    <div class="container">
        <div class="trust-grid">
            <div class="trust-item fade-in-up">
                <div class="trust-number"><span class="counter" data-target="500">0</span><span class="accent">+</span></div>
                <div class="trust-label">Anggota Terdaftar</div>
            </div>
            <div class="trust-item fade-in-up">
                <div class="trust-number">Rp <span class="counter" data-target="2" data-suffix="M">0</span></div>
                <div class="trust-label">Total Simpanan Dikelola</div>
            </div>
            <div class="trust-item fade-in-up">
                <div class="trust-number">Rp <span class="counter" data-target="850" data-suffix="Jt">0</span></div>
                <div class="trust-label">Pinjaman Tersalurkan</div>
            </div>
            <div class="trust-item fade-in-up">
                <div class="trust-number"><span class="counter" data-target="98">0</span><span class="accent">%</span></div>
                <div class="trust-label">Tingkat Kepuasan</div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════════
     FEATURES SECTION
     ═══════════════════════════════════════════════════════════════════ -->
<section class="features-section" id="fitur">
    <div class="container">
        <div class="section-header fade-in-up">
            <div class="eyebrow-cap">Fitur Unggulan</div>
            <h2 class="display-md">Semua yang Anda<br>Butuhkan dalam Satu Platform</h2>
            <p class="body-md">Kelola seluruh aktivitas koperasi dengan fitur lengkap dan mudah digunakan.</p>
        </div>

        <div class="feature-grid">
            <!-- Feature 1 -->
            <div class="feature-card fade-in-up">
                <div class="feature-icon navy-bg">🏦</div>
                <h3 class="heading-md">Manajemen Simpanan</h3>
                <p class="body-md">Kelola simpanan pokok, wajib, dan sukarela secara digital dengan riwayat transaksi yang lengkap dan transparan.</p>
                <div class="feature-tags">
                    <span class="feature-tag">Pokok</span>
                    <span class="feature-tag">Wajib</span>
                    <span class="feature-tag">Sukarela</span>
                </div>
            </div>

            <!-- Feature 2 -->
            <div class="feature-card fade-in-up">
                <div class="feature-icon gold-bg">💳</div>
                <h3 class="heading-md">Pinjaman & Simulasi</h3>
                <p class="body-md">Ajukan pinjaman online dengan simulasi angsuran real-time. Ketahui cicilan Anda sebelum mengajukan.</p>
                <div class="feature-tags">
                    <span class="feature-tag">Simulasi</span>
                    <span class="feature-tag">Online</span>
                    <span class="feature-tag">Cepat</span>
                </div>
            </div>

            <!-- Feature 3 -->
            <div class="feature-card fade-in-up">
                <div class="feature-icon green-bg">✅</div>
                <h3 class="heading-md">Verifikasi Transparan</h3>
                <p class="body-md">Setiap transaksi diverifikasi oleh admin dengan status yang dapat dipantau secara real-time oleh anggota.</p>
                <div class="feature-tags">
                    <span class="feature-tag">Real-time</span>
                    <span class="feature-tag">Transparan</span>
                </div>
            </div>

            <!-- Feature 4 -->
            <div class="feature-card fade-in-up">
                <div class="feature-icon blue-bg">📊</div>
                <h3 class="heading-md">Dashboard Interaktif</h3>
                <p class="body-md">Pantau ringkasan keuangan, status pinjaman, dan riwayat transaksi melalui dashboard yang informatif.</p>
                <div class="feature-tags">
                    <span class="feature-tag">Statistik</span>
                    <span class="feature-tag">Grafik</span>
                </div>
            </div>

            <!-- Feature 5 -->
            <div class="feature-card fade-in-up">
                <div class="feature-icon red-bg">🔒</div>
                <h3 class="heading-md">Keamanan Data</h3>
                <p class="body-md">Data anggota dilindungi dengan sistem autentikasi yang aman dan role-based access control.</p>
                <div class="feature-tags">
                    <span class="feature-tag">Enkripsi</span>
                    <span class="feature-tag">Aman</span>
                </div>
            </div>

            <!-- Feature 6 -->
            <div class="feature-card fade-in-up">
                <div class="feature-icon purple-bg">🛠️</div>
                <h3 class="heading-md">Sewa Alat Koperasi</h3>
                <p class="body-md">Akses katalog alat koperasi dan ajukan penyewaan langsung melalui platform dengan proses yang mudah.</p>
                <div class="feature-tags">
                    <span class="feature-tag">Katalog</span>
                    <span class="feature-tag">Sewa Online</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════════
     HOW IT WORKS
     ═══════════════════════════════════════════════════════════════════ -->
<section class="how-section" id="cara-kerja">
    <div class="container">
        <div class="section-header fade-in-up">
            <div class="eyebrow-cap">Cara Kerja</div>
            <h2 class="display-md">Mulai dalam<br>Tiga Langkah Mudah</h2>
            <p class="body-md">Bergabung dan kelola keuangan koperasi Anda dengan proses yang sederhana.</p>
        </div>

        <div class="steps-grid">
            <div class="step-card fade-in-up">
                <div class="step-number navy">
                    <div class="ring"></div>
                    <div class="inner">1</div>
                </div>
                <h3 class="heading-md">Daftar Akun</h3>
                <p class="body-md">Buat akun anggota koperasi Anda secara gratis dalam hitungan menit.</p>
            </div>

            <div class="step-card fade-in-up">
                <div class="step-number gold">
                    <div class="ring"></div>
                    <div class="inner">2</div>
                </div>
                <h3 class="heading-md">Ajukan Layanan</h3>
                <p class="body-md">Simpan dana, ajukan pinjaman, atau sewa alat melalui formulir online.</p>
            </div>

            <div class="step-card fade-in-up">
                <div class="step-number green">
                    <div class="ring"></div>
                    <div class="inner">3</div>
                </div>
                <h3 class="heading-md">Kelola & Pantau</h3>
                <p class="body-md">Pantau status, riwayat, dan angsuran Anda melalui dashboard yang intuitif.</p>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════════
     DATA PREVIEW
     ═══════════════════════════════════════════════════════════════════ -->
<section class="preview-section" id="preview">
    <div class="container">
        <div class="preview-grid">
            <div class="preview-text fade-in-up">
                <div class="eyebrow-cap">Cuplikan Platform</div>
                <h2 class="display-md">Lihat Bagaimana<br>SKOTER Bekerja</h2>
                <p class="body-lg">
                    Dashboard yang intuitif membantu Anda memantau seluruh aktivitas koperasi
                    — dari simpanan hingga angsuran — dalam tampilan yang mudah dipahami.
                </p>
                <div class="preview-features">
                    <div class="preview-feature">
                        <span class="check">✓</span>
                        Ringkasan saldo dan simpanan real-time
                    </div>
                    <div class="preview-feature">
                        <span class="check">✓</span>
                        Status pinjaman dan progress angsuran
                    </div>
                    <div class="preview-feature">
                        <span class="check">✓</span>
                        Riwayat transaksi yang terperinci
                    </div>
                    <div class="preview-feature">
                        <span class="check">✓</span>
                        Notifikasi verifikasi dari admin
                    </div>
                </div>
            </div>

            <!-- Dashboard Mockup -->
            <div class="preview-mockup fade-in-up">
                <div class="mockup-toolbar">
                    <div class="mockup-dot red"></div>
                    <div class="mockup-dot yellow"></div>
                    <div class="mockup-dot green"></div>
                    <div class="mockup-url">skoter.id/anggota/dashboard</div>
                </div>
                <div class="mockup-body">
                    <div class="mockup-header-row">
                        <span class="title">Dashboard Anggota</span>
                        <span class="pill-tag pill-tag-emerald" style="font-size:10px; padding:3px 10px;">● Online</span>
                    </div>
                    <div class="mockup-mini-stats">
                        <div class="mockup-mini-stat">
                            <div class="s-label">Total Simpanan</div>
                            <div class="s-value">Rp 5.250.000</div>
                        </div>
                        <div class="mockup-mini-stat">
                            <div class="s-label">Simpanan Pokok</div>
                            <div class="s-value gold">Rp 1.000.000</div>
                        </div>
                        <div class="mockup-mini-stat">
                            <div class="s-label">Simpanan Wajib</div>
                            <div class="s-value green">Rp 2.400.000</div>
                        </div>
                    </div>
                    <table class="mockup-table">
                        <thead>
                            <tr>
                                <th>Transaksi</th>
                                <th>Tanggal</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Simpanan Wajib</td>
                                <td>01 Jun 2026</td>
                                <td style="font-weight:600;color:var(--navy-dark);">Rp 200.000</td>
                                <td><span class="badge-sm success">Success</span></td>
                            </tr>
                            <tr>
                                <td>Angsuran #3</td>
                                <td>28 Mei 2026</td>
                                <td style="font-weight:600;color:var(--navy-dark);">Rp 458.333</td>
                                <td><span class="badge-sm success">Success</span></td>
                            </tr>
                            <tr>
                                <td>Simpanan Sukarela</td>
                                <td>25 Mei 2026</td>
                                <td style="font-weight:600;color:var(--navy-dark);">Rp 500.000</td>
                                <td><span class="badge-sm pending">Pending</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════════
     CTA BAND
     ═══════════════════════════════════════════════════════════════════ -->
<section class="cta-section">
    <div class="container">
        <div class="cta-content fade-in-up">
            <h2 class="display-lg">
                Siap Bergabung dengan<br>
                <span class="highlight">SKOTER</span>?
            </h2>
            <p class="body-lg">
                Daftarkan diri Anda sekarang dan nikmati kemudahan mengelola keuangan koperasi secara digital.
            </p>
            <div class="cta-actions">
                <a href="{{ route('register') }}" class="btn-pill btn-primary-pill" id="cta-register">
                    Daftar Sekarang — Gratis
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
                <a href="{{ route('login') }}" class="btn-pill btn-outline-dark" id="cta-login">Sudah Punya Akun? Masuk</a>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════════
     FOOTER
     ═══════════════════════════════════════════════════════════════════ -->
<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-brand">
                <div class="logo-text">SK<span>O</span>TER</div>
                <p>Platform manajemen koperasi digital yang mudah, aman, dan transparan untuk seluruh anggota koperasi.</p>
            </div>
            <div class="footer-col">
                <h4>Layanan</h4>
                <ul>
                    <li><a href="#fitur">Simpanan</a></li>
                    <li><a href="#fitur">Pinjaman</a></li>
                    <li><a href="#fitur">Angsuran</a></li>
                    <li><a href="#fitur">Sewa Alat</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Platform</h4>
                <ul>
                    <li><a href="#fitur">Fitur</a></li>
                    <li><a href="#cara-kerja">Cara Kerja</a></li>
                    <li><a href="#preview">Preview</a></li>
                    <li><a href="{{ route('register') }}">Daftar</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Bantuan</h4>
                <ul>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Kontak</a></li>
                    <li><a href="#">Kebijakan Privasi</a></li>
                    <li><a href="#">Syarat & Ketentuan</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} SKOTER — Sistem Koperasi Terpadu. All rights reserved.</p>
            <p>Built with ❤️ for Koperasi Indonesia</p>
        </div>
    </div>
</footer>

<!-- ═══════════════════════════════════════════════════════════════════
     SCRIPTS
     ═══════════════════════════════════════════════════════════════════ -->
<script>
    // ── Navbar Scroll Effect ──────────────────────────────────────────
    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
        navbar.classList.toggle('scrolled', window.scrollY > 50);
    });

    // ── Hamburger Menu ────────────────────────────────────────────────
    const hamburger = document.getElementById('hamburger-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    hamburger.addEventListener('click', () => {
        hamburger.classList.toggle('active');
        mobileMenu.classList.toggle('active');
    });
    // Close mobile menu on link click
    mobileMenu.querySelectorAll('a:not(.btn-pill)').forEach(link => {
        link.addEventListener('click', () => {
            hamburger.classList.remove('active');
            mobileMenu.classList.remove('active');
        });
    });

    // ── Intersection Observer (Fade-in) ───────────────────────────────
    const fadeObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                fadeObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' });

    document.querySelectorAll('.fade-in-up').forEach(el => fadeObserver.observe(el));

    // ── Counter Animation ─────────────────────────────────────────────
    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counter = entry.target;
                const target = parseInt(counter.dataset.target);
                const suffix = counter.dataset.suffix || '';
                const duration = 2000;
                const start = performance.now();

                function update(now) {
                    const elapsed = now - start;
                    const progress = Math.min(elapsed / duration, 1);
                    // Ease out cubic
                    const ease = 1 - Math.pow(1 - progress, 3);
                    const current = Math.floor(ease * target);
                    counter.textContent = current.toLocaleString('id-ID') + suffix;
                    if (progress < 1) requestAnimationFrame(update);
                }
                requestAnimationFrame(update);
                counterObserver.unobserve(counter);
            }
        });
    }, { threshold: 0.5 });

    document.querySelectorAll('.counter').forEach(el => counterObserver.observe(el));

    // ── Animate chart bars on load ────────────────────────────────────
    window.addEventListener('load', () => {
        document.querySelectorAll('.chart-bar').forEach((bar, i) => {
            const h = bar.style.height;
            bar.style.height = '0%';
            setTimeout(() => { bar.style.height = h; }, 300 + i * 100);
        });
    });

    // ── Smooth scroll for anchor links ────────────────────────────────
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });
</script>

</body>
</html>
