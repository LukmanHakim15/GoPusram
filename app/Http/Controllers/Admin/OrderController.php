<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['user', 'items', 'delivery'])->latest();

        if ($request->filled('status')) {
            $query->where('status_pesanan', $request->status);
        }
        if ($request->filled('search')) {
            $query->whereHas('user', fn($q) => $q->where('name', 'like', '%'.$request->search.'%'));
        }

        $orders      = $query->paginate(15)->withQueryString();
        $statusCounts = Order::selectRaw('status_pesanan, count(*) as total')
                             ->groupBy('status_pesanan')
                             ->pluck('total', 'status_pesanan');

        return view('admin.orders.index', compact('orders', 'statusCounts'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'items.product', 'delivery']);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status_pesanan' => 'required|in:pending,diproses,siap_diambil,diantar,selesai,dibatalkan',
        ]);

        $oldStatus = $order->status_pesanan;
        $newStatus = $request->status_pesanan;

        $order->update([
            'status_pesanan'    => $newStatus,
            'status_pembayaran' => $newStatus === 'selesai' ? 'sudah_bayar' : $order->status_pembayaran,
        ]);

        Notification::create([
            'user_id' => $order->user_id,
            'pesan'   => "Admin memperbarui pesanan #" . str_pad($order->id, 4, '0', STR_PAD_LEFT) .
                         ": " . Order::STATUS_LABELS[$oldStatus] .
                         " → " . Order::STATUS_LABELS[$newStatus] . ".",
        ]);

        return back()->with('success', 'Status pesanan diperbarui!');
    }
}