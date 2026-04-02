@extends('layouts.admin')
@section('title', 'Kelola Pesanan')
@section('page-title', 'Kelola Semua Pesanan')

@section('content')

{{-- Filter & Cari --}}
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-md-4">
                <label class="form-label small fw-semibold">Cari Nama Siswa</label>
                <input type="text" name="search" class="form-control"
                       placeholder="Nama siswa..." value="{{ request('search') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label small fw-semibold">Filter Status</label>
                <select name="status" class="form-select">
                    <option value="">Semua Status</option>
                    @foreach(\App\Models\Order::STATUS_LABELS as $key => $label)
                        <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary flex-fill">Filter</button>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary">Reset</a>
            </div>
        </form>
    </div>
</div>

{{-- Tab status ringkasan --}}
<div class="d-flex flex-wrap gap-2 mb-4">
    @foreach(\App\Models\Order::STATUS_LABELS as $key => $label)
        @if($statusCounts->get($key, 0) > 0)
        <a href="{{ route('admin.orders.index', ['status' => $key]) }}"
           class="btn btn-sm {{ request('status') == $key ? 'btn-'.\App\Models\Order::STATUS_COLORS[$key] : 'btn-outline-secondary' }}">
            {{ $label }}
            <span class="badge bg-white text-dark ms-1">{{ $statusCounts->get($key) }}</span>
        </a>
        @endif
    @endforeach
</div>

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
                    <td class="fw-bold">#{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</td>
                    <td>
                        <div>{{ $order->user->name }}</div>
                        <small class="text-muted">{{ $order->user->kelas }}</small>
                    </td>
                    <td class="fw-bold text-primary">
                        Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                    </td>
                    <td>
                        @if($order->metode_pengambilan === 'diantar')
                            <span class="badge bg-info text-dark">Diantar</span>
                        @else
                            <span class="badge bg-light text-dark border">Ambil Sendiri</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge bg-{{ $order->statusColor() }}">
                            {{ $order->statusLabel() }}
                        </span>
                    </td>
                    <td><small class="text-muted">{{ $order->created_at->diffForHumans() }}</small></td>
                    <td class="text-center">
                        <a href="{{ route('admin.orders.show', $order) }}"
                           class="btn btn-sm btn-primary">Detail</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-5 text-muted">
                        <i class="bi bi-inbox fs-2 d-block mb-2"></i>Tidak ada pesanan.
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