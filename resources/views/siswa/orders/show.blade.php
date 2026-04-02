@extends('layouts.siswa')
@section('title', 'Detail Pesanan')

@section('content')
<div class="row g-4 justify-content-center">
<div class="col-lg-8">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-1">
                Pesanan #{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}
            </h5>
            <p class="text-muted small mb-0">{{ $order->created_at->format('d M Y, H:i') }}</p>
        </div>
        <span class="badge bg-{{ $order->statusColor() }} fs-6 px-3 py-2">
            {{ $order->statusLabel() }}
        </span>
    </div>

    {{-- Item yang dipesan --}}
    <div class="card border-0 shadow-sm mb-3">
        <div class="card-header bg-white border-0 pt-3 px-4">
            <h6 class="fw-bold mb-0">Produk yang Dipesan</h6>
        </div>
        <div class="card-body px-4">
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
                    <div class="text-muted small">
                        {{ $item->quantity }} ×
                        Rp {{ number_format($item->harga, 0, ',', '.') }}
                    </div>
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

    {{-- Info pengiriman & pembayaran --}}
    <div class="card border-0 shadow-sm mb-3">
        <div class="card-body px-4 py-3">
            <div class="row">
                <div class="col-md-6">
                    <p class="small text-muted mb-1">Metode Pengambilan</p>
                    <p class="fw-semibold mb-0">
                        @if($order->metode_pengambilan === 'diantar')
                            <i class="bi bi-bicycle me-1 text-primary"></i>Diantar ke Kelas
                        @else
                            <i class="bi bi-person-walking me-1 text-primary"></i>Ambil Sendiri
                        @endif
                    </p>
                </div>
                <div class="col-md-6">
                    <p class="small text-muted mb-1">Metode Pembayaran</p>
                    <p class="fw-semibold mb-0">
                        @if($order->metode_pembayaran === 'cash')
                            <i class="bi bi-cash-coin me-1 text-success"></i>Cash / Tunai
                        @else
                            <i class="bi bi-wallet2 me-1 text-success"></i>E-Wallet (Simulasi)
                        @endif
                    </p>
                </div>
            </div>

            {{-- Data pengantaran --}}
            @if($order->delivery)
            <hr>
            <p class="small text-muted mb-2">Data Pengantaran</p>
            <div class="row">
                <div class="col-md-4">
                    <p class="small mb-0 text-muted">Penerima</p>
                    <p class="fw-semibold mb-0">{{ $order->delivery->nama_penerima }}</p>
                </div>
                <div class="col-md-4">
                    <p class="small mb-0 text-muted">Kelas</p>
                    <p class="fw-semibold mb-0">{{ $order->delivery->kelas }}</p>
                </div>
                <div class="col-md-4">
                    <p class="small mb-0 text-muted">Lokasi</p>
                    <p class="fw-semibold mb-0">{{ $order->delivery->lokasi_ruangan }}</p>
                </div>
            </div>
            @endif

            {{-- Catatan --}}
            @if($order->catatan)
            <hr>
            <p class="small text-muted mb-1">Catatan</p>
            <p class="mb-0">{{ $order->catatan }}</p>
            @endif
        </div>
    </div>

    <a href="{{ route('siswa.orders.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Kembali ke Riwayat
    </a>

</div>
</div>
@endsection