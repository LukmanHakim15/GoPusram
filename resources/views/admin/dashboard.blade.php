@extends('layouts.admin')
@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')

@section('content')

{{-- Kartu statistik ringkasan --}}
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-3 bg-primary bg-opacity-10 p-3">
                        <i class="bi bi-cash-stack text-primary fs-4"></i>
                    </div>
                    <div>
                        <p class="text-muted small mb-0">Total Pendapatan</p>
                        <h5 class="fw-bold mb-0">
                            Rp {{ number_format($stats['total_pendapatan'], 0, ',', '.') }}
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-3 bg-success bg-opacity-10 p-3">
                        <i class="bi bi-receipt text-success fs-4"></i>
                    </div>
                    <div>
                        <p class="text-muted small mb-0">Total Pesanan</p>
                        <h5 class="fw-bold mb-0">{{ $stats['total_pesanan'] }}</h5>
                        @if($stats['pesanan_pending'] > 0)
                            <small class="text-warning fw-semibold">
                                {{ $stats['pesanan_pending'] }} menunggu
                            </small>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-3 bg-warning bg-opacity-10 p-3">
                        <i class="bi bi-box-seam text-warning fs-4"></i>
                    </div>
                    <div>
                        <p class="text-muted small mb-0">Produk Aktif</p>
                        <h5 class="fw-bold mb-0">{{ $stats['total_produk'] }}</h5>
                        @if($stats['stok_habis'] > 0)
                            <small class="text-danger fw-semibold">
                                {{ $stats['stok_habis'] }} stok habis
                            </small>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-3 bg-info bg-opacity-10 p-3">
                        <i class="bi bi-people text-info fs-4"></i>
                    </div>
                    <div>
                        <p class="text-muted small mb-0">Total Siswa</p>
                        <h5 class="fw-bold mb-0">{{ $stats['total_siswa'] }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    {{-- Grafik pendapatan 7 hari --}}
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0 pt-4 px-4">
                <h6 class="fw-bold mb-0">Pendapatan 7 Hari Terakhir</h6>
            </div>
            <div class="card-body px-4">
                <canvas id="revenueChart" height="100"></canvas>
            </div>
        </div>
    </div>

    {{-- Produk terlaris --}}
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0 pt-4 px-4">
                <h6 class="fw-bold mb-0">🔥 Produk Terlaris</h6>
            </div>
            <div class="card-body px-4">
                @forelse($topProducts as $i => $product)
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="fw-bold text-muted" style="width:20px">{{ $i+1 }}</span>
                    @if($product->gambar)
                        <img src="{{ Storage::url($product->gambar) }}"
                             class="rounded-2" style="width:36px;height:36px;object-fit:cover">
                    @else
                        <div class="rounded-2 bg-light d-flex align-items-center justify-content-center"
                             style="width:36px;height:36px">
                            <i class="bi bi-box-seam text-muted small"></i>
                        </div>
                    @endif
                    <div class="flex-fill">
                        <div class="fw-semibold small">{{ Str::limit($product->nama_produk, 24) }}</div>
                        <small class="text-muted">Terjual: {{ $product->order_items_sum_quantity ?? 0 }} pcs</small>
                    </div>
                </div>
                @empty
                    <p class="text-muted text-center small">Belum ada data penjualan.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

{{-- Pesanan terbaru --}}
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
        <h6 class="fw-bold mb-0">Pesanan Terbaru</h6>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-primary btn-sm">Lihat Semua</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>No. Pesanan</th>
                    <th>Siswa</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Waktu</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentOrders as $order)
                <tr onclick="window.location='{{ route('admin.orders.show', $order) }}'" style="cursor:pointer">
                    <td class="fw-bold">#{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</td>
                    <td>
                        <div>{{ $order->user->name }}</div>
                        <small class="text-muted">{{ $order->user->kelas }}</small>
                    </td>
                    <td class="fw-bold text-primary">
                        Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                    </td>
                    <td>
                        <span class="badge bg-{{ $order->statusColor() }}">
                            {{ $order->statusLabel() }}
                        </span>
                    </td>
                    <td><small class="text-muted">{{ $order->created_at->diffForHumans() }}</small></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
<script>
const ctx = document.getElementById('revenueChart');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: {!! json_encode($labels) !!},
        datasets: [{
            label: 'Pendapatan (Rp)',
            data: {!! json_encode($revenue) !!},
            backgroundColor: 'rgba(13,110,253,0.15)',
            borderColor: 'rgba(13,110,253,0.8)',
            borderWidth: 2,
            borderRadius: 6,
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: v => 'Rp ' + new Intl.NumberFormat('id-ID').format(v)
                }
            }
        }
    }
});
</script>
@endpush