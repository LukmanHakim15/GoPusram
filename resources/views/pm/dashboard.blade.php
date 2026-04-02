@extends('layouts.pm')
@section('title', 'Dashboard PM')
@section('page-title', 'Dashboard')

@section('content')

<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm text-center py-3">
            <div class="text-warning fs-1 fw-bold">{{ $stats['pending'] }}</div>
            <div class="text-muted small">Menunggu</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm text-center py-3">
            <div class="text-info fs-1 fw-bold">{{ $stats['diproses'] }}</div>
            <div class="text-muted small">Diproses</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm text-center py-3">
            <div class="text-primary fs-1 fw-bold">{{ $stats['siap_diambil'] + $stats['diantar'] }}</div>
            <div class="text-muted small">Siap/Diantar</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm text-center py-3">
            <div class="text-success fs-1 fw-bold">{{ $stats['selesai_hari'] }}</div>
            <div class="text-muted small">Selesai Hari Ini</div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-0 pt-3 px-4 d-flex justify-content-between">
        <h6 class="fw-bold mb-0">Pesanan Aktif</h6>
        <a href="{{ route('pm.orders.index') }}" class="btn btn-primary btn-sm">Lihat Semua</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>No. Pesanan</th>
                    <th>Siswa</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentOrders as $order)
                <tr>
                    <td class="fw-bold">#{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</td>
                    <td>
                        <div>{{ $order->user->name }}</div>
                        <small class="text-muted">{{ $order->user->kelas }}</small>
                    </td>
                    <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                    <td>
                        <span class="badge bg-{{ $order->statusColor() }}">
                            {{ $order->statusLabel() }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('pm.orders.show', $order) }}" class="btn btn-sm btn-outline-primary">
                            Proses
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-muted">
                        Tidak ada pesanan aktif saat ini.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection