<div class="card product-card shadow-sm h-100">
    {{-- Gambar --}}
    @if($product->gambar)
        <img src="{{ Storage::url($product->gambar) }}"
             class="card-img-top" alt="{{ $product->nama_produk }}">
    @else
        <div class="img-placeholder">
            <i class="bi bi-box-seam fs-1 text-muted"></i>
        </div>
    @endif

    <div class="card-body d-flex flex-column p-3">
        {{-- Badge kategori + terlaris --}}
        <div class="d-flex gap-1 mb-2 flex-wrap">
            <span class="badge badge-category small">{{ $product->category->nama_kategori }}</span>
            @if($isTerlaris ?? false)
                <span class="badge bg-danger small">🔥 Terlaris</span>
            @endif
        </div>

        <h6 class="card-title fw-semibold mb-1" style="font-size:.9rem;line-height:1.3">
            {{ $product->nama_produk }}
        </h6>

        <p class="fw-bold text-primary mb-2 mt-auto">{{ $product->hargaFormatted() }}</p>

        <div class="d-flex align-items-center justify-content-between mb-3">
            <small class="text-muted">
                <i class="bi bi-box me-1"></i>Stok: {{ $product->stok }}
            </small>
            @if($product->expired_date)
                <small class="text-muted">
                    Exp: {{ $product->expired_date->format('d/m/Y') }}
                </small>
            @endif
        </div>

        {{-- Tombol tambah ke keranjang --}}
        @if($operatingHour->isCurrentlyOpen())
            <form action="{{ route('siswa.cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="submit" class="btn btn-primary btn-sm w-100">
                    <i class="bi bi-cart-plus me-1"></i>Tambah ke Keranjang
                </button>
            </form>
        @else
            <button class="btn btn-secondary btn-sm w-100" disabled>
                <i class="bi bi-lock me-1"></i>Toko Tutup
            </button>
        @endif
    </div>
</div>