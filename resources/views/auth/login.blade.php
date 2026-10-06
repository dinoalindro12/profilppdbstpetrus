<x-guest-layout>

    {{-- Mobile: logo kecil di atas form --}}
    <div class="flex items-center gap-3 mb-8 lg:hidden">
        <div class="w-9 h-9 rounded-lg bg-cobalt-100 border border-cobalt-200 p-1">
            <img src="{{ asset('storage/backgrounds/logo2.png') }}"
                 alt="Logo SMA RK Deli Murni Delitua" class="w-full h-full object-contain">
        </div>
        <div>
            <span class="block text-sm font-bold text-cobalt-800">SMA RK Deli Murni</span>
            <span class="block text-xs text-cobalt-400">Delitua</span>
        </div>
    </div>

    {{-- Heading --}}
    <div class="mb-8">
        <h1 class="font-display text-2xl font-bold text-cobalt-800 mb-1">Masuk ke Portal</h1>
        <p class="text-cobalt-500 text-sm">
            .
        </p>
    </div>

    {{-- Session status (mis. setelah reset password) --}}
    @if (session('status'))
    <div class="sp-alert-info mb-5" role="alert">
        {{ session('status') }}
    </div>
    @endif

    {{-- ── Error kredensial: pesan jelas, bukan "These credentials do not match" --}}
    @if ($errors->any())
    <div class="sp-alert-error mb-5" role="alert">
        <div class="flex items-start gap-2">
            <svg class="w-4 h-4 mt-0.5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
            <div>
                @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-5" novalidate>
        @csrf

        {{-- Email --}}
        <div>
            <label for="email" class="block text-sm font-semibold text-cobalt-700 mb-1.5">
                Alamat Email
            </label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
                autocomplete="username"
                placeholder="nama@smastpetrus.sch.id"
                class="w-full rounded-lg border px-4 py-2.5 text-sm text-ink
                       placeholder:text-cobalt-300
                       border-slate-300 bg-white
                       focus:border-cobalt-500 focus:ring-2 focus:ring-cobalt-200
                       @error('email') border-ember ring-2 ring-ember/20 @enderror
                       transition"
            >
        </div>

        {{-- Password --}}
        <div x-data="{ show: false }">
            <div class="flex items-center justify-between mb-1.5">
                <label for="password" class="block text-sm font-semibold text-cobalt-700">
                    Kata Sandi
                </label>
                @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                   class="text-xs text-cobalt-500 hover:text-cobalt-700 underline underline-offset-2 transition-colors">
                    Lupa kata sandi?
                </a>
                @endif
            </div>
            <div class="relative">
                <input
                    id="password"
                    :type="show ? 'text' : 'password'"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder="••••••••"
                    class="w-full rounded-lg border px-4 py-2.5 pr-11 text-sm text-ink
                           placeholder:text-cobalt-300
                           border-slate-300 bg-white
                           focus:border-cobalt-500 focus:ring-2 focus:ring-cobalt-200
                           @error('password') border-ember ring-2 ring-ember/20 @enderror
                           transition"
                >
                <button type="button" @click="show = !show"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-cobalt-400 hover:text-cobalt-600 transition-colors"
                        :aria-label="show ? 'Sembunyikan kata sandi' : 'Tampilkan kata sandi'">
                    <svg x-show="!show" class="w-4.5 h-4.5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    <svg x-show="show" class="w-4.5 h-4.5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Remember me --}}
        <div class="flex items-center gap-2">
            <input id="remember_me" type="checkbox" name="remember"
                   class="w-4 h-4 rounded border-slate-300 text-cobalt-600 focus:ring-cobalt-400">
            <label for="remember_me" class="text-sm text-cobalt-600 cursor-pointer select-none">
                Ingat saya di perangkat ini
            </label>
        </div>

        {{-- Submit --}}
        <button type="submit" class="btn-primary w-full justify-center py-3 text-base mt-2">
            Masuk
        </button>
    </form>

    {{-- Link kembali (mobile only) --}}
    <div class="mt-6 text-center lg:hidden">
        <a href="{{ route('home') }}"
           class="inline-flex items-center gap-1.5 text-sm text-cobalt-500 hover:text-cobalt-700 transition-colors">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke website
        </a>
    </div>

</x-guest-layout>
