<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoPusram — Minimarket Sekolah</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --green:     #1a5c38;
            --green-mid: #2d7a50;
            --green-lt:  #e8f5ee;
            --cream:     #faf7f2;
            --ink:       #111810;
            --ink-mid:   #3a4038;
            --ink-lt:    #7a8078;
            --accent:    #f0a500;
            --red:       #d63329;
            --white:     #ffffff;
            --radius:    14px;
            --ff-head:   'Syne', sans-serif;
            --ff-body:   'DM Sans', sans-serif;
        }

        html { scroll-behavior: smooth; }
        body { font-family: var(--ff-body); background: var(--cream); color: var(--ink); overflow-x: hidden; }

        /* ── NAV ───────────────────────────────────────── */
        nav {
            position: fixed; top: 0; left: 0; right: 0; z-index: 100;
            padding: 0 5%;
            display: flex; align-items: center; justify-content: space-between;
            height: 68px;
            background: rgba(250,247,242,0.85);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(26,92,56,0.1);
            transition: box-shadow .3s;
        }
        nav.scrolled { box-shadow: 0 4px 24px rgba(0,0,0,.07); }
        .nav-brand {
            font-family: var(--ff-head);
            font-size: 1.35rem; font-weight: 800;
            color: var(--green); letter-spacing: -.5px;
            display: flex; align-items: center; gap: 8px;
            text-decoration: none;
        }
        .nav-brand span { color: var(--ink); }
        .nav-links { display: flex; align-items: center; gap: 8px; }
        .nav-links a {
            font-size: .9rem; font-weight: 500; color: var(--ink-mid);
            text-decoration: none; padding: 8px 16px; border-radius: 40px;
            transition: all .2s;
        }
        .nav-links a:hover { background: var(--green-lt); color: var(--green); }
        .btn-nav-login {
            background: var(--green) !important; color: var(--white) !important;
            padding: 10px 22px !important; border-radius: 40px !important;
            font-weight: 600 !important;
        }
        .btn-nav-login:hover { background: var(--green-mid) !important; transform: translateY(-1px); }

        /* ── HERO ──────────────────────────────────────── */
        .hero {
            min-height: 100vh;
            padding: 120px 5% 80px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
            position: relative;
            overflow: hidden;
        }
        .hero::before {
            content: '';
            position: absolute;
            top: -100px; right: -100px;
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(45,122,80,0.12) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }
        .hero::after {
            content: '';
            position: absolute;
            bottom: -60px; left: 30%;
            width: 400px; height: 400px;
            background: radial-gradient(circle, rgba(240,165,0,0.08) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }
        .hero-badge {
            display: inline-flex; align-items: center; gap: 8px;
            background: var(--green-lt); color: var(--green);
            font-size: .8rem; font-weight: 600; letter-spacing: .5px; text-transform: uppercase;
            padding: 7px 16px; border-radius: 40px;
            border: 1px solid rgba(26,92,56,0.2);
            margin-bottom: 24px;
            animation: fadeUp .6s ease both;
        }
        .hero-badge::before {
            content: ''; width: 7px; height: 7px; border-radius: 50%;
            background: var(--green); animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%,100% { opacity: 1; transform: scale(1); }
            50% { opacity: .5; transform: scale(1.3); }
        }
        .hero h1 {
            font-family: var(--ff-head);
            font-size: clamp(2.8rem, 5vw, 4.2rem);
            font-weight: 800; line-height: 1.05;
            letter-spacing: -2px; color: var(--ink);
            animation: fadeUp .6s .1s ease both;
        }
        .hero h1 em {
            font-style: normal; color: var(--green);
            position: relative; display: inline-block;
        }
        .hero h1 em::after {
            content: '';
            position: absolute; left: 0; bottom: 4px;
            width: 100%; height: 6px;
            background: var(--accent); opacity: .4; border-radius: 3px;
        }
        .hero-sub {
            font-size: 1.1rem; color: var(--ink-lt); line-height: 1.7;
            margin: 20px 0 36px; max-width: 440px;
            animation: fadeUp .6s .2s ease both;
        }
        .hero-cta {
            display: flex; gap: 14px; flex-wrap: wrap;
            animation: fadeUp .6s .3s ease both;
        }
        .btn-primary-hero {
            display: inline-flex; align-items: center; gap: 8px;
            background: var(--green); color: var(--white);
            font-family: var(--ff-head); font-weight: 700; font-size: 1rem;
            padding: 14px 28px; border-radius: 40px;
            text-decoration: none; border: none; cursor: pointer;
            transition: all .25s; box-shadow: 0 4px 20px rgba(26,92,56,.3);
        }
        .btn-primary-hero:hover { background: var(--green-mid); transform: translateY(-2px); box-shadow: 0 8px 28px rgba(26,92,56,.35); color: white; }
        .btn-secondary-hero {
            display: inline-flex; align-items: center; gap: 8px;
            background: transparent; color: var(--ink);
            font-weight: 500; font-size: 1rem;
            padding: 14px 28px; border-radius: 40px;
            text-decoration: none; border: 2px solid rgba(0,0,0,.12);
            transition: all .25s;
        }
        .btn-secondary-hero:hover { border-color: var(--green); color: var(--green); background: var(--green-lt); }

        /* Hero Stats */
        .hero-stats {
            display: flex; gap: 32px; margin-top: 40px;
            animation: fadeUp .6s .4s ease both;
        }
        .stat { }
        .stat-num {
            font-family: var(--ff-head); font-size: 1.8rem; font-weight: 800;
            color: var(--ink); line-height: 1;
        }
        .stat-label { font-size: .8rem; color: var(--ink-lt); margin-top: 2px; }

        /* Hero Visual */
        .hero-visual {
            position: relative;
            animation: fadeRight .8s .2s ease both;
        }
        .hero-card-main {
            background: var(--white);
            border-radius: 24px;
            padding: 28px;
            box-shadow: 0 20px 60px rgba(0,0,0,.1);
            position: relative;
        }
        .store-status-pill {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 8px 16px; border-radius: 40px; font-size: .85rem; font-weight: 600;
            margin-bottom: 20px;
        }
        .store-status-pill.open { background: #e8f5ee; color: #1a5c38; }
        .store-status-pill.closed { background: #fdecea; color: #d63329; }
        .store-status-pill::before {
            content: ''; width: 8px; height: 8px; border-radius: 50%;
        }
        .store-status-pill.open::before { background: #1a5c38; animation: pulse 2s infinite; }
        .store-status-pill.closed::before { background: #d63329; }

        .mini-product-grid {
            display: grid; grid-template-columns: 1fr 1fr; gap: 12px;
        }
        .mini-product {
            background: var(--cream); border-radius: 12px; padding: 14px;
            display: flex; align-items: center; gap: 10px;
            border: 1px solid rgba(0,0,0,.06);
        }
        .mini-product-icon {
            width: 40px; height: 40px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.3rem; flex-shrink: 0;
        }
        .mini-product-name { font-size: .78rem; font-weight: 600; color: var(--ink); line-height: 1.3; }
        .mini-product-price { font-size: .75rem; color: var(--green); font-weight: 700; margin-top: 2px; }

        /* Floating badges */
        .float-badge {
            position: absolute; border-radius: 40px; font-size: .8rem; font-weight: 600;
            padding: 8px 14px; box-shadow: 0 8px 24px rgba(0,0,0,.12);
            animation: float 3s ease-in-out infinite;
        }
        .float-badge.badge-1 {
            top: -16px; right: 20px;
            background: var(--accent); color: var(--ink);
            animation-delay: 0s;
        }
        .float-badge.badge-2 {
            bottom: -16px; left: 20px;
            background: var(--green); color: white;
            animation-delay: 1.5s;
        }
        @keyframes float {
            0%,100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeRight {
            from { opacity: 0; transform: translateX(24px); }
            to   { opacity: 1; transform: translateX(0); }
        }

        /* ── SECTION COMMON ────────────────────────────── */
        section { padding: 80px 5%; }
        .section-label {
            font-size: .75rem; font-weight: 700; letter-spacing: 2px; text-transform: uppercase;
            color: var(--green); margin-bottom: 12px;
        }
        .section-title {
            font-family: var(--ff-head); font-size: clamp(1.8rem, 3vw, 2.5rem);
            font-weight: 800; color: var(--ink); letter-spacing: -1px; line-height: 1.1;
            margin-bottom: 12px;
        }
        .section-sub { color: var(--ink-lt); max-width: 500px; line-height: 1.7; }

        /* ── KATEGORI ──────────────────────────────────── */
        .kategori-section { background: var(--white); }
        .kategori-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(130px, 1fr));
            gap: 14px; margin-top: 40px;
        }
        .kategori-card {
            background: var(--cream); border-radius: var(--radius);
            padding: 20px 14px; text-align: center;
            border: 1.5px solid transparent;
            transition: all .25s; cursor: pointer;
            text-decoration: none; display: block;
        }
        .kategori-card:hover {
            border-color: var(--green); background: var(--green-lt);
            transform: translateY(-3px);
        }
        .kat-icon {
            font-size: 2rem; display: block; margin-bottom: 10px;
        }
        .kat-name {
            font-weight: 600; font-size: .85rem; color: var(--ink); display: block;
        }
        .kat-count {
            font-size: .75rem; color: var(--ink-lt); margin-top: 4px; display: block;
        }

        /* ── PRODUK CARDS ──────────────────────────────── */
        .produk-section { background: var(--cream); }
        .produk-header {
            display: flex; align-items: flex-end; justify-content: space-between;
            flex-wrap: wrap; gap: 16px; margin-bottom: 36px;
        }
        .produk-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 18px;
        }
        .produk-card {
            background: var(--white); border-radius: var(--radius);
            overflow: hidden; border: 1.5px solid rgba(0,0,0,.06);
            transition: all .25s;
        }
        .produk-card:hover { transform: translateY(-4px); box-shadow: 0 16px 40px rgba(0,0,0,.1); border-color: var(--green-lt); }
        .produk-img {
            height: 150px; background: var(--cream);
            display: flex; align-items: center; justify-content: center;
            font-size: 3rem; position: relative;
        }
        .produk-body { padding: 16px; }
        .produk-kategori {
            font-size: .7rem; font-weight: 600; letter-spacing: .5px; text-transform: uppercase;
            color: var(--green); margin-bottom: 6px;
        }
        .produk-nama {
            font-weight: 600; font-size: .9rem; color: var(--ink); line-height: 1.3;
            margin-bottom: 10px;
        }
        .produk-footer { display: flex; align-items: center; justify-content: space-between; }
        .produk-harga { font-family: var(--ff-head); font-weight: 700; color: var(--green); font-size: 1rem; }
        .produk-stok { font-size: .75rem; color: var(--ink-lt); }
        .btn-pesan {
            display: block; width: 100%; margin-top: 14px;
            background: var(--green); color: white; border: none;
            padding: 10px; border-radius: 10px; font-weight: 600; font-size: .85rem;
            cursor: pointer; transition: all .2s; text-align: center; text-decoration: none;
        }
        .btn-pesan:hover { background: var(--green-mid); color: white; }
        .btn-pesan.locked { background: var(--cream); color: var(--ink-lt); border: 1.5px solid rgba(0,0,0,.1); cursor: default; }

        /* Login prompt overlay */
        .login-prompt {
            display: none; position: fixed; inset: 0;
            background: rgba(17,24,16,.6); backdrop-filter: blur(6px);
            z-index: 200; align-items: center; justify-content: center;
        }
        .login-prompt.show { display: flex; }
        .login-modal {
            background: var(--white); border-radius: 24px; padding: 40px;
            max-width: 400px; width: 90%; text-align: center;
            animation: fadeUp .3s ease both;
            box-shadow: 0 40px 80px rgba(0,0,0,.2);
        }
        .login-modal .icon { font-size: 3rem; margin-bottom: 16px; }
        .login-modal h3 { font-family: var(--ff-head); font-size: 1.5rem; font-weight: 800; margin-bottom: 10px; }
        .login-modal p { color: var(--ink-lt); line-height: 1.6; margin-bottom: 24px; }
        .modal-btns { display: flex; gap: 12px; justify-content: center; }

        /* ── CARA PESAN ────────────────────────────────── */
        .howto-section { background: var(--white); }
        .howto-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 24px; margin-top: 48px; }
        .howto-step {
            position: relative; padding: 28px 24px;
            background: var(--cream); border-radius: var(--radius);
            border: 1.5px solid rgba(0,0,0,.06);
        }
        .step-num {
            font-family: var(--ff-head); font-size: 3.5rem; font-weight: 800;
            color: rgba(26,92,56,.08); line-height: 1;
            position: absolute; top: 16px; right: 20px;
        }
        .step-icon { font-size: 1.8rem; margin-bottom: 14px; display: block; }
        .step-title { font-family: var(--ff-head); font-size: 1rem; font-weight: 700; margin-bottom: 6px; }
        .step-desc { font-size: .85rem; color: var(--ink-lt); line-height: 1.6; }

        /* ── FOOTER ────────────────────────────────────── */
        footer {
            background: var(--ink); color: rgba(255,255,255,.5);
            padding: 40px 5%; text-align: center;
            font-size: .85rem;
        }
        footer strong { color: var(--white); font-family: var(--ff-head); }

        /* ── RESPONSIVE ────────────────────────────────── */
        @media (max-width: 768px) {
            .hero { grid-template-columns: 1fr; gap: 40px; padding-top: 100px; }
            .hero-visual { display: none; }
            .hero-stats { gap: 20px; }
            .nav-links a:not(.btn-nav-login) { display: none; }
        }
    </style>
</head>
<body>

{{-- ══ NAVBAR ══════════════════════════════════════════════ --}}
<nav id="navbar">
    <a href="{{ route('landing') }}" class="nav-brand">
        🛒 <span>Go</span>Pusram
    </a>
    <div class="nav-links">
        <a href="#kategori">Kategori</a>
        <a href="#produk">Produk</a>
        <a href="#cara-pesan">Cara Pesan</a>
        @auth
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="btn-nav-login">Dashboard</a>
            @elseif(auth()->user()->role === 'pm')
                <a href="{{ route('pm.dashboard') }}" class="btn-nav-login">Dashboard</a>
            @else
                <a href="{{ route('siswa.katalog') }}" class="btn-nav-login">Mulai Belanja</a>
            @endif
        @else
            <a href="{{ route('login') }}" style="font-weight:500;color:var(--ink-mid)">Masuk</a>
            <a href="{{ route('register') }}" class="btn-nav-login">Daftar Gratis</a>
        @endauth
    </div>
</nav>

{{-- ══ HERO ════════════════════════════════════════════════ --}}
<section class="hero">
    <div class="hero-content">
        <div class="hero-badge">
            <i class="bi bi-shop"></i> Minimarket Digital Sekolah
        </div>

        <h1>
            Jajan Mudah,<br>
            <em>Tanpa Antri</em><br>
            di Pusram
        </h1>

        <p class="hero-sub">
            Pesan makanan, minuman, dan kebutuhan sekolahmu langsung dari HP.
            Bayar di tempat atau e-wallet, pilih ambil sendiri atau diantar ke kelas.
        </p>

        <div class="hero-cta">
            @auth
                <a href="{{ auth()->user()->role === 'siswa' ? route('siswa.katalog') : route(auth()->user()->role.'.dashboard') }}"
                   class="btn-primary-hero">
                    <i class="bi bi-bag-heart"></i> Lihat Katalog
                </a>
            @else
                <a href="{{ route('register') }}" class="btn-primary-hero">
                    <i class="bi bi-bag-heart"></i> Mulai Pesan Sekarang
                </a>
                <a href="{{ route('login') }}" class="btn-secondary-hero">
                    Sudah punya akun <i class="bi bi-arrow-right"></i>
                </a>
            @endauth
        </div>

        <div class="hero-stats">
            <div class="stat">
                <div class="stat-num">50+</div>
                <div class="stat-label">Produk Tersedia</div>
            </div>
            <div class="stat">
                <div class="stat-num">7</div>
                <div class="stat-label">Kategori</div>
            </div>
            <div class="stat">
                <div class="stat-num">
                    @if($operatingHour->isCurrentlyOpen())
                        <span style="color:var(--green)">Buka</span>
                    @else
                        <span style="color:var(--red)">Tutup</span>
                    @endif
                </div>
                <div class="stat-label">Status Toko</div>
            </div>
        </div>
    </div>

    {{-- Hero Visual --}}
    <div class="hero-visual">
        <div class="float-badge badge-1">🔥 Terlaris hari ini!</div>
        <div class="hero-card-main">
            <div class="store-status-pill {{ $operatingHour->isCurrentlyOpen() ? 'open' : 'closed' }}">
                {{ $operatingHour->isCurrentlyOpen() ? 'Pusram Sedang Buka' : 'Pusram Sedang Tutup' }}
                &nbsp;·&nbsp;
                {{ \Carbon\Carbon::parse($operatingHour->jam_buka)->format('H:i') }}–{{ \Carbon\Carbon::parse($operatingHour->jam_tutup)->format('H:i') }} WIB
            </div>
            <div class="mini-product-grid">
                @php
                    $emojiMap = [
                        'Minuman'              => '🥤',
                        'Makanan Ringan'       => '🍿',
                        'Mie & Makanan Instan' => '🍜',
                        'Roti & Kue'          => '🍞',
                        'Permen & Cokelat'    => '🍫',
                        'Kebutuhan Sehari-hari'=> '📦',
                        'Frozen Food'         => '❄️',
                    ];
                    $bgMap = [
                        'Minuman'              => '#e8f4fd',
                        'Makanan Ringan'       => '#fef5e4',
                        'Mie & Makanan Instan' => '#fef5e4',
                        'Roti & Kue'          => '#fef5e4',
                        'Permen & Cokelat'    => '#fdecea',
                        'Kebutuhan Sehari-hari'=> '#e8f5ee',
                        'Frozen Food'         => '#e8f4fd',
                    ];
                @endphp
                @foreach($featuredProducts->take(4) as $p)
                <div class="mini-product">
                    <div class="mini-product-icon"
                         style="background:{{ $bgMap[$p->category->nama_kategori] ?? '#f0f0f0' }}">
                        {{ $emojiMap[$p->category->nama_kategori] ?? '🛍️' }}
                    </div>
                    <div>
                        <div class="mini-product-name">{{ Str::limit($p->nama_produk, 22) }}</div>
                        <div class="mini-product-price">{{ $p->hargaFormatted() }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="float-badge badge-2">
            <i class="bi bi-bicycle me-1"></i>Antar ke kelas!
        </div>
    </div>
</section>

{{-- ══ KATEGORI ════════════════════════════════════════════ --}}
<section class="kategori-section" id="kategori">
    <div class="section-label">Jelajahi</div>
    <div style="display:flex;align-items:flex-end;justify-content:space-between;flex-wrap:wrap;gap:16px">
        <div>
            <div class="section-title">Semua Kategori</div>
            <div class="section-sub">Dari minuman segar sampai kebutuhan belajar, semua ada di Pusram.</div>
        </div>
    </div>

    <div class="kategori-grid">
        @foreach($categories as $cat)
        @php
            $icon = $emojiMap[$cat->nama_kategori] ?? '🛍️';
            $bg   = $bgMap[$cat->nama_kategori]    ?? '#f5f5f5';
        @endphp
        <a href="{{ auth()->check() && auth()->user()->role === 'siswa'
                    ? route('siswa.katalog', ['category_id' => $cat->id])
                    : route('login') }}"
           class="kategori-card">
            <span class="kat-icon" style="background:{{ $bg }};border-radius:12px;padding:8px;display:inline-block">
                {{ $icon }}
            </span>
            <span class="kat-name">{{ $cat->nama_kategori }}</span>
            <span class="kat-count">{{ $cat->products_count }} produk</span>
        </a>
        @endforeach
    </div>
</section>

{{-- ══ PRODUK UNGGULAN ═════════════════════════════════════ --}}
<section class="produk-section" id="produk">
    <div class="produk-header">
        <div>
            <div class="section-label">Pilihan Hari Ini</div>
            <div class="section-title">Produk Unggulan</div>
        </div>
        @auth
            @if(auth()->user()->role === 'siswa')
            <a href="{{ route('siswa.katalog') }}" class="btn-secondary-hero" style="font-size:.9rem;padding:10px 22px">
                Lihat Semua <i class="bi bi-arrow-right"></i>
            </a>
            @endif
        @else
            <a href="{{ route('register') }}" class="btn-secondary-hero" style="font-size:.9rem;padding:10px 22px">
                Daftar untuk Belanja <i class="bi bi-arrow-right"></i>
            </a>
        @endauth
    </div>

    <div class="produk-grid">
        @foreach($featuredProducts as $p)
        @php
            $icon = $emojiMap[$p->category->nama_kategori] ?? '🛍️';
            $bg   = $bgMap[$p->category->nama_kategori]    ?? '#f5f5f5';
        @endphp
        <div class="produk-card">
            <div class="produk-img" style="background:{{ $bg }}">
                @if($p->gambar)
                    <img src="{{ Storage::url($p->gambar) }}"
                         style="width:100%;height:100%;object-fit:cover">
                @else
                    {{ $icon }}
                @endif
                @if($p->stok < 5)
                    <span style="position:absolute;top:10px;right:10px;background:#d63329;color:white;font-size:.65rem;font-weight:700;padding:3px 8px;border-radius:20px;letter-spacing:.5px">
                        STOK TIPIS
                    </span>
                @endif
            </div>
            <div class="produk-body">
                <div class="produk-kategori">{{ $p->category->nama_kategori }}</div>
                <div class="produk-nama">{{ $p->nama_produk }}</div>
                <div class="produk-footer">
                    <div class="produk-harga">{{ $p->hargaFormatted() }}</div>
                    <div class="produk-stok">Stok: {{ $p->stok }}</div>
                </div>
                @if($operatingHour->isCurrentlyOpen())
                    @auth
                        @if(auth()->user()->role === 'siswa')
                            <form action="{{ route('siswa.cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $p->id }}">
                                <button type="submit" class="btn-pesan">
                                    <i class="bi bi-cart-plus me-1"></i>Tambah ke Keranjang
                                </button>
                            </form>
                        @else
                            <span class="btn-pesan locked">Login sebagai siswa untuk memesan</span>
                        @endif
                    @else
                        <a href="javascript:void(0)" onclick="showLoginPrompt()" class="btn-pesan">
                            <i class="bi bi-cart-plus me-1"></i>Pesan Sekarang
                        </a>
                    @endauth
                @else
                    <span class="btn-pesan locked"><i class="bi bi-lock me-1"></i>Toko Tutup</span>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</section>

{{-- ══ CARA PESAN ══════════════════════════════════════════ --}}
<section class="howto-section" id="cara-pesan">
    <div style="text-align:center;max-width:560px;margin:0 auto 0">
        <div class="section-label" style="justify-content:center;display:flex">Panduan</div>
        <div class="section-title" style="text-align:center">Cara Pesan di GoPusram</div>
        <div class="section-sub" style="margin:0 auto;text-align:center">
            Cukup 4 langkah mudah, pesananmu langsung diproses oleh petugas Pusram.
        </div>
    </div>

    <div class="howto-grid">
        <div class="howto-step">
            <span class="step-num">01</span>
            <span class="step-icon">📝</span>
            <div class="step-title">Daftar Akun</div>
            <p class="step-desc">Buat akun dengan email sekolahmu dan isi data kelas. Gratis dan cepat.</p>
        </div>
        <div class="howto-step">
            <span class="step-num">02</span>
            <span class="step-icon">🛒</span>
            <div class="step-title">Pilih Produk</div>
            <p class="step-desc">Jelajahi katalog, filter kategori, dan tambahkan produk ke keranjang belanja.</p>
        </div>
        <div class="howto-step">
            <span class="step-num">03</span>
            <span class="step-icon">📦</span>
            <div class="step-title">Checkout</div>
            <p class="step-desc">Pilih ambil sendiri atau antar ke kelas. Bayar cash atau e-wallet.</p>
        </div>
        <div class="howto-step">
            <span class="step-num">04</span>
            <span class="step-icon">✅</span>
            <div class="step-title">Terima Pesanan</div>
            <p class="step-desc">Pantau status pesanan secara real-time. Notifikasi otomatis dikirim ke akunmu.</p>
        </div>
    </div>

    <div style="text-align:center;margin-top:48px">
        @guest
        <a href="{{ route('register') }}" class="btn-primary-hero" style="display:inline-flex">
            <i class="bi bi-person-plus"></i> Daftar Sekarang — Gratis!
        </a>
        @endguest
    </div>
</section>

{{-- ══ FOOTER ══════════════════════════════════════════════ --}}
<footer>
    <p>
        <strong>🛒 GoPusram</strong> — Sistem Pemesanan Minimarket Sekolah<br>
        <span style="font-size:.8rem;margin-top:6px;display:block">
            Dikelola oleh Siswa Jurusan Pemasaran &nbsp;·&nbsp; {{ now()->year }}
        </span>
    </p>
</footer>

{{-- ══ LOGIN PROMPT MODAL ═══════════════════════════════════ --}}
<div class="login-prompt" id="loginPrompt" onclick="if(event.target===this)hideLoginPrompt()">
    <div class="login-modal">
        <div class="icon">🛒</div>
        <h3>Mau Pesan?</h3>
        <p>Kamu perlu login dulu untuk bisa menambahkan produk ke keranjang dan melakukan pemesanan.</p>
        <div class="modal-btns">
            <a href="{{ route('login') }}" class="btn-primary-hero" style="padding:12px 24px;font-size:.9rem">
                <i class="bi bi-box-arrow-in-right"></i> Login
            </a>
            <a href="{{ route('register') }}" class="btn-secondary-hero" style="padding:12px 24px;font-size:.9rem">
                Daftar Dulu
            </a>
        </div>
        <button onclick="hideLoginPrompt()" style="margin-top:16px;background:none;border:none;color:var(--ink-lt);cursor:pointer;font-size:.85rem">
            Tutup
        </button>
    </div>
</div>

<script>
    // Navbar shadow on scroll
    window.addEventListener('scroll', () => {
        document.getElementById('navbar').classList.toggle('scrolled', window.scrollY > 20);
    });

    // Login prompt modal
    function showLoginPrompt() {
        document.getElementById('loginPrompt').classList.add('show');
        document.body.style.overflow = 'hidden';
    }
    function hideLoginPrompt() {
        document.getElementById('loginPrompt').classList.remove('show');
        document.body.style.overflow = '';
    }
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') hideLoginPrompt();
    });

    // Staggered card animation on scroll
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, i) => {
            if (entry.isIntersecting) {
                entry.target.style.animationDelay = (i * 0.05) + 's';
                entry.target.classList.add('visible');
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.produk-card, .howto-step, .kategori-card').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(16px)';
        el.style.transition = 'opacity .4s ease, transform .4s ease';
        observer.observe(el);
    });

    // Fake observer trigger for visible items
    setTimeout(() => {
        document.querySelectorAll('.produk-card, .howto-step, .kategori-card').forEach((el, i) => {
            setTimeout(() => {
                el.style.opacity = '1';
                el.style.transform = 'translateY(0)';
            }, i * 60);
        });
    }, 200);
</script>

</body>
</html>