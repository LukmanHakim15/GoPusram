<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OperatingHour extends Model
{
    protected $fillable = ['is_open', 'jam_buka', 'jam_tutup'];

    protected $casts = ['is_open' => 'boolean'];

    // Method statis untuk mengambil setting jam operasional (selalu hanya ada 1 row)
    public static function getSetting(): self
    {
        return self::firstOrCreate([], [
            'is_open'   => false,
            'jam_buka'  => '07:00:00',
            'jam_tutup' => '14:00:00',
        ]);
    }

    // Apakah toko sedang dalam jam operasional sekarang?
   public function isCurrentlyOpen(): bool
{
    // Kalau admin matikan manual, langsung tutup
    if (!$this->is_open) return false;

    try {
        $now   = now()->format('H:i');
        $buka  = substr($this->jam_buka,  0, 5); // ambil "HH:MM" saja
        $tutup = substr($this->jam_tutup, 0, 5); // ambil "HH:MM" saja

        return $now >= $buka && $now <= $tutup;
    } catch (\Exception $e) {
        return false;
    }
}
}