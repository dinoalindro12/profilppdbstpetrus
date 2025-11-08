<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Kontak;
use App\Models\Setting;

class KontakaController extends Controller
{
    public function create(): View
    {
        return view('frontend.contact.index');
    }
    
    public function store(Request $request)
    {
        // Validasi
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'tujuan' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        // Rate Limiting Check
        $ipAddress = $request->ip();
        $rateLimit = Setting::getValue('contact_rate_limit', 5);
        $rateLimitHours = Setting::getValue('contact_rate_limit_hours', 1);

        $recentMessages = Kontak::recentFromIp($ipAddress, $rateLimitHours)->count();

        if ($recentMessages >= $rateLimit) {
            return back()->withErrors([
                'rate_limit' => "Anda telah mengirim {$recentMessages} pesan dalam {$rateLimitHours} jam terakhir. Silakan coba lagi nanti."
            ])->withInput();
        }

        // Simpan data kontak dengan informasi tambahan
        $kontakData = array_merge($validated, [
            'ip_address' => $ipAddress,
            'user_agent' => $request->header('User-Agent')
        ]);

        Kontak::create($kontakData);

        return redirect()->route('contact.contact')
            ->with('success', 'Pesan Anda telah berhasil dikirim!');
    }
}