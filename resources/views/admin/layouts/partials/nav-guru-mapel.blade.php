{{-- Navigasi Guru Mata Pelajaran: jadwal hari ini + input nilai per kelas --}}

<a href="{{ route('dashboard.guru_mapel') }}"
   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
          {{ request()->routeIs('dashboard.guru_mapel') ? 'bg-cobalt-600 text-white' : 'text-cobalt-200 hover:bg-cobalt-600/60 hover:text-white' }}">
    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
    </svg>
    Jadwal Hari Ini
</a>

<p class="px-3 pt-4 pb-1 text-[0.65rem] font-bold text-cobalt-400 uppercase tracking-wider">Mengajar</p>

<a href="{{ route('dashboard.guru_mapel') }}#jadwal-minggu"
   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors text-cobalt-200 hover:bg-cobalt-600/60 hover:text-white">
    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
    </svg>
    Jadwal Minggu Ini
</a>

<a href="{{ route('dashboard.guru_mapel') }}#input-nilai"
   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors text-cobalt-200 hover:bg-cobalt-600/60 hover:text-white">
    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
    </svg>
    Input Nilai
</a>

<a href="{{ route('dashboard.guru_mapel') }}#kehadiran"
   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors text-cobalt-200 hover:bg-cobalt-600/60 hover:text-white">
    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>
    Input Kehadiran
</a>

<p class="px-3 pt-4 pb-1 text-[0.65rem] font-bold text-cobalt-400 uppercase tracking-wider">Informasi</p>

<a href="{{ route('news.index') }}"
   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors text-cobalt-200 hover:bg-cobalt-600/60 hover:text-white">
    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
    </svg>
    Berita Sekolah
</a>
