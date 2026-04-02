<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\OperatingHour;
use App\Models\Product;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    public function index(Request $request)
    {
        // Ambil setting jam operasional
        $operatingHour = OperatingHour::getSetting();

        // Ambil semua kategori untuk filter
        $categories = Category::has('products')->get();

        // Query produk aktif dan ada stoknya
        $query = Product::with('category')
                        ->where('is_active', true)
                        ->where('stok', '>', 0);

        // Filter berdasarkan kategori
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter berdasarkan pencarian
        if ($request->filled('search')) {
            $query->where('nama_produk', 'like', '%' . $request->search . '%');
        }

        $products = $query->latest()->paginate(12)->withQueryString();

        // Produk terlaris (berdasarkan total order_items)
        $terlaris = Product::withCount('orderItems')
                           ->where('is_active', true)
                           ->where('stok', '>', 0)
                           ->orderByDesc('order_items_count')
                           ->take(4)
                           ->get();

        return view('siswa.katalog', compact(
            'products', 'categories', 'operatingHour', 'terlaris'
        ));
    }
}