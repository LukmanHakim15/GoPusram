<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Delivery;
use App\Models\Notification;
use App\Models\OperatingHour;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    // ── Halaman form checkout ─────────────────────────────────
    public function index()
    {
        // Cek toko buka
        $operatingHour = OperatingHour::getSetting();
        if (!$operatingHour->isCurrentlyOpen()) {
            return redirect()->route('siswa.katalog')
                             ->with('error', 'Pusram sedang tutup. Checkout tidak tersedia.');
        }

        $cart  = auth()->user()->cart;
        $items = $cart?->items()->with('product')->get() ?? collect();

        // Keranjang kosong? Balik ke katalog
        if ($items->isEmpty()) {
            return redirect()->route('siswa.katalog')
                             ->with('error', 'Keranjangmu kosong. Pilih produk dulu.');
        }

        // Auto-fill data siswa dari profil
        $user = auth()->user();

        return view('siswa.checkout', compact('cart', 'items', 'user'));
    }

    // ── Proses checkout ───────────────────────────────────────
    public function store(Request $request)
    {
        // Validasi cek toko lagi (anti bypass)
        $operatingHour = OperatingHour::getSetting();
        if (!$operatingHour->isCurrentlyOpen()) {
            return back()->with('error', 'Toko sudah tutup saat kamu checkout.');
        }

        // Validasi input form
        $rules = [
            'metode_pengambilan' => 'required|in:ambil_sendiri,diantar',
            'metode_pembayaran'  => 'required|in:cash,ewallet',
            'catatan'            => 'nullable|string|max:300',
        ];

        // Tambah validasi data pengantaran jika memilih "diantar"
        if ($request->metode_pengambilan === 'diantar') {
            $rules['nama_penerima']  = 'required|string|max:100';
            $rules['kelas_penerima'] = 'required|string|max:30';
            $rules['lokasi']         = 'required|string|max:100';
        }

        $validated = $request->validate($rules, [
            'metode_pengambilan.required' => 'Metode pengambilan wajib dipilih.',
            'metode_pembayaran.required'  => 'Metode pembayaran wajib dipilih.',
            'nama_penerima.required'      => 'Nama penerima wajib diisi untuk pengantaran.',
            'kelas_penerima.required'     => 'Kelas penerima wajib diisi.',
            'lokasi.required'             => 'Lokasi ruangan wajib diisi.',
        ]);

        $cart  = auth()->user()->cart;
        $items = $cart?->items()->with('product')->get() ?? collect();

        if ($items->isEmpty()) {
            return redirect()->route('siswa.katalog')
                             ->with('error', 'Keranjangmu kosong.');
        }

        // Bungkus semua operasi dalam transaction
        // Jika ada yang gagal di tengah jalan, semua dibatalkan otomatis
        DB::transaction(function () use ($request, $items, $cart) {

            // 1. Hitung total & validasi stok semua produk
            $total = 0;
            foreach ($items as $item) {
                $product = $item->product;

                if ($product->stok < $item->quantity) {
                    throw new \Exception(
                        "Stok {$product->nama_produk} tidak mencukupi. " .
                        "Tersedia: {$product->stok}, diminta: {$item->quantity}."
                    );
                }

                $total += $product->harga * $item->quantity;
            }

            // 2. Buat order
            $order = Order::create([
                'user_id'            => auth()->id(),
                'total_harga'        => $total,
                'metode_pengambilan' => $request->metode_pengambilan,
                'metode_pembayaran'  => $request->metode_pembayaran,
                'status_pesanan'     => 'pending',
                'status_pembayaran'  => 'belum_bayar',
                'catatan'            => $request->catatan,
            ]);

            // 3. Buat order items & kurangi stok
            foreach ($items as $item) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $item->product_id,
                    'quantity'   => $item->quantity,
                    'harga'      => $item->product->harga, // simpan harga saat transaksi
                ]);

                // Kurangi stok produk
                $item->product->decrement('stok', $item->quantity);
            }

            // 4. Simpan data pengantaran jika diantar
            if ($request->metode_pengambilan === 'diantar') {
                Delivery::create([
                    'order_id'       => $order->id,
                    'nama_penerima'  => $request->nama_penerima,
                    'kelas'          => $request->kelas_penerima,
                    'lokasi_ruangan' => $request->lokasi,
                ]);
            }

            // 5. Kosongkan keranjang
            $cart->items()->delete();

            // 6. Kirim notifikasi ke user
            Notification::create([
                'user_id' => auth()->id(),
                'pesan'   => "Pesanan #" . str_pad($order->id, 4, '0', STR_PAD_LEFT) .
                             " berhasil dibuat. Total: Rp " .
                             number_format($order->total_harga, 0, ',', '.') .
                             ". Status: Menunggu konfirmasi.",
            ]);

            // Simpan ID order ke session untuk halaman sukses
            session(['last_order_id' => $order->id]);
        });

        return redirect()->route('siswa.orders.show', session('last_order_id'))
                         ->with('success', 'Pesanan berhasil dibuat! Silakan tunggu konfirmasi dari Pusram.');
    }
}