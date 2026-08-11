@extends('admin.layouts.app')
@section('title', 'Jadwal Mengajar Hari Ini')

@section('content')
<div class="space-y-6 animate-entry">

    {{-- ── Greeting --}}
    <div class="sp-card p-6 flex items-start justify-between gap-4 flex-wrap">
        <div>
            <h2 class="font-display text-xl font-bold text-cobalt-800">
                Syalom, {{ Auth::user()->name }}
            </h2>
            <p class="text-cobalt-500 text-sm mt-1">
                {{ now()->translatedFormat('l, d F Y') }}
                @if($todaySchedules->isEmpty())
                    — tidak ada jam mengajar hari ini.
                @else
                    — {{ $todaySchedules->count() }} sesi mengajar hari ini.
                @endif
            </p>
        </div>
        <span class="role-badge role-badge-gurumap shrink-0">Guru Mata Pelajaran</span>
    </div>

    {{-- ── Jadwal HARI INI (core fitur, query per user login) ─────── --}}
    <div class="sp-card p-5">
        <h3 class="sp-mark-sm font-display text-base font-bold text-cobalt-800 mb-1">
            Jadwal Hari Ini
        </h3>
        <p class="text-xs text-cobalt-400 mb-5">
            {{ now()->translatedFormat('l') }} — hanya kelas yang Anda ampu
        </p>

        @if($todaySchedules->isEmpty())
        <div class="py-12 text-center">
            <svg class="w-12 h-12 text-cobalt-200 mx-auto mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <p class="text-cobalt-400 text-sm">Tidak ada sesi mengajar hari ini.</p>
            <p class="text-cobalt-300 text-xs mt-1">Jadwal mengajar Anda akan muncul di sini setiap harinya.</p>
        </div>
        @else
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
                         : ($isPast   ? 'border-slate-200 bg-slate-50/50 opacity-70'
                                      : 'border-slate-200 bg-white') }}">
                {{-- Waktu --}}
                <div class="time-col shrink-0 w-20 text-right">
                    <p class="text-sm font-bold font-mono text-cobalt-700">
                        {{ $schedule->start_time instanceof \Carbon\Carbon ? $schedule->start_time->format('H:i') : substr($schedule->start_time, 0, 5) }}
                    </p>
                    <p class="text-xs text-cobalt-400">
                        {{ $schedule->end_time instanceof \Carbon\Carbon ? $schedule->end_time->format('H:i') : substr($schedule->end_time, 0, 5) }}
                    </p>
                </div>

                {{-- Separator emas --}}
                <div class="separator w-px {{ $isCurrent ? 'bg-gold-400' : 'bg-cobalt-200' }}"></div>

                {{-- Info kelas --}}
                <div class="flex-1 min-w-0">
                    <div class="flex items-start justify-between gap-2 flex-wrap">
                        <div>
                            <p class="text-sm font-bold text-cobalt-800">
                                {{ $schedule->teacherSubject->schoolClass->name ?? 'Kelas?' }}
                            </p>
                            <p class="text-xs font-semibold text-cobalt-500 mt-0.5">
                                {{ $schedule->teacherSubject->subject->name ?? 'Mapel?' }}
                            </p>
                        </div>
                        <div class="text-right">
                            @if($schedule->room)
                            <span class="inline-flex items-center gap-1 text-xs text-cobalt-500 bg-slate-100 px-2 py-0.5 rounded">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                                {{ $schedule->room }}
                            </span>
                            @endif
                            @if($isCurrent)
                            <span class="block mt-1 text-xs font-bold text-gold-600 animate-pulse">● Sedang berlangsung</span>
                            @elseif($isPast)
                            <span class="block mt-1 text-xs text-cobalt-400">Selesai</span>
                            @else
                            @php $menit = $now->diffInMinutes($start, false); @endphp
                            <span class="block mt-1 text-xs text-cobalt-400">
                                {{ $menit > 0 ? "dalam {$menit} menit" : 'Segera' }}
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    {{-- ── Jadwal minggu ini ────────────────────────────────────── --}}
    <div class="sp-card p-5" id="jadwal-minggu">
        <h3 class="sp-mark-sm font-display text-base font-bold text-cobalt-800 mb-4">
            Jadwal Minggu Ini
        </h3>
        @if(isset($weekSchedules) && $weekSchedules->count())
        <div class="space-y-1">
            @php $currentDay = null; @endphp
            @foreach($weekSchedules as $sch)
            @if($currentDay !== $sch->day_of_week)
                @php $currentDay = $sch->day_of_week; @endphp
                <p class="text-xs font-bold text-cobalt-500 uppercase tracking-wider pt-3 pb-1 first:pt-0">
                    {{ \App\Models\Schedule::$days[$sch->day_of_week] ?? '' }}
                </p>
            @endif
            <div class="flex items-center gap-3 py-2 px-3 rounded-lg hover:bg-cobalt-50/50 transition-colors text-sm">
                <span class="font-mono text-xs text-cobalt-500 w-12 shrink-0">
                    {{ $sch->start_time instanceof \Carbon\Carbon ? $sch->start_time->format('H:i') : substr($sch->start_time, 0, 5) }}
                </span>
                <span class="font-medium text-cobalt-800">{{ $sch->teacherSubject->schoolClass->name ?? '—' }}</span>
                <span class="text-cobalt-500">–</span>
                <span class="text-cobalt-600">{{ $sch->teacherSubject->subject->name ?? '—' }}</span>
                @if($sch->room)
                <span class="ml-auto text-xs text-cobalt-400">{{ $sch->room }}</span>
                @endif
            </div>
            @endforeach
        </div>
        @else
        <p class="text-sm text-cobalt-400 py-4 text-center">Belum ada jadwal yang ditetapkan.</p>
        @endif
    </div>

</div>
@endsection
