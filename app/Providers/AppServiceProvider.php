<?php

namespace App\Providers;

use App\Models\PpdbInfo;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Bagikan data PPDB aktif ke semua view frontend.
        // $activePpdb bernilai null jika tidak ada PPDB yang sedang dibuka,
        // sehingga view bisa cek: @if($activePpdb) ... @endif
        View::composer('frontend.*', function ($view) {
            static $activePpdb = false; // static agar query hanya jalan sekali per request

            if ($activePpdb === false) {
                $activePpdb = PpdbInfo::where('is_active', true)
                    ->where('registration_start', '<=', now())
                    ->where('registration_end', '>=', now())
                    ->first();
            }

            $view->with('activePpdb', $activePpdb);
        });
    }
}
