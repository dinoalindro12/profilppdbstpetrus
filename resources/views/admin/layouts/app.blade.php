<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Portal') — SMAS St. Petrus</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-slate-100 font-sans antialiased"
      x-data="{ sidebarOpen: false }">

{{-- ─── Shell layout: sidebar kiri + main kanan ────────────────── --}}
<div class="flex h-full min-h-screen">

    {{-- ══════════════════════════════════════════
         SIDEBAR
    ══════════════════════════════════════════ --}}
    {{--
        Konsisten dengan desain publik: cobalt-700 + gold accent.
        Tapi lebih padat karena ini tools internal.
    --}}

    {{-- Overlay mobile --}}
    <div x-show="sidebarOpen"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
         @click="sidebarOpen = false"
         class="fixed inset-0 z-20 bg-cobalt-900/60 lg:hidden"></div>

    <aside
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
        class="fixed lg:static inset-y-0 left-0 z-30 w-64 flex flex-col
               bg-cobalt-700 text-white transition-transform duration-200 ease-out
               lg:translate-x-0 shrink-0">

        {{-- Gold top bar --}}
        <div class="h-1 bg-gradient-to-r from-gold-600 via-gold-400 to-gold-600 shrink-0"></div>

        {{-- Logo / identitas --}}
        <div class="px-5 py-4 border-b border-cobalt-600/60 shrink-0">
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <div class="w-8 h-8 rounded-md bg-white/10 border border-white/20 p-1 shrink-0">
                    <img src="{{ asset('storage/backgrounds/logo2.png') }}" alt="Logo" class="w-full h-full object-contain">
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-bold text-white truncate leading-none">SMAS St. Petrus</p>
                    <p class="text-[0.65rem] text-cobalt-300 tracking-widest uppercase mt-0.5">Portal Sekolah</p>
                </div>
            </a>
        </div>

        {{-- User info + role badge --}}
        <div class="px-5 py-3.5 border-b border-cobalt-600/60 shrink-0">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-cobalt-500 flex items-center justify-center text-white font-bold text-sm shrink-0">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-sm font-semibold text-white truncate leading-none">{{ Auth::user()->name }}</p>
                    @php
                        $roleLabel = [
                            'kepala_sekolah' => 'Kepala Sekolah',
                            'admin'          => 'Administrator',
                            'super_admin'    => 'Super Admin',
                            'guru_kelas'     => 'Guru Kelas',
                            'guru_mapel'     => 'Guru Mata Pelajaran',
                            'siswa'          => 'Siswa',
                        ][Auth::user()->role] ?? Auth::user()->role;
                    @endphp
                    <p class="text-[0.7rem] text-gold-400 mt-0.5">{{ $roleLabel }}</p>
                </div>
            </div>
        </div>

        {{-- Navigasi — menu berubah sesuai role --}}
        <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-0.5">

            @php $role = Auth::user()->role; @endphp

            {{-- ── KEPALA SEKOLAH ─────────────────────────── --}}
            @if($role === 'kepala_sekolah')
                @include('admin.layouts.partials.nav-kepala')

            {{-- ── ADMIN / SUPER ADMIN ─────────────────────── --}}
            @elseif(in_array($role, ['admin', 'super_admin']))
                @include('admin.layouts.partials.nav-admin')

            {{-- ── GURU KELAS ─────────────────────────────── --}}
            @elseif($role === 'guru_kelas')
                @include('admin.layouts.partials.nav-guru-kelas')

            {{-- ── GURU MATA PELAJARAN ─────────────────────── --}}
            @elseif($role === 'guru_mapel')
                @include('admin.layouts.partials.nav-guru-mapel')

            {{-- ── SISWA ──────────────────────────────────── --}}
            @elseif($role === 'siswa')
                @include('admin.layouts.partials.nav-siswa')
            @endif

        </nav>

        {{-- Logout --}}
        <div class="px-3 py-3 border-t border-cobalt-600/60 shrink-0">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium
                               text-cobalt-300 hover:bg-cobalt-600/60 hover:text-white transition-colors">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    {{-- ══════════════════════════════════════════
         MAIN CONTENT
    ══════════════════════════════════════════ --}}
    <div class="flex flex-col flex-1 min-w-0 overflow-hidden">

        {{-- Top bar --}}
        <header class="h-14 bg-white border-b border-slate-200 flex items-center justify-between px-4 lg:px-6 shrink-0">
            {{-- Hamburger (mobile) --}}
            <button @click="sidebarOpen = !sidebarOpen"
                    class="lg:hidden p-2 rounded-md text-cobalt-600 hover:bg-cobalt-50 focus-visible:ring-2 focus-visible:ring-gold-500"
                    aria-label="Buka navigasi">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            {{-- Judul halaman --}}
            <div class="flex items-center gap-2 min-w-0">
                <h1 class="text-sm font-semibold text-cobalt-800 truncate">@yield('title', 'Dashboard')</h1>
            </div>

            {{-- Kanan: tanggal + aksi --}}
            <div class="flex items-center gap-3">
                <span class="hidden sm:block text-xs text-cobalt-400">
                    {{ now()->translatedFormat('l, d F Y') }}
                </span>
                {{-- Notif placeholder --}}
                <button class="relative p-1.5 rounded-md text-cobalt-400 hover:text-cobalt-600 hover:bg-cobalt-50 transition-colors"
                        aria-label="Notifikasi">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                </button>
                {{-- Avatar dropdown --}}
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" @click.outside="open = false"
                            class="w-8 h-8 rounded-full bg-cobalt-600 text-white text-sm font-bold
                                   flex items-center justify-center hover:bg-cobalt-700 transition-colors focus-visible:ring-2 focus-visible:ring-gold-500">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </button>
                    <div x-show="open"
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 -translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="absolute right-0 top-full mt-2 w-52 sp-card py-1 z-50">
                        <div class="px-4 py-3 border-b border-slate-100">
                            <p class="text-sm font-semibold text-cobalt-800 truncate">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-cobalt-400 truncate">{{ Auth::user()->email }}</p>
                        </div>
                        <a href="#" class="flex items-center gap-2.5 px-4 py-2.5 text-sm text-cobalt-700 hover:bg-cobalt-50 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Edit Profil
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-2.5 px-4 py-2.5 text-sm text-ember hover:bg-red-50 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        {{-- Flash messages --}}
        @if(session('success') || session('error') || session('info'))
        <div class="px-4 lg:px-6 pt-4">
            @if(session('success'))
            <div class="sp-alert-success mb-3" role="alert">{{ session('success') }}</div>
            @endif
            @if(session('error'))
            <div class="sp-alert-error mb-3" role="alert">{{ session('error') }}</div>
            @endif
            @if(session('info'))
            <div class="sp-alert-info mb-3" role="alert">{{ session('info') }}</div>
            @endif
        </div>
        @endif

        {{-- Page content --}}
        <main class="flex-1 overflow-y-auto p-4 lg:p-6">
            @yield('content')
        </main>
    </div>
</div>

@stack('scripts')
</body>
</html>
