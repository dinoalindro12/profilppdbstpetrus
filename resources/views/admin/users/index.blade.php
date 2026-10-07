@extends('admin.layouts.app')
@section('title', 'Kelola Pengguna')

@section('content')
<div class="space-y-5">

    <div class="flex items-center justify-between gap-4 flex-wrap">
        <div>
            <h2 class="sp-mark font-display text-xl font-bold text-cobalt-800">Kelola Pengguna</h2>
            <p class="text-cobalt-500 text-sm mt-1">Daftar seluruh akun yang terdaftar di sistem.</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="btn-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Pengguna
        </a>
    </div>

    @if(session('success'))
    <div class="text-sm text-emerald-700 bg-emerald-50 border border-emerald-200 rounded-lg px-4 py-3">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="text-sm text-ember bg-red-50 border border-red-200 rounded-lg px-4 py-3">
        {{ session('error') }}
    </div>
    @endif

    <div class="sp-card overflow-hidden">
        @if($users->count())
        <div class="overflow-x-auto">
            <table class="sp-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $i => $user)
                    <tr>
                        <td class="text-cobalt-400">{{ ($users->currentPage() - 1) * $users->perPage() + $i + 1 }}</td>
                        <td>
                            <p class="font-medium text-cobalt-800">{{ $user->name }}</p>
                            @if($user->nip)
                            <p class="text-xs text-cobalt-400">NIP: {{ $user->nip }}</p>
                            @elseif($user->nis)
                            <p class="text-xs text-cobalt-400">NIS: {{ $user->nis }}</p>
                            @endif
                        </td>
                        <td class="text-sm text-cobalt-600">{{ $user->email }}</td>
                        <td>
                            @php
                                $roleLabels = [
                                    'kepala_sekolah' => ['label' => 'Kepala Sekolah', 'class' => 'bg-gold-50 text-gold-700'],
                                    'super_admin'    => ['label' => 'Super Admin',    'class' => 'bg-purple-50 text-purple-700'],
                                    'admin'          => ['label' => 'Admin',           'class' => 'bg-cobalt-50 text-cobalt-700'],
                                    'guru_kelas'     => ['label' => 'Guru Kelas',      'class' => 'bg-emerald-50 text-emerald-700'],
                                    'guru_mapel'     => ['label' => 'Guru Mapel',      'class' => 'bg-teal-50 text-teal-700'],
                                    'siswa'          => ['label' => 'Siswa',           'class' => 'bg-slate-100 text-cobalt-500'],
                                ];
                                $r = $roleLabels[$user->role] ?? ['label' => $user->role, 'class' => 'bg-slate-100 text-cobalt-500'];
                            @endphp
                            <span class="text-xs px-2.5 py-1 rounded-full font-semibold {{ $r['class'] }}">
                                {{ $r['label'] }}
                            </span>
                        </td>
                        <td>
                            <span class="text-xs px-2.5 py-1 rounded-full font-semibold
                                {{ $user->is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-cobalt-400' }}">
                                {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td>
                            <div class="flex items-center justify-end gap-2">
                                {{-- Toggle aktif --}}
                                @if($user->id !== auth()->id())
                                <form method="POST" action="{{ route('admin.users.toggle-active', $user) }}">
                                    @csrf @method('PATCH')
                                    <button type="submit"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-semibold
                                                   {{ $user->is_active ? 'bg-amber-50 text-amber-700 hover:bg-amber-100' : 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100' }}
                                                   transition-colors">
                                        {{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                    </button>
                                </form>

                                {{-- Hapus --}}
                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                      onsubmit="return confirm('Hapus akun {{ $user->name }}? Tindakan ini tidak bisa dibatalkan.')">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-semibold
                                                   bg-red-50 text-ember hover:bg-red-100 transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                                @else
                                <span class="text-xs text-cobalt-300 italic">Akun Anda</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if($users->hasPages())
        <div class="px-5 py-3 border-t border-slate-100">
            {{ $users->links() }}
        </div>
        @endif
        @else
        <div class="py-16 text-center">
            <p class="text-cobalt-500 font-medium">Belum ada pengguna terdaftar.</p>
            <a href="{{ route('admin.users.create') }}" class="btn-primary mt-4 inline-flex">Tambah pengguna pertama</a>
        </div>
        @endif
    </div>

</div>
@endsection
