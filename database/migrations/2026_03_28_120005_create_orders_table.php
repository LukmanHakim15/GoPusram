<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->decimal('total_harga', 10, 2);
        $table->enum('metode_pengambilan', ['ambil_sendiri', 'diantar'])->default('ambil_sendiri');
        $table->enum('metode_pembayaran', ['cash', 'ewallet'])->default('cash');
        $table->enum('status_pesanan', [
            'pending', 'diproses', 'siap_diambil', 'diantar', 'selesai', 'dibatalkan'
        ])->default('pending');
        $table->enum('status_pembayaran', ['belum_bayar', 'sudah_bayar'])->default('belum_bayar');
        $table->text('catatan')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
