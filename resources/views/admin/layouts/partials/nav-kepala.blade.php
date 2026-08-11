{{-- Navigasi Kepala Sekolah: read-mostly, overview sekolah --}}

@php
    function navItem(string $route, string $label, string $icon): string {
        $active = request()->routeIs($route) ? 'bg-cobalt-600 text-white' : 'text-cobalt-200 hover:bg-cobalt-600/60 hover:text-white';
        return "<a href=\"" . route($route) . "\" class=\"flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {$active}\">
                    <span class=\"w-4 h-4 shrink-0\">{$icon}</span>
                    {$label}
                </a>";
    }
@endphp

{{-- Dashboard --}}
<a href="{{ route('dashboard.kepala_sekolah') }}"
   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
          {{ request()->routeIs('dashboard.kepala_sekolah') ? 'bg-cobalt-600 text-white' : 'text-cobalt-200 hover:bg-cobalt-600/60 hover:text-white' }}">
    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
    </svg>
    Ringkasan Sekolah
</a>

{{-- Divider label --}}
<p class="px-3 pt-4 pb-1 text-[0.65rem] font-bold text-cobalt-400 uppercase tracking-wider">Data Sekolah</p>

<a href="{{ route('admin.ppdb.registration.index') }}"
   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
          {{ request()->routeIs('admin.ppdb.registration.*') ? 'bg-cobalt-600 text-white' : 'text-cobalt-200 hover:bg-cobalt-600/60 hover:text-white' }}">
    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
    </svg>
    Data Pendaftar PPDB
</a>

<a href="{{ route('admin.news.posts.index') }}"
   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
          {{ request()->routeIs('admin.news.*') ? 'bg-cobalt-600 text-white' : 'text-cobalt-200 hover:bg-cobalt-600/60 hover:text-white' }}">
    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
    </svg>
    Berita & Pengumuman
</a>

<a href="{{ route('admin.kontak.index') }}"
   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
          {{ request()->routeIs('admin.kontak.*') ? 'bg-cobalt-600 text-white' : 'text-cobalt-200 hover:bg-cobalt-600/60 hover:text-white' }}">
    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
    </svg>
    Pesan Masuk
</a>
