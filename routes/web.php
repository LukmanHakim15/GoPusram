<?php

use Illuminate\Support\Facades\Route;

// ── Halaman awal → login ────────────────────────────────────
Route::get('/', [\App\Http\Controllers\LandingController::class, 'index'])->name('landing');

// ── Auth (Breeze) ───────────────────────────────────────────
require __DIR__.'/auth.php';

// ═══════════════════════════════════════════════════════════
// SISWA
// ═══════════════════════════════════════════════════════════
Route::middleware(['auth', 'role:siswa'])
    ->prefix('siswa')
    ->name('siswa.')
    ->group(function () {

    // Katalog
    Route::get('/katalog', [\App\Http\Controllers\Siswa\KatalogController::class, 'index'])
         ->name('katalog');

    // Keranjang
    Route::get('/cart',          [\App\Http\Controllers\Siswa\CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add',     [\App\Http\Controllers\Siswa\CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/{id}',   [\App\Http\Controllers\Siswa\CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{id}',  [\App\Http\Controllers\Siswa\CartController::class, 'remove'])->name('cart.remove');

    // Checkout
    Route::get('/checkout',  [\App\Http\Controllers\Siswa\CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [\App\Http\Controllers\Siswa\CheckoutController::class, 'store'])->name('checkout.store');

    // Pesanan siswa
    Route::get('/orders',       [\App\Http\Controllers\Siswa\OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}',  [\App\Http\Controllers\Siswa\OrderController::class, 'show'])->name('orders.show');
});

// ═══════════════════════════════════════════════════════════
// PM (PETUGAS)
// ═══════════════════════════════════════════════════════════
Route::middleware(['auth', 'role:pm'])
    ->prefix('pm')
    ->name('pm.')
    ->group(function () {

    Route::get('/dashboard', [\App\Http\Controllers\PM\DashboardController::class, 'index'])
         ->name('dashboard');

    Route::get('/orders',                  [\App\Http\Controllers\PM\OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}',          [\App\Http\Controllers\PM\OrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}/status', [\App\Http\Controllers\PM\OrderController::class, 'updateStatus'])->name('orders.updateStatus');
});

// ═══════════════════════════════════════════════════════════
// ADMIN
// ═══════════════════════════════════════════════════════════
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    // Dashboard
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])
         ->name('dashboard');

    // Kategori
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class)
         ->names('categories');

    // Produk
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class)
         ->names('products');

    // Pesanan
    Route::get('/orders',                  [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}',          [\App\Http\Controllers\Admin\OrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}/status', [\App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('orders.updateStatus');

    // Jam operasional
    Route::get('/operating-hours',   [\App\Http\Controllers\Admin\OperatingHourController::class, 'index'])->name('operating-hours');
    Route::patch('/operating-hours', [\App\Http\Controllers\Admin\OperatingHourController::class, 'update'])->name('operating-hours.update');

    // Laporan
    Route::get('/reports',              [\App\Http\Controllers\Admin\ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/export-excel', [\App\Http\Controllers\Admin\ReportController::class, 'exportExcel'])->name('reports.excel');
    Route::get('/reports/export-pdf',   [\App\Http\Controllers\Admin\ReportController::class, 'exportPdf'])->name('reports.pdf');
});