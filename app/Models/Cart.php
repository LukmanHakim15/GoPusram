<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['user_id'];

    // Keranjang ini milik satu user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Keranjang ini punya banyak item
    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    // Helper: hitung total harga semua item di keranjang ini
    public function totalHarga()
    {
        return $this->items->sum(function ($item) {
            return $item->product->harga * $item->quantity;
        });
    }
}