<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\OperatingHour;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Ambil atau buat keranjang milik user yang sedang login
    private function getOrCreateCart(): Cart
    {
        return Cart::firstOrCreate(['user_id' => auth()->id()]);
    }

    // ── Tampilkan isi keranjang ──────────────────────────────
    public function index()
    {
        $cart          = $this->getOrCreateCart();
        $items         = $cart->items()->with('product.category')->get();
        $operatingHour = OperatingHour::getSetting();

        return view('siswa.cart', compact('cart', 'items', 'operatingHour'));
    }

    // ── Tambah produk ke keranjang ───────────────────────────
    public function add(Request $request)
    {
        // Cek jam operasional dulu
        $operatingHour = OperatingHour::getSetting();
        if (!$operatingHour->isCurrentlyOpen()) {
            return back()->with('error', 'Maaf, Pusram sedang tutup. Pemesanan tidak dapat dilakukan.');
        }

        $request->validate(['product_id' => 'required|exists:products,id']);

        $product = Product::findOrFail($request->product_id);

        // Cek stok
        if ($product->stok <= 0) {
            return back()->with('error', 'Stok produk ini sudah habis.');
        }

        $cart = $this->getOrCreateCart();

        // Cek apakah produk sudah ada di keranjang
        $existingItem = $cart->items()->where('product_id', $product->id)->first();

        if ($existingItem) {
            // Cek apakah penambahan melebihi stok
            if ($existingItem->quantity >= $product->stok) {
                return back()->with('error', 'Jumlah di keranjang sudah melebihi stok tersedia.');
            }
            $existingItem->increment('quantity');
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity'   => 1,
            ]);
        }

        return back()->with('success', "{$product->nama_produk} ditambahkan ke keranjang!");
    }

    // ── Update jumlah item ────────────────────────────────────
    public function update(Request $request, $id)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);

        $item = CartItem::whereHas('cart', fn($q) => $q->where('user_id', auth()->id()))
                        ->findOrFail($id);

        // Pastikan tidak melebihi stok
        $maxQty = $item->product->stok;
        $qty    = min($request->quantity, $maxQty);

        $item->update(['quantity' => $qty]);

        return back()->with('success', 'Jumlah item diperbarui.');
    }

    // ── Hapus item dari keranjang ─────────────────────────────
    public function remove($id)
    {
        $item = CartItem::whereHas('cart', fn($q) => $q->where('user_id', auth()->id()))
                        ->findOrFail($id);
        $item->delete();

        return back()->with('success', 'Item dihapus dari keranjang.');
    }
}