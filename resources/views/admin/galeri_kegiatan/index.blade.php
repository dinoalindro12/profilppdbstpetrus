@extends('admin.layouts.app')
@section('title', 'Galeri Kegiatan')

@section('content')
<div class="space-y-5">

    <div class="flex items-center justify-between gap-4 flex-wrap">
        <div>
            <h2 class="sp-mark font-display text-xl font-bold text-cobalt-800">Galeri Kegiatan</h2>
            <p class="text-cobalt-500 text-sm mt-1">Foto dokumentasi kegiatan harian sekolah.</p>
        </div>
        <a href="{{ route('admin.galeri-kegiatan.create') }}" class="btn-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Album Kegiatan
        </a>
    </div>

    <div class="sp-card overflow-hidden">
        @if($kegiatan->count())
        <div class="overflow-x-auto">
            <table class="sp-table">
                <thead>
                    <tr>
                        <th class="w-10">#</th>
                        <th>Album</th>
                        <th>Tanggal</th>
                        <th>Foto</th>
                        <th>Status</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kegiatan as $i => $k)
                    <tr>
                        <td class="text-cobalt-400">{{ ($kegiatan->currentPage()-1)*$kegiatan->perPage()+$i+1 }}</td>
                        <td>
                            <div class="flex items-center gap-3">
                                @if($k->cover)
                                <img src="{{ asset('storage/'.$k->cover) }}" alt="{{ $k->judul }}"
                                     class="w-14 h-10 object-cover rounded-lg shrink-0 border border-slate-200">
                                @else
                                <div class="w-14 h-10 rounded-lg bg-cobalt-100 flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5 text-cobalt-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                @endif
                                <div class="min-w-0">
                                    <p class="font-medium text-cobalt-800 truncate">{{ $k->judul }}</p>
                                    @if($k->deskripsi)
                                    <p class="text-xs text-cobalt-400 truncate">{{ Str::limit($k->deskripsi, 50) }}</p>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="text-sm text-cobalt-600 whitespace-nowrap">
                            {{ $k->tanggal->translatedFormat('d M Y') }}
                        </td>
                        <td>
                            <span class="text-sm font-medium text-cobalt-600">
                                {{ $k->fotos_count }}
                                <span class="text-cobalt-400 font-normal">foto</span>
                            </span>
                        </td>
                        <td>
                            <span class="text-xs px-2.5 py-1 rounded-full font-semibold
                                {{ $k->is_published ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-cobalt-400' }}">
                                {{ $k->is_published ? 'Ditampilkan' : 'Disembunyikan' }}
                            </span>
                        </td>
                        <td>
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('gallery.show', $k->id) }}" target="_blank"
                                   class="p-1.5 text-cobalt-400 hover:text-cobalt-700 rounded transition-colors" title="Lihat publik">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                    </svg>
                                </a>
                                <a href="{{ route('admin.galeri-kegiatan.edit', $k->id) }}"
                                   class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-semibold
                                          bg-cobalt-50 text-cobalt-700 hover:bg-cobalt-100 transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('admin.galeri-kegiatan.destroy', $k->id) }}"
                                      onsubmit="return confirm('Hapus album \'{{ $k->judul }}\'?')">
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
        @if($kegiatan->hasPages())
        <div class="px-5 py-3 border-t border-slate-100">{{ $kegiatan->links() }}</div>
        @endif
        @else
        <div class="py-16 text-center">
            <svg class="w-12 h-12 text-cobalt-200 mx-auto mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <p class="text-cobalt-500 font-medium">Belum ada album kegiatan.</p>
            <a href="{{ route('admin.galeri-kegiatan.create') }}" class="btn-primary mt-4 inline-flex">Tambah sekarang</a>
        </div>
        @endif
    </div>
</div>
@endsection
