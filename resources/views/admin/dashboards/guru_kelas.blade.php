@extends('admin.layouts.app')
@section('title', 'Dashboard Wali Kelas')

@section('content')
<div class="space-y-6 animate-entry">

    {{-- ── Greeting + info kelas --}}
    <div class="sp-card p-6">
        <div class="flex items-start justify-between gap-4 flex-wrap">
            <div>
                <h2 class="font-display text-xl font-bold text-cobalt-800">
                    Syalom, {{ Auth::user()->name }}
                </h2>
                <p class="text-cobalt-500 text-sm mt-1">
                    {{ now()->translatedFormat('l, d F Y') }}
                </p>
            </div>
            <div class="flex items-center gap-3">
                @if($homeroomClass)
                <div class="text-right">
                    <p class="text-xs text-cobalt-400 uppercase tracking-wider font-semibold">Wali kelas</p>
                    <p class="text-cobalt-800 font-bold text-base">{{ $homeroomClass->name }}</p>
                    <p class="text-xs text-cobalt-500">{{ $homeroomClass->academic_year }}</p>
                </div>
                @endif
                <span class="role-badge role-badge-gurukel shrink-0">Guru Kelas</span>
            </div>
        </div>
    </div>

    @if(!$homeroomClass)
    <div class="sp-alert-info">
        Anda belum ditetapkan sebagai wali kelas. Hubungi administrator untuk pengaturan kelas.
    </div>
    @else

    {{-- ── Ringkasan kelas ─────────────────────────────────────── --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        @foreach([
            ['label' => 'Jumlah Siswa',    'value' => $classStats['total'] ?? 0,   'color' => 'bg-cobalt-50 text-cobalt-600'],
            ['label' => 'Hadir Hari Ini',  'value' => $classStats['hadir'] ?? '—', 'color' => 'bg-emerald-50 text-emerald-600'],
            ['label' => 'Izin / Sakit',    'value' => $classStats['izin'] ?? '—',  'color' => 'bg-gold-50 text-gold-600'],
            ['label' => 'Alpa',            'value' => $classStats['alpa'] ?? '—',  'color' => 'bg-red-50 text-ember'],
        ] as $s)
        <div class="sp-card p-4 text-center">
            <p class="text-2xl font-bold font-display {{ explode(' ', $s['color'])[1] }}">{{ $s['value'] }}</p>
            <p class="text-xs text-cobalt-500 mt-1">{{ $s['label'] }}</p>
        </div>
        @endforeach
    </div>

    {{-- ── Roster siswa kelas ───────────────────────────────────── --}}
    <div class="sp-card p-5" id="roster">
        <div class="flex items-center justify-between mb-4">
            <h3 class="sp-mark-sm font-display text-base font-bold text-cobalt-800">
                Roster — {{ $homeroomClass->name }}
            </h3>
            <span class="text-xs text-cobalt-400">{{ $students->count() }} siswa</span>
        </div>

        @if($students->count())
        <div class="overflow-x-auto">
            <table class="sp-table">
                <thead>
                    <tr>
                        <th class="w-8">#</th>
                        <th>Nama Siswa</th>
                        <th>NIS</th>
                        <th>Kehadiran Hari Ini</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $i => $siswa)
                    <tr>
                        <td class="text-cobalt-400">{{ $i + 1 }}</td>
                        <td class="font-medium">{{ $siswa->name }}</td>
                        <td class="text-cobalt-400 font-mono text-xs">{{ $siswa->nis ?? '—' }}</td>
                        <td>
                            @php
                                $hadirStatus = $todayAttendance[$siswa->id] ?? null;
                            @endphp
                            @if($hadirStatus)
                            <span class="text-xs px-2 py-0.5 rounded-full font-semibold
                                {{ $hadirStatus === 'hadir' ? 'bg-emerald-50 text-emerald-700'
                                : ($hadirStatus === 'alpa' ? 'bg-red-50 text-ember'
                                : 'bg-gold-50 text-gold-700') }}">
                                {{ ucfirst($hadirStatus) }}
                            </span>
                            @else
                            <span class="text-xs text-cobalt-300">Belum diisi</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p class="text-sm text-cobalt-400 py-6 text-center">Belum ada siswa di kelas ini.</p>
        @endif
    </div>

    {{-- ── Tugas pending ────────────────────────────────────────── --}}
    @if(isset($pendingTasks) && count($pendingTasks))
    <div class="sp-card p-5" id="tugas">
        <h3 class="sp-mark-sm font-display text-base font-bold text-cobalt-800 mb-4">
            Perlu Diisi Hari Ini
        </h3>
        <div class="space-y-2">
            @foreach($pendingTasks as $task)
            <div class="flex items-center gap-3 p-3 rounded-lg border border-gold-200 bg-gold-50">
                <svg class="w-4 h-4 text-gold-600 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                <p class="text-sm text-cobalt-700">{{ $task }}</p>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    @endif {{-- end if homeroomClass --}}

</div>
@endsection
