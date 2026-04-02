<?php

namespace App\Http\Controllers\PM;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Status yang boleh diubah oleh PM (urutan alur kerja)
    const ALLOWED_TRANSITIONS = [
        'pending'      => ['diproses', 'dibatalkan'],
        'diproses'     => ['siap_diambil', 'diantar', 'dibatalkan'],
        'siap_diambil' => ['selesai'],
        'diantar'      => ['selesai'],
    ];

    public function index(Request $request)
    {
        $query = Order::with(['user', 'items.product', 'delivery'])->latest();

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status_pesanan', $request->status);
        } else {
            // Default: tampilkan yang belum selesai/batal
            $query->whereNotIn('status_pesanan', ['selesai', 'dibatalkan']);
        }

        $orders = $query->paginate(15)->withQueryString();

        // Hitung jumlah tiap status untuk tab filter
        $statusCounts = Order::selectRaw('status_pesanan, count(*) as total')
                             ->groupBy('status_pesanan')
                             ->pluck('total', 'status_pesanan');

        return view('pm.orders.index', compact('orders', 'statusCounts'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'items.product', 'delivery']);
        $allowedTransitions = self::ALLOWED_TRANSITIONS[$order->status_pesanan] ?? [];

        return view('pm.orders.show', compact('order', 'allowedTransitions'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status_pesanan' => 'required|in:diproses,siap_diambil,diantar,selesai,dibatalkan',
        ]);

        $newStatus = $request->status_pesanan;

        // Validasi: status baru harus ada di daftar transisi yang diizinkan
        $allowed = self::ALLOWED_TRANSITIONS[$order->status_pesanan] ?? [];
        if (!in_array($newStatus, $allowed)) {
            return back()->with('error', "Status tidak bisa diubah dari '{$order->statusLabel()}' ke '{$newStatus}'.");
        }

        $oldStatus = $order->status_pesanan;
        $order->update(['status_pesanan' => $newStatus]);

        // Jika selesai, tandai pembayaran lunas
        if ($newStatus === 'selesai') {
            $order->update(['status_pembayaran' => 'sudah_bayar']);
        }

        // Kirim notifikasi ke siswa
        Notification::create([
            'user_id' => $order->user_id,
            'pesan'   => "Pesanan #" . str_pad($order->id, 4, '0', STR_PAD_LEFT) .
                         " diperbarui: " . Order::STATUS_LABELS[$oldStatus] .
                         " → " . Order::STATUS_LABELS[$newStatus] . ".",
        ]);

        return back()->with('success', 'Status pesanan berhasil diperbarui!');
    }
}