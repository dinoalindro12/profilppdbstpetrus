@extends('frontend.layouts.app')

@section('title', 'Kalender Akademik — SMA RK Deli Murni Delitua')
@section('description', 'Kalender akademik dan jadwal kegiatan SMA Swasta RK Deli Murni Delitua, Kab. Deli Serdang, Sumatera Utara.')

@section('content')

{{-- Hero --}}
<section class="bg-cobalt-700 pt-14 pb-10">
    <div class="h-1 bg-gradient-to-r from-gold-600 via-gold-400 to-gold-600 -mt-14 mb-14"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs text-cobalt-300 mb-4">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a>
            <span>/</span>
            <a href="{{ route('academic.curriculum') }}" class="hover:text-white transition-colors">Akademik</a>
            <span>/</span>
            <span class="text-white">Kalender Akademik</span>
        </nav>
        <p class="text-gold-400 text-sm font-semibold tracking-widest uppercase mb-2">Jadwal Kegiatan</p>
        <h1 class="font-display text-display-lg text-white">Kalender Akademik</h1>
        <p class="text-cobalt-200 mt-3 text-base max-w-lg">
            Jadwal dan agenda kegiatan akademik SMA RK Deli Murni Delitua.
        </p>
    </div>
</section>

<section class="py-14 bg-parchment">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        {{-- Kalender yang sedang berjalan --}}
        @if($currentCalendar)
        <div class="sp-card p-5 border-l-4 border-gold-500 rounded-l-none">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <p class="text-xs font-bold text-gold-600 uppercase tracking-wider mb-1 flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-gold-500 animate-pulse"></span>
                        Kalender Aktif Saat Ini
                    </p>
                    <h3 class="font-display text-lg font-bold text-cobalt-800">{{ $currentCalendar->title }}</h3>
                    <p class="text-sm text-cobalt-500 mt-0.5">
                        {{ $currentCalendar->start_date->translatedFormat('d M Y') }}
                        – {{ $currentCalendar->end_date->translatedFormat('d M Y') }}
                    </p>
                </div>
                <div class="flex gap-2 shrink-0">
                    <a href="{{ route('academic-calendars.show', $currentCalendar) }}" class="btn-secondary text-sm">
                        Lihat Detail
                    </a>
                    @if($currentCalendar->file_path)
                    <a href="{{ route('academic-calendars.download', $currentCalendar) }}" class="btn-primary text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        Unduh
                    </a>
                    @endif
                </div>
            </div>
        </div>
        @endif

        {{-- Filter tahun ajaran --}}
        @if($academicYears->count() > 1)
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('academic-calendars.index') }}"
               class="px-4 py-2 rounded-full text-sm font-semibold transition-colors
                      {{ !request('year') ? 'bg-cobalt-700 text-white' : 'bg-white border border-slate-300 text-cobalt-600 hover:border-cobalt-400' }}">
                Semua Tahun
            </a>
            @foreach($academicYears as $year)
            <a href="{{ route('academic-calendars.filter', ['year' => $year]) }}"
               class="px-4 py-2 rounded-full text-sm font-semibold transition-colors
                      {{ request('year') == $year ? 'bg-cobalt-700 text-white' : 'bg-white border border-slate-300 text-cobalt-600 hover:border-cobalt-400' }}">
                {{ $year }}
            </a>
            @endforeach
        </div>
        @endif

        {{-- Daftar kalender --}}
        @forelse($academicCalendars as $calendar)
        <div class="sp-card p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-start gap-4">
                {{-- Ikon --}}
                <div class="w-12 h-12 rounded-xl bg-cobalt-100 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-cobalt-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div class="min-w-0">
                    <div class="flex flex-wrap items-center gap-2 mb-1">
                        <h3 class="font-display text-base font-bold text-cobalt-800">{{ $calendar->title }}</h3>
                        @if($calendar->isCurrent())
                        <span class="text-xs bg-emerald-50 text-emerald-700 font-bold px-2 py-0.5 rounded-full">
                            Aktif
                        </span>
                        @endif
                    </div>
                    <div class="flex flex-wrap gap-x-4 gap-y-1 text-xs text-cobalt-500">
                        <span>Tahun Ajaran: <strong class="text-cobalt-700">{{ $calendar->academic_year }}</strong></span>
                        @if($calendar->semester)
                        <span>{{ $calendar->semester }}</span>
                        @endif
                        @if($calendar->start_date && $calendar->end_date)
                        <span>{{ $calendar->start_date->translatedFormat('d M Y') }} – {{ $calendar->end_date->translatedFormat('d M Y') }}</span>
                        @endif
                        @if($calendar->formatted_file_size)
                        <span>{{ $calendar->formatted_file_size }}</span>
                        @endif
                    </div>
                    @if($calendar->description)
                    <p class="text-xs text-cobalt-400 mt-1.5 line-clamp-1">{{ $calendar->description }}</p>
                    @endif
                </div>
            </div>
            <div class="flex gap-2 shrink-0 ml-16 sm:ml-0">
                <a href="{{ route('academic-calendars.show', $calendar) }}"
                   class="btn-secondary text-xs py-2 px-3">
                    Detail
                </a>
                @if($calendar->file_path)
                <a href="{{ route('academic-calendars.download', $calendar) }}"
                   class="btn-primary text-xs py-2 px-3">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    Unduh
                </a>
                @endif
            </div>
        </div>
        @empty
        <div class="sp-card py-16 text-center">
            <svg class="w-14 h-14 text-cobalt-200 mx-auto mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <p class="text-cobalt-500 font-medium">Kalender akademik belum tersedia.</p>
        </div>
        @endforelse

        {{-- Pagination --}}
        @if($academicCalendars->hasPages())
        <div class="mt-4">{{ $academicCalendars->links() }}</div>
        @endif

    </div>
</section>

@endsection
