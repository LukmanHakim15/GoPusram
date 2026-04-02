<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GoPusram')</title>
    <link rel="stylesheet" href="{{ asset('css/gopusram.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f5f6f4; margin: 0; }

        /* Topnav untuk siswa */
        .gp-topnav {
            position: sticky; top: 0; z-index: 100;
            background: var(--white); border-bottom: 1.5px solid var(--border);
            padding: 0 5%; height: 64px;
            display: flex; align-items: center; justify-content: space-between;
        }
        .gp-topnav-brand {
            font-family: var(--ff-head); font-size: 1.25rem; font-weight: 800;
            color: var(--green); text-decoration: none; display: flex; align-items: center; gap: 8px;
        }
        .gp-topnav-right { display: flex; align-items: center; gap: 6px; }
        .gp-icon-btn {
            width: 40px; height: 40px; border-radius: 10px;
            border: 1.5px solid var(--border); background: var(--white);
            display: flex; align-items: center; justify-content: center;
            color: var(--ink-mid); text-decoration: none; position: relative;
            transition: all .15s; cursor: pointer;
        }
        .gp-icon-btn:hover { background: var(--green-lt); border-color: var(--green); color: var(--green); }
        .gp-icon-btn .notif-dot {
            position: absolute; top: -3px; right: -3px;
            width: 16px; height: 16px; border-radius: 50%;
            background: var(--danger); color: white;
            font-size: .6rem; font-weight: 700;
            display: flex; align-items: center; justify-content: center;
            border: 2px solid white;
        }
        .gp-user-btn {
            display: flex; align-items: center; gap: 8px;
            padding: 6px 12px 6px 6px;
            border: 1.5px solid var(--border); border-radius: 40px;
            background: var(--white); cursor: pointer;
            text-decoration: none; transition: all .15s;
        }
        .gp-user-btn:hover { border-color: var(--green); background: var(--green-lt); }
        .gp-user-avatar {
            width: 30px; height: 30px; border-radius: 8px;
            background: var(--green); color: white;
            display: flex; align-items: center; justify-content: center;
            font-family: var(--ff-head); font-weight: 800; font-size: .82rem;
        }
        .gp-user-name { font-size: .82rem; font-weight: 600; color: var(--ink); }

        /* Dropdown */
        .gp-dropdown { position: relative; }
        .gp-dropdown-menu {
            display: none; position: absolute; right: 0; top: calc(100% + 8px);
            background: var(--white); border: 1.5px solid var(--border);
            border-radius: var(--radius); box-shadow: var(--shadow-lg);
            min-width: 200px; padding: 6px; z-index: 200;
        }
        .gp-dropdown:hover .gp-dropdown-menu { display: block; }
        .gp-dropdown-item {
            display: flex; align-items: center; gap: 10px;
            padding: 9px 12px; border-radius: 8px; font-size: .85rem;
            color: var(--ink-mid); text-decoration: none; transition: all .12s;
        }
        .gp-dropdown-item:hover { background: var(--cream); color: var(--green); }
        .gp-dropdown-item.danger { color: var(--danger); }
        .gp-dropdown-item.danger:hover { background: #fdecea; }
        .gp-dropdown-divider { height: 1px; background: var(--border); margin: 4px 0; }
        .gp-dropdown-header { padding: 8px 12px 4px; font-size: .72rem; font-weight: 700; letter-spacing: .5px; text-transform: uppercase; color: var(--ink-lt); }

        .siswa-content { padding: 2rem 5%; max-width: 1400px; margin: 0 auto; }
    </style>
</head>
<body>

<nav class="gp-topnav">
    <a href="{{ route('landing') }}" class="gp-topnav-brand">
        🛒 GoPusram
    </a>

    <div class="gp-topnav-right">
        {{-- Notifikasi --}}
        <a href="#" class="gp-icon-btn">
            <i class="bi bi-bell" style="font-size:1rem"></i>
            @if(auth()->user()->unreadNotificationsCount() > 0)
                <span class="notif-dot">{{ auth()->user()->unreadNotificationsCount() }}</span>
            @endif
        </a>

        {{-- Keranjang --}}
        <a href="{{ route('siswa.cart.index') }}" class="gp-icon-btn">
            <i class="bi bi-bag" style="font-size:1rem"></i>
            @php $cartCount = auth()->user()->cart?->items()->count() ?? 0; @endphp
            @if($cartCount > 0)
                <span class="notif-dot" style="background:var(--green)">{{ $cartCount }}</span>
            @endif
        </a>

        {{-- User dropdown --}}
        <div class="gp-dropdown">
            <div class="gp-user-btn">
                <div class="gp-user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                <span class="gp-user-name">{{ Str::limit(auth()->user()->name, 14) }}</span>
                <i class="bi bi-chevron-down" style="font-size:.7rem;color:var(--ink-lt)"></i>
            </div>
            <div class="gp-dropdown-menu">
                <div class="gp-dropdown-header">{{ auth()->user()->kelas }}</div>
                <a href="{{ route('siswa.katalog') }}" class="gp-dropdown-item">
                    <i class="bi bi-shop"></i> Katalog Produk
                </a>
                <a href="{{ route('siswa.orders.index') }}" class="gp-dropdown-item">
                    <i class="bi bi-receipt"></i> Riwayat Pesanan
                </a>
                <div class="gp-dropdown-divider"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="gp-dropdown-item danger" style="width:100%;border:none;background:none;cursor:pointer;text-align:left">
                        <i class="bi bi-box-arrow-right"></i> Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<main class="siswa-content">
    @if(session('success'))
        <div class="gp-alert success gp-animate" style="margin-bottom:20px">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="gp-alert error gp-animate" style="margin-bottom:20px">
            <i class="bi bi-exclamation-circle-fill"></i> {{ session('error') }}
        </div>
    @endif

    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>