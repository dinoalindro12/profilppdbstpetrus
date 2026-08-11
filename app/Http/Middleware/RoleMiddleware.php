<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * Membatasi akses route berdasarkan role user.
 *
 * Penggunaan di route:
 *   ->middleware('role:admin,super_admin')
 *   ->middleware('role:guru_kelas')
 *   ->middleware('role:siswa')
 *
 * Jika user tidak punya role yang diizinkan:
 *   - Belum login      → redirect ke login
 *   - Sudah login tapi role salah → redirect ke dashboard role yang benar
 */
class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (! Auth::check()) {
            return redirect()->route('login')
                ->with('status', 'Silakan masuk terlebih dahulu untuk mengakses halaman ini.');
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Blokir akun non-aktif
        if (! $user->is_active) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')
                ->withErrors(['email' => 'Akun Anda dinonaktifkan. Hubungi administrator.']);
        }

        // Cek apakah role user termasuk dalam yang diizinkan
        if (! in_array($user->role, $roles)) {
            // Redirect ke dashboard yang sesuai role-nya, bukan 403 mentah
            return redirect()->route($this->dashboardRouteFor($user->role))
                ->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
        }

        return $next($request);
    }

    private function dashboardRouteFor(string $role): string
    {
        return match ($role) {
            'kepala_sekolah'        => 'dashboard.kepala_sekolah',
            'admin', 'super_admin'  => 'admin.dashboard',
            'guru_kelas'            => 'dashboard.guru_kelas',
            'guru_mapel'            => 'dashboard.guru_mapel',
            'siswa'                 => 'dashboard.siswa',
            default                 => 'admin.dashboard',
        };
    }
}
