@extends('admin.layouts.app')
@section('title', 'Edit Kategori')

@section('content')
<div class="max-w-xl space-y-5">

    <div class="flex items-center gap-3">
        <a href="{{ route('admin.news.categories.index') }}"
           class="p-1.5 rounded-lg text-cobalt-500 hover:bg-cobalt-50 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
        </a>
        <div>
            <h2 class="sp-mark font-display text-xl font-bold text-cobalt-800">Edit Kategori</h2>
            <p class="text-cobalt-500 text-sm mt-0.5">{{ $category->name }}</p>
        </div>
    </div>

    <div class="sp-card p-6">
        <form action="{{ route('admin.news.categories.update', $category->id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-semibold text-cobalt-700 mb-1.5">
                    Nama Kategori <span class="text-ember">*</span>
                </label>
                <input type="text" name="name" id="name"
                       value="{{ old('name', $category->name) }}"
                       class="w-full rounded-lg border px-4 py-2.5 text-sm text-ink
                              border-slate-300 bg-white focus:border-cobalt-500 focus:ring-2 focus:ring-cobalt-200
                              @error('name') border-ember ring-2 ring-ember/20 @enderror transition">
                @error('name') <p class="mt-1 text-xs text-ember">{{ $message }}</p> @enderror
                <p class="mt-1 text-xs text-cobalt-400">
                    Slug saat ini: <code class="bg-slate-100 px-1.5 py-0.5 rounded text-cobalt-600">{{ $category->slug }}</code>
                </p>
            </div>

            <div>
                <label for="description" class="block text-sm font-semibold text-cobalt-700 mb-1.5">Deskripsi</label>
                <textarea name="description" id="description" rows="3"
                          class="w-full rounded-lg border px-4 py-2.5 text-sm text-ink
                                 border-slate-300 bg-white focus:border-cobalt-500 focus:ring-2 focus:ring-cobalt-200 transition">{{ old('description', $category->description) }}</textarea>
            </div>

            <div class="flex justify-end gap-3 pt-2 border-t border-slate-100">
                <a href="{{ route('admin.news.categories.index') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
