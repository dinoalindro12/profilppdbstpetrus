@extends('admin.layouts.app')
@section('title', 'Kategori Berita')

@section('content')
<div class="space-y-5">

    <div class="flex items-center justify-between gap-4 flex-wrap">
        <div>
            <h2 class="sp-mark font-display text-xl font-bold text-cobalt-800">Kategori Berita</h2>
            <p class="text-cobalt-500 text-sm mt-1">Kelola pengelompokan berita dan pengumuman.</p>
        </div>
        <a href="{{ route('admin.news.categories.create') }}" class="btn-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Kategori
        </a>
    </div>

    <div class="sp-card overflow-hidden">
        @if($categories->count())
        <div class="overflow-x-auto">
            <table class="sp-table">
                <thead>
                    <tr>
                        <th class="w-10">#</th>
                        <th>Nama Kategori</th>
                        <th>Slug</th>
                        <th>Jumlah Berita</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $cat)
                    <tr>
                        <td class="text-cobalt-400">{{ $loop->iteration }}</td>
                        <td class="font-medium text-cobalt-800">{{ $cat->name }}</td>
                        <td>
                            <code class="text-xs bg-slate-100 text-cobalt-600 px-2 py-0.5 rounded">{{ $cat->slug }}</code>
                        </td>
                        <td>
                            <span class="text-sm font-medium text-cobalt-600">
                                {{ $cat->posts_count ?? $cat->posts()->count() }}
                                <span class="text-cobalt-400 font-normal">berita</span>
                            </span>
                        </td>
                        <td>
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.news.categories.edit', $cat->id) }}"
                                   class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-semibold
                                          bg-cobalt-50 text-cobalt-700 hover:bg-cobalt-100 transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('admin.news.categories.destroy', $cat->id) }}"
                                      onsubmit="return confirm('Hapus kategori \'{{ $cat->name }}\'? Berita di kategori ini tidak ikut terhapus.')">
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
        @if($categories->hasPages())
        <div class="px-5 py-3 border-t border-slate-100">
            {{ $categories->links() }}
        </div>
        @endif
        @else
        <div class="py-14 text-center">
            <p class="text-cobalt-500 font-medium">Belum ada kategori.</p>
            <a href="{{ route('admin.news.categories.create') }}" class="btn-primary mt-4 inline-flex">
                Buat kategori pertama
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
