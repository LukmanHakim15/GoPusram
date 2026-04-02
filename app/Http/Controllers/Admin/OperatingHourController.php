<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OperatingHour;
use Illuminate\Http\Request;

class OperatingHourController extends Controller
{
    public function index()
    {
        $setting = OperatingHour::getSetting();
        return view('admin.operating-hours', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'jam_buka'  => 'required|date_format:H:i',
            'jam_tutup' => 'required|date_format:H:i|after:jam_buka',
        ], [
            'jam_tutup.after' => 'Jam tutup harus setelah jam buka.',
        ]);

        $setting = OperatingHour::getSetting();
        $setting->update([
            'is_open'   => $request->boolean('is_open'),
            'jam_buka'  => $request->jam_buka . ':00',
            'jam_tutup' => $request->jam_tutup . ':00',
        ]);

        $status = $setting->is_open ? 'dibuka' : 'ditutup';
        return back()->with('success', "Pengaturan disimpan. Toko sekarang {$status}.");
    }
}