<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // ── Statistik ringkasan ─────────────────────────────
        $stats = [
            'total_pendapatan' => Order::where('status_pesanan', 'selesai')->sum('total_harga'),
            'total_pesanan'    => Order::count(),
            'pesanan_pending'  => Order::where('status_pesanan', 'pending')->count(),
            'total_produk'     => Product::where('is_active', true)->count(),
            'stok_menipis'     => Product::where('stok', '<', 5)->where('stok', '>', 0)->count(),
            'stok_habis'       => Product::where('stok', 0)->count(),
            'total_siswa'      => User::where('role', 'siswa')->count(),
        ];

        // ── Pesanan terbaru (5 terakhir) ────────────────────
        $recentOrders = Order::with('user')
                             ->latest()
                             ->take(5)
                             ->get();

        // ── Produk terlaris ─────────────────────────────────
        $topProducts = Product::withSum('orderItems', 'quantity')
                              ->orderByDesc('order_items_sum_quantity')
                              ->take(5)
                              ->get();

        // ── Data grafik: pendapatan 7 hari terakhir ─────────
        $chartData = Order::where('status_pesanan', 'selesai')
            ->where('created_at', '>=', now()->subDays(6))
            ->selectRaw('DATE(created_at) as tanggal, SUM(total_harga) as total')
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get()
            ->keyBy('tanggal');

        // Lengkapi 7 hari (agar hari yang kosong tetap ada di grafik)
        $labels  = [];
        $revenue = [];
        for ($i = 6; $i >= 0; $i--) {
            $date      = now()->subDays($i)->format('Y-m-d');
            $labels[]  = now()->subDays($i)->format('d M');
            $revenue[] = $chartData->get($date)?->total ?? 0;
        }

        return view('admin.dashboard', compact('stats', 'recentOrders', 'topProducts', 'labels', 'revenue'));
    }
}