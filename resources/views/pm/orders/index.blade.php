@extends('layouts.pm')
@section('title', 'Pesanan Masuk')
@section('page-title', 'Pesanan Masuk')

@section('content')

{{-- Tab filter status --}}
<div class="d-flex flex-wrap gap-2 mb-4">
    @php
        $allStatuses = ['pending'=>'Menunggu','diproses'=>'Diproses','siap_diambil'=>'Siap Diambil','diantar'=>'Diantar','selesai'=>'Selesai','dibatalkan'=>'Dibatalkan'];
        $colors      = \App\Models\Order::STATUS_COLORS;
    @endphp

    <a href="{{ route('pm.orders.index') }}"
       class="btn btn-sm {{ !request('status') ? 'btn-dark' : 'btn-outline-secondary' }}">
        Aktif
        <span class="badge bg-secondary ms-1">
            {{ $statusCounts->except(['selesai','dibatalkan'])->sum() }}
        </span>
    </a>

    @foreach($allStatuses as $key => $label)
    <a href="{{ route('pm.orders.index', ['status' => $key]) }}"
       class="btn btn-sm {{ request('status') == $key ? 'btn-'.$colors[$key] : 'btn-outline-secondary' }}">
        {{ $label }}
        @if($statusCounts->get($key, 0) > 0)
            <span class="badge bg-white text-dark ms-1">{{ $statusCounts->get($key) }}</span>
        @endif
    </a>
    @endforeach
</div>

{{-- Tabel pesanan --}}
<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>No. Pesanan</th>
                    <th>Siswa</th>
                    <th>Total</th>
                    <th>Pengambilan</th>
                    <th>Status</th>
                    <th>Waktu</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td>
                        <span class="fw-bold">#{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</span>
                        <br>
                        <small class="text-muted">{{ $order->items->count() }} produk</small>
                    </td>
                    <td>
                        <div class="fw-semibold">{{ $order->user->name }}</div>
                        <small class="text-muted">{{ $order->user->kelas }}</small>
                    </td>
                    <td class="fw-bold text-primary">
                        Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                    </td>
                    <td>
                        @if($order->metode_pengambilan === 'diantar')
                            <span class="badge bg-info text-dark">
                                <i class="bi bi-bicycle me-1"></i>Diantar
                            </span>
                        @else
                            <span class="badge bg-light text-dark border">
                                <i class="bi bi-person-walking me-1"></i>Ambil Sendiri
                            </span>
                        @endif
                    </td>
                    <td>
                        <span class="badge bg-{{ $order->statusColor() }} status-badge">
                            {{ $order->statusLabel() }}
                        </span>
                    </td>
                    <td>
                        <small class="text-muted">{{ $order->created_at->diffForHumans() }}</small>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('pm.orders.show', $order) }}"
                           class="btn btn-sm btn-primary">
                            <i class="bi bi-arrow-right me-1"></i>Proses
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-5 text-muted">
                        <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                        Tidak ada pesanan untuk ditampilkan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($orders->hasPages())
        <div class="card-footer bg-white border-0">{{ $orders->links() }}</div>
    @endif
</div>
@endsection