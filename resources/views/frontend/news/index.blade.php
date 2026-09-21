@extends('frontend.layouts.app')

@section('title', 'Berita & Pengumuman — SMAS St. Petrus')
@section('description', 'Ikuti kabar terbaru dari SMAS St. Petrus Pontianak — kegiatan, prestasi, dan pengumuman sekolah.')

@section('content')

{{-- ── Hero singkat ──────────────────────────────────────────────────────── --}}
<section class="bg-cobalt-700 pt-14 pb-10">
    <div class="h-1 bg-gradient-to-r from-gold-600 via-gold-400 to-gold-600 -mt-14 mb-14"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <p class="text-gold-400 text-sm font-semibold tracking-widest uppercase mb-2">Kabar Sekolah</p>
        <h1 class="font-display text-display-lg text-white">Berita & Pengumuman</h1>
        <p class="text-cobalt-200 mt-3 text-base max-w-lg">
            Kegiatan, prestasi, dan informasi penting dari SMAS St. Petrus Pontianak.
        </p>
    </div>
</section>

{{-- ── Konten utama ─────────────────────────────────────────────────────── --}}
<section class="py-14 bg-parchment">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-3 gap-8">

            {{-- ── Kolom kiri: daftar berita ─────────────────────────── --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Search & filter --}}
                <form action="{{ route('news.index') }}" method="GET"
                      class="flex flex-col sm:flex-row gap-3">
                    <div class="relative flex-1">
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Cari berita…"
                               class="w-full rounded-lg border border-slate-300 bg-white
                                      pl-4 pr-10 py-2.5 text-sm text-ink
                                      focus:border-cobalt-500 focus:ring-2 focus:ring-cobalt-200 transition">
                        <button type="submit"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-cobalt-400 hover:text-cobalt-700">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </button>
                    </div>
                    <select name="category" onchange="this.form.submit()"
                            class="rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm text-ink
                                   focus:border-cobalt-500 focus:ring-2 focus:ring-cobalt-200 transition sm:w-48">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->slug }}" {{ request('category') == $cat->slug ? 'selected' : '' }}>
                            {{ $cat->name }} ({{ $cat->posts_count }})
                        </option>
                        @endforeach
                    </select>
                </form>

                {{-- Daftar berita --}}
                @forelse($posts as $post)
                <a href="{{ route('news.detail', $post->slug) }}"
                   class="sp-card-hover group flex flex-col sm:flex-row gap-0 overflow-hidden">
                    {{-- Thumbnail --}}
                    <div class="sm:w-52 sm:shrink-0 aspect-video sm:aspect-auto overflow-hidden bg-cobalt-100">
                        @if($post->thumbnail)
                        <img src="{{ asset('storage/' . $post->thumbnail) }}"
                             alt="{{ $post->title }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                        <div class="w-full h-full flex items-center justify-center min-h-[120px]">
                            <svg class="w-10 h-10 text-cobalt-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                            </svg>
                        </div>
                        @endif
                    </div>
                    {{-- Konten --}}
                    <div class="flex flex-col justify-between p-5 flex-1 min-w-0">
                        <div>
                            <div class="flex items-center gap-2 mb-2 flex-wrap">
                                @if($post->category)
                                <span class="text-xs font-semibold px-2.5 py-0.5 rounded-full bg-cobalt-50 text-cobalt-700">
                                    {{ $post->category->name }}
                                </span>
                                @endif
                                <time class="text-xs text-cobalt-400">
                                    {{ $post->published_at?->translatedFormat('d F Y') }}
                                </time>
                            </div>
                            <h2 class="font-display text-base font-bold text-cobalt-800 leading-snug
                                       group-hover:text-cobalt-600 transition-colors line-clamp-2">
                                {{ $post->title }}
                            </h2>
                            @if($post->excerpt)
                            <p class="text-sm text-cobalt-500 mt-2 line-clamp-2 leading-relaxed">
                                {{ $post->excerpt }}
                            </p>
                            @endif
                        </div>
                        <div class="flex items-center justify-between mt-3 pt-3 border-t border-slate-100">
                            <span class="text-xs text-cobalt-400 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                {{ number_format($post->views) }} dibaca
                            </span>
                            <span class="text-xs font-semibold text-cobalt-600 inline-flex items-center gap-1
                                         group-hover:text-cobalt-800 transition-colors">
                                Baca selengkapnya
                                <svg class="w-3.5 h-3.5 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </span>
                        </div>
                    </div>
                </a>
                @empty
                <div class="sp-card p-12 text-center">
                    <svg class="w-12 h-12 text-cobalt-200 mx-auto mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                    <p class="text-cobalt-500 font-medium">
                        @if(request('search'))
                            Tidak ada berita yang cocok dengan "<strong>{{ request('search') }}</strong>".
                        @else
                            Belum ada berita yang dipublikasikan.
                        @endif
                    </p>
                    @if(request('search') || request('category'))
                    <a href="{{ route('news.index') }}" class="btn-secondary mt-4 inline-flex text-sm">
                        Tampilkan semua berita
                    </a>
                    @endif
                </div>
                @endforelse

                {{-- Pagination --}}
                @if($posts->hasPages())
                <div class="mt-4">
                    {{ $posts->withQueryString()->links() }}
                </div>
                @endif
            </div>

            {{-- ── Sidebar kanan ────────────────────────────────────── --}}
            <aside class="space-y-6">

                {{-- Berita utama / terbaru --}}
                @if($featuredPosts->count())
                <div class="sp-card p-5">
                    <h3 class="sp-mark-sm font-display text-sm font-bold text-cobalt-700 uppercase tracking-wider mb-4">
                        Berita Terbaru
                    </h3>
                    <div class="space-y-4">
                        @foreach($featuredPosts as $fp)
                        <a href="{{ route('news.detail', $fp->slug) }}"
                           class="flex gap-3 group">
                            <div class="w-16 h-14 rounded-lg overflow-hidden shrink-0 bg-cobalt-100">
                                @if($fp->thumbnail)
                                <img src="{{ asset('storage/' . $fp->thumbnail) }}"
                                     alt="{{ $fp->title }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-cobalt-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                    </svg>
                                </div>
                                @endif
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs font-bold text-cobalt-800 line-clamp-2 leading-snug
                                           group-hover:text-cobalt-600 transition-colors">
                                    {{ $fp->title }}
                                </p>
                                <time class="text-xs text-cobalt-400 mt-1 block">
                                    {{ $fp->published_at?->translatedFormat('d M Y') }}
                                </time>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Kategori --}}
                @if($categories->count())
                <div class="sp-card p-5">
                    <h3 class="sp-mark-sm font-display text-sm font-bold text-cobalt-700 uppercase tracking-wider mb-4">
                        Kategori
                    </h3>
                    <ul class="space-y-1">
                        <li>
                            <a href="{{ route('news.index') }}"
                               class="flex items-center justify-between py-2 px-3 rounded-lg text-sm transition-colors
                                      {{ !request('category') ? 'bg-cobalt-50 text-cobalt-800 font-semibold' : 'text-cobalt-600 hover:bg-cobalt-50' }}">
                                <span>Semua</span>
                                <span class="text-xs bg-slate-100 text-cobalt-500 px-2 py-0.5 rounded-full">
                                    {{ $posts->total() }}
                                </span>
                            </a>
                        </li>
                        @foreach($categories as $cat)
                        <li>
                            <a href="{{ route('news.category', $cat->slug) }}"
                               class="flex items-center justify-between py-2 px-3 rounded-lg text-sm transition-colors
                                      {{ request('category') == $cat->slug ? 'bg-cobalt-50 text-cobalt-800 font-semibold' : 'text-cobalt-600 hover:bg-cobalt-50' }}">
                                <span>{{ $cat->name }}</span>
                                <span class="text-xs bg-slate-100 text-cobalt-500 px-2 py-0.5 rounded-full">
                                    {{ $cat->posts_count }}
                                </span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif

            </aside>
        </div>
    </div>
</section>

@endsection
