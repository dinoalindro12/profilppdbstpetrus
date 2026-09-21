@extends('frontend.layouts.app')

@section('title', ($academicCalendar->title ?? $currentCalendar->title ?? 'Kalender Akademik') . ' — SMA RK Deli Murni')
@section('description', 'Kalender akademik ' . ($academicCalendar->academic_year ?? $currentCalendar->academic_year ?? '') . ' SMA Swasta RK Deli Murni Delitua.')

@section('content')

@php $cal = $academicCalendar ?? $currentCalendar; @endphp

{{-- Hero --}}
<section class="bg-cobalt-700 pt-14 pb-10">
    <div class="h-1 bg-gradient-to-r from-gold-600 via-gold-400 to-gold-600 -mt-14 mb-14"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs text-cobalt-300 mb-4">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a>
            <span>/</span>
            <a href="{{ route('academic-calendars.index') }}" class="hover:text-white transition-colors">Kalender Akademik</a>
            <span>/</span>
            <span class="text-white">{{ $cal->title }}</span>
        </nav>
        <p class="text-gold-400 text-sm font-semibold tracking-widest uppercase mb-2">Kalender Akademik</p>
        <h1 class="font-display text-display-lg text-white">{{ $cal->title }}</h1>
        <div class="flex flex-wrap items-center gap-3 mt-3">
            <span class="bg-gold-500 text-cobalt-900 text-xs font-bold px-3 py-1 rounded-full">
                {{ $cal->academic_year }}
            </span>
            @if($cal->semester)
            <span class="bg-cobalt-600 text-white text-xs font-medium px-3 py-1 rounded-full">
                {{ $cal->semester }}
            </span>
            @endif
            @if($cal->isCurrent())
            <span class="bg-emerald-500 text-white text-xs font-bold px-3 py-1 rounded-full flex items-center gap-1">
                <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
                Sedang Berjalan
            </span>
            @endif
        </div>
    </div>
</section>

{{-- Konten --}}
<section class="py-14 bg-parchment">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        {{-- Info kartu --}}
        <div class="sp-card p-6">
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <div>
                    <p class="text-xs font-semibold text-cobalt-400 uppercase tracking-wider mb-1">Tahun Ajaran</p>
                    <p class="font-display text-base font-bold text-cobalt-800">{{ $cal->academic_year }}</p>
                </div>
                @if($cal->semester)
                <div>
                    <p class="text-xs font-semibold text-cobalt-400 uppercase tracking-wider mb-1">Semester</p>
                    <p class="font-display text-base font-bold text-cobalt-800">{{ $cal->semester }}</p>
                </div>
                @endif
                @if($cal->start_date)
                <div>
                    <p class="text-xs font-semibold text-cobalt-400 uppercase tracking-wider mb-1">Mulai</p>
                    <p class="font-medium text-cobalt-700">{{ $cal->start_date->translatedFormat('d F Y') }}</p>
                </div>
                @endif
                @if($cal->end_date)
                <div>
                    <p class="text-xs font-semibold text-cobalt-400 uppercase tracking-wider mb-1">Selesai</p>
                    <p class="font-medium text-cobalt-700">{{ $cal->end_date->translatedFormat('d F Y') }}</p>
                </div>
                @endif
            </div>

            @if($cal->description)
            <div class="mt-5 pt-5 border-t border-slate-100">
                <p class="text-sm text-cobalt-600 leading-relaxed">{{ $cal->description }}</p>
            </div>
            @endif
        </div>

        {{-- File download --}}
        @if($cal->file_path)
        <div class="sp-card p-6">
            <h3 class="sp-mark-sm font-display text-base font-bold text-cobalt-800 mb-4">
                File Kalender Akademik
            </h3>
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4
                        bg-cobalt-50 rounded-xl p-4 border border-cobalt-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-cobalt-600 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-cobalt-800">
                            {{ $cal->original_file_name ?? $cal->title }}
                        </p>
                        @if($cal->formatted_file_size)
                        <p class="text-xs text-cobalt-400 mt-0.5">{{ $cal->formatted_file_size }}</p>
                        @endif
                    </div>
                </div>
                <div class="flex gap-2 shrink-0">
                    <a href="{{ route('academic-calendars.preview', $cal) }}" target="_blank"
                       class="btn-secondary text-sm py-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        Pratinjau
                    </a>
                    <a href="{{ route('academic-calendars.download', $cal) }}"
                       class="btn-primary text-sm py-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        Unduh
                    </a>
                </div>
            </div>
        </div>
        @endif

        {{-- Kembali --}}
        <div>
            <a href="{{ route('academic-calendars.index') }}" class="btn-secondary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Semua Kalender Akademik
            </a>
        </div>
    </div>
</section>

@endsection
