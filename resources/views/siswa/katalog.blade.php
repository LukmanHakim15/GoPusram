@extends('layouts.siswa')

@section('title', 'Katalog Produk - GoPusram')

@section('content')

{{-- Banner toko tutup --}}
@if(!$operatingHour->isCurrentlyOpen())
<div class="store-closed-banner p-4 mb-4 text-center">
    <i class="bi bi-shop-window fs-2 d-block mb-2"></i>
    <h5 class="fw-bold mb-1">Pusram Sedang Tutup</h5>
    <p class="mb-0 opacity-75">
        Jam operasional: {{ \Carbon\Carbon::parse($operatingHour->jam_buka)->format('H:i') }}
        – {{ \Carbon\Carbon::parse($operatingHour->jam_tutup)->format('H:i') }} WIB.
        Kamu tetap bisa melihat produk, tapi pemesanan tidak tersedia saat ini.
    </p>
</div>
@endif

{{-- Hero search --}}
<div class="bg-white rounded-3 shadow-sm p-4 mb-4">
    <h5 class="fw-bold mb-3">Cari Produk</h5>
    <form method="GET" class="d-flex gap-2">
        @if(request('category_id'))
            <input type="hidden" name="category_id" value="{{ request('category_id') }}">
        @endif
        <input type="text" name="search" class="form-control"
               placeholder="Cari nama produk..." value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary px-4">
            <i class="bi bi-search"></i>
        </button>
        @if(request()->hasAny(['search','category_id']))
            <a href="{{ route('siswa.katalog') }}" class="btn btn-outline-secondary">
                <i class="bi bi-x-lg"></i>
            </a>
        @endif
    </form>
</div>

{{-- Filter Kategori (pill buttons) --}}
<div class="d-flex flex-wrap gap-2 mb-4">
    <a href="{{ route('siswa.katalog', request()->except('category_id')) }}"
       class="btn btn-outline-primary btn-sm filter-pill {{ !request('category_id') ? 'active' : '' }}">
        Semua
    </a>
    @foreach($categories as $cat)
        <a href="{{ route('siswa.katalog', array_merge(request()->all(), ['category_id' => $cat->id])) }}"
           class="btn btn-outline-primary btn-sm filter-pill {{ request('category_id') == $cat->id ? 'active' : '' }}">
            {{ $cat->nama_kategori }}
        </a>
    @endforeach
</div>

{{-- Produk Terlaris (hanya tampil di halaman utama tanpa filter) --}}
@if(!request()->hasAny(['search','category_id']) && $terlaris->isNotEmpty())
<div class="mb-5">
    <h6 class="fw-bold mb-3">
        <i class="bi bi-fire text-danger me-2"></i>Produk Terlaris
    </h6>
    <div class="row g-3">
        @foreach($terlaris as $product)
        <div class="col-6 col-md-3">
            @include('siswa.partials.product-card', ['product' => $product, 'isTerlaris' => true])
        </div>
        @endforeach
    </div>
    <hr class="my-4">
</div>
@endif

{{-- Semua Produk --}}
<div class="d-flex justify-content-between align-items-center mb-3">
    <h6 class="fw-bold mb-0">
        {{ request()->hasAny(['search','category_id']) ? 'Hasil Pencarian' : 'Semua Produk' }}
        <span class="text-muted fw-normal fs-6">({{ $products->total() }} produk)</span>
    </h6>
</div>

@if($products->isNotEmpty())
    <div class="row g-3">
        @foreach($products as $product)
        <div class="col-6 col-md-3">
            @include('siswa.partials.product-card', ['product' => $product, 'isTerlaris' => false])
        </div>
        @endforeach
    </div>
    <div class="mt-4">{{ $products->links() }}</div>
@else
    <div class="text-center py-5 text-muted">
        <i class="bi bi-search fs-1 d-block mb-3 opacity-50"></i>
        <p class="fs-5">Produk tidak ditemukan.</p>
        <a href="{{ route('siswa.katalog') }}" class="btn btn-outline-primary">Lihat semua produk</a>
    </div>
@endif

@endsection