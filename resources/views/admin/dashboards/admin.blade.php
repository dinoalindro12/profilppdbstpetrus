@extends('admin.layouts.app')
@section('title', 'Dashboard Admin')

@section('content')
<div class="space-y-6 animate-entry">

    {{-- ── Greeting --}}
    <div class="sp-card p-6 flex items-start justify-between gap-4">
        <div>
            <h2 class="font-display text-xl font-bold text-cobalt-800">
                Selamat datang, {{ Auth::user()->name }}
            </h2>
            <p class="text-cobalt-500 text-sm mt-1">
                {{ now()->translatedFormat('l, d F Y') }} — semua data sekolah bisa kamu kelola dari sini.
            </p>
        </div>
        <span class="role-badge role-badge-admin shrink-0">Admin</span>
    </div>

    {{-- ── Statistik --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        @foreach([
            ['label' => 'Siswa',        'value' => $stats['total_siswa'] ?? '—',  'color' => 'bg-cobalt-50 text-cobalt-600'],
            ['label' => 'Guru & Staf',  'value' => $stats['total_guru'] ?? '—',   'color' => 'bg-gold-50 text-gold-600'],
            ['label' => 'Pendaftar PPDB','value'=> $stats['total_ppdb'] ?? '—',   'color' => 'bg-emerald-50 text-emerald-600'],
            ['label' => 'Pesan Masuk',  'value' => $stats['pesan_baru'] ?? '—',   'color' => 'bg-red-50 text-ember'],
        ] as $s)
        <div class="sp-card p-4 flex items-center gap-3">
            <div class="w-10 h-10 rounded-lg {{ $s['color'] }} flex items-center justify-center font-bold text-lg shrink-0">
                {{ $s['value'] }}
            </div>
            <p class="text-sm font-medium text-cobalt-600">{{ $s['label'] }}</p>
        </div>
        @endforeach
    </div>

    {{-- ── Notifikasi sistem --}}
    @if(isset($notifications) && count($notifications))
    <div class="sp-card p-5">
        <h3 class="sp-mark-sm font-display text-base font-bold text-cobalt-800 mb-3">Notifikasi Sistem</h3>
        <div class="space-y-2">
            @foreach($notifications as $notif)
            <div class="flex items-start gap-3 p-3 rounded-lg bg-cobalt-50 text-sm">
                <svg class="w-4 h-4 mt-0.5 text-cobalt-500 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="text-cobalt-700">{{ $notif }}</span>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- ── Shortcut CRUD ─────────────────────────────────────────── --}}
    <div class="sp-card p-5">
        <h3 class="sp-mark-sm font-display text-base font-bold text-cobalt-800 mb-4">Akses Cepat</h3>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
            @foreach([
                ['route' => 'admin.news.posts.create',          'label' => 'Tulis Berita Baru',   'color' => 'hover:border-cobalt-300 hover:bg-cobalt-50'],
                ['route' => 'admin.ppdb.registration.index',    'label' => 'Kelola Pendaftar',     'color' => 'hover:border-gold-300 hover:bg-gold-50'],
                ['route' => 'admin.profile.staff.create',       'label' => 'Tambah Guru/Staf',     'color' => 'hover:border-cobalt-300 hover:bg-cobalt-50'],
                ['route' => 'admin.academic.achievement.create','label' => 'Catat Prestasi',       'color' => 'hover:border-emerald-300 hover:bg-emerald-50'],
                ['route' => 'admin.profile.facilities.create',  'label' => 'Tambah Fasilitas',     'color' => 'hover:border-cobalt-300 hover:bg-cobalt-50'],
                ['route' => 'admin.academic.extracurricular.create','label'=> 'Tambah Ekskul',     'color' => 'hover:border-gold-300 hover:bg-gold-50'],
                ['route' => 'admin.ppdb.info.create',           'label' => 'Buat Info PPDB',       'color' => 'hover:border-cobalt-300 hover:bg-cobalt-50'],
                ['route' => 'admin.kontak.index',               'label' => 'Lihat Pesan Masuk',    'color' => 'hover:border-red-200 hover:bg-red-50'],
            ] as $sc)
            <a href="{{ route($sc['route']) }}"
               class="flex items-center justify-center text-center px-3 py-3.5 rounded-lg border border-slate-200
                      text-sm font-medium text-cobalt-700 transition-all duration-150 {{ $sc['color'] }}">
                {{ $sc['label'] }}
            </a>
            @endforeach
        </div>
    </div>

    <div class="grid lg:grid-cols-2 gap-6">

        {{-- ── Pendaftar PPDB terbaru --}}
        <div class="sp-card p-5">
            <h3 class="sp-mark-sm font-display text-base font-bold text-cobalt-800 mb-4">
                Pendaftar PPDB Terbaru
            </h3>
            @if(isset($recentRegistrations) && $recentRegistrations->count())
            <div class="overflow-x-auto">
                <table class="sp-table">
                    <thead><tr><th>Nama</th><th>Status</th><th>Mendaftar</th></tr></thead>
                    <tbody>
                        @foreach($recentRegistrations as $reg)
                        <tr>
                            <td class="font-medium">{{ $reg->full_name }}</td>
                            <td>
                                <span class="text-xs px-2 py-0.5 rounded-full font-semibold
                                    {{ $reg->status === 'approved' ? 'bg-emerald-50 text-emerald-700'
                                    : ($reg->status === 'rejected' ? 'bg-red-50 text-ember'
                                    : 'bg-gold-50 text-gold-700') }}">
                                    {{ ucfirst($reg->status) }}
                                </span>
                            </td>
                            <td class="text-xs text-cobalt-400">{{ $reg->created_at->diffForHumans() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <p class="text-sm text-cobalt-400 py-4 text-center">Belum ada pendaftar.</p>
            @endif
        </div>

        {{-- ── Pesan masuk terbaru --}}
        <div class="sp-card p-5">
            <h3 class="sp-mark-sm font-display text-base font-bold text-cobalt-800 mb-4">
                Pesan Masuk Terbaru
            </h3>
            @if(isset($recentMessages) && $recentMessages->count())
            <div class="divide-y divide-slate-100">
                @foreach($recentMessages as $msg)
                <a href="{{ route('admin.kontak.show', $msg->id) }}"
                   class="py-3 flex items-start justify-between gap-3 hover:bg-cobalt-50/50 -mx-2 px-2 rounded transition-colors block">
                    <div class="min-w-0">
                        <p class="text-sm font-medium text-cobalt-800">{{ $msg->name }}</p>
                        <p class="text-xs text-cobalt-400 truncate">{{ Str::limit($msg->message ?? '', 60) }}</p>
                    </div>
                    <span class="text-xs text-cobalt-400 shrink-0">{{ $msg->created_at->diffForHumans() }}</span>
                </a>
                @endforeach
            </div>
            @else
            <p class="text-sm text-cobalt-400 py-4 text-center">Tidak ada pesan baru.</p>
            @endif
        </div>
    </div>

</div>
@endsection
