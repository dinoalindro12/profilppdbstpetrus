<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- ── SEO: Title ─────────────────────────────────────────────────── --}}
    <title>@yield('title', 'SMA Swasta RK Deli Murni Delitua') — SMA Terbaik di Delitua, Deli Serdang</title>

    {{-- ── SEO: Meta Description & Keywords ─────────────────────────── --}}
    <meta name="description"
          content="@yield('description', 'SMA Swasta RK Deli Murni Delitua — sekolah menengah atas terbaik di Delitua, Kabupaten Deli Serdang, Sumatera Utara. Akreditasi A, NPSN 10214181. Mendidik generasi berkarakter, cerdas, dan berprestasi.')">
    <meta name="keywords"
          content="@yield('keywords', 'SMA Swasta RK Deli Murni Delitua, SMA terbaik di Delitua, SMA RK Deli Murni Delitua, sekolah menengah atas Delitua, SMA Deli Serdang, PPDB SMA Delitua, SMA akreditasi A Delitua, sekolah Katolik Delitua, SMA Sumatera Utara')">
    <meta name="author" content="SMA Swasta RK Deli Murni Delitua">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- ── SEO: Open Graph (Facebook, WhatsApp, dll) ─────────────────── --}}
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="SMA Swasta RK Deli Murni Delitua">
    <meta property="og:title" content="@yield('title', 'SMA Swasta RK Deli Murni Delitua') — SMA Terbaik di Delitua">
    <meta property="og:description" content="@yield('description', 'SMA Swasta RK Deli Murni Delitua — sekolah menengah atas terbaik di Delitua, Deli Serdang. Akreditasi A, NPSN 10214181.')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('storage/backgrounds/logo2.png') }}">
    <meta property="og:locale" content="id_ID">

    {{-- ── SEO: Twitter Card ──────────────────────────────────────────── --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'SMA Swasta RK Deli Murni Delitua')">
    <meta name="twitter:description" content="@yield('description', 'SMA Swasta RK Deli Murni Delitua — SMA terbaik di Delitua, Deli Serdang. Akreditasi A.')">
    <meta name="twitter:image" content="{{ asset('storage/backgrounds/logo2.png') }}">

    {{-- ── SEO: Schema.org JSON-LD (Google rich results) ───────────────── --}}
    <script type="application/ld+json">{!! json_encode([
        '@context'      => 'https://schema.org',
        '@type'         => 'HighSchool',
        'name'          => 'SMA Swasta RK Deli Murni Delitua',
        'alternateName' => 'SMA RK Deli Murni',
        'description'   => 'Sekolah Menengah Atas Swasta RK Deli Murni di Delitua, Kabupaten Deli Serdang, Sumatera Utara. Akreditasi A.',
        'url'           => config('app.url'),
        'logo'          => asset('storage/backgrounds/logo2.png'),
        'address'       => [
            '@type'           => 'PostalAddress',
            'streetAddress'   => 'Jl. Nogio VI No. 117',
            'addressLocality' => 'Deli Tua Timur, Kec. Deli Tua',
            'addressRegion'   => 'Sumatera Utara',
            'addressCountry'  => 'ID',
            'postalCode'      => '20355',
        ],
        'telephone'     => '+62-xxx-xxxx-xxxx',
        'identifier'    => [
            '@type' => 'PropertyValue',
            'name'  => 'NPSN',
            'value' => '10214181',
        ],
        'hasCredential' => 'Akreditasi A',
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-parchment text-ink antialiased">

{{-- ─── Navbar ─────────────────────────────────────────────────────────── --}}
<header
    class="sticky top-0 z-50 bg-white/95 backdrop-blur-sm border-b border-slate-200"
    x-data="{ open: false, profil: false, akademik: false, ppdb: false }"
    @keydown.escape.window="open = false; profil = false; akademik = false; ppdb = false"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3 shrink-0 group">
                <div class="w-9 h-9 rounded-md overflow-hidden border border-cobalt-100">
                    <img src="{{ asset('storage/backgrounds/logo2.png') }}" alt="Logo SMA RK Deli Murni Delitua"
                         class="w-full h-full object-contain p-0.5">
                </div>
                <div class="leading-none">
                    <span class="block text-[0.9375rem] font-bold text-cobalt-700 tracking-tight">SMA RK Deli Murni</span>
                    <span class="block text-[0.6875rem] font-medium text-cobalt-400 tracking-widest uppercase mt-0.5">Delitua</span>
                </div>
            </a>

            {{-- Desktop nav --}}
            <nav class="hidden lg:flex items-center gap-1">
                <a href="{{ route('home') }}"
                   class="nav-link px-3 {{ request()->routeIs('home') ? 'active' : '' }}">
                    Beranda
                </a>

                {{-- Profil dropdown --}}
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" @click.outside="open = false"
                            class="nav-link px-3 flex items-center gap-1
                                   {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                        Profil
                        <svg :class="open ? 'rotate-180' : ''" class="w-3.5 h-3.5 transition-transform duration-150"
                             fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open" x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 -translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                         class="absolute top-full left-0 mt-1.5 w-48 sp-card py-1 z-50"
                         @click.outside="open = false">
                        @foreach([
                            ['route' => 'profile.history',        'label' => 'Sejarah Sekolah'],
                            ['route' => 'profile.vision-mission', 'label' => 'Visi & Misi'],
                            ['route' => 'profile.teachers',       'label' => 'Guru & Staf'],
                            ['route' => 'profile.facilities',     'label' => 'Fasilitas'],
                        ] as $item)
                        <a href="{{ route($item['route']) }}"
                           class="block px-4 py-2.5 text-sm text-cobalt-700 hover:bg-cobalt-50 hover:text-cobalt-900 transition-colors
                                  {{ request()->routeIs($item['route']) ? 'bg-cobalt-50 text-cobalt-900 font-medium' : '' }}">
                            {{ $item['label'] }}
                        </a>
                        @endforeach
                    </div>
                </div>

                {{-- Akademik dropdown --}}
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" @click.outside="open = false"
                            class="nav-link px-3 flex items-center gap-1
                                   {{ request()->routeIs('academic.*') ? 'active' : '' }}">
                        Akademik
                        <svg :class="open ? 'rotate-180' : ''" class="w-3.5 h-3.5 transition-transform duration-150"
                             fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open" x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 -translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                         class="absolute top-full left-0 mt-1.5 w-52 sp-card py-1 z-50">
                        @foreach([
                            ['route' => 'academic.curriculum',        'label' => 'Kurikulum'],
                            ['route' => 'academic.extracurricular',   'label' => 'Ekstrakurikuler'],
                            ['route' => 'academic.achievement',       'label' => 'Prestasi'],
                            ['route' => 'academic-calendars.index',   'label' => 'Kalender Akademik'],
                        ] as $item)
                        <a href="{{ route($item['route']) }}"
                           class="block px-4 py-2.5 text-sm text-cobalt-700 hover:bg-cobalt-50 hover:text-cobalt-900 transition-colors
                                  {{ request()->routeIs($item['route']) ? 'bg-cobalt-50 text-cobalt-900 font-medium' : '' }}">
                            {{ $item['label'] }}
                        </a>
                        @endforeach
                    </div>
                </div>

                {{-- PPDB dropdown --}}
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" @click.outside="open = false"
                            class="nav-link px-3 flex items-center gap-1
                                   {{ request()->routeIs('ppdb.*') ? 'active' : '' }}">
                        PPDB
                        <svg :class="open ? 'rotate-180' : ''" class="w-3.5 h-3.5 transition-transform duration-150"
                             fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open" x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 -translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                         class="absolute top-full left-0 mt-1.5 w-48 sp-card py-1 z-50">
                        @foreach([
                            ['route' => 'ppdb.index', 'label' => 'Tentang PPDB'],
                            ['route' => 'ppdb.info',  'label' => 'Informasi & Persyaratan'],
                            ['route' => 'ppdb.form',  'label' => 'Daftar Sekarang'],
                            ['route' => 'ppdb.status','label' => 'Cek Status Pendaftaran'],
                        ] as $item)
                        <a href="{{ route($item['route']) }}"
                           class="block px-4 py-2.5 text-sm text-cobalt-700 hover:bg-cobalt-50 hover:text-cobalt-900 transition-colors
                                  {{ request()->routeIs($item['route']) ? 'bg-cobalt-50 text-cobalt-900 font-medium' : '' }}">
                            {{ $item['label'] }}
                        </a>
                        @endforeach
                    </div>
                </div>

                <a href="{{ route('news.index') }}"
                   class="nav-link px-3 {{ request()->routeIs('news.*') ? 'active' : '' }}">
                    Berita
                </a>

                {{-- Galeri dropdown --}}
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" @click.outside="open = false"
                            class="nav-link px-3 flex items-center gap-1
                                   {{ request()->routeIs('gallery.*') || request()->routeIs('alumni.*') ? 'active' : '' }}">
                        Galeri
                        <svg :class="open ? 'rotate-180' : ''" class="w-3.5 h-3.5 transition-transform duration-150"
                             fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open" x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 -translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                         class="absolute top-full left-0 mt-1.5 w-48 sp-card py-1 z-50"
                         @click.outside="open = false">
                        <a href="{{ route('gallery.index') }}"
                           class="block px-4 py-2.5 text-sm text-cobalt-700 hover:bg-cobalt-50 hover:text-cobalt-900 transition-colors
                                  {{ request()->routeIs('gallery.*') ? 'bg-cobalt-50 text-cobalt-900 font-medium' : '' }}">
                            Galeri Kegiatan
                        </a>
                        <a href="{{ route('alumni.galeri.index') }}"
                           class="block px-4 py-2.5 text-sm text-cobalt-700 hover:bg-cobalt-50 hover:text-cobalt-900 transition-colors
                                  {{ request()->routeIs('alumni.*') ? 'bg-cobalt-50 text-cobalt-900 font-medium' : '' }}">
                            Galeri Alumni
                        </a>
                    </div>
                </div>

                <a href="{{ route('contact.contact') }}"
                   class="nav-link px-3 {{ request()->routeIs('contact.*') ? 'active' : '' }}">
                    Kontak
                </a>
            </nav>

            {{-- CTA masuk + hamburger --}}
            <div class="flex items-center gap-2">
                @auth
                <a href="{{ route(Auth::user()->dashboardRoute()) }}"
                   class="hidden lg:inline-flex btn-primary text-xs py-2 px-4">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </a>
                @else
                <a href="{{ route('login') }}"
                   class="hidden lg:inline-flex items-center gap-1.5 text-sm font-semibold text-cobalt-600 hover:text-cobalt-800 transition-colors px-1">
                    Masuk
                </a>
                @endauth

                {{-- Mobile hamburger --}}
                <button @click="open = !open"
                        class="lg:hidden p-2 rounded-md text-cobalt-600 hover:bg-cobalt-50 focus-visible:ring-2 focus-visible:ring-gold-500"
                        :aria-expanded="open.toString()" aria-label="Buka menu navigasi">
                    <svg x-show="!open" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg x-show="open" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile menu --}}
    <div x-show="open"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
         class="lg:hidden border-t border-slate-200 bg-white">
        <div class="max-w-7xl mx-auto px-4 py-4 space-y-1">
            <a href="{{ route('home') }}" class="block py-2.5 px-3 rounded-lg text-sm font-medium text-cobalt-700 hover:bg-cobalt-50 {{ request()->routeIs('home') ? 'bg-cobalt-50 text-cobalt-900' : '' }}">Beranda</a>

            {{-- Profil accordion --}}
            <div x-data="{ sub: false }">
                <button @click="sub = !sub" class="w-full flex justify-between items-center py-2.5 px-3 rounded-lg text-sm font-medium text-cobalt-700 hover:bg-cobalt-50">
                    Profil
                    <svg :class="sub ? 'rotate-180' : ''" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="sub" class="pl-4 mt-1 space-y-0.5 border-l-2 border-gold-300 ml-3">
                    <a href="{{ route('profile.history') }}"        class="block py-2 px-3 text-sm text-cobalt-600 hover:text-cobalt-900">Sejarah Sekolah</a>
                    <a href="{{ route('profile.vision-mission') }}" class="block py-2 px-3 text-sm text-cobalt-600 hover:text-cobalt-900">Visi & Misi</a>
                    <a href="{{ route('profile.teachers') }}"       class="block py-2 px-3 text-sm text-cobalt-600 hover:text-cobalt-900">Guru & Staf</a>
                    <a href="{{ route('profile.facilities') }}"     class="block py-2 px-3 text-sm text-cobalt-600 hover:text-cobalt-900">Fasilitas</a>
                </div>
            </div>

            {{-- Akademik accordion --}}
            <div x-data="{ sub: false }">
                <button @click="sub = !sub" class="w-full flex justify-between items-center py-2.5 px-3 rounded-lg text-sm font-medium text-cobalt-700 hover:bg-cobalt-50">
                    Akademik
                    <svg :class="sub ? 'rotate-180' : ''" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="sub" class="pl-4 mt-1 space-y-0.5 border-l-2 border-gold-300 ml-3">
                    <a href="{{ route('academic.curriculum') }}"      class="block py-2 px-3 text-sm text-cobalt-600 hover:text-cobalt-900">Kurikulum</a>
                    <a href="{{ route('academic.extracurricular') }}" class="block py-2 px-3 text-sm text-cobalt-600 hover:text-cobalt-900">Ekstrakurikuler</a>
                    <a href="{{ route('academic.achievement') }}"     class="block py-2 px-3 text-sm text-cobalt-600 hover:text-cobalt-900">Prestasi</a>
                    <a href="{{ route('academic-calendars.index') }}" class="block py-2 px-3 text-sm text-cobalt-600 hover:text-cobalt-900">Kalender Akademik</a>
                </div>
            </div>

            {{-- PPDB accordion --}}
            <div x-data="{ sub: false }">
                <button @click="sub = !sub" class="w-full flex justify-between items-center py-2.5 px-3 rounded-lg text-sm font-medium text-cobalt-700 hover:bg-cobalt-50">
                    PPDB
                    <svg :class="sub ? 'rotate-180' : ''" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="sub" class="pl-4 mt-1 space-y-0.5 border-l-2 border-gold-300 ml-3">
                    <a href="{{ route('ppdb.index') }}"  class="block py-2 px-3 text-sm text-cobalt-600 hover:text-cobalt-900">Tentang PPDB</a>
                    <a href="{{ route('ppdb.info') }}"   class="block py-2 px-3 text-sm text-cobalt-600 hover:text-cobalt-900">Informasi & Persyaratan</a>
                    <a href="{{ route('ppdb.form') }}"   class="block py-2 px-3 text-sm text-cobalt-600 hover:text-cobalt-900">Daftar Sekarang</a>
                    <a href="{{ route('ppdb.status') }}" class="block py-2 px-3 text-sm text-cobalt-600 hover:text-cobalt-900">Cek Status Pendaftaran</a>
                </div>
            </div>

            <a href="{{ route('news.index') }}"      class="block py-2.5 px-3 rounded-lg text-sm font-medium text-cobalt-700 hover:bg-cobalt-50 {{ request()->routeIs('news.*') ? 'bg-cobalt-50 text-cobalt-900' : '' }}">Berita</a>

            {{-- Galeri accordion --}}
            <div x-data="{ sub: false }">
                <button @click="sub = !sub" class="w-full flex justify-between items-center py-2.5 px-3 rounded-lg text-sm font-medium text-cobalt-700 hover:bg-cobalt-50">
                    Galeri
                    <svg :class="sub ? 'rotate-180' : ''" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="sub" class="pl-4 mt-1 space-y-0.5 border-l-2 border-gold-300 ml-3">
                    <a href="{{ route('gallery.index') }}"      class="block py-2 px-3 text-sm text-cobalt-600 hover:text-cobalt-900">Galeri Kegiatan</a>
                    <a href="{{ route('alumni.galeri.index') }}" class="block py-2 px-3 text-sm text-cobalt-600 hover:text-cobalt-900">Galeri Alumni</a>
                </div>
            </div>

            <a href="{{ route('contact.contact') }}" class="block py-2.5 px-3 rounded-lg text-sm font-medium text-cobalt-700 hover:bg-cobalt-50">Kontak</a>

            <div class="pt-3 border-t border-slate-200 mt-2">
                @auth
                <a href="{{ route(Auth::user()->dashboardRoute()) }}" class="btn-primary w-full justify-center text-sm">
                    Buka Dashboard
                </a>
                @else
                <a href="{{ route('login') }}" class="btn-primary w-full justify-center text-sm">
                    Masuk ke Portal Sekolah
                </a>
                @endauth
            </div>
        </div>
    </div>
</header>

{{-- ─── Page Content ───────────────────────────────────────────────────── --}}
<main>
    @yield('content')
</main>

{{-- ─── Footer ─────────────────────────────────────────────────────────── --}}
<footer class="bg-cobalt-700 text-white mt-20">
    {{-- Gold top bar — signature element --}}
    <div class="h-1 bg-gradient-to-r from-gold-500 via-gold-400 to-gold-600"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">

            {{-- Identitas --}}
            <div class="lg:col-span-1">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-md bg-white/10 p-1.5">
                        <img src="{{ asset('storage/backgrounds/logo2.png') }}" alt="Logo" class="w-full h-full object-contain">
                    </div>
                    <div>
                        <p class="font-bold text-white text-base leading-none">SMA RK Deli Murni</p>
                        <p class="text-cobalt-300 text-xs mt-0.5">Delitua, Deli Serdang</p>
                    </div>
                </div>
                <p class="text-cobalt-200 text-sm leading-relaxed mb-3">
                    Mendidik generasi berkarakter, cerdas, dan berprestasi sejak berdirinya sekolah ini.
                </p>
                {{-- Badge akreditasi & NPSN --}}
                <div class="flex flex-wrap gap-2 mt-3">
                    <span class="inline-flex items-center gap-1.5 bg-gold-500/20 border border-gold-500/40
                                 text-gold-300 text-xs font-bold px-2.5 py-1 rounded-full">
                        Akreditasi A
                    </span>
                    <span class="inline-flex items-center gap-1.5 bg-white/10 border border-white/20
                                 text-cobalt-300 text-xs font-medium px-2.5 py-1 rounded-full">
                        NPSN 10214181
                    </span>
                </div>
            </div>

            {{-- Navigasi --}}
            <div>
                <h4 class="sp-mark-sm text-sm font-semibold text-gold-400 uppercase tracking-wider mb-4">Sekolah</h4>
                <ul class="space-y-2.5">
                    @foreach([
                        ['route' => 'profile.history',        'label' => 'Sejarah Sekolah'],
                        ['route' => 'profile.vision-mission', 'label' => 'Visi & Misi'],
                        ['route' => 'profile.teachers',       'label' => 'Guru & Staf'],
                        ['route' => 'profile.facilities',     'label' => 'Fasilitas'],
                    ] as $item)
                    <li><a href="{{ route($item['route']) }}" class="text-cobalt-200 hover:text-white text-sm transition-colors">{{ $item['label'] }}</a></li>
                    @endforeach
                </ul>
            </div>

            {{-- Akademik & PPDB --}}
            <div>
                <h4 class="sp-mark-sm text-sm font-semibold text-gold-400 uppercase tracking-wider mb-4">Akademik & PPDB</h4>
                <ul class="space-y-2.5">
                    @foreach([
                        ['route' => 'academic.curriculum',      'label' => 'Kurikulum'],
                        ['route' => 'academic.extracurricular', 'label' => 'Ekstrakurikuler'],
                        ['route' => 'academic.achievement',     'label' => 'Prestasi'],
                        ['route' => 'ppdb.form',                'label' => 'Daftar PPDB'],
                        ['route' => 'ppdb.status',              'label' => 'Cek Status PPDB'],
                    ] as $item)
                    <li><a href="{{ route($item['route']) }}" class="text-cobalt-200 hover:text-white text-sm transition-colors">{{ $item['label'] }}</a></li>
                    @endforeach
                </ul>
            </div>

            {{-- Kontak --}}
            <div>
                <h4 class="sp-mark-sm text-sm font-semibold text-gold-400 uppercase tracking-wider mb-4">Hubungi Kami</h4>
                <address class="not-italic space-y-3 text-sm text-cobalt-200">
                    <p class="flex items-start gap-2.5">
                        <svg class="w-4 h-4 mt-0.5 shrink-0 text-gold-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>
                            Jl. Nogio VI No. 117, Deli Tua Timur,<br>
                            Kec. Deli Tua, Kab. Deli Serdang,<br>
                            Sumatera Utara
                        </span>
                    </p>
                    <p class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 shrink-0 text-gold-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        (061) xxx-xxxx
                    </p>
                    <p class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 shrink-0 text-gold-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        info@smarkdelimurni.sch.id
                    </p>
                    <p class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 shrink-0 text-gold-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Senin–Jumat, 07.00–16.00 WIB
                    </p>
                </address>
            </div>
        </div>

        <div class="mt-12 pt-6 border-t border-cobalt-600/60 flex flex-col sm:flex-row justify-between items-center gap-3">
            <p class="text-cobalt-400 text-xs">
                &copy; {{ date('Y') }} SMA Swasta RK Deli Murni Delitua. Hak cipta dilindungi.
            </p>
            <div class="flex items-center gap-4">
                <a href="#" class="text-cobalt-400 hover:text-white transition-colors text-xs">Kebijakan Privasi</a>
                <a href="{{ route('contact.contact') }}" class="text-cobalt-400 hover:text-white transition-colors text-xs">Kontak</a>
                <a href="{{ route('login') }}" class="text-cobalt-400 hover:text-white transition-colors text-xs">Portal Guru &amp; Siswa</a>
            </div>
        </div>
    </div>
</footer>

@stack('scripts')
</body>
</html>
