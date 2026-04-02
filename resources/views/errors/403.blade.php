<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Akses Ditolak</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="min-height:100vh">
    <div class="text-center">
        <div class="display-1 fw-bold text-danger mb-3">403</div>
        <h4 class="fw-bold mb-2">Akses Ditolak</h4>
        <p class="text-muted mb-4">
            Kamu tidak punya izin untuk mengakses halaman ini.<br>
            Pastikan kamu login dengan akun yang sesuai.
        </p>
        <a href="{{ url()->previous() }}" class="btn btn-primary me-2">
            <i class="bi bi-arrow-left me-1"></i>Kembali
        </a>
        <form method="POST" action="{{ route('logout') }}" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-outline-secondary">Logout & Login Ulang</button>
        </form>
    </div>
</body>
</html>