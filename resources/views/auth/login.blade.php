<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk — GoPusram</title>
    <link rel="stylesheet" href="{{ asset('css/gopusram.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background: var(--cream); min-height: 100vh; display: grid; grid-template-columns: 1fr 1fr; }

        .auth-left {
            background: var(--green);
            padding: 60px;
            display: flex; flex-direction: column; justify-content: space-between;
            position: relative; overflow: hidden;
        }
        .auth-left::before {
            content: '';
            position: absolute; top: -80px; right: -80px;
            width: 400px; height: 400px; border-radius: 50%;
            background: rgba(255,255,255,.05);
        }
        .auth-left::after {
            content: '';
            position: absolute; bottom: -60px; left: -60px;
            width: 300px; height: 300px; border-radius: 50%;
            background: rgba(255,255,255,.04);
        }
        .auth-brand {
            font-family: var(--ff-head); font-size: 1.5rem; font-weight: 800;
            color: white; text-decoration: none; display: flex; align-items: center; gap: 10px;
        }
        .auth-left-content { position: relative; z-index: 1; }
        .auth-left h2 {
            font-family: var(--ff-head); font-size: 2.4rem; font-weight: 800;
            color: white; line-height: 1.15; letter-spacing: -1px; margin-bottom: 16px;
        }
        .auth-left p { color: rgba(255,255,255,.65); line-height: 1.7; font-size: .95rem; max-width: 340px; }
        .auth-features { margin-top: 32px; display: flex; flex-direction: column; gap: 14px; }
        .auth-feature {
            display: flex; align-items: center; gap: 12px;
            color: rgba(255,255,255,.8); font-size: .88rem;
        }
        .auth-feature-icon {
            width: 34px; height: 34px; border-radius: 10px;
            background: rgba(255,255,255,.12);
            display: flex; align-items: center; justify-content: center;
            font-size: 1rem; flex-shrink: 0;
        }
        .auth-left-bottom { color: rgba(255,255,255,.35); font-size: .78rem; position: relative; z-index: 1; }

        .auth-right {
            display: flex; align-items: center; justify-content: center;
            padding: 60px 40px;
        }
        .auth-form-box { width: 100%; max-width: 400px; }
        .auth-form-box h3 {
            font-family: var(--ff-head); font-size: 1.8rem; font-weight: 800;
            color: var(--ink); letter-spacing: -.5px; margin-bottom: 6px;
        }
        .auth-form-box .subtitle { color: var(--ink-lt); font-size: .9rem; margin-bottom: 32px; }
        .form-group { margin-bottom: 20px; }
        .input-wrap { position: relative; }
        .input-wrap i {
            position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
            color: var(--ink-lt); font-size: 1rem; pointer-events: none;
        }
        .input-wrap .gp-input { padding-left: 42px; }
        .auth-submit {
            width: 100%; padding: 13px; border-radius: 40px;
            background: var(--green); color: white; border: none;
            font-family: var(--ff-head); font-weight: 700; font-size: 1rem;
            cursor: pointer; transition: all .2s;
            box-shadow: 0 4px 20px rgba(26,92,56,.3);
        }
        .auth-submit:hover { background: var(--green-mid); transform: translateY(-1px); }
        .auth-divider {
            text-align: center; color: var(--ink-lt); font-size: .82rem;
            margin: 20px 0; position: relative;
        }
        .auth-divider::before, .auth-divider::after {
            content: ''; position: absolute; top: 50%;
            width: 42%; height: 1px; background: var(--border);
        }
        .auth-divider::before { left: 0; }
        .auth-divider::after { right: 0; }
        .auth-alt {
            text-align: center; font-size: .88rem; color: var(--ink-lt); margin-top: 20px;
        }
        .auth-alt a { color: var(--green); font-weight: 700; text-decoration: none; }
        .auth-alt a:hover { text-decoration: underline; }
        .remember-row { display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px; }
        .remember-row label { display: flex; align-items: center; gap: 8px; font-size: .85rem; color: var(--ink-mid); cursor: pointer; }
        .remember-row a { font-size: .85rem; color: var(--green); text-decoration: none; font-weight: 500; }

        @media (max-width: 768px) {
            body { grid-template-columns: 1fr; }
            .auth-left { display: none; }
            .auth-right { padding: 40px 24px; }
        }
    </style>
</head>
<body>

{{-- Kiri: Branding --}}
<div class="auth-left">
    <a href="{{ route('landing') }}" class="auth-brand">🛒 GoPusram</a>

    <div class="auth-left-content">
        <h2>Selamat datang kembali!</h2>
        <p>Masuk ke akunmu dan mulai pesan makanan atau kebutuhan sekolah tanpa antri.</p>
        <div class="auth-features">
            <div class="auth-feature">
                <div class="auth-feature-icon">🛒</div>
                <span>50+ produk minimarket tersedia</span>
            </div>
            <div class="auth-feature">
                <div class="auth-feature-icon">🚲</div>
                <span>Pilih ambil sendiri atau antar ke kelas</span>
            </div>
            <div class="auth-feature">
                <div class="auth-feature-icon">💳</div>
                <span>Bayar cash atau e-wallet</span>
            </div>
            <div class="auth-feature">
                <div class="auth-feature-icon">📱</div>
                <span>Pantau status pesanan real-time</span>
            </div>
        </div>
    </div>

    <div class="auth-left-bottom">
        © {{ now()->year }} GoPusram · Minimarket Sekolah
    </div>
</div>

{{-- Kanan: Form Login --}}
<div class="auth-right">
    <div class="auth-form-box gp-animate">

        <h3>Masuk Akun</h3>
        <p class="subtitle">Masukkan email dan password yang sudah terdaftar.</p>

        @if(session('status'))
            <div class="gp-alert success"><i class="bi bi-check-circle-fill"></i> {{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label class="gp-label">Email</label>
                <div class="input-wrap">
                    <i class="bi bi-envelope"></i>
                    <input type="email" name="email"
                           class="gp-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                           value="{{ old('email') }}" required autofocus
                           placeholder="email@sekolah.com">
                </div>
                @error('email')
                    <div class="gp-invalid"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="gp-label">Password</label>
                <div class="input-wrap">
                    <i class="bi bi-lock"></i>
                    <input type="password" name="password"
                           class="gp-input {{ $errors->has('password') ? 'is-invalid' : '' }}"
                           required placeholder="••••••••">
                </div>
                @error('password')
                    <div class="gp-invalid"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                @enderror
            </div>

            <div class="remember-row">
                <label>
                    <input type="checkbox" name="remember" style="accent-color:var(--green)">
                    Ingat saya
                </label>
                @if(Route::has('password.request'))
                    <a href="{{ route('password.request') }}">Lupa password?</a>
                @endif
            </div>

            <button type="submit" class="auth-submit">
                Masuk ke GoPusram
            </button>
        </form>

        <div class="auth-alt">
            Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
        </div>
    </div>
</div>

</body>
</html>