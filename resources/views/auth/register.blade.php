<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar — GoPusram</title>
    <link rel="stylesheet" href="{{ asset('css/gopusram.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background: var(--cream); min-height: 100vh; display: grid; grid-template-columns: 1fr 1fr; }
        .auth-left {
            background: var(--ink); padding: 60px;
            display: flex; flex-direction: column; justify-content: space-between;
            position: relative; overflow: hidden;
        }
        .auth-left::before {
            content: ''; position: absolute; top: -80px; right: -80px;
            width: 400px; height: 400px; border-radius: 50%; background: rgba(255,255,255,.03);
        }
        .auth-brand {
            font-family: var(--ff-head); font-size: 1.5rem; font-weight: 800;
            color: white; text-decoration: none; display: flex; align-items: center; gap: 10px;
        }
        .auth-left-content { position: relative; z-index: 1; }
        .auth-left h2 {
            font-family: var(--ff-head); font-size: 2.2rem; font-weight: 800;
            color: white; line-height: 1.15; letter-spacing: -1px; margin-bottom: 14px;
        }
        .auth-left h2 span { color: #4caf7d; }
        .auth-left p { color: rgba(255,255,255,.5); line-height: 1.7; font-size: .9rem; }
        .auth-steps { margin-top: 36px; display: flex; flex-direction: column; gap: 20px; }
        .auth-step { display: flex; gap: 14px; align-items: flex-start; }
        .auth-step-num {
            width: 30px; height: 30px; border-radius: 8px; background: var(--green);
            display: flex; align-items: center; justify-content: center;
            font-family: var(--ff-head); font-size: .85rem; font-weight: 800; color: white; flex-shrink: 0;
        }
        .auth-step-title { font-size: .88rem; font-weight: 600; color: rgba(255,255,255,.8); }
        .auth-step-sub { font-size: .78rem; color: rgba(255,255,255,.35); margin-top: 2px; }
        .auth-left-bottom { color: rgba(255,255,255,.25); font-size: .78rem; position: relative; z-index: 1; }

        .auth-right {
            display: flex; align-items: center; justify-content: center; padding: 50px 40px;
        }
        .auth-form-box { width: 100%; max-width: 420px; }
        .auth-form-box h3 {
            font-family: var(--ff-head); font-size: 1.7rem; font-weight: 800;
            color: var(--ink); letter-spacing: -.5px; margin-bottom: 4px;
        }
        .subtitle { color: var(--ink-lt); font-size: .88rem; margin-bottom: 28px; }
        .form-group { margin-bottom: 16px; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
        .input-wrap { position: relative; }
        .input-wrap i { position: absolute; left: 13px; top: 50%; transform: translateY(-50%); color: var(--ink-lt); font-size: .95rem; pointer-events: none; }
        .input-wrap .gp-input { padding-left: 40px; }
        .auth-submit {
            width: 100%; padding: 13px; border-radius: 40px;
            background: var(--green); color: white; border: none;
            font-family: var(--ff-head); font-weight: 700; font-size: 1rem;
            cursor: pointer; transition: all .2s; box-shadow: 0 4px 20px rgba(26,92,56,.3);
            margin-top: 8px;
        }
        .auth-submit:hover { background: var(--green-mid); transform: translateY(-1px); }
        .auth-alt { text-align: center; font-size: .85rem; color: var(--ink-lt); margin-top: 18px; }
        .auth-alt a { color: var(--green); font-weight: 700; text-decoration: none; }
        @media (max-width: 768px) {
            body { grid-template-columns: 1fr; }
            .auth-left { display: none; }
            .auth-right { padding: 36px 20px; }
            .form-row { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<div class="auth-left">
    <a href="{{ route('landing') }}" class="auth-brand">🛒 GoPusram</a>
    <div class="auth-left-content">
        <h2>Bergabung dengan<br><span>GoPusram</span></h2>
        <p>Daftar gratis dalam 1 menit dan mulai pesan dari Pusram tanpa harus ke sana langsung.</p>
        <div class="auth-steps">
            <div class="auth-step">
                <div class="auth-step-num">1</div>
                <div>
                    <div class="auth-step-title">Isi data diri</div>
                    <div class="auth-step-sub">Nama, kelas, dan email sekolahmu</div>
                </div>
            </div>
            <div class="auth-step">
                <div class="auth-step-num">2</div>
                <div>
                    <div class="auth-step-title">Verifikasi akun</div>
                    <div class="auth-step-sub">Login langsung setelah daftar</div>
                </div>
            </div>
            <div class="auth-step">
                <div class="auth-step-num">3</div>
                <div>
                    <div class="auth-step-title">Mulai pesan!</div>
                    <div class="auth-step-sub">Pilih produk, checkout, dan tunggu di kelas</div>
                </div>
            </div>
        </div>
    </div>
    <div class="auth-left-bottom">© {{ now()->year }} GoPusram · Minimarket Sekolah</div>
</div>

<div class="auth-right">
    <div class="auth-form-box gp-animate">
        <h3>Buat Akun Baru</h3>
        <p class="subtitle">Gratis untuk semua siswa. Daftar sekarang!</p>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-row">
                <div class="form-group">
                    <label class="gp-label">Nama Lengkap</label>
                    <div class="input-wrap">
                        <i class="bi bi-person"></i>
                        <input type="text" name="name"
                               class="gp-input {{ $errors->has('name') ? 'is-invalid' : '' }}"
                               value="{{ old('name') }}" required placeholder="Nama lengkapmu">
                    </div>
                    @error('name') <div class="gp-invalid">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label class="gp-label">Kelas</label>
                    <div class="input-wrap">
                        <i class="bi bi-mortarboard"></i>
                        <input type="text" name="kelas"
                               class="gp-input {{ $errors->has('kelas') ? 'is-invalid' : '' }}"
                               value="{{ old('kelas') }}" required placeholder="XI RPL 1">
                    </div>
                    @error('kelas') <div class="gp-invalid">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="form-group">
                <label class="gp-label">Email</label>
                <div class="input-wrap">
                    <i class="bi bi-envelope"></i>
                    <input type="email" name="email"
                           class="gp-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                           value="{{ old('email') }}" required placeholder="email@sekolah.com">
                </div>
                @error('email') <div class="gp-invalid">{{ $message }}</div> @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="gp-label">Password</label>
                    <div class="input-wrap">
                        <i class="bi bi-lock"></i>
                        <input type="password" name="password"
                               class="gp-input {{ $errors->has('password') ? 'is-invalid' : '' }}"
                               required placeholder="Min. 8 karakter">
                    </div>
                    @error('password') <div class="gp-invalid">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label class="gp-label">Konfirmasi</label>
                    <div class="input-wrap">
                        <i class="bi bi-lock-fill"></i>
                        <input type="password" name="password_confirmation"
                               class="gp-input" required placeholder="Ulangi password">
                    </div>
                </div>
            </div>

            <button type="submit" class="auth-submit">
                Daftar Sekarang — Gratis!
            </button>
        </form>

        <div class="auth-alt">
            Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
        </div>
    </div>
</div>

</body>
</html>