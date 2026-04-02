@extends('layouts.admin')
@section('title', 'Detail Pesanan')
@section('page-title', 'Detail Pesanan')

@section('content')
<div class="row g-4">
    <div class="col-lg-8">

        {{-- Gunakan kembali konten detail yang sama dengan PM --}}
        {{-- Salin seluruh bagian kolom kiri dari pm/orders/show.blade.php --}}
        {{-- Hanya ganti nama route dari pm. ke admin. --}}

        <div class="d-flex align-items-center gap-3 mb-4">
            <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left"></i>
            </a>
            <div>
                <h5 class="fw-bold mb-0">Pesanan #{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</h5>
                <small class="text-muted">{{ $order->created_at->format('d M Y, H:i') }}</small>
            </div>
            <span class="badge bg-{{ $order->statusColor() }} ms-auto fs-6 px-3 py-2">
                {{ $order->statusLabel() }}
            </span>
        </div>

        {{-- Info pemesan --}}
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body px-4">
                <h6 class="fw-bold mb-3"><i class="bi bi-person me-2"></i>Info Pemesan</h6>
                <div class="row">
                    <div class="col-md-4">
                        <p class="text-muted small mb-1">Nama</p>
                        <p class="fw-semibold">{{ $order->user->name }}</p>
                    </div>
                    <div class="col-md-4">
                        <p class="text-muted small mb-1">Kelas</p>
                        <p class="fw-semibold">{{ $order->user->kelas }}</p>
                    </div>
                    <div class="col-md-4">
                        <p class="text-muted small mb-1">Email</p>
                        <p class="fw-semibold">{{ $order->user->email }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Produk dipesan --}}
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body px-4">
                <h6 class="fw-bold mb-3"><i class="bi bi-box-seam me-2"></i>Produk Dipesan</h6>
                @foreach($order->items as $item)
                <div class="d-flex align-items-center gap-3 mb-3">
                    @if($item->product->gambar)
                        <img src="{{ Storage::url($item->product->gambar) }}"
                             class="rounded-2" style="width:52px;height:52px;object-fit:cover">
                    @else
                        <div class="rounded-2 bg-light d-flex align-items-center justify-content-center"
                             style="width:52px;height:52px">
                            <i class="bi bi-box-seam text-muted"></i>
                        </div>
                    @endif
                    <div class="flex-fill">
                        <div class="fw-semibold">{{ $item->product->nama_produk }}</div>
                        <small class="text-muted">
                            {{ $item->quantity }} × Rp {{ number_format($item->harga, 0, ',', '.') }}
                        </small>
                    </div>
                    <div class="fw-bold">Rp {{ number_format($item->subtotal(), 0, ',', '.') }}</div>
                </div>
                @endforeach
                <hr>
                <div class="d-flex justify-content-between fw-bold fs-5">
                    <span>Total</span>
                    <span class="text-primary">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        {{-- Data pengantaran jika ada --}}
        @if($order->delivery)
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body px-4">
                <h6 class="fw-bold mb-3"><i class="bi bi-geo-alt me-2"></i>Data Pengantaran</h6>
                <div class="row">
                    <div class="col-4">
                        <p class="small text-muted mb-0">Penerima</p>
                        <p class="fw-semibold">{{ $order->delivery->nama_penerima }}</p>
                    </div>
                    <div class="col-4">
                        <p class="small text-muted mb-0">Kelas</p>
                        <p class="fw-semibold">{{ $order->delivery->kelas }}</p>
                    </div>
                    <div class="col-4">
                        <p class="small text-muted mb-0">Lokasi</p>
                        <p class="fw-semibold">{{ $order->delivery->lokasi_ruangan }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endif

    </div>

    {{-- Kolom kanan: Admin bisa ubah ke semua status --}}
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm sticky-top" style="top:80px">
            <div class="card-header bg-white border-0 pt-4 px-4">
                <h6 class="fw-bold mb-0">Update Status (Admin)</h6>
            </div>
            <div class="card-body px-4 pb-4">
                <p class="text-muted small mb-2">Status saat ini:</p>
                <span class="badge bg-{{ $order->statusColor() }} fs-6 px-3 py-2 mb-3 d-block text-center">
                    {{ $order->statusLabel() }}
                </span>
                <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <label class="form-label small fw-semibold">Ubah ke:</label>
                    <select name="status_pesanan" class="form-select mb-3">
                        @foreach(\App\Models\Order::STATUS_LABELS as $key => $label)
                            <option value="{{ $key }}"
                                    {{ $order->status_pesanan === $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary w-100"
                            onclick="return confirm('Update status pesanan ini?')">
                        <i class="bi bi-check-lg me-1"></i>Update Status
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection