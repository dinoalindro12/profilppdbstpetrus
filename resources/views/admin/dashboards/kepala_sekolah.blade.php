@extends('admin.layouts.app')
@section('title', 'Ringkasan Sekolah')

@section('content')
<div class="space-y-6 animate-entry">

    {{-- ── Greeting ─────────────────────────────────────────────── --}}
    <div class="sp-card p-6">
        <div class="flex items-start justify-between gap-4">
            <div>
                <h2 class="font-display text-xl font-bold text-cobalt-800">
                    Syalom, {{ Auth::user()->name }}
                </h2>
                <p class="text-cobalt-500 text-sm mt-1">
                    {{ now()->translatedFormat('l, d F Y') }} — ini ringkasan kondisi sekolah hari ini.
                </p>
            </div>
            <span class="role-badge role-badge-kepala shrink-0">Kepala Sekolah</span>
        </div>
    </div>

    {{-- ── Statistik utama ──────────────────────────────────────── --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        @foreach([
            [
                'label'  => 'Siswa Aktif',
                'value'  => $stats['total_siswa'] ?? '—',
                'sub'    => 'terdaftar tahun ini',
                'color'  => 'bg-cobalt-50 text-cobalt-600',
                'icon'   => '<path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>',
            ],
            [
                'label'  => 'Guru & Staf',
                'value'  => $stats['total_guru'] ?? '—',
                'sub'    => 'tenaga pengajar aktif',
                'color'  => 'bg-gold-50 text-gold-600',
                'icon'   => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>',
            ],
            [
                'label'  => 'Pendaftar PPDB',
                'value'  => $stats['total_ppdb'] ?? '—',
                'sub'    => 'menunggu proses seleksi',
                'color'  => 'bg-emerald-50 text-emerald-600',
                'icon'   => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>',
            ],
            [
                'label'  => 'Berita Terbit',
                'value'  => $stats['total_berita'] ?? '—',
                'sub'    => 'artikel dipublikasikan',
                'color'  => 'bg-slate-100 text-cobalt-500',
                'icon'   => '<path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>',
            ],
        ] as $s)
        <div class="stat-card">
            <div class="stat-icon {{ $s['color'] }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    {!! $s['icon'] !!}
                </svg>
            </div>
            <div class="min-w-0">
                <p class="text-2xl font-bold font-display text-cobalt-800">{{ $s['value'] }}</p>
                <p class="text-xs font-semibold text-cobalt-600">{{ $s['label'] }}</p>
                <p class="text-xs text-cobalt-400 mt-0.5">{{ $s['sub'] }}</p>
            </div>
        </div>
        @endforeach
    </div>

    <div class="grid lg:grid-cols-3 gap-6">

        {{-- ── Status PPDB per kategori ─────────────────────────── --}}
        <div class="sp-card p-5">
            <h3 class="sp-mark-sm font-display text-base font-bold text-cobalt-800 mb-4">
                Status Pendaftar PPDB
            </h3>
            @php
                $ppdbStats = $stats['ppdb_status'] ?? ['pending' => 0, 'approved' => 0, 'rejected' => 0];
                $total = array_sum($ppdbStats) ?: 1;
            @endphp
            <div class="space-y-3">
                @foreach([
                    ['key' => 'approved', 'label' => 'Diterima',  'color' => 'bg-emerald-500'],
                    ['key' => 'pending',  'label' => 'Menunggu',  'color' => 'bg-gold-500'],
                    ['key' => 'rejected', 'label' => 'Ditolak',   'color' => 'bg-ember'],
                ] as $item)
                @php $count = $ppdbStats[$item['key']] ?? 0; $pct = round($count/$total*100); @endphp
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span class="text-cobalt-600 font-medium">{{ $item['label'] }}</span>
                        <span class="text-cobalt-800 font-bold">{{ $count }}
                            <span class="text-cobalt-400 font-normal text-xs">({{ $pct }}%)</span>
                        </span>
                    </div>
                    <div class="h-2 bg-slate-100 rounded-full overflow-hidden">
                        <div class="{{ $item['color'] }} h-full rounded-full transition-all duration-500"
                             style="width: {{ $pct }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
            <a href="{{ route('admin.ppdb.registration.index') }}"
               class="mt-4 inline-flex items-center gap-1.5 text-xs font-semibold text-cobalt-600 hover:text-cobalt-800 transition-colors">
                Lihat semua pendaftar
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>

        {{-- ── Berita terbaru ───────────────────────────────────── --}}
        <div class="sp-card p-5 lg:col-span-2">
            <h3 class="sp-mark-sm font-display text-base font-bold text-cobalt-800 mb-4">
                Berita Terbaru
            </h3>
            @if(isset($recentPosts) && $recentPosts->count())
            <div class="divide-y divide-slate-100">
                @foreach($recentPosts as $post)
                <div class="py-3 flex items-start justify-between gap-3">
                    <div class="min-w-0">
                        <p class="text-sm font-medium text-cobalt-800 truncate">{{ $post->title }}</p>
                        <p class="text-xs text-cobalt-400 mt-0.5">{{ $post->created_at->diffForHumans() }}</p>
                    </div>
                    <span class="shrink-0 text-xs px-2 py-0.5 rounded-full
                                 {{ $post->status === 'published' ? 'bg-emerald-50 text-emerald-700' : 'bg-gold-50 text-gold-700' }}">
                        {{ $post->status === 'published' ? 'Terbit' : 'Draft' }}
                    </span>
                </div>
                @endforeach
            </div>
            @else
            <p class="text-sm text-cobalt-400 py-4 text-center">Belum ada berita yang dipublikasikan.</p>
            @endif
            <a href="{{ route('admin.news.posts.index') }}"
               class="mt-3 inline-flex items-center gap-1.5 text-xs font-semibold text-cobalt-600 hover:text-cobalt-800 transition-colors">
                Kelola berita
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>

    {{-- ── Pesan masuk terbaru ──────────────────────────────────── --}}
    @if(isset($recentMessages) && $recentMessages->count())
    <div class="sp-card p-5">
        <h3 class="sp-mark-sm font-display text-base font-bold text-cobalt-800 mb-4">
            Pesan Masuk Terbaru
        </h3>
        <div class="overflow-x-auto">
            <table class="sp-table">
                <thead>
                    <tr>
                        <th>Pengirim</th>
                        <th>Subjek</th>
                        <th>Diterima</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentMessages as $msg)
                    <tr>
                        <td class="font-medium">{{ $msg->name }}</td>
                        <td class="text-cobalt-500">{{ Str::limit($msg->subject ?? $msg->message, 50) }}</td>
                        <td class="text-cobalt-400 text-xs">{{ $msg->created_at->diffForHumans() }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <a href="{{ route('admin.kontak.index') }}"
           class="mt-3 inline-flex items-center gap-1.5 text-xs font-semibold text-cobalt-600 hover:text-cobalt-800 transition-colors">
            Lihat semua pesan
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>
    </div>
    @endif

</div>
@endsection
