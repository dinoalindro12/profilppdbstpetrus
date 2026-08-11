@extends('admin.layouts.app')
@section('title', 'Portal Siswa')

@section('content')
<div class="space-y-6 animate-entry">

    {{-- ── Greeting --}}
    <div class="sp-card p-6 flex items-start justify-between gap-4 flex-wrap">
        <div>
            <h2 class="font-display text-xl font-bold text-cobalt-800">
                Halo, {{ Auth::user()->name }}
            </h2>
            <p class="text-cobalt-500 text-sm mt-1">
                {{ now()->translatedFormat('l, d F Y') }}
                @if($myClass)
                    — {{ $myClass->name }}, Tahun Ajaran {{ $myClass->academic_year }}
                @endif
            </p>
        </div>
        <div class="flex items-center gap-3">
            @if(Auth::user()->nis)
            <div class="text-right">
                <p class="text-xs text-cobalt-400 uppercase tracking-wider">NIS</p>
                <p class="font-mono text-sm font-bold text-cobalt-700">{{ Auth::user()->nis }}</p>
            </div>
            @endif
            <span class="role-badge role-badge-siswa shrink-0">Siswa</span>
        </div>
    </div>

    {{-- ── Jadwal hari ini ──────────────────────────────────────── --}}
    <div class="sp-card p-5" id="jadwal">
        <h3 class="sp-mark-sm font-display text-base font-bold text-cobalt-800 mb-1">
            Jadwal Hari Ini
        </h3>
        <p class="text-xs text-cobalt-400 mb-5">{{ now()->translatedFormat('l, d F Y') }}</p>

        @if(isset($todaySchedules) && $todaySchedules->count())
        <div class="space-y-2">
            @foreach($todaySchedules as $schedule)
            @php
                $now       = now();
                $start     = \Carbon\Carbon::today()->setTimeFromTimeString($schedule->start_time instanceof \Carbon\Carbon ? $schedule->start_time->format('H:i') : $schedule->start_time);
                $end       = \Carbon\Carbon::today()->setTimeFromTimeString($schedule->end_time instanceof \Carbon\Carbon ? $schedule->end_time->format('H:i') : $schedule->end_time);
                $isCurrent = $now->between($start, $end);
                $isPast    = $now->gt($end);
            @endphp
            <div class="schedule-slot rounded-lg border
                        {{ $isCurrent ? 'border-gold-400 bg-gold-50'
                         : ($isPast   ? 'border-slate-200 opacity-60'
                                      : 'border-slate-200') }}">
                <div class="time-col shrink-0 w-16 text-right">
                    <p class="text-sm font-bold font-mono text-cobalt-700">
                        {{ $schedule->start_time instanceof \Carbon\Carbon ? $schedule->start_time->format('H:i') : substr($schedule->start_time, 0, 5) }}
                    </p>
                    <p class="text-xs text-cobalt-400">
                        {{ $schedule->end_time instanceof \Carbon\Carbon ? $schedule->end_time->format('H:i') : substr($schedule->end_time, 0, 5) }}
                    </p>
                </div>
                <div class="separator"></div>
                <div class="flex-1">
                    <p class="text-sm font-bold text-cobalt-800">
                        {{ $schedule->teacherSubject->subject->name ?? 'Mata Pelajaran' }}
                    </p>
                    <p class="text-xs text-cobalt-500">
                        {{ $schedule->teacherSubject->teacher->name ?? '' }}
                        @if($schedule->room)
                         — Ruang {{ $schedule->room }}
                        @endif
                    </p>
                </div>
                @if($isCurrent)
                <span class="text-xs font-bold text-gold-600 animate-pulse shrink-0">● Sekarang</span>
                @endif
            </div>
            @endforeach
        </div>
        @else
        <div class="py-10 text-center">
            <p class="text-cobalt-400 text-sm">Tidak ada pelajaran hari ini.</p>
        </div>
        @endif
    </div>

    <div class="grid lg:grid-cols-2 gap-6">

        {{-- ── Nilai terbaru ──────────────────────────────────── --}}
        <div class="sp-card p-5" id="nilai">
            <h3 class="sp-mark-sm font-display text-base font-bold text-cobalt-800 mb-4">
                Nilai Terbaru
            </h3>
            @if(isset($recentGrades) && $recentGrades->count())
            <table class="sp-table">
                <thead>
                    <tr><th>Mata Pelajaran</th><th>Jenis</th><th>Nilai</th></tr>
                </thead>
                <tbody>
                    @foreach($recentGrades as $grade)
                    <tr>
                        <td class="font-medium">{{ $grade->teacherSubject->subject->name ?? '—' }}</td>
                        <td class="text-xs text-cobalt-500">{{ ucfirst(str_replace('_', ' ', $grade->grade_type)) }}</td>
                        <td>
                            <span class="font-bold {{ $grade->score >= 75 ? 'text-emerald-600' : 'text-ember' }}">
                                {{ number_format($grade->score, 0) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p class="text-sm text-cobalt-400 py-4 text-center">Belum ada nilai yang diinput.</p>
            @endif
        </div>

        {{-- ── Pengumuman terbaru ────────────────────────────── --}}
        <div class="sp-card p-5">
            <h3 class="sp-mark-sm font-display text-base font-bold text-cobalt-800 mb-4">
                Pengumuman Terbaru
            </h3>
            @if(isset($announcements) && $announcements->count())
            <div class="divide-y divide-slate-100">
                @foreach($announcements as $post)
                <a href="{{ route('news.detail', $post->slug) }}"
                   class="block py-3 hover:bg-cobalt-50/50 -mx-2 px-2 rounded transition-colors">
                    <p class="text-sm font-medium text-cobalt-800">{{ $post->title }}</p>
                    <p class="text-xs text-cobalt-400 mt-0.5">{{ $post->created_at->diffForHumans() }}</p>
                </a>
                @endforeach
            </div>
            @else
            <p class="text-sm text-cobalt-400 py-4 text-center">Tidak ada pengumuman terbaru.</p>
            @endif
            <a href="{{ route('news.index') }}"
               class="mt-3 inline-flex items-center gap-1.5 text-xs font-semibold text-cobalt-600 hover:text-cobalt-800 transition-colors">
                Lihat semua berita
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>

</div>
@endsection
