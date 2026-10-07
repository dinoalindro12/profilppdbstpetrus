{{-- Navigasi Admin / Super Admin: full access --}}

@php
    $link = fn(string $route, string $label, string $svgPath) =>
        '<a href="' . route($route) . '" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors '
        . (request()->routeIs($route . '*') ? 'bg-cobalt-600 text-white' : 'text-cobalt-200 hover:bg-cobalt-600/60 hover:text-white')
        . '"><svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">'
        . $svgPath . '</svg>' . $label . '</a>';
@endphp

<a href="{{ route('admin.dashboard') }}"
   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
          {{ request()->routeIs('admin.dashboard') ? 'bg-cobalt-600 text-white' : 'text-cobalt-200 hover:bg-cobalt-600/60 hover:text-white' }}">
    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
    </svg>
    Dashboard
</a>

{{-- ── Profil Sekolah — hanya super_admin ─────────────────── --}}
@if(auth()->user()->role === 'super_admin')
<p class="px-3 pt-4 pb-1 text-[0.65rem] font-bold text-cobalt-400 uppercase tracking-wider">Profil Sekolah</p>

@foreach([
    ['route' => 'admin.profile.history',        'label' => 'Sejarah'],
    ['route' => 'admin.profile.vision-mission', 'label' => 'Visi & Misi'],
    ['route' => 'admin.profile.staff.index',    'label' => 'Guru & Staf'],
    ['route' => 'admin.profile.facilities.index','label'=> 'Fasilitas'],
] as $item)
<a href="{{ route($item['route']) }}"
   class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-colors
          {{ request()->routeIs($item['route'] . '*') ? 'bg-cobalt-600 text-white' : 'text-cobalt-200 hover:bg-cobalt-600/60 hover:text-white' }}">
    <span class="w-1.5 h-1.5 rounded-full bg-cobalt-400 shrink-0 ml-1.5"></span>
    {{ $item['label'] }}
</a>
@endforeach
@endif

{{-- ── Akademik — hanya super_admin ──────────────────────── --}}
@if(auth()->user()->role === 'super_admin')
<p class="px-3 pt-4 pb-1 text-[0.65rem] font-bold text-cobalt-400 uppercase tracking-wider">Akademik</p>

@foreach([
    ['route' => 'admin.academic.curriculum.index',       'label' => 'Kurikulum'],
    ['route' => 'admin.academic.extracurricular.index',  'label' => 'Ekstrakurikuler'],
    ['route' => 'admin.academic.achievement.index',      'label' => 'Prestasi'],
    ['route' => 'admin.academic.academic-calendars.index','label'=> 'Kalender Akademik'],
] as $item)
<a href="{{ route($item['route']) }}"
   class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-colors
          {{ request()->routeIs($item['route'] . '*') ? 'bg-cobalt-600 text-white' : 'text-cobalt-200 hover:bg-cobalt-600/60 hover:text-white' }}">
    <span class="w-1.5 h-1.5 rounded-full bg-cobalt-400 shrink-0 ml-1.5"></span>
    {{ $item['label'] }}
</a>
@endforeach
@endif

{{-- ── PPDB ────────────────────────────────────────────────── --}}
<p class="px-3 pt-4 pb-1 text-[0.65rem] font-bold text-cobalt-400 uppercase tracking-wider">PPDB</p>

@foreach([
    ['route' => 'admin.ppdb.info.index',         'label' => 'Info PPDB'],
    ['route' => 'admin.ppdb.registration.index', 'label' => 'Pendaftar'],
] as $item)
<a href="{{ route($item['route']) }}"
   class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-colors
          {{ request()->routeIs($item['route'] . '*') ? 'bg-cobalt-600 text-white' : 'text-cobalt-200 hover:bg-cobalt-600/60 hover:text-white' }}">
    <span class="w-1.5 h-1.5 rounded-full bg-cobalt-400 shrink-0 ml-1.5"></span>
    {{ $item['label'] }}
</a>
@endforeach

{{-- ── Konten ──────────────────────────────────────────────── --}}
<p class="px-3 pt-4 pb-1 text-[0.65rem] font-bold text-cobalt-400 uppercase tracking-wider">Konten</p>

@foreach([
    ['route' => 'admin.news.posts.index',      'label' => 'Berita'],
    ['route' => 'admin.news.categories.index', 'label' => 'Kategori Berita'],
    ['route' => 'admin.kontak.index',          'label' => 'Pesan Masuk'],
    ['route' => 'admin.galeri.index',          'label' => 'Galeri Alumni'],
    ['route' => 'admin.galeri-kegiatan.index', 'label' => 'Galeri Kegiatan'],
    ['route' => 'admin.sambutan.index',        'label' => 'Sambutan Kepsek'],
] as $item)
<a href="{{ route($item['route']) }}"
   class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-colors
          {{ request()->routeIs($item['route'] . '*') ? 'bg-cobalt-600 text-white' : 'text-cobalt-200 hover:bg-cobalt-600/60 hover:text-white' }}">
    <span class="w-1.5 h-1.5 rounded-full bg-cobalt-400 shrink-0 ml-1.5"></span>
    {{ $item['label'] }}
</a>
@endforeach
