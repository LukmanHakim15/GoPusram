<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'nama_produk', 'harga',
        'stok', 'deskripsi', 'gambar', 'expired_date', 'is_active'
    ];

    protected $casts = [
        'expired_date' => 'date',
        'is_active'    => 'boolean',
    ];

    // Produk ini milik satu kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Produk ini bisa ada di banyak cart item
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    // Produk ini bisa ada di banyak order item
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Helper: apakah stok menipis (kurang dari 5)?
    public function isLowStock(): bool
    {
        return $this->stok < 5;
    }

    // Helper: format harga ke Rupiah
    public function hargaFormatted(): string
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }
}