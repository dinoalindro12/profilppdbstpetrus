<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UserController extends Controller
{
    // Daftar semua pengguna
    public function index(): View
    {
        $users = User::orderBy('role')->orderBy('name')->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    // Form tambah pengguna baru
    public function create(): View
    {
        $kepalaSekolahExists = User::where('role', 'kepala_sekolah')->exists();

        $roles = [
            'admin'        => 'Admin',
            'super_admin'  => 'Super Admin',
            'guru_kelas'   => 'Guru Kelas',
            'guru_mapel'   => 'Guru Mata Pelajaran',
            'siswa'        => 'Siswa',
        ];

        // Kepala sekolah hanya bisa didaftarkan jika belum ada
        if (! $kepalaSekolahExists) {
            $roles = ['kepala_sekolah' => 'Kepala Sekolah'] + $roles;
        }

        return view('admin.users.create', compact('roles', 'kepalaSekolahExists'));
    }

    // Simpan pengguna baru
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'role'     => ['required', Rule::in(['kepala_sekolah', 'admin', 'super_admin', 'guru_kelas', 'guru_mapel', 'siswa'])],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'nip'      => ['nullable', 'string', 'max:30'],
            'nis'      => ['nullable', 'string', 'max:20'],
            'phone'    => ['nullable', 'string', 'max:20'],
        ]);

        // Pastikan kepala sekolah hanya boleh 1
        if ($request->role === 'kepala_sekolah') {
            if (User::where('role', 'kepala_sekolah')->exists()) {
                return back()->withErrors([
                    'role' => 'Kepala sekolah sudah ada. Hanya boleh satu kepala sekolah.',
                ])->withInput();
            }
        }

        User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'role'      => $request->role,
            'password'  => Hash::make($request->password),
            'nip'       => $request->nip,
            'nis'       => $request->nis,
            'phone'     => $request->phone,
            'is_active' => true,
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', "Akun {$request->name} berhasil dibuat.");
    }

    // Hapus pengguna
    public function destroy(User $user): RedirectResponse
    {
        // Tidak boleh hapus diri sendiri
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Tidak dapat menghapus akun sendiri.');
        }

        $user->delete();

        return back()->with('success', "Akun {$user->name} berhasil dihapus.");
    }

    // Toggle aktif/nonaktif
    public function toggleActive(User $user): RedirectResponse
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Tidak dapat menonaktifkan akun sendiri.');
        }

        $user->update(['is_active' => ! $user->is_active]);

        $status = $user->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return back()->with('success', "Akun {$user->name} berhasil {$status}.");
    }
}
