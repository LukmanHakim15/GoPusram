@extends('layouts.admin')

@section('title', 'Edit Produk')
@section('page-title', 'Edit Produk')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 pt-4 px-4">
                <h6 class="fw-bold mb-0">Form Edit Produk</h6>
            </div>
            <div class="card-body px-4 pb-4">
                <form action="{{ route('admin.products.update', $product) }}"
                      method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="form-label fw-semibold">
                                Nama Produk <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="nama_produk"
                                   class="form-control @error('nama_produk') is-invalid @enderror"
                                   value="{{ old('nama_produk', $product->nama_produk) }}">
                            @error('nama_produk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">
                                Kategori <span class="text-danger">*</span>
                            </label>
                            <select name="category_id"
                                    class="form-select @error('category_id') is-invalid @enderror">
                                <option value="">Pilih kategori...</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}"
                                        {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                Harga (Rp) <span class="text-danger">*</span>
                            </label>
                            <input type="number" name="harga"
                                   class="form-control @error('harga') is-invalid @enderror"
                                   value="{{ old('harga', $product->harga) }}" min="0" step="100">
                            @error('harga')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-semibold">
                                Stok <span class="text-danger">*</span>
                            </label>
                            <input type="number" name="stok"
                                   class="form-control @error('stok') is-invalid @enderror"
                                   value="{{ old('stok', $product->stok) }}" min="0">
                            @error('stok')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Tanggal Kadaluarsa</label>
                            <input type="date" name="expired_date"
                                   class="form-control @error('expired_date') is-invalid @enderror"
                                   value="{{ old('expired_date', $product->expired_date?->format('Y-m-d')) }}">
                            @error('expired_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $product->deskripsi) }}</textarea>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Gambar Produk</label>

                            {{-- Tampilkan gambar lama jika ada --}}
                            @if($product->gambar)
                                <div class="mb-2">
                                    <img src="{{ Storage::url($product->gambar) }}"
                                         class="rounded-3"
                                         style="height:120px;object-fit:cover">
                                    <p class="text-muted small mt-1">
                                        Gambar saat ini. Upload baru untuk mengganti.
                                    </p>
                                </div>
                            @endif

                            <input type="file" name="gambar"
                                   class="form-control @error('gambar') is-invalid @enderror"
                                   accept="image/*" onchange="previewImage(this)">
                            <div class="form-text">Format: JPG, PNG, WEBP. Maks 2MB.</div>
                            @error('gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <img id="preview" src="#"
                                 class="mt-2 rounded d-none"
                                 style="max-height:150px;max-width:200px;object-fit:cover">
                        </div>

                        <div class="col-12">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox"
                                       name="is_active" id="is_active" value="1"
                                       {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold" for="is_active">
                                    Produk Aktif (tampil di katalog)
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-check-lg me-1"></i>Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.products.index') }}"
                           class="btn btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function previewImage(input) {
    const preview = document.getElementById('preview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            preview.src = e.target.result;
            preview.classList.remove('d-none');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush