<?php

namespace App\Http\Controllers\PM;

use App\Http\Controllers\Controller;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'pending'      => Order::where('status_pesanan', 'pending')->count(),
            'diproses'     => Order::where('status_pesanan', 'diproses')->count(),
            'siap_diambil' => Order::where('status_pesanan', 'siap_diambil')->count(),
            'diantar'      => Order::where('status_pesanan', 'diantar')->count(),
            'selesai_hari' => Order::where('status_pesanan', 'selesai')
                                   ->whereDate('updated_at', today())
                                   ->count(),
        ];

        $recentOrders = Order::with('user')
                             ->whereNotIn('status_pesanan', ['selesai', 'dibatalkan'])
                             ->latest()
                             ->take(8)
                             ->get();

        return view('pm.dashboard', compact('stats', 'recentOrders'));
    }
}