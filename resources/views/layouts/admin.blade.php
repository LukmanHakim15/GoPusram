<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin — GoPusram')</title>
    <link rel="stylesheet" href="{{ asset('css/gopusram.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f5f6f4; margin: 0; }
        .gp-sidebar { background: #111810; }
    </style>
</head>
<body>

<aside class="gp-sidebar">
    <a href="{{ route('landing') }}" class="gp-sidebar-brand">
        🛒 Go<span class="brand-dot">Pusram</span>
    </a>
    <span class="gp-sidebar-role">Administrator</span>

    <nav>
        <a href="{{ route('admin.dashboard') }}"
           class="gp-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2"></i> Dashboard
        </a>
        <a href="{{ route('admin.products.index') }}"
           class="gp-nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
            <i class="bi bi-box-seam"></i> Produk
        </a>
        <a href="{{ route('admin.categories.index') }}"
           class="gp-nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
            <i class="bi bi-tags"></i> Kategori
        </a>
        <a href="{{ route('admin.orders.index') }}"
           class="gp-nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
            <i class="bi bi-receipt"></i> Pesanan
            @php $pending = \App\Models\Order::where('status_pesanan','pending')->count(); @endphp
            @if($pending > 0)
                <span class="gp-nav-badge">{{ $pending }}</span>
            @endif
        </a>
        <a href="{{ route('admin.operating-hours') }}"
           class="gp-nav-link {{ request()->routeIs('admin.operating-hours*') ? 'active' : '' }}">
            <i class="bi bi-clock"></i> Jam Operasional
        </a>
        <a href="{{ route('admin.reports.index') }}"
           class="gp-nav-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
            <i class="bi bi-bar-chart-line"></i> Laporan
        </a>
    </nav>

    <div class="gp-sidebar-footer">
        <div class="gp-sidebar-user">
            <div class="gp-sidebar-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            <div>
                <div class="gp-sidebar-name">{{ Str::limit(auth()->user()->name, 18) }}</div>
                <div class="gp-sidebar-kelas">Administrator</div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="gp-logout-btn">
                <i class="bi bi-box-arrow-right"></i> Keluar dari akun
            </button>
        </form>
    </div>
</aside>

<div class="gp-main-wrap">
    <div class="gp-topbar">
        <span class="gp-topbar-title">@yield('page-title', 'Dashboard')</span>
        <div style="display:flex;align-items:center;gap:10px">
            @php $oh = \App\Models\OperatingHour::getSetting(); @endphp
            <span class="gp-badge {{ $oh->isCurrentlyOpen() ? 'green' : 'red' }}">
                <span style="width:6px;height:6px;border-radius:50%;background:currentColor;display:inline-block"></span>
                Toko {{ $oh->isCurrentlyOpen() ? 'Buka' : 'Tutup' }}
            </span>
        </div>
    </div>

    <main class="gp-content">
        @if(session('success'))
            <div class="gp-alert success gp-animate">
                <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="gp-alert error gp-animate">
                <i class="bi bi-exclamation-circle-fill"></i> {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>