<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $fillable = ['order_id', 'nama_penerima', 'kelas', 'lokasi_ruangan'];

    public function order() { return $this->belongsTo(Order::class); }
}