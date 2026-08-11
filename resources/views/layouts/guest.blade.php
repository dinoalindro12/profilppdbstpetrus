<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'SMAS St. Petrus') }} — Portal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-cobalt-700 antialiased font-sans">

<div class="min-h-screen grid lg:grid-cols-2">

    {{-- ── Sisi kiri: identitas sekolah ───────────────────────────── --}}
    <div class="hidden lg:flex flex-col justify-between p-12 relative overflow-hidden">
        {{-- Motif diagonal --}}
        <div class="absolute inset-0 opacity-[0.05]"
             style="background-image: repeating-linear-gradient(
                 -45deg, #fff 0, #fff 1px, transparent 0, transparent 50%
             ); background-size: 24px 24px;"></div>

        {{-- Gold bar atas --}}
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-gold-600 via-gold-400 to-gold-600"></div>

        {{-- Logo + nama --}}
        <div class="relative z-10">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-lg bg-white/10 border border-white/20 p-1.5">
                    <img src="{{ asset('storage/backgrounds/logo2.png') }}"
                         alt="Logo SMAS St. Petrus" class="w-full h-full object-contain">
                </div>
                <div class="leading-none">
                    <span class="block text-base font-bold text-white tracking-tight">SMAS St. Petrus</span>
                    <span class="block text-xs font-medium text-cobalt-300 tracking-widest uppercase mt-0.5">Pontianak</span>
                </div>
            </a>
        </div>

        {{-- Kutipan tengah --}}
        <div class="relative z-10 my-auto">
            <div class="sp-mark mb-6">
                <p class="font-serif italic text-2xl text-white leading-relaxed">
                    "Saya datang supaya mereka mempunyai hidup,<br>
                    dan mempunyainya dalam segala kelimpahan."
                </p>
                <p class="text-cobalt-300 text-sm mt-3 not-italic">— Yohanes 10:10</p>
            </div>
            <p class="text-cobalt-200 text-sm leading-relaxed max-w-sm">
                Portal ini adalah akses terpusat bagi kepala sekolah, guru, dan siswa
                SMAS St. Petrus untuk mengelola kegiatan akademik sehari-hari.
            </p>
        </div>

        {{-- Link kembali ke beranda --}}
        <div class="relative z-10">
            <a href="{{ route('home') }}"
               class="inline-flex items-center gap-2 text-cobalt-300 hover:text-white text-sm transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke website sekolah
            </a>
        </div>
    </div>

    {{-- ── Sisi kanan: form login ──────────────────────────────────── --}}
    <div class="flex items-center justify-center px-6 py-12 bg-parchment lg:rounded-l-3xl">
        <div class="w-full max-w-md">
            {{ $slot }}
        </div>
    </div>
</div>

</body>
</html>
