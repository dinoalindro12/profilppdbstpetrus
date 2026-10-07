@extends('admin.layouts.app')
@section('title', 'Tambah Pengguna')

@section('content')
<div class="max-w-xl space-y-5">

    <div class="flex items-center gap-3">
        <a href="{{ route('admin.users.index') }}"
           class="p-1.5 rounded-lg text-cobalt-500 hover:bg-cobalt-50 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
        </a>
        <div>
            <h2 class="sp-mark font-display text-xl font-bold text-cobalt-800">Tambah Pengguna</h2>
            <p class="text-cobalt-500 text-sm mt-0.5">Buat akun baru untuk staf, guru, atau siswa.</p>
        </div>
    </div>

    @if($kepalaSekolahExists && request()->old('role') === 'kepala_sekolah')
    <div class="text-sm text-ember bg-red-50 border border-red-200 rounded-lg px-4 py-3">
        Kepala sekolah sudah ada. Sistem hanya mengizinkan satu kepala sekolah.
    </div>
    @endif

    <div class="sp-card p-6">
        <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-4">
            @csrf

            {{-- Nama --}}
            <div>
                <label for="name" class="block text-sm font-semibold text-cobalt-700 mb-1.5">
                    Nama Lengkap <span class="text-ember">*</span>
                </label>
                <input id="name" name="name" type="text"
                       value="{{ old('name') }}" required autofocus
                       class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm
                              focus:border-cobalt-500 focus:ring-2 focus:ring-cobalt-200 transition
                              @error('name') border-ember ring-2 ring-ember/20 @enderror">
                @error('name')<p class="text-xs text-ember mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Email --}}
            <div>
                <label for="email" class="block text-sm font-semibold text-cobalt-700 mb-1.5">
                    Email <span class="text-ember">*</span>
                </label>
                <input id="email" name="email" type="email"
                       value="{{ old('email') }}" required autocomplete="off"
                       class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm
                              focus:border-cobalt-500 focus:ring-2 focus:ring-cobalt-200 transition
                              @error('email') border-ember ring-2 ring-ember/20 @enderror">
                @error('email')<p class="text-xs text-ember mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Role --}}
            <div>
                <label for="role" class="block text-sm font-semibold text-cobalt-700 mb-1.5">
                    Role <span class="text-ember">*</span>
                </label>
                <select id="role" name="role" required
                        class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm bg-white
                               focus:border-cobalt-500 focus:ring-2 focus:ring-cobalt-200 transition
                               @error('role') border-ember ring-2 ring-ember/20 @enderror">
                    <option value="">— Pilih role —</option>
                    @foreach($roles as $value => $label)
                    <option value="{{ $value }}" {{ old('role') === $value ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                    @endforeach
                </select>
                @error('role')<p class="text-xs text-ember mt-1">{{ $message }}</p>@enderror
                @if($kepalaSekolahExists)
                <p class="text-xs text-cobalt-400 mt-1">
                    Role kepala sekolah tidak tersedia karena sudah ada satu akun kepala sekolah.
                </p>
                @endif
            </div>

            {{-- NIP / NIS --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="nip" class="block text-sm font-semibold text-cobalt-700 mb-1.5">NIP</label>
                    <input id="nip" name="nip" type="text" value="{{ old('nip') }}"
                           placeholder="Untuk guru/staf"
                           class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm
                                  focus:border-cobalt-500 focus:ring-2 focus:ring-cobalt-200 transition">
                </div>
                <div>
                    <label for="nis" class="block text-sm font-semibold text-cobalt-700 mb-1.5">NIS</label>
                    <input id="nis" name="nis" type="text" value="{{ old('nis') }}"
                           placeholder="Untuk siswa"
                           class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm
                                  focus:border-cobalt-500 focus:ring-2 focus:ring-cobalt-200 transition">
                </div>
            </div>

            {{-- No. HP --}}
            <div>
                <label for="phone" class="block text-sm font-semibold text-cobalt-700 mb-1.5">No. HP</label>
                <input id="phone" name="phone" type="text" value="{{ old('phone') }}"
                       class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm
                              focus:border-cobalt-500 focus:ring-2 focus:ring-cobalt-200 transition">
            </div>

            {{-- Password --}}
            <div>
                <label for="password" class="block text-sm font-semibold text-cobalt-700 mb-1.5">
                    Kata Sandi <span class="text-ember">*</span>
                </label>
                <input id="password" name="password" type="password" required autocomplete="new-password"
                       class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm
                              focus:border-cobalt-500 focus:ring-2 focus:ring-cobalt-200 transition
                              @error('password') border-ember ring-2 ring-ember/20 @enderror">
                @error('password')<p class="text-xs text-ember mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Konfirmasi Password --}}
            <div>
                <label for="password_confirmation" class="block text-sm font-semibold text-cobalt-700 mb-1.5">
                    Konfirmasi Kata Sandi <span class="text-ember">*</span>
                </label>
                <input id="password_confirmation" name="password_confirmation" type="password"
                       required autocomplete="new-password"
                       class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm
                              focus:border-cobalt-500 focus:ring-2 focus:ring-cobalt-200 transition">
            </div>

            <div class="flex items-center justify-end gap-3 pt-2 border-t border-slate-100">
                <a href="{{ route('admin.users.index') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary">Buat Akun</button>
            </div>
        </form>
    </div>

</div>
@endsection
