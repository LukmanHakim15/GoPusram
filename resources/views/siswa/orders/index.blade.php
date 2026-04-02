@extends('layouts.siswa')
@section('title', 'Riwayat Pesanan')

@section('content')
<h5 class="fw-bold mb-4"><i class="bi bi-receipt me-2"></i>Riwayat Pesanan</h5>

@forelse($orders as $order)
<div class="card border-0 shadow-sm mb-3">
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col-md-3">
                <p class="text-muted small mb-0">No. Pesanan</p>
                <p class="fw-bold mb-0">#{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</p>
                <p class="text-muted small">{{ $order->created_at->format('d M Y, H:i') }}</p>
            </div>
            <div class="col-md-3">
                <p class="text-muted small mb-1">Status</p>
                <span class="badge bg-{{ $order->statusColor() }} fs-6 px-3 py-2">
                    {{ $order->statusLabel() }}
                </span>
            </div>
            <div class="col-md-3">
                <p class="text-muted small mb-0">Total</p>
                <p class="fw-bold text-primary mb-0">
                    Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                </p>
                <small class="text-muted">{{ $order->items->count() }} produk</small>
            </div>
            <div class="col-md-3 text-md-end mt-3 mt-md-0">
                <a href="{{ route('siswa.orders.show', $order->id) }}"
                   class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-eye me-1"></i>Lihat Detail
                </a>
            </div>
        </div>
    </div>
</div>
@empty
<div class="text-center py-5 text-muted">
    <i class="bi bi-receipt fs-1 d-block mb-3 opacity-50"></i>
    <p>Belum ada pesanan.</p>
    <a href="{{ route('siswa.katalog') }}" class="btn btn-primary">Mulai Belanja</a>
</div>
@endforelse

{{ $orders->links() }}
@endsection