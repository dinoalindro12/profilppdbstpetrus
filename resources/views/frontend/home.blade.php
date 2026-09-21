@extends('frontend.layouts.app')

@section('title', 'Beranda')
@section('description', 'SMA Swasta RK Deli Murni Delitua — sekolah menengah atas terbaik di Delitua, Deli Serdang. Akreditasi A, NPSN 10214181. Mendidik generasi berkarakter, cerdas, dan berprestasi.')
@section('keywords', 'SMA Swasta RK Deli Murni Delitua, SMA terbaik di Delitua, SMA RK Deli Murni Delitua, PPDB SMA Delitua, SMA Deli Serdang akreditasi A')

@section('content')

{{-- ═══════════════════════════════════════════════════════════
     HERO — Pernyataan tesis, bukan carousel + teks overlay
     Wireframe:
     [ label kecil / teks arah kiri        | foto kepsek kanan ]
     [ Heading besar 2-3 baris             |                   ]
     [ Paragraf pendek spesifik sekolah    |                   ]
     [ CTA Daftar + CTA Pelajari           |                   ]
═══════════════════════════════════════════════════════════ --}}
<section class="relative overflow-hidden bg-cobalt-700 text-white">
    {{-- Gold hairline di atas --}}
    <div class="h-1 bg-gradient-to-r from-gold-600 via-gold-400 to-gold-600"></div>

    {{-- Motif latar: diagonal lines subtle --}}
    <div class="absolute inset-0 opacity-[0.04]"
         style="background-image: repeating-linear-gradient(
             -45deg,
             #fff 0,
             #fff 1px,
             transparent 0,
             transparent 50%
         ); background-size: 24px 24px;">
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-0 items-stretch min-h-[88vh]">

            {{-- Kolom teks --}}
            <div class="flex flex-col justify-center py-20 lg:py-28 animate-entry">
                <div class="sp-mark-sm inline-flex mb-6">
                    <span class="text-gold-400 text-sm font-semibold tracking-widest uppercase">
                        Delitua, Deli Serdang — Sumatera Utara
                    </span>
                </div>

                <h1 class="font-display text-display-xl leading-tight-display text-balance text-white mb-6">
                    Kami mendidik siswa<br>
                    yang <em class="not-italic text-gold-400">berani berpikir</em><br>
                    dan teguh beriman.
                </h1>

                <p class="text-cobalt-200 text-lg leading-relaxed max-w-lg mb-8">
                    Sejak berdiri, SMA Swasta RK Deli Murni menemani ratusan keluarga Delitua
                    dalam perjalanan akademik putra-putri mereka menuju Perguruan Tinggi
                    dan kehidupan yang bermakna.
                </p>

                <div class="flex flex-wrap gap-3">
                    @if($activePpdb)
                    <a href="{{ route('ppdb.form') }}" class="btn-gold text-base py-3 px-7">
                        Daftar PPDB {{ $activePpdb->academic_year }}
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                    @endif
                    <a href="{{ route('profile.history') }}"
                       class="inline-flex items-center gap-2 text-base py-3 px-6 rounded-[6px] font-semibold
                              text-white border border-white/30 hover:bg-white/10 transition-colors duration-200">
                        Kenali Sekolah Kami
                    </a>
                </div>

                {{-- Tiga fakta spesifik — bukan "angka besar + label kecil" --}}
                <div class="mt-14 grid grid-cols-3 gap-6 pt-10 border-t border-white/10">
                    @foreach([
                        ['angka' => '1975',  'konteks' => 'Tahun sekolah ini berdiri'],
                        ['angka' => '98%',   'konteks' => 'Lulusan diterima di PTN/PTS pilihan'],
                        ['angka' => '40+',   'konteks' => 'Prestasi akademik & non-akademik'],
                    ] as $f)
                    <div>
                        <p class="text-2xl font-bold text-gold-400 font-display">{{ $f['angka'] }}</p>
                        <p class="text-cobalt-300 text-xs mt-1 leading-snug">{{ $f['konteks'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Kolom foto kepsek — dari DB --}}
            <div class="hidden lg:flex items-center justify-center relative">

                {{-- Latar dekoratif --}}
                <div class="absolute bottom-0 right-0 w-4/5 h-5/6 bg-cobalt-600 rounded-tl-3xl -z-10"></div>

                {{-- Wrapper: TIDAK overflow-hidden, supaya panel teks bebas melebar ke luar frame foto --}}
                <div class="relative z-10 group w-[420px]">

                    {{-- ① Foto: kotak rounded, bukan lingkaran --}}
                    <div class="relative w-full aspect-[4/5] rounded-2xl overflow-hidden shadow-2xl bg-cobalt-800">
                        @if($sambutan && $sambutan->image)
                            <img src="{{ asset('storage/'.$sambutan->image) }}"
                                alt="{{ $sambutan->nama_kepsek ?? 'Kepala Sekolah' }}"
                                class="w-full h-full object-cover object-top block
                                        transition-all duration-500 ease-out
                                        group-hover:blur-md group-hover:scale-110">
                        @else
                            <img src="{{ asset('storage/backgrounds/kepsek1.png') }}"
                                alt="Kepala Sekolah SMA RK Deli Murni Delitua"
                                class="w-full h-full object-cover object-top block
                                        transition-all duration-500 ease-out
                                        group-hover:blur-md group-hover:scale-110">
                        @endif

                        {{-- Overlay gelap, ikut dibatasi bentuk foto --}}
                        <div class="absolute inset-0 bg-cobalt-900/70
                                    opacity-0 group-hover:opacity-100
                                    transition-opacity duration-500 ease-out pointer-events-none">
                        </div>

                        {{-- Nama & label, tetap kelihatan di atas foto saat normal --}}
                        <div class="absolute bottom-0 inset-x-0 p-6 bg-gradient-to-t from-cobalt-950/90 to-transparent
                                    opacity-100 group-hover:opacity-0 transition-opacity duration-300">
                            <p class="text-sm font-bold text-white">
                                {{ $sambutan->nama_kepsek ?? 'Kepala Sekolah' }}
                            </p>
                            <p class="text-[0.65rem] text-cobalt-300 mt-0.5">Kepala Sekolah</p>
                        </div>
                    </div>

                    {{-- ② Panel teks sambutan: DI LUAR frame foto, bisa discroll agar isi lengkap terbaca --}}
                    <div class="absolute top-6 left-0 w-full z-20 rounded-2xl shadow-2xl
                                bg-cobalt-900/95 backdrop-blur-sm
                                max-h-[420px] overflow-y-auto
                                [scrollbar-width:none] [&::-webkit-scrollbar]:hidden
                                opacity-0 group-hover:opacity-100
                                scale-95 group-hover:scale-100
                                -translate-y-2 group-hover:translate-y-0
                                transition-all duration-500 ease-out
                                pointer-events-none group-hover:pointer-events-auto">

                        <div class="flex flex-col items-center text-center px-8 pt-9 pb-8">
                            <p class="text-[0.6rem] font-bold text-gold-400 uppercase tracking-widest mb-3">
                                Sambutan Kepala Sekolah
                            </p>

                            <p class="font-serif italic text-white text-[0.85rem] leading-relaxed">
                                "{!! nl2br(e(strip_tags($sambutan->content ?? 'Selamat datang di SMA RK Deli Murni Delitua.'))) !!}"
                            </p>

                            <div class="w-10 h-px bg-gold-400/60 mx-auto my-4"></div>

                            <p class="text-sm font-bold text-white">
                                {{ $sambutan->nama_kepsek ?? 'Kepala Sekolah' }}
                            </p>
                            <p class="text-[0.65rem] text-cobalt-300 mt-0.5">
                                Kepala Sekolah
                            </p>

                            <p class="text-[0.6rem] text-white/40 mt-5 animate-bounce">
                                ↑ geser untuk membaca selengkapnya
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>


{{-- ═══════════════════════════════════════════════════════════
     SAMBUTAN KEPALA SEKOLAH — hanya tampil di mobile & tablet (< lg)
═══════════════════════════════════════════════════════════ --}}
@if($sambutan)
<section class="lg:hidden bg-cobalt-800 py-10 px-4 sm:px-6">
    <div class="max-w-xl mx-auto flex flex-col items-center text-center gap-5">

        {{-- Foto --}}
        <div class="w-28 h-28 rounded-full overflow-hidden ring-4 ring-gold-400/60 shadow-xl shrink-0">
            @if($sambutan->image)
                <img src="{{ asset('storage/'.$sambutan->image) }}"
                     alt="{{ $sambutan->nama_kepsek ?? 'Kepala Sekolah' }}"
                     class="w-full h-full object-cover object-top">
            @else
                <img src="{{ asset('storage/backgrounds/kepsek1.png') }}"
                     alt="Kepala Sekolah SMA RK Deli Murni Delitua"
                     class="w-full h-full object-cover object-top">
            @endif
        </div>

        {{-- Teks sambutan --}}
        <div>
            <p class="text-[0.6rem] font-bold text-gold-400 uppercase tracking-widest mb-3">
                Sambutan Kepala Sekolah
            </p>
            <p class="font-serif italic text-cobalt-100 text-sm leading-relaxed">
                "{!! nl2br(e(strip_tags($sambutan->content ?? 'Selamat datang di SMA RK Deli Murni Delitua.'))) !!}"
            </p>
            <div class="w-10 h-px bg-gold-400/60 mx-auto my-4"></div>
            <p class="text-sm font-bold text-white">{{ $sambutan->nama_kepsek ?? 'Kepala Sekolah' }}</p>
            <p class="text-xs text-cobalt-300 mt-0.5">Kepala Sekolah</p>
        </div>

    </div>
</section>
@endif

{{-- STRIP PPDB — hanya tampil jika ada PPDB aktif --}}
@if($activePpdb)
<section class="bg-gold-500">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex flex-col sm:flex-row items-center justify-between gap-3">
        <div class="flex items-center gap-3">
            <span class="inline-block bg-cobalt-700 text-white text-xs font-bold px-2.5 py-1 rounded tracking-wider uppercase">
                PPDB Dibuka
            </span>
            <p class="text-cobalt-900 text-sm font-medium">
                Penerimaan Peserta Didik Baru {{ $activePpdb->academic_year }}
                &mdash; Pendaftaran online sampai
                {{ $activePpdb->registration_end->translatedFormat('d F Y') }}.
            </p>
        </div>
        <a href="{{ route('ppdb.form') }}"
           class="shrink-0 inline-flex items-center gap-1.5 text-sm font-bold text-cobalt-800 underline underline-offset-2 hover:text-cobalt-900 transition-colors">
            Daftar sekarang
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>
    </div>
</section>
@endif

{{-- ═══════════════════════════════════════════════════════════
     BERITA TERBARU
═══════════════════════════════════════════════════════════ --}}
<section class="py-20 bg-parchment">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex items-end justify-between mb-10">
            <div>
                <p class="text-gold-600 text-sm font-semibold tracking-widest uppercase mb-2">Kabar Sekolah</p>
                <h2 class="sp-mark font-display text-display-md text-cobalt-800">Berita Terbaru</h2>
            </div>
            <a href="{{ route('news.index') }}"
               class="hidden sm:inline-flex items-center gap-1.5 text-sm font-semibold text-cobalt-600 hover:text-cobalt-800 transition-colors">
                Semua berita
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>

        @if(isset($news) && count($news) > 0)
        {{-- Layout: satu berita besar + dua kecil --}}
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

            {{-- Berita utama --}}
            @isset($news[0])
            <a href="{{ route('news.detail', $news[0]['slug'] ?? '#') }}"
               class="lg:col-span-3 sp-card-hover group overflow-hidden flex flex-col">
                <div class="aspect-[16/9] overflow-hidden">
                    <img src="{{ $news[0]['image'] ?? asset('images/placeholder.jpg') }}"
                         alt="{{ $news[0]['title'] }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <div class="p-6 flex flex-col flex-1">
                    <div class="flex items-center gap-2 mb-3">
                        @isset($news[0]['category'])
                        <span class="text-xs font-semibold text-cobalt-600 bg-cobalt-50 px-2.5 py-1 rounded-full">
                            {{ $news[0]['category'] }}
                        </span>
                        @endisset
                        <time class="text-xs text-cobalt-400">{{ \Carbon\Carbon::parse($news[0]['date'] ?? now())->translatedFormat('d F Y') }}</time>
                    </div>
                    <h3 class="font-display text-xl font-bold text-cobalt-800 mb-2 leading-snug group-hover:text-cobalt-600 transition-colors">
                        {{ $news[0]['title'] }}
                    </h3>
                    <p class="text-cobalt-500 text-sm leading-relaxed line-clamp-3 flex-1">
                        {{ $news[0]['excerpt'] ?? '' }}
                    </p>
                    <div class="mt-4 flex items-center gap-1.5 text-cobalt-600 text-sm font-semibold">
                        Baca selengkapnya
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </div>
                </div>
            </a>
            @endisset

            {{-- Dua berita sampingan --}}
            <div class="lg:col-span-2 flex flex-col gap-4">
                @foreach(array_slice($news, 1, 2) as $item)
                <a href="{{ route('news.detail', $item['slug'] ?? '#') }}"
                   class="sp-card-hover group overflow-hidden flex gap-4 p-4">
                    <div class="w-28 h-24 shrink-0 overflow-hidden rounded-lg">
                        <img src="{{ $item['image'] ?? asset('images/placeholder.jpg') }}"
                             alt="{{ $item['title'] }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="flex flex-col justify-between min-w-0">
                        <div>
                            <time class="text-xs text-cobalt-400 block mb-1">{{ \Carbon\Carbon::parse($item['date'] ?? now())->translatedFormat('d F Y') }}</time>
                            <h3 class="font-display text-sm font-bold text-cobalt-800 leading-snug line-clamp-3 group-hover:text-cobalt-600 transition-colors">
                                {{ $item['title'] }}
                            </h3>
                        </div>
                        <span class="text-xs font-semibold text-cobalt-500 inline-flex items-center gap-1 mt-2">
                            Baca
                            <svg class="w-3 h-3 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </span>
                    </div>
                </a>
                @endforeach

                {{-- Slot pengumuman penting --}}
                <div class="sp-card p-5 border-l-4 border-gold-500 rounded-l-none">
                    <p class="text-xs font-bold text-gold-600 uppercase tracking-wider mb-2">Pengumuman</p>
                    <p class="text-sm text-cobalt-700 leading-relaxed">
                        Rapat orang tua siswa kelas XII dijadwalkan pada <strong>Sabtu, 15 Agustus 2025</strong>
                        pukul 09.00 WIB di Aula Sekolah.
                    </p>
                </div>
            </div>
        </div>
        @else
        <div class="text-center py-16 text-cobalt-400">
            <p>Belum ada berita yang dipublikasikan.</p>
        </div>
        @endif

        <div class="mt-8 sm:hidden text-center">
            <a href="{{ route('news.index') }}" class="btn-secondary">Lihat semua berita</a>
        </div>
    </div>
</section>


{{-- ═══════════════════════════════════════════════════════════
     KEUNGGULAN — 3 pilar sekolah, bukan icon grid generik
═══════════════════════════════════════════════════════════ --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mb-14">
            <p class="text-gold-600 text-sm font-semibold tracking-widest uppercase mb-2">Mengapa SMA RK Deli Murni?</p>
            <h2 class="sp-mark font-display text-display-md text-cobalt-800 text-balance">
                Tiga hal yang membedakan kami dari sekolah lain
            </h2>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            @foreach([
                [
                    'no'     => '01',
                    'judul'  => 'Kurikulum Merdeka dengan Pembinaan Karakter',
                    'isi'    => 'Kurikulum nasional kami padukan dengan program pembinaan karakter Kristiani — bukan sebagai pelajaran tambahan, melainkan menjadi cara kami memandang setiap mata pelajaran.',
                    'cta'    => ['Lihat kurikulum', 'academic.curriculum'],
                ],
                [
                    'no'     => '02',
                    'judul'  => 'Guru yang Mengenal Siswa Secara Personal',
                    'isi'    => 'Rasio guru-siswa kami dijaga agar setiap siswa bisa dikenal, dipantau, dan didampingi perkembangannya — bukan hanya diajar.',
                    'cta'    => ['Kenali guru kami', 'profile.teachers'],
                ],
                [
                    'no'     => '03',
                    'judul'  => 'Ekskul & Prestasi yang Nyata',
                    'isi'    => 'Dari olimpiade sains hingga paduan suara, kami menyediakan ruang bagi setiap bakat. Lebih dari 40 piala diraih siswa kami dalam lima tahun terakhir.',
                    'cta'    => ['Lihat prestasi', 'academic.achievement'],
                ],
            ] as $pilar)
            <div class="group">
                <div class="flex items-start gap-4 mb-5">
                    <span class="font-display text-5xl font-bold text-cobalt-100 group-hover:text-gold-300 transition-colors leading-none select-none">
                        {{ $pilar['no'] }}
                    </span>
                    <div class="h-px flex-1 bg-cobalt-100 mt-6"></div>
                </div>
                <h3 class="font-display text-lg font-bold text-cobalt-800 mb-3 leading-snug">{{ $pilar['judul'] }}</h3>
                <p class="text-cobalt-500 text-sm leading-relaxed mb-5">{{ $pilar['isi'] }}</p>
                <a href="{{ route($pilar['cta'][1]) }}"
                   class="inline-flex items-center gap-1.5 text-sm font-semibold text-cobalt-600 hover:text-cobalt-800 transition-colors">
                    {{ $pilar['cta'][0] }}
                    <svg class="w-3.5 h-3.5 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════
     STRIP INFO RESMI SEKOLAH — Data identitas dari Dapodik
═══════════════════════════════════════════════════════════ --}}
<section class="py-10 bg-cobalt-700 border-t border-cobalt-600">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row items-start lg:items-center gap-8">

            {{-- Label --}}
            <div class="shrink-0">
                <p class="text-gold-400 text-xs font-bold uppercase tracking-widest mb-1">Identitas Sekolah</p>
                <h3 class="font-display text-xl font-bold text-white leading-tight">
                    SMA Swasta RK<br>Deli Murni Delitua
                </h3>
                <div class="flex items-center gap-2 mt-2">
                    <span class="inline-flex items-center gap-1.5 bg-gold-500/20 border border-gold-400/40
                                 text-gold-300 text-xs font-bold px-2.5 py-1 rounded-full">
                        ★ Akreditasi A
                    </span>
                </div>
            </div>

            {{-- Divider --}}
            <div class="hidden lg:block w-px h-16 bg-cobalt-500"></div>

            {{-- Grid data --}}
            <div class="flex-1 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-x-8 gap-y-4">
                @foreach([
                    ['label' => 'NPSN',        'value' => '10214181'],
                    ['label' => 'Status',       'value' => 'Swasta'],
                    ['label' => 'Jenjang',      'value' => 'SMA (DIKMEN)'],
                    ['label' => 'Kecamatan',    'value' => 'Kec. Deli Tua'],
                    ['label' => 'Kabupaten',    'value' => 'Kab. Deli Serdang'],
                    ['label' => 'Provinsi',     'value' => 'Sumatera Utara'],
                    ['label' => 'Alamat',       'value' => 'Jl. Nogio VI No. 117'],
                    ['label' => 'Kelurahan',    'value' => 'Deli Tua Timur'],
                ] as $item)
                <div>
                    <p class="text-[0.65rem] font-semibold text-cobalt-400 uppercase tracking-wider">
                        {{ $item['label'] }}
                    </p>
                    <p class="text-sm font-medium text-cobalt-100 mt-0.5">
                        {{ $item['value'] }}
                    </p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════
     GALERI FOTO
═══════════════════════════════════════════════════════════ --}}
<section class="py-20 bg-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex items-end justify-between mb-10">
            <div>
                <p class="text-gold-600 text-sm font-semibold tracking-widest uppercase mb-2">Kehidupan Sekolah</p>
                <h2 class="sp-mark font-display text-display-md text-cobalt-800">Galeri Kegiatan</h2>
            </div>
            <a href="{{ route('gallery.index') }}"
               class="hidden sm:inline-flex items-center gap-1.5 text-sm font-semibold text-cobalt-600 hover:text-cobalt-800 transition-colors">
                Lihat semua
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>

        @if(isset($gallery) && count($gallery) > 0)
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
            @foreach(array_slice($gallery, 0, 8) as $idx => $item)
            <a href="{{ isset($item['id']) ? route('gallery.show', $item['id']) : '#' }}"
               class="group relative overflow-hidden rounded-xl {{ $idx === 0 ? 'md:col-span-2 md:row-span-2' : '' }} aspect-square">
                <img src="{{ $item['image'] ?? asset('images/placeholder.jpg') }}"
                     alt="{{ $item['title'] ?? 'Kegiatan sekolah' }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                <div class="absolute inset-0 bg-cobalt-900/0 group-hover:bg-cobalt-900/50 transition-colors duration-300
                            flex items-end p-4 opacity-0 group-hover:opacity-100">
                    <p class="text-white text-sm font-medium">{{ $item['title'] ?? '' }}</p>
                </div>
            </a>
            @endforeach
        </div>
        @else
        <div class="text-center py-16 text-cobalt-400">
            <p>Galeri belum tersedia.</p>
        </div>
        @endif
    </div>
</section>


{{-- CTA PPDB — hanya tampil jika ada PPDB aktif --}}
@if($activePpdb)
<section class="py-20 bg-cobalt-700 relative overflow-hidden">
    <div class="absolute inset-0 opacity-[0.04]"
         style="background-image: repeating-linear-gradient(-45deg,#fff 0,#fff 1px,transparent 0,transparent 50%);
                background-size: 24px 24px;">
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <p class="text-gold-400 text-sm font-semibold tracking-widest uppercase mb-4">
                PPDB {{ $activePpdb->academic_year }} Sedang Dibuka
            </p>
            <h2 class="font-display text-display-lg text-white mb-5 text-balance">
                Daftarkan putra-putri Anda sebelum kuota penuh.
            </h2>
            <p class="text-cobalt-200 text-lg leading-relaxed mb-8 max-w-xl">
                Proses seleksi terbuka, transparan, dan bisa dipantau secara online.
                Pendaftaran ditutup
                <strong class="text-white">{{ $activePpdb->registration_end->translatedFormat('d F Y') }}</strong>.
            </p>

            {{-- Timeline dari data nyata --}}
            <div class="grid sm:grid-cols-3 gap-4 mb-10">
                @foreach([
                    ['tanggal' => $activePpdb->registration_start->translatedFormat('d M'), 'label' => 'Pendaftaran dibuka'],
                    ['tanggal' => $activePpdb->registration_end->translatedFormat('d M'),   'label' => 'Batas pendaftaran'],
                    ['tanggal' => 'Pengumuman',                                              'label' => 'Lihat info PPDB'],
                ] as $i => $fase)
                <div class="flex items-center gap-3">
                    <div class="shrink-0 w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm bg-white/10 text-white">
                        {{ $i + 1 }}
                    </div>
                    <div>
                        <p class="text-white font-semibold text-base">{{ $fase['tanggal'] }}</p>
                        <p class="text-cobalt-300 text-xs">{{ $fase['label'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="flex flex-wrap gap-3">
                <a href="{{ route('ppdb.form') }}" class="btn-gold text-base py-3 px-7">
                    Isi Formulir Pendaftaran
                </a>
                <a href="{{ route('ppdb.info') }}"
                   class="inline-flex items-center gap-2 text-base py-3 px-6 rounded-[6px] font-semibold
                          text-white border border-white/30 hover:bg-white/10 transition-colors">
                    Lihat persyaratan
                </a>
            </div>
        </div>
    </div>
</section>
@endif

{{-- ═══════════════════════════════════════════════════════════
     EKSTRAKURIKULER — list nyata, bukan ikon generik
═══════════════════════════════════════════════════════════ --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mb-12">
            <p class="text-gold-600 text-sm font-semibold tracking-widest uppercase mb-2">Di luar kelas</p>
            <h2 class="sp-mark font-display text-display-md text-cobalt-800">Ekstrakurikuler yang Aktif</h2>
            <p class="text-cobalt-500 mt-4 text-base leading-relaxed">
                Kegiatan non-akademik bukan pelengkap — ini tempat siswa menemukan identitasnya.
            </p>
        </div>

        @if(isset($extracurriculars) && count($extracurriculars) > 0)
        <div class="flex flex-wrap gap-3 mb-8">
            @foreach($extracurriculars as $ekskul)
            <span class="px-4 py-2 rounded-full border border-cobalt-200 text-cobalt-700 text-sm font-medium
                         hover:border-gold-400 hover:bg-gold-50 hover:text-cobalt-900 transition-colors cursor-default">
                {{ $ekskul->name ?? $ekskul['name'] ?? $ekskul }}
            </span>
            @endforeach
        </div>
        @else
        {{-- Fallback hard-coded yang spesifik --}}
        <div class="flex flex-wrap gap-3 mb-8">
            @foreach(['Paduan Suara', 'Basket', 'Futsal', 'Olimpiade Matematika', 'Olimpiade Sains',
                      'Pramuka', 'PMR', 'English Club', 'Teater', 'Tari Tradisional', 'Badminton',
                      'Robotika', 'Jurnalistik Sekolah'] as $ekskul)
            <span class="px-4 py-2 rounded-full border border-cobalt-200 text-cobalt-700 text-sm font-medium
                         hover:border-gold-400 hover:bg-gold-50 hover:text-cobalt-900 transition-colors cursor-default">
                {{ $ekskul }}
            </span>
            @endforeach
        </div>
        @endif

        <a href="{{ route('academic.extracurricular') }}" class="btn-secondary">
            Lihat detail semua ekstrakurikuler
        </a>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════
     POP-UP PPDB — hanya di beranda, muncul SEKALI per kunjungan
     Key localStorage: ppdb_dismissed_{academic_year}
     Jika user tutup, tidak muncul lagi sampai tahun ajaran berubah
═══════════════════════════════════════════════════════════ --}}
@if($activePpdb)
<div x-data="{
        show: false,
        key: 'ppdb_dismissed_{{ Str::slug($activePpdb->academic_year) }}',
        init() {
            if (!localStorage.getItem(this.key)) {
                setTimeout(() => this.show = true, 900);
            }
        },
        close() {
            this.show = false;
            localStorage.setItem(this.key, '1');
        }
     }"
     x-show="show"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     @keydown.escape.window="close()"
     class="fixed inset-0 z-[70] flex items-center justify-center p-4 bg-cobalt-950/65 backdrop-blur-sm"
     @click.self="close()">

    {{-- Card --}}
    <div x-show="show"
         x-transition:enter="transition ease-out duration-350"
         x-transition:enter-start="opacity-0 scale-95 translate-y-6"
         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95 translate-y-4"
         class="relative w-full max-w-sm bg-white rounded-2xl overflow-hidden shadow-2xl">

        {{-- ── Header cobalt ──────────────────────────────────────── --}}
        <div class="relative bg-cobalt-700 px-6 pt-6 pb-14">
            {{-- Diagonal pattern --}}
            <div class="absolute inset-0 opacity-[0.07]"
                 style="background-image:repeating-linear-gradient(-45deg,#fff 0,#fff 1px,transparent 0,transparent 50%);
                        background-size:18px 18px;"></div>

            {{-- Gold line top --}}
            <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-gold-600 via-gold-300 to-gold-600"></div>

            {{-- Close button --}}
            <button @click="close()"
                    class="absolute top-3.5 right-3.5 w-8 h-8 rounded-full bg-white/15 hover:bg-white/25
                           flex items-center justify-center text-white transition-colors"
                    aria-label="Tutup">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            {{-- Badge --}}
            <span class="relative inline-flex items-center gap-1.5 bg-gold-500 text-cobalt-900
                         text-[0.65rem] font-bold px-2.5 py-1 rounded-full uppercase tracking-widest mb-3">
                <span class="w-1.5 h-1.5 rounded-full bg-cobalt-800/40 animate-pulse"></span>
                Pendaftaran Dibuka
            </span>

            {{-- Title --}}
            <h2 class="relative font-display text-[1.6rem] font-bold text-white leading-tight">
                PPDB {{ $activePpdb->academic_year }}
            </h2>
            <p class="relative text-cobalt-300 text-sm mt-1">
                SMA Swasta RK Deli Murni Delitua
            </p>
        </div>

        {{-- Wave separator — putih di atas cobalt --}}
        <div class="relative -mt-8 z-10">
            <svg viewBox="0 0 400 32" fill="white" class="w-full block" preserveAspectRatio="none" style="height:32px">
                <path d="M0,32 C100,0 300,0 400,32 Z"/>
            </svg>
        </div>

        {{-- ── Body ────────────────────────────────────────────────── --}}
        <div class="relative z-10 bg-white px-6 pb-6 -mt-1">

            {{-- Grid tanggal --}}
            <div class="grid grid-cols-2 gap-3 mb-4">
                <div class="rounded-xl border border-slate-200 px-4 py-3 text-center">
                    <p class="text-[0.6rem] text-cobalt-400 font-bold uppercase tracking-wider mb-1">Mulai</p>
                    <p class="font-display text-lg font-bold text-cobalt-800 leading-none">
                        {{ $activePpdb->registration_start->translatedFormat('d M') }}
                    </p>
                    <p class="text-xs text-cobalt-400 mt-0.5">{{ $activePpdb->registration_start->format('Y') }}</p>
                </div>
                <div class="rounded-xl border border-cobalt-200 bg-cobalt-50 px-4 py-3 text-center">
                    <p class="text-[0.6rem] text-cobalt-500 font-bold uppercase tracking-wider mb-1">Batas Daftar</p>
                    <p class="font-display text-lg font-bold text-cobalt-800 leading-none">
                        {{ $activePpdb->registration_end->translatedFormat('d M') }}
                    </p>
                    <p class="text-xs text-cobalt-400 mt-0.5">{{ $activePpdb->registration_end->format('Y') }}</p>
                </div>
            </div>

            {{-- Kuota --}}
            @if($activePpdb->quota)
            <div class="flex items-center gap-2.5 bg-gold-50 border border-gold-200
                        rounded-xl px-4 py-3 mb-4">
                <svg class="w-4 h-4 text-gold-600 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <p class="text-sm text-cobalt-700">
                    Kuota: <strong class="font-bold">{{ number_format($activePpdb->quota) }} siswa</strong>
                </p>
            </div>
            @endif

            {{-- CTA utama --}}
            <a href="{{ route('ppdb.form') }}" @click="close()"
               class="btn-primary w-full justify-center py-3 text-[0.9375rem] font-bold mb-2.5">
                <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                Daftar Sekarang
            </a>

            {{-- Secondary actions --}}
            <div class="flex gap-2.5">
                <a href="{{ route('ppdb.info') }}" @click="close()"
                   class="btn-secondary flex-1 justify-center py-2.5 text-sm">
                    Info & Syarat
                </a>
                <button @click="close()"
                        class="flex-1 py-2.5 text-sm font-semibold text-cobalt-400 hover:text-cobalt-600
                               rounded-lg border border-slate-200 hover:bg-slate-50 transition-colors">
                    Nanti Saja
                </button>
            </div>
        </div>
    </div>
</div>
@endif

@endsection