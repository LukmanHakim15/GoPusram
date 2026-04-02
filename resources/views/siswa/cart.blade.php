@extends('layouts.siswa')

@section('title', 'Keranjang Belanja')

@section('content')
<div class="row g-4">

    {{-- Kolom kiri: daftar item --}}
    <div class="col-lg-8">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold mb-0">
                <i class="bi bi-cart3 me-2"></i>Keranjang Belanja
            </h5>
            <a href="{{ route('siswa.katalog') }}" class="btn btn-outline-primary btn-sm">
                <i class="bi bi-arrow-left me-1"></i>Lanjut Belanja
            </a>
        </div>

        @if($items->isEmpty())
            <div class="card border-0 shadow-sm text-center py-5">
                <div class="card-body">
                    <i class="bi bi-cart-x fs-1 text-muted d-block mb-3"></i>
                    <p class="text-muted fs-5 mb-3">Keranjangmu masih kosong.</p>
                    <a href="{{ route('siswa.katalog') }}" class="btn btn-primary">
                        Mulai Belanja
                    </a>
                </div>
            </div>
        @else
            <div class="d-flex flex-column gap-3">
                @foreach($items as $item)
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="row align-items-center g-3">

                            {{-- Gambar produk --}}
                            <div class="col-auto">
                                @if($item->product->gambar)
                                    <img src="{{ Storage::url($item->product->gambar) }}"
                                         class="rounded-3" style="width:72px;height:72px;object-fit:cover">
                                @else
                                    <div class="rounded-3 bg-light d-flex align-items-center justify-content-center"
                                         style="width:72px;height:72px">
                                        <i class="bi bi-box-seam text-muted fs-4"></i>
                                    </div>
                                @endif
                            </div>

                            {{-- Info produk --}}
                            <div class="col">
                                <span class="badge badge-category small mb-1">
                                    {{ $item->product->category->nama_kategori }}
                                </span>
                                <h6 class="fw-semibold mb-0">{{ $item->product->nama_produk }}</h6>
                                <p class="text-primary fw-bold mb-0">{{ $item->product->hargaFormatted() }}</p>
                                <small class="text-muted">Stok tersedia: {{ $item->product->stok }}</small>
                            </div>

                            {{-- Qty control --}}
                            <div class="col-auto">
                                <form action="{{ route('siswa.cart.update', $item->id) }}"
                                      method="POST" class="d-flex align-items-center gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" name="quantity" value="{{ $item->quantity - 1 }}"
                                            class="btn btn-outline-secondary btn-sm rounded-circle"
                                            style="width:32px;height:32px;padding:0"
                                            {{ $item->quantity <= 1 ? 'disabled' : '' }}>
                                        <i class="bi bi-dash"></i>
                                    </button>
                                    <span class="fw-bold" style="min-width:24px;text-align:center">
                                        {{ $item->quantity }}
                                    </span>
                                    <button type="submit" name="quantity" value="{{ $item->quantity + 1 }}"
                                            class="btn btn-outline-secondary btn-sm rounded-circle"
                                            style="width:32px;height:32px;padding:0"
                                            {{ $item->quantity >= $item->product->stok ? 'disabled' : '' }}>
                                        <i class="bi bi-plus"></i>
                                    </button>
                                </form>
                            </div>

                            {{-- Subtotal + hapus --}}
                            <div class="col-auto text-end">
                                <p class="fw-bold mb-1">
                                    Rp {{ number_format($item->subtotal(), 0, ',', '.') }}
                                </p>
                                <form action="{{ route('siswa.cart.remove', $item->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Hapus item ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm text-danger border-0 p-0">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Kolom kanan: ringkasan --}}
    @if($items->isNotEmpty())
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm sticky-top" style="top: 80px">
            <div class="card-header bg-white border-0 pt-4 px-4">
                <h6 class="fw-bold mb-0">Ringkasan Belanja</h6>
            </div>
            <div class="card-body px-4">

                {{-- Daftar item ringkasan --}}
                @foreach($items as $item)
                <div class="d-flex justify-content-between small mb-2">
                    <span class="text-muted">
                        {{ Str::limit($item->product->nama_produk, 22) }}
                        <span class="text-secondary">×{{ $item->quantity }}</span>
                    </span>
                    <span>Rp {{ number_format($item->subtotal(), 0, ',', '.') }}</span>
                </div>
                @endforeach

                <hr>

                <div class="d-flex justify-content-between fw-bold fs-5 mb-4">
                    <span>Total</span>
                    <span class="text-primary">Rp {{ number_format($cart->totalHarga(), 0, ',', '.') }}</span>
                </div>

                @if($operatingHour->isCurrentlyOpen())
                    <a href="{{ route('siswa.checkout.index') }}" class="btn btn-primary w-100 py-2">
                        <i class="bi bi-bag-check me-2"></i>Lanjut ke Checkout
                    </a>
                @else
                    <button class="btn btn-secondary w-100 py-2" disabled>
                        <i class="bi bi-lock me-2"></i>Toko Sedang Tutup
                    </button>
                    <p class="text-muted text-center small mt-2 mb-0">
                        Pesanan bisa dilakukan saat toko buka.
                    </p>
                @endif
            </div>
        </div>
    </div>
    @endif

</div>
@endsection