<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    // Riwayat semua pesanan milik user ini
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
                       ->with(['items.product'])
                       ->latest()
                       ->paginate(10);

        return view('siswa.orders.index', compact('orders'));
    }

    // Detail satu pesanan
    public function show($id)
    {
        $order = Order::where('user_id', auth()->id())
                      ->with(['items.product', 'delivery'])
                      ->findOrFail($id);

        return view('siswa.orders.show', compact('order'));
    }
}