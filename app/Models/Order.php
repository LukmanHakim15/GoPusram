<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'total_harga', 'metode_pengambilan',
        'metode_pembayaran', 'status_pesanan', 'status_pembayaran', 'catatan'
    ];

    // Label status yang ramah dibaca
    const STATUS_LABELS = [
        'pending'      => 'Menunggu',
        'diproses'     => 'Sedang Diproses',
        'siap_diambil' => 'Siap Diambil',
        'diantar'      => 'Sedang Diantar',
        'selesai'      => 'Selesai',
        'dibatalkan'   => 'Dibatalkan',
    ];

    // Warna badge Bootstrap sesuai status
    const STATUS_COLORS = [
        'pending'      => 'warning',
        'diproses'     => 'info',
        'siap_diambil' => 'primary',
        'diantar'      => 'primary',
        'selesai'      => 'success',
        'dibatalkan'   => 'danger',
    ];

    public function user()       { return $this->belongsTo(User::class); }
    public function items()      { return $this->hasMany(OrderItem::class); }
    public function delivery()   { return $this->hasOne(Delivery::class); }

    public function statusLabel(): string
    {
        return self::STATUS_LABELS[$this->status_pesanan] ?? $this->status_pesanan;
    }

    public function statusColor(): string
    {
        return self::STATUS_COLORS[$this->status_pesanan] ?? 'secondary';
    }
}