<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Blokir akun non-aktif sebelum redirect
        if (! $user->is_active) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return back()->withErrors([
                'email' => 'Akun Anda sementara dinonaktifkan. Hubungi administrator sekolah.',
            ])->onlyInput('email');
        }

        // Redirect ke dashboard sesuai role
        $route = match ($user->role) {
            'kepala_sekolah'        => route('dashboard.kepala_sekolah'),
            'admin', 'super_admin'  => route('admin.dashboard'),
            'guru_kelas'            => route('dashboard.guru_kelas'),
            'guru_mapel'            => route('dashboard.guru_mapel'),
            'siswa'                 => route('dashboard.siswa'),
            default                 => route('admin.dashboard'),
        };

        return redirect()->intended($route);
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
