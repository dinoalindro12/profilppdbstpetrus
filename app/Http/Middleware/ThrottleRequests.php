<?php

namespace App\Http\Middleware;

use Illuminate\Routing\Middleware\ThrottleRequests as Middleware;

class ThrottleRequests extends Middleware
{
    /**
     * Handle an incoming request.
     */
    public function handle($request, \Closure $next, ...$limits)
    {
        try {
            return parent::handle($request, $next, ...$limits);
        } catch (\Illuminate\Http\Exceptions\ThrottleRequestsException $e) {
            // Check if this is a POST request to ppdb.check-status
            if ($request->isMethod('post') && str_contains($request->path(), 'ppdb/status')) {
                return back()
                    ->withInput()
                    ->with('error', 'Terlalu banyak permintaan. Silahkan tunggu 1 menit sebelum mencoba lagi untuk mencegah penyalahgunaan.');
            }

            throw $e;
        }
    }
}
