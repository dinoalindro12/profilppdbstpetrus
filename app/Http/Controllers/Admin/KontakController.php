<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kontak;
use App\Models\Setting;

class KontakController extends Controller
{
    public function index()
    {
        $kontaks = Kontak::active()
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        $rateLimit = Setting::getValue('contact_rate_limit', 5);
        $rateLimitHours = Setting::getValue('contact_rate_limit_hours', 1);

        return view('admin.kontak.index', compact('kontaks', 'rateLimit', 'rateLimitHours'));
    }

    public function show($id)
    {
        $kontak = Kontak::findOrFail($id);
        return view('admin.kontak.show', compact('kontak'));
    }

    public function destroy($id)
    {
        $kontak = Kontak::findOrFail($id);
        $kontak->delete();

        return redirect()->route('admin.kontak.index')
            ->with('success', 'Pesan kontak berhasil dihapus.');
    }

    public function updateRateLimit(Request $request)
    {
        $request->validate([
            'rate_limit' => 'required|integer|min:1|max:100',
            'rate_limit_hours' => 'required|integer|min:1|max:24'
        ]);

        Setting::setValue('contact_rate_limit', $request->rate_limit, 'Jumlah maksimal pesan kontak per jam per IP');
        Setting::setValue('contact_rate_limit_hours', $request->rate_limit_hours, 'Jangka waktu rate limit (dalam jam)');

        return redirect()->route('admin.kontak.index')
            ->with('success', 'Pengaturan rate limit berhasil diperbarui.');
    }
}