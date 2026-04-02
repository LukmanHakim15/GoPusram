@extends('layouts.siswa')

@section('title', 'Checkout')

@section('content')
<div class="row g-4 justify-content-center">

    {{-- Kolom kiri: Form checkout --}}
    <div class="col-lg-7">
        <h5 class="fw-bold mb-4">
            <i class="bi bi-bag-check me-2"></i>Checkout
        </h5>

        <form action="{{ route('siswa.checkout.store') }}" method="POST" id="checkoutForm">
        @csrf

        {{-- 1. Metode Pengambilan --}}
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-header bg-white border-0 pt-3 px-4">
                <h6 class="fw-bold mb-0">
                    <span class="badge bg-primary rounded-circle me-2">1</span>
                    Metode Pengambilan
                </h6>
            </div>
            <div class="card-body px-4 pb-4">
                <div class="row g-3">
                    <div class="col-md-6">
                        <input type="radio" class="btn-check" name="metode_pengambilan"
                               id="ambil_sendiri" value="ambil_sendiri"
                               {{ old('metode_pengambilan', 'ambil_sendiri') == 'ambil_sendiri' ? 'checked' : '' }}>
                        <label class="btn btn-outline-primary w-100 py-3 text-start" for="ambil_sendiri">
                            <i class="bi bi-person-walking fs-4 d-block mb-1"></i>
                            <span class="fw-semibold">Ambil Sendiri</span><br>
                            <small class="text-muted">Ambil langsung di Pusram</small>
                        </label>
                    </div>
                    <div class="col-md-6">
                        <input type="radio" class="btn-check" name="metode_pengambilan"
                               id="diantar" value="diantar"
                               {{ old('metode_pengambilan') == 'diantar' ? 'checked' : '' }}>
                        <label class="btn btn-outline-primary w-100 py-3 text-start" for="diantar">
                            <i class="bi bi-bicycle fs-4 d-block mb-1"></i>
                            <span class="fw-semibold">Diantar ke Kelas</span><br>
                            <small class="text-muted">Petugas PM akan mengantarkan</small>
                        </label>
                    </div>
                </div>
                @error('metode_pengambilan')
                    <div class="text-danger small mt-2">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- 2. Form Data Pengantaran (muncul jika "diantar" dipilih) --}}
        <div class="card border-0 shadow-sm mb-3" id="deliveryForm"
             style="{{ old('metode_pengambilan') == 'diantar' ? '' : 'display:none' }}">
            <div class="card-header bg-white border-0 pt-3 px-4">
                <h6 class="fw-bold mb-0">
                    <span class="badge bg-primary rounded-circle me-2">2</span>
                    Data Pengantaran
                </h6>
            </div>
            <div class="card-body px-4 pb-4">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small">Nama Penerima</label>
                        <input type="text" name="nama_penerima" class="form-control @error('nama_penerima') is-invalid @enderror"
                               value="{{ old('nama_penerima', $user->name) }}"
                               placeholder="Nama lengkap penerima">
                        @error('nama_penerima')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small">Kelas</label>
                        <input type="text" name="kelas_penerima" class="form-control @error('kelas_penerima') is-invalid @enderror"
                               value="{{ old('kelas_penerima', $user->kelas) }}"
                               placeholder="Contoh: XI RPL 1">
                        @error('kelas_penerima')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold small">Lokasi / Nomor Ruangan</label>
                        <input type="text" name="lokasi" class="form-control @error('lokasi') is-invalid @enderror"
                               value="{{ old('lokasi') }}"
                               placeholder="Contoh: Ruang 12, Lab Komputer 2">
                        @error('lokasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- 3. Metode Pembayaran --}}
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-header bg-white border-0 pt-3 px-4">
                <h6 class="fw-bold mb-0">
                    <span class="badge bg-primary rounded-circle me-2">3</span>
                    Metode Pembayaran
                </h6>
            </div>
            <div class="card-body px-4 pb-4">
                <div class="row g-3">
                    <div class="col-md-6">
                        <input type="radio" class="btn-check" name="metode_pembayaran"
                               id="cash" value="cash"
                               {{ old('metode_pembayaran', 'cash') == 'cash' ? 'checked' : '' }}>
                        <label class="btn btn-outline-success w-100 py-3 text-start" for="cash">
                            <i class="bi bi-cash-coin fs-4 d-block mb-1"></i>
                            <span class="fw-semibold">Cash / Tunai</span><br>
                            <small class="text-muted">Bayar langsung saat ambil/terima</small>
                        </label>
                    </div>
                    <div class="col-md-6">
                        <input type="radio" class="btn-check" name="metode_pembayaran"
                               id="ewallet" value="ewallet"
                               {{ old('metode_pembayaran') == 'ewallet' ? 'checked' : '' }}>
                        <label class="btn btn-outline-success w-100 py-3 text-start" for="ewallet">
                            <i class="bi bi-wallet2 fs-4 d-block mb-1"></i>
                            <span class="fw-semibold">E-Wallet (Simulasi)</span><br>
                            <small class="text-muted">Transfer saldo digital</small>
                        </label>
                    </div>
                </div>
                @error('metode_pembayaran')
                    <div class="text-danger small mt-2">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- 4. Catatan --}}
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body px-4 py-3">
                <label class="form-label fw-semibold small">Catatan (opsional)</label>
                <textarea name="catatan" class="form-control" rows="2"
                          placeholder="Contoh: Tolong dibungkus, tanpa kantong plastik...">{{ old('catatan') }}</textarea>
            </div>
        </div>

        </form>
    </div>

    {{-- Kolom kanan: Ringkasan order --}}
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm sticky-top" style="top:80px">
            <div class="card-header bg-white border-0 pt-4 px-4">
                <h6 class="fw-bold mb-0">Ringkasan Pesanan</h6>
            </div>
            <div class="card-body px-4">
                @foreach($items as $item)
                <div class="d-flex align-items-center gap-3 mb-3">
                    @if($item->product->gambar)
                        <img src="{{ Storage::url($item->product->gambar) }}"
                             class="rounded-2" style="width:44px;height:44px;object-fit:cover">
                    @else
                        <div class="rounded-2 bg-light d-flex align-items-center justify-content-center"
                             style="width:44px;height:44px">
                            <i class="bi bi-box-seam text-muted"></i>
                        </div>
                    @endif
                    <div class="flex-fill">
                        <div class="fw-semibold small">{{ $item->product->nama_produk }}</div>
                        <div class="text-muted small">{{ $item->quantity }} × {{ $item->product->hargaFormatted() }}</div>
                    </div>
                    <div class="fw-semibold small">
                        Rp {{ number_format($item->subtotal(), 0, ',', '.') }}
                    </div>
                </div>
                @endforeach

                <hr>

                <div class="d-flex justify-content-between fw-bold fs-5 mb-4">
                    <span>Total</span>
                    <span class="text-primary">Rp {{ number_format($cart->totalHarga(), 0, ',', '.') }}</span>
                </div>

                <button type="submit" form="checkoutForm" class="btn btn-primary w-100 py-2 fw-semibold">
                    <i class="bi bi-bag-check-fill me-2"></i>Buat Pesanan
                </button>
                <a href="{{ route('siswa.cart.index') }}" class="btn btn-outline-secondary w-100 mt-2">
                    <i class="bi bi-arrow-left me-1"></i>Kembali ke Keranjang
                </a>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
// Toggle form pengantaran berdasarkan pilihan metode
document.querySelectorAll('input[name="metode_pengambilan"]').forEach(radio => {
    radio.addEventListener('change', function () {
        const deliveryForm = document.getElementById('deliveryForm');
        if (this.value === 'diantar') {
            deliveryForm.style.display = 'block';
        } else {
            deliveryForm.style.display = 'none';
        }
    });
});
</script>
@endpush