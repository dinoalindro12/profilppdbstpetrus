@extends('admin.layouts.app')
@section('title', 'Sambutan Kepala Sekolah')

@section('content')
<div class="space-y-5">

    <div class="flex items-center justify-between gap-4 flex-wrap">
        <div>
            <h2 class="sp-mark font-display text-xl font-bold text-cobalt-800">Sambutan Kepala Sekolah</h2>
            <p class="text-cobalt-500 text-sm mt-1">
                Sambutan terbaru (paling atas) yang ditampilkan di halaman beranda.
            </p>
        </div>
        <a href="{{ route('admin.sambutan.create') }}" class="btn-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Tulis Sambutan Baru
        </a>
    </div>

    {{-- Info: sambutan mana yang aktif --}}
    @if($sambutans->count())
    <div class="sp-alert-info flex items-start gap-2">
        <svg class="w-4 h-4 mt-0.5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        Sambutan yang ditampilkan di beranda adalah yang <strong class="mx-1">paling baru ditambahkan</strong>
        — yaitu baris pertama di tabel ini.
    </div>
    @endif

    <div class="sp-card overflow-hidden">
        @if($sambutans->count())
        <div class="overflow-x-auto">
            <table class="sp-table">
                <thead>
                    <tr>
                        <th class="w-10">#</th>
                        <th>Judul Sambutan</th>
                        <th>Nama Kepala Sekolah</th>
                        <th>Ditambahkan</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sambutans as $i => $s)
                    <tr>
                        <td class="text-cobalt-400">{{ $i + 1 }}</td>
                        <td>
                            <div class="flex items-center gap-3">
                                @if($s->image)
                                <img src="{{ asset('storage/'.$s->image) }}" alt="{{ $s->nama_kepsek }}"
                                     class="w-10 h-10 rounded-full object-cover border-2 border-slate-200 shrink-0">
                                @else
                                <div class="w-10 h-10 rounded-full bg-cobalt-100 flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5 text-cobalt-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                @endif
                                <div class="min-w-0">
                                    <p class="font-medium text-cobalt-800 truncate">{{ $s->title }}</p>
                                    <p class="text-xs text-cobalt-400 truncate">{{ Str::limit(strip_tags($s->content), 60) }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="text-cobalt-600 text-sm">{{ $s->nama_kepsek }}</td>
                        <td class="text-xs text-cobalt-400 whitespace-nowrap">
                            {{ $s->created_at->translatedFormat('d M Y') }}
                            @if($i === 0)
                            <span class="ml-1.5 inline-flex items-center gap-1 text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full text-xs font-semibold">
                                ● Aktif di beranda
                            </span>
                            @endif
                        </td>
                        <td>
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.sambutan.edit', $s->slug) }}"
                                   class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-semibold
                                          bg-cobalt-50 text-cobalt-700 hover:bg-cobalt-100 transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('admin.sambutan.destroy', $s->slug) }}"
                                      onsubmit="return confirm('Hapus sambutan ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-semibold
                                                   bg-red-50 text-ember hover:bg-red-100 transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if($sambutans->hasPages())
        <div class="px-5 py-3 border-t border-slate-100">{{ $sambutans->links() }}</div>
        @endif
        @else
        <div class="py-16 text-center">
            <svg class="w-12 h-12 text-cobalt-200 mx-auto mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
            </svg>
            <p class="text-cobalt-500 font-medium">Belum ada sambutan yang ditulis.</p>
            <a href="{{ route('admin.sambutan.create') }}" class="btn-primary mt-4 inline-flex">
                Tulis sambutan pertama
            </a>
        </div>
        @endif
    </div>

</div>
@endsection
