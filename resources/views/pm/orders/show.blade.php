@extends('layouts.pm')
@section('title', 'Detail Pesanan')
@section('page-title', 'Detail Pesanan')

@section('content')
<div class="row g-4">

    {{-- Kolom kiri: detail pesanan --}}
    <div class="col-lg-8">
        <div class="d-flex align-items-center gap-3 mb-4">
            <a href="{{ route('pm.orders.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left"></i>
            </a>
            <div>
                <h5 class="fw-bold mb-0">
                    Pesanan #{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}
                </h5>
                <small class="text-muted">{{ $order->created_at->format('d M Y, H:i') }}</small>
            </div>
            <span class="badge bg-{{ $order->statusColor() }} ms-auto fs-6 px-3 py-2">
                {{ $order->statusLabel() }}
            </span>
        </div>

        {{-- Info pemesan --}}
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-header bg-white border-0 pt-3 px-4">
                <h6 class="fw-bold mb-0"><i class="bi bi-person me-2"></i>Info Pemesan</h6>
            </div>
            <div class="card-body px-4">
                <div class="row">
                    <div class="col-md-4">
                        <p class="text-muted small mb-1">Nama</p>
                        <p class="fw-semibold mb-0">{{ $order->user->name }}</p>
                    </div>
                    <div class="col-md-4">
                        <p class="text-muted small mb-1">Kelas</p>
                        <p class="fw-semibold mb-0">{{ $order->user->kelas }}</p>
                    </div>
                    <div class="col-md-4">
                        <p class="text-muted small mb-1">Email</p>
                        <p class="fw-semibold mb-0">{{ $order->user->email }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Produk yang dipesan --}}
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-header bg-white border-0 pt-3 px-4">
                <h6 class="fw-bold mb-0"><i class="bi bi-box-seam me-2"></i>Produk Dipesan</h6>
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
                        <small class="text-muted">
                            {{ $item->quantity }} × Rp {{ number_format($item->harga, 0, ',', '.') }}
                        </small>
                    </div>
                    <div class="fw-bold">Rp {{ number_format($item->subtotal(), 0, ',', '.') }}</div>
                </div>
                @endforeach
                <hr>
                <div class="d-flex justify-content-between fw-bold">
                    <span>Total Pembayaran</span>
                    <span class="text-primary fs-5">
                        Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                    </span>
                </div>
            </div>
        </div>

        {{-- Info pengambilan --}}
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-header bg-white border-0 pt-3 px-4">
                <h6 class="fw-bold mb-0"><i class="bi bi-truck me-2"></i>Info Pengambilan</h6>
            </div>
            <div class="card-body px-4">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p class="text-muted small mb-1">Metode Pengambilan</p>
                        <p class="fw-semibold mb-0">
                            @if($order->metode_pengambilan === 'diantar')
                                <i class="bi bi-bicycle text-info me-1"></i>Diantar ke Kelas
                            @else
                                <i class="bi bi-person-walking text-secondary me-1"></i>Ambil Sendiri
                            @endif
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p class="text-muted small mb-1">Metode Pembayaran</p>
                        <p class="fw-semibold mb-0">
                            @if($order->metode_pembayaran === 'cash')
                                <i class="bi bi-cash-coin text-success me-1"></i>Cash / Tunai
                            @else
                                <i class="bi bi-wallet2 text-success me-1"></i>E-Wallet
                            @endif
                            —
                            <span class="badge {{ $order->status_pembayaran === 'sudah_bayar' ? 'bg-success' : 'bg-warning text-dark' }}">
                                {{ $order->status_pembayaran === 'sudah_bayar' ? 'Sudah Bayar' : 'Belum Bayar' }}
                            </span>
                        </p>
                    </div>
                </div>

                @if($order->delivery)
                <div class="bg-light rounded-3 p-3">
                    <p class="fw-semibold small text-muted mb-2">
                        <i class="bi bi-geo-alt me-1"></i>Data Pengantaran
                    </p>
                    <div class="row">
                        <div class="col-4">
                            <p class="small text-muted mb-0">Penerima</p>
                            <p class="fw-semibold mb-0">{{ $order->delivery->nama_penerima }}</p>
                        </div>
                        <div class="col-4">
                            <p class="small text-muted mb-0">Kelas</p>
                            <p class="fw-semibold mb-0">{{ $order->delivery->kelas }}</p>
                        </div>
                        <div class="col-4">
                            <p class="small text-muted mb-0">Lokasi</p>
                            <p class="fw-semibold mb-0">{{ $order->delivery->lokasi_ruangan }}</p>
                        </div>
                    </div>
                </div>
                @endif

                @if($order->catatan)
                <div class="mt-3 p-3 border rounded-3 border-warning bg-warning bg-opacity-10">
                    <p class="small fw-semibold mb-1"><i class="bi bi-sticky me-1"></i>Catatan dari Siswa:</p>
                    <p class="mb-0">{{ $order->catatan }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Kolom kanan: update status --}}
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm sticky-top" style="top:80px">
            <div class="card-header bg-white border-0 pt-4 px-4">
                <h6 class="fw-bold mb-0">Update Status Pesanan</h6>
            </div>
            <div class="card-body px-4 pb-4">
                <p class="text-muted small mb-3">Status saat ini:</p>
                <span class="badge bg-{{ $order->statusColor() }} fs-6 px-3 py-2 mb-4 d-block text-center">
                    {{ $order->statusLabel() }}
                </span>

                @if(count($allowedTransitions) > 0)
                    <p class="text-muted small mb-2">Ubah ke:</p>
                    @php
                        $colors = \App\Models\Order::STATUS_COLORS;
                        $labels = \App\Models\Order::STATUS_LABELS;
                    @endphp
                    @foreach($allowedTransitions as $status)
                    <form action="{{ route('pm.orders.updateStatus', $order) }}"
                          method="POST" class="mb-2"
                          onsubmit="return confirm('Ubah status ke {{ $labels[$status] }}?')">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status_pesanan" value="{{ $status }}">
                        <button type="submit"
                                class="btn btn-{{ $colors[$status] }} w-100
                                       {{ $status === 'dibatalkan' ? 'btn-outline-danger' : '' }}">
                            @if($status === 'diproses')      <i class="bi bi-gear me-2"></i>
                            @elseif($status === 'siap_diambil') <i class="bi bi-bag-check me-2"></i>
                            @elseif($status === 'diantar')   <i class="bi bi-bicycle me-2"></i>
                            @elseif($status === 'selesai')   <i class="bi bi-check-circle me-2"></i>
                            @elseif($status === 'dibatalkan') <i class="bi bi-x-circle me-2"></i>
                            @endif
                            {{ $labels[$status] }}
                        </button>
                    </form>
                    @endforeach
                @else
                    <div class="text-center text-muted py-3">
                        <i class="bi bi-check-all fs-2 d-block mb-2"></i>
                        <p class="small mb-0">Pesanan ini sudah final.<br>Tidak ada aksi yang tersedia.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>
@endsection