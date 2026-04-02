<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PM — GoPusram')</title>
    <link rel="stylesheet" href="{{ asset('css/gopusram.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f5f6f4; margin: 0; }
        .gp-sidebar { background: #1a2e1f; }
        .gp-sidebar-brand { border-color: rgba(255,255,255,.06); }
        .gp-pm-tag {
            display: inline-block; background: var(--accent); color: var(--ink);
            font-size: .6rem; font-weight: 800; letter-spacing: 1px;
            padding: 2px 8px; border-radius: 4px; text-transform: uppercase;
            margin-left: 4px; vertical-align: middle;
        }
    </style>
</head>
<body>

<aside class="gp-sidebar">
    <a href="{{ route('landing') }}" class="gp-sidebar-brand">
        🛒 GoPusram <span class="gp-pm-tag">PM</span>
    </a>
    <span class="gp-sidebar-role">Petugas Minimarket</span>

    <nav>
        <a href="{{ route('pm.dashboard') }}"
           class="gp-nav-link {{ request()->routeIs('pm.dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2"></i> Dashboard
        </a>
        <a href="{{ route('pm.orders.index') }}"
           class="gp-nav-link {{ request()->routeIs('pm.orders.*') ? 'active' : '' }}">
            <i class="bi bi-receipt"></i> Pesanan Masuk
            @php $pending = \App\Models\Order::whereIn('status_pesanan',['pending','diproses'])->count(); @endphp
            @if($pending > 0)
                <span class="gp-nav-badge">{{ $pending }}</span>
            @endif
        </a>
    </nav>

    <div class="gp-sidebar-footer">
        <div class="gp-sidebar-user">
            <div class="gp-sidebar-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            <div>
                <div class="gp-sidebar-name">{{ Str::limit(auth()->user()->name, 18) }}</div>
                <div class="gp-sidebar-kelas">{{ auth()->user()->kelas }}</div>
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
        <span class="gp-topbar-title">@yield('page-title')</span>
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