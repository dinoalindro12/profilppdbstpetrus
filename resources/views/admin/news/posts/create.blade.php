@extends('admin.layouts.app')
@section('title', 'Tulis Berita Baru')

@section('content')
<div class="space-y-5">

    <div class="flex items-center gap-3">
        <a href="{{ route('admin.news.posts.index') }}"
           class="p-1.5 rounded-lg text-cobalt-500 hover:bg-cobalt-50 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
        </a>
        <h2 class="sp-mark font-display text-xl font-bold text-cobalt-800">Tulis Berita Baru</h2>
    </div>

    <form action="{{ route('admin.news.posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid lg:grid-cols-3 gap-5">

            {{-- Konten utama --}}
            <div class="lg:col-span-2 space-y-5">
                <div class="sp-card p-5 space-y-4">

                    {{-- Judul --}}
                    <div>
                        <label for="title" class="block text-sm font-semibold text-cobalt-700 mb-1.5">
                            Judul Berita <span class="text-ember">*</span>
                        </label>
                        <input type="text" name="title" id="title"
                               value="{{ old('title') }}"
                               placeholder="Judul yang informatif dan menarik"
                               class="w-full rounded-lg border px-4 py-2.5 text-base text-ink font-medium
                                      border-slate-300 bg-white placeholder:text-cobalt-300
                                      focus:border-cobalt-500 focus:ring-2 focus:ring-cobalt-200
                                      @error('title') border-ember ring-2 ring-ember/20 @enderror transition">
                        @error('title') <p class="mt-1 text-xs text-ember">{{ $message }}</p> @enderror
                    </div>

                    {{-- Excerpt --}}
                    <div>
                        <label for="excerpt" class="block text-sm font-semibold text-cobalt-700 mb-1.5">
                            Ringkasan
                            <span class="text-cobalt-400 font-normal ml-1">(tampil di halaman daftar berita)</span>
                        </label>
                        <textarea name="excerpt" id="excerpt" rows="2"
                                  placeholder="Satu–dua kalimat yang merangkum isi berita."
                                  class="w-full rounded-lg border px-4 py-2.5 text-sm text-ink
                                         border-slate-300 bg-white placeholder:text-cobalt-300
                                         focus:border-cobalt-500 focus:ring-2 focus:ring-cobalt-200 transition">{{ old('excerpt') }}</textarea>
                    </div>

                    {{-- Konten --}}
                    <div>
                        <label for="content" class="block text-sm font-semibold text-cobalt-700 mb-1.5">
                            Isi Berita <span class="text-ember">*</span>
                        </label>
                        <textarea name="content" id="content" rows="16"
                                  placeholder="Tulis isi berita di sini..."
                                  class="w-full rounded-lg border px-4 py-2.5 text-sm text-ink font-mono
                                         border-slate-300 bg-white placeholder:text-cobalt-300
                                         focus:border-cobalt-500 focus:ring-2 focus:ring-cobalt-200 transition">{{ old('content') }}</textarea>
                        @error('content') <p class="mt-1 text-xs text-ember">{{ $message }}</p> @enderror
                        <p class="mt-1 text-xs text-cobalt-400">HTML dasar didukung: &lt;b&gt;, &lt;i&gt;, &lt;ul&gt;, &lt;ol&gt;, &lt;p&gt;, &lt;a&gt;</p>
                    </div>
                </div>

                {{-- Meta SEO --}}
                <div class="sp-card p-5 space-y-4">
                    <h3 class="text-sm font-bold text-cobalt-600 uppercase tracking-wider">SEO (opsional)</h3>
                    <div>
                        <label for="meta_description" class="block text-sm font-semibold text-cobalt-700 mb-1.5">Meta Description</label>
                        <textarea name="meta_description" id="meta_description" rows="2"
                                  placeholder="Deskripsi singkat untuk mesin pencari (maks. 160 karakter)."
                                  class="w-full rounded-lg border px-4 py-2.5 text-sm border-slate-300 bg-white
                                         placeholder:text-cobalt-300 focus:border-cobalt-500 focus:ring-2 focus:ring-cobalt-200 transition">{{ old('meta_description') }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Sidebar settings --}}
            <div class="space-y-5">
                {{-- Publish --}}
                <div class="sp-card p-5 space-y-4">
                    <h3 class="text-sm font-bold text-cobalt-600 uppercase tracking-wider">Publikasi</h3>

                    <div>
                        <label for="status" class="block text-sm font-semibold text-cobalt-700 mb-1.5">Status</label>
                        <select name="status" id="status"
                                class="w-full rounded-lg border px-4 py-2.5 text-sm border-slate-300 bg-white
                                       focus:border-cobalt-500 focus:ring-2 focus:ring-cobalt-200 transition">
                            <option value="draft" {{ old('status') !== 'published' ? 'selected' : '' }}>Draft — belum tayang</option>
                            <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Terbitkan sekarang</option>
                        </select>
                    </div>

                    <div>
                        <label for="published_at" class="block text-sm font-semibold text-cobalt-700 mb-1.5">
                            Tanggal Terbit
                            <span class="text-cobalt-400 font-normal">(opsional)</span>
                        </label>
                        <input type="datetime-local" name="published_at" id="published_at"
                               value="{{ old('published_at') }}"
                               class="w-full rounded-lg border px-4 py-2.5 text-sm border-slate-300 bg-white
                                      focus:border-cobalt-500 focus:ring-2 focus:ring-cobalt-200 transition">
                    </div>

                    <div class="flex gap-3 pt-2 border-t border-slate-100">
                        <a href="{{ route('admin.news.posts.index') }}" class="btn-secondary flex-1 justify-center">Batal</a>
                        <button type="submit" class="btn-primary flex-1 justify-center">Simpan</button>
                    </div>
                </div>

                {{-- Kategori --}}
                <div class="sp-card p-5 space-y-3">
                    <h3 class="text-sm font-bold text-cobalt-600 uppercase tracking-wider">Kategori</h3>
                    <select name="category_id" id="category_id"
                            class="w-full rounded-lg border px-4 py-2.5 text-sm border-slate-300 bg-white
                                   focus:border-cobalt-500 focus:ring-2 focus:ring-cobalt-200
                                   @error('category_id') border-ember ring-2 ring-ember/20 @enderror transition">
                        <option value="">-- Pilih kategori --</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="text-xs text-ember">{{ $message }}</p> @enderror
                    <a href="{{ route('admin.news.categories.create') }}"
                       class="text-xs text-cobalt-500 hover:text-cobalt-700 transition-colors">
                        + Tambah kategori baru
                    </a>
                </div>

                {{-- Thumbnail --}}
                <div class="sp-card p-5 space-y-3" x-data="{ preview: null }">
                    <h3 class="text-sm font-bold text-cobalt-600 uppercase tracking-wider">Thumbnail</h3>
                    <template x-if="preview">
                        <img :src="preview" class="w-full aspect-video object-cover rounded-lg">
                    </template>
                    <input type="file" name="thumbnail" id="thumbnail" accept="image/*"
                           @change="preview = URL.createObjectURL($event.target.files[0])"
                           class="w-full text-sm text-cobalt-600
                                  file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0
                                  file:text-xs file:font-semibold file:bg-cobalt-50 file:text-cobalt-700
                                  hover:file:bg-cobalt-100 focus:outline-none">
                    <p class="text-xs text-cobalt-400">JPG, PNG, WebP — maks. 2MB</p>
                    @error('thumbnail') <p class="text-xs text-ember">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
