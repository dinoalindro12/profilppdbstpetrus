@extends('frontend.layouts.app')

@section('title', 'Beranda')
@section('description', 'SMAS St. Petrus Pontianak — sekolah Katolik yang membentuk siswa berkarakter, cerdas, dan beriman sejak berdiri.')

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
                        Medan, Sumatera Utara
                    </span>
                </div>

                <h1 class="font-display text-display-xl leading-tight-display text-balance text-white mb-6">
                    Kami mendidik siswa<br>
                    yang <em class="not-italic text-gold-400">berani berpikir</em><br>
                    dan teguh beriman.
                </h1>

                <p class="text-cobalt-200 text-lg leading-relaxed max-w-lg mb-8">
                    Sejak berdiri, SMA RK Santo Petrus menemani ratusan keluarga Medan
                    dalam perjalanan akademik putra-putri mereka menuju Perguruan Tinggi
                    dan kehidupan yang bermakna.
                </p>

                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('ppdb.form') }}" class="btn-gold text-base py-3 px-7">
                        Daftar PPDB 2025/2026
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
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

            {{-- Kolom foto kepsek --}}
            <div class="hidden lg:flex items-end justify-center relative pt-20">
                {{-- Latar kuning miring --}}
                <div class="absolute bottom-0 right-0 w-4/5 h-5/6 bg-cobalt-600 rounded-tl-3xl"></div>
                <div class="relative z-10 rounded-full overflow-hidden w-[520px] h-[520px]">
                    <img src="{{ asset('storage/backgrounds/kepsek1.png') }}" alt="Kepala Sekolah SMA RK Santo Petrus" class="h-full w-full object-cover object-center drop-shadow-2xl">
                </div>
                {{-- Label sambutan mengambang --}}
                <div class="absolute top-32 right-8 bg-white text-cobalt-800 rounded-xl p-4 shadow-card-lg max-w-[220px]">
                    <p class="text-xs text-cobalt-500 mb-1 font-medium">Sambutan Kepala Sekolah</p>
                    <p class="text-sm font-serif italic leading-relaxed text-cobalt-700">
                        "Syalom — semoga putra-putri kita tumbuh menjadi terang di tengah dunia."
                    </p>
                    <div class="mt-3 sp-mark-sm">
                        <p class="text-xs font-semibold text-cobalt-700">Kepala Sekolah</p>
                        <p class="text-xs text-cobalt-500">SMA RK Santo Petrus</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- ═══════════════════════════════════════════════════════════
     STRIP PPDB — info jadwal pendaftaran yang sedang berjalan
═══════════════════════════════════════════════════════════ --}}
<section class="bg-gold-500">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex flex-col sm:flex-row items-center justify-between gap-3">
        <div class="flex items-center gap-3">
            <span class="inline-block bg-cobalt-700 text-white text-xs font-bold px-2.5 py-1 rounded tracking-wider uppercase">
                PPDB Dibuka
            </span>
            <p class="text-cobalt-900 text-sm font-medium">
                Penerimaan Peserta Didik Baru 2025/2026 &mdash; Pendaftaran online sampai 30 Juli 2025.
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
            <p class="text-gold-600 text-sm font-semibold tracking-widest uppercase mb-2">Mengapa SMAS St. Petrus?</p>
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
            <div class="group relative overflow-hidden rounded-xl {{ $idx === 0 ? 'md:col-span-2 md:row-span-2' : '' }} aspect-square">
                <img src="{{ $item['image'] ?? asset('images/placeholder.jpg') }}"
                     alt="{{ $item['title'] ?? 'Kegiatan sekolah' }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                <div class="absolute inset-0 bg-cobalt-900/0 group-hover:bg-cobalt-900/50 transition-colors duration-300
                            flex items-end p-4 opacity-0 group-hover:opacity-100">
                    <p class="text-white text-sm font-medium">{{ $item['title'] ?? '' }}</p>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-16 text-cobalt-400">
            <p>Galeri belum tersedia.</p>
        </div>
        @endif
    </div>
</section>


{{-- ═══════════════════════════════════════════════════════════
     CTA PPDB — bukan blok statistik angka besar generik
═══════════════════════════════════════════════════════════ --}}
<section class="py-20 bg-cobalt-700 relative overflow-hidden">
    <div class="absolute inset-0 opacity-[0.04]"
         style="background-image: repeating-linear-gradient(-45deg,#fff 0,#fff 1px,transparent 0,transparent 50%);
                background-size: 24px 24px;">
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <p class="text-gold-400 text-sm font-semibold tracking-widest uppercase mb-4">PPDB 2025/2026 Sedang Dibuka</p>
            <h2 class="font-display text-display-lg text-white mb-5 text-balance">
                Daftarkan putra-putri Anda sebelum kuota penuh.
            </h2>
            <p class="text-cobalt-200 text-lg leading-relaxed mb-8 max-w-xl">
                Proses seleksi terbuka, transparan, dan bisa dipantau secara online.
                Pendaftaran ditutup <strong class="text-white">30 Juli 2025</strong>.
            </p>

            {{-- Timeline pendaftaran — info nyata, bukan dekorasi --}}
            <div class="grid sm:grid-cols-3 gap-4 mb-10">
                @foreach([
                    ['tanggal' => '15 Jun', 'label' => 'Pendaftaran dibuka', 'selesai' => true],
                    ['tanggal' => '30 Jul', 'label' => 'Batas pendaftaran',  'selesai' => false],
                    ['tanggal' => '5 Agu',  'label' => 'Pengumuman hasil',   'selesai' => false],
                ] as $i => $fase)
                <div class="flex items-center gap-3">
                    <div class="shrink-0 w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm
                                {{ $fase['selesai'] ? 'bg-gold-500 text-cobalt-900' : 'bg-white/10 text-white' }}">
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

@endsection
