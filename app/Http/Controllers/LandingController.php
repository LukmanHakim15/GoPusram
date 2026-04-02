<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\OperatingHour;
use App\Models\Product;

class LandingController extends Controller
{
    public function index()
    {
        $operatingHour = OperatingHour::getSetting();

        $categories = Category::withCount(['products' => function ($q) {
            $q->where('is_active', true)->where('stok', '>', 0);
        }])->get();

        // Produk unggulan untuk ditampilkan di landing (max 8)
        $featuredProducts = Product::with('category')
            ->where('is_active', true)
            ->where('stok', '>', 0)
            ->inRandomOrder()
            ->take(8)
            ->get();

        // Produk terlaris
        $terlaris = Product::withCount('orderItems')
            ->where('is_active', true)
            ->where('stok', '>', 0)
            ->orderByDesc('order_items_count')
            ->take(4)
            ->get();

        return view('landing', compact(
            'operatingHour', 'categories', 'featuredProducts', 'terlaris'
        ));
    }
}