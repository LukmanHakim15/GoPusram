<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',      // tambahkan ini
        'kelas',     // tambahkan ini
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    // Helper method untuk cek role — kita pakai ini nanti di seluruh aplikasi
    public function isAdmin(): bool { return $this->role === 'admin'; }
    public function isSiswa(): bool { return $this->role === 'siswa'; }
    public function isPM(): bool    { return $this->role === 'pm'; }
    // Tambahkan di dalam class User, setelah method isPM()

public function cart()
{
    return $this->hasOne(Cart::class);
}

public function orders()
{
    return $this->hasMany(Order::class);
}

public function notifications()
{
    return $this->hasMany(Notification::class);
}

// Helper: jumlah notifikasi yang belum dibaca
public function unreadNotificationsCount(): int
{
    return $this->notifications()->where('is_read', false)->count();
}
}