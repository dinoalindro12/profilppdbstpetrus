@extends('admin.layouts.app')
@section('title', 'Berita & Pengumuman')

@section('content')
<div class="space-y-5">

    <div class="flex items-center justify-between gap-4 flex-wrap">
        <div>
            <h2 class="sp-mark font-display text-xl font-bold text-cobalt-800">Berita & Pengumuman</h2>
            <p class="text-cobalt-500 text-sm mt-1">Kelola semua artikel yang ditampilkan di halaman publik.</p>
        </div>
        <a href="{{ route('admin.news.posts.create') }}" class="btn-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Tulis Berita Baru
        </a>
    </div>

    {{-- Filter status --}}
    <div class="flex gap-1 border-b border-slate-200">
        @foreach(['all' => 'Semua', 'published' => 'Terbit', 'draft' => 'Draft'] as $val => $label)
        <a href="{{ request()->fullUrlWithQuery(['status' => $val]) }}"
           class="px-4 py-2.5 text-sm font-medium border-b-2 transition-colors -mb-px
                  {{ request('status', 'all') === $val
                     ? 'border-gold-500 text-cobalt-800'
                     : 'border-transparent text-cobalt-500 hover:text-cobalt-700' }}">
            {{ $label }}
        </a>
        @endforeach
    </div>

    <div class="sp-card overflow-hidden">
        @if(count($posts))
        <div class="overflow-x-auto">
            <table class="sp-table">
                <thead>
                    <tr>
                        <th class="w-10">#</th>
                        <th>Berita</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Tanggal Terbit</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $i => $post)
                    <tr>
                        <td class="text-cobalt-400">{{ $i + 1 }}</td>
                        <td>
                            <div class="flex items-center gap-3">
                                @if($post->thumbnail)
                                <img src="{{ asset('storage/' . $post->thumbnail) }}"
                                     alt="{{ $post->title }}"
                                     class="w-14 h-10 object-cover rounded-lg shrink-0 border border-slate-200">
                                @else
                                <div class="w-14 h-10 rounded-lg bg-cobalt-100 flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5 text-cobalt-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                    </svg>
                                </div>
                                @endif
                                <div class="min-w-0">
                                    <p class="font-medium text-cobalt-800 truncate max-w-xs">{{ $post->title }}</p>
                                    @if($post->excerpt)
                                    <p class="text-xs text-cobalt-400 mt-0.5 truncate max-w-xs">{{ $post->excerpt }}</p>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="text-xs px-2.5 py-1 rounded-full font-semibold bg-cobalt-50 text-cobalt-700">
                                {{ $post->category?->name ?? '—' }}
                            </span>
                        </td>
                        <td>
                            <span class="text-xs px-2.5 py-1 rounded-full font-semibold
                                {{ $post->is_published ? 'bg-emerald-50 text-emerald-700' : 'bg-gold-50 text-gold-700' }}">
                                {{ $post->is_published ? 'Terbit' : 'Draft' }}
                            </span>
                        </td>
                        <td class="text-xs text-cobalt-500">
                            {{ $post->published_at ? $post->published_at->translatedFormat('d M Y') : '—' }}
                        </td>
                        <td>
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('news.detail', $post->slug) }}" target="_blank"
                                   class="p-1.5 text-cobalt-400 hover:text-cobalt-700 rounded transition-colors" title="Lihat di halaman publik">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                    </svg>
                                </a>
                                <a href="{{ route('admin.news.posts.edit', $post->id) }}"
                                   class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-semibold
                                          bg-cobalt-50 text-cobalt-700 hover:bg-cobalt-100 transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('admin.news.posts.destroy', $post->id) }}"
                                      onsubmit="return confirm('Hapus berita ini? Tindakan tidak dapat dibatalkan.')">
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
        @else
        <div class="py-16 text-center">
            <svg class="w-12 h-12 text-cobalt-200 mx-auto mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
            </svg>
            <p class="text-cobalt-500 font-medium">Belum ada berita yang ditulis.</p>
            <a href="{{ route('admin.news.posts.create') }}" class="btn-primary mt-4 inline-flex">Tulis berita pertama</a>
        </div>
        @endif
    </div>

</div>
@endsection
