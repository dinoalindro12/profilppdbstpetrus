@extends('admin.layouts.app')
@section('title', 'Edit Profil Akun')

@section('content')

{{-- Form verifikasi email (harus di luar form lain karena HTML tidak izinkan nested form) --}}
<form id="send-verification" method="POST" action="{{ route('verification.send') }}">@csrf</form>

<div class="max-w-2xl space-y-6">

    <div>
        <h2 class="sp-mark font-display text-xl font-bold text-cobalt-800">Edit Profil Akun</h2>
        <p class="text-cobalt-500 text-sm mt-1">Perbarui nama, email, dan kata sandi akun Anda.</p>
    </div>

    {{-- ── Informasi Akun ───────────────────────────────────────── --}}
    <div class="sp-card p-6">
        <h3 class="text-sm font-bold text-cobalt-700 mb-4">Informasi Akun</h3>

        @if (session('status') === 'profile-updated')
        <div class="mb-4 text-sm text-emerald-700 bg-emerald-50 border border-emerald-200 rounded-lg px-4 py-2.5">
            Profil berhasil diperbarui.
        </div>
        @endif

        <form method="POST" action="{{ route('admin.account.update') }}" class="space-y-4">
            @csrf
            @method('PATCH')

            <div>
                <label for="name" class="block text-sm font-semibold text-cobalt-700 mb-1.5">Nama</label>
                <input id="name" name="name" type="text"
                       value="{{ old('name', $user->name) }}"
                       required autofocus autocomplete="name"
                       class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm
                              focus:border-cobalt-500 focus:ring-2 focus:ring-cobalt-200 transition
                              @error('name') border-ember ring-2 ring-ember/20 @enderror">
                @error('name')<p class="text-xs text-ember mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-semibold text-cobalt-700 mb-1.5">Email</label>
                <input id="email" name="email" type="email"
                       value="{{ old('email', $user->email) }}"
                       required autocomplete="username"
                       class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm
                              focus:border-cobalt-500 focus:ring-2 focus:ring-cobalt-200 transition
                              @error('email') border-ember ring-2 ring-ember/20 @enderror">
                @error('email')<p class="text-xs text-ember mt-1">{{ $message }}</p>@enderror

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <p class="text-xs text-amber-600 mt-1">
                    Email belum diverifikasi.
                    <button form="send-verification" type="submit"
                            class="underline hover:text-amber-800 transition-colors">
                        Kirim ulang verifikasi
                    </button>
                </p>
                @if (session('status') === 'verification-link-sent')
                <p class="text-xs text-emerald-600 mt-1">Link verifikasi telah dikirim ke email Anda.</p>
                @endif
                @endif
            </div>

            <div class="flex justify-end pt-2 border-t border-slate-100">
                <button type="submit" class="btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>

    {{-- ── Ubah Kata Sandi ─────────────────────────────────────── --}}
    <div class="sp-card p-6">
        <h3 class="text-sm font-bold text-cobalt-700 mb-4">Ubah Kata Sandi</h3>

        @if (session('status') === 'password-updated')
        <div class="mb-4 text-sm text-emerald-700 bg-emerald-50 border border-emerald-200 rounded-lg px-4 py-2.5">
            Kata sandi berhasil diperbarui.
        </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="current_password" class="block text-sm font-semibold text-cobalt-700 mb-1.5">
                    Kata Sandi Saat Ini
                </label>
                <input id="current_password" name="current_password" type="password"
                       autocomplete="current-password"
                       class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm
                              focus:border-cobalt-500 focus:ring-2 focus:ring-cobalt-200 transition
                              @error('current_password', 'updatePassword') border-ember ring-2 ring-ember/20 @enderror">
                @error('current_password', 'updatePassword')
                    <p class="text-xs text-ember mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-semibold text-cobalt-700 mb-1.5">
                    Kata Sandi Baru
                </label>
                <input id="password" name="password" type="password"
                       autocomplete="new-password"
                       class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm
                              focus:border-cobalt-500 focus:ring-2 focus:ring-cobalt-200 transition
                              @error('password', 'updatePassword') border-ember ring-2 ring-ember/20 @enderror">
                @error('password', 'updatePassword')
                    <p class="text-xs text-ember mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-semibold text-cobalt-700 mb-1.5">
                    Konfirmasi Kata Sandi Baru
                </label>
                <input id="password_confirmation" name="password_confirmation" type="password"
                       autocomplete="new-password"
                       class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm
                              focus:border-cobalt-500 focus:ring-2 focus:ring-cobalt-200 transition">
            </div>

            <div class="flex justify-end pt-2 border-t border-slate-100">
                <button type="submit" class="btn-primary">Perbarui Kata Sandi</button>
            </div>
        </form>
    </div>

</div>
@endsection
