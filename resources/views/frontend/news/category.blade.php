@extends('frontend.layouts.app')

@section('title', $category->name . ' — Berita SMAS St. Petrus')
@section('description', 'Kumpulan berita kategori ' . $category->name . ' dari SMAS St. Petrus Pontianak.')

@section('content')

{{-- Hero --}}
<section class="bg-cobalt-700 pt-14 pb-10">
    <div class="h-1 bg-gradient-to-r from-gold-600 via-gold-400 to-gold-600 -mt-14 mb-14"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs text-cobalt-300 mb-4">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a>
            <span>/</span>
            <a href="{{ route('news.index') }}" class="hover:text-white transition-colors">Berita</a>
            <span>/</span>
            <span class="text-white">{{ $category->name }}</span>
        </nav>
        <p class="text-gold-400 text-sm font-semibold tracking-widest uppercase mb-2">Kategori</p>
        <h1 class="font-display text-display-lg text-white">{{ $category->name }}</h1>
        <p class="text-cobalt-200 mt-2 text-sm">{{ $posts->total() }} berita dalam kategori ini</p>
    </div>
</section>

{{-- Konten --}}
<section class="py-14 bg-parchment">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-3 gap-8">

            {{-- Daftar --}}
            <div class="lg:col-span-2 space-y-5">
                @forelse($posts as $post)
                <a href="{{ route('news.detail', $post->slug) }}"
                   class="sp-card-hover group flex flex-col sm:flex-row gap-0 overflow-hidden">
                    <div class="sm:w-52 sm:shrink-0 aspect-video sm:aspect-auto overflow-hidden bg-cobalt-100">
                        @if($post->thumbnail)
                        <img src="{{ asset('storage/' . $post->thumbnail) }}"
                             alt="{{ $post->title }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 min-h-[120px]">
                        @else
                        <div class="w-full h-full flex items-center justify-center min-h-[120px]">
                            <svg class="w-10 h-10 text-cobalt-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                            </svg>
                        </div>
                        @endif
                    </div>
                    <div class="flex flex-col justify-between p-5 flex-1 min-w-0">
                        <div>
                            <time class="text-xs text-cobalt-400 block mb-1.5">
                                {{ $post->published_at?->translatedFormat('d F Y') }}
                            </time>
                            <h2 class="font-display text-base font-bold text-cobalt-800 leading-snug
                                       group-hover:text-cobalt-600 transition-colors line-clamp-2">
                                {{ $post->title }}
                            </h2>
                            @if($post->excerpt)
                            <p class="text-sm text-cobalt-500 mt-2 line-clamp-2">{{ $post->excerpt }}</p>
                            @endif
                        </div>
                        <div class="flex justify-end mt-3 pt-3 border-t border-slate-100">
                            <span class="text-xs font-semibold text-cobalt-600 inline-flex items-center gap-1 group-hover:text-cobalt-800">
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
                    <p class="text-cobalt-500 font-medium">Belum ada berita di kategori ini.</p>
                    <a href="{{ route('news.index') }}" class="btn-secondary mt-4 inline-flex text-sm">
                        Lihat semua berita
                    </a>
                </div>
                @endforelse

                @if($posts->hasPages())
                <div class="mt-4">{{ $posts->withQueryString()->links() }}</div>
                @endif
            </div>

            {{-- Sidebar kategori --}}
            <aside>
                <div class="sp-card p-5">
                    <h3 class="sp-mark-sm font-display text-sm font-bold text-cobalt-700 uppercase tracking-wider mb-4">
                        Semua Kategori
                    </h3>
                    <ul class="space-y-1">
                        <li>
                            <a href="{{ route('news.index') }}"
                               class="flex items-center justify-between py-2 px-3 rounded-lg text-sm text-cobalt-600 hover:bg-cobalt-50 transition-colors">
                                <span>Semua Berita</span>
                            </a>
                        </li>
                        @foreach($categories as $cat)
                        <li>
                            <a href="{{ route('news.category', $cat->slug) }}"
                               class="flex items-center justify-between py-2 px-3 rounded-lg text-sm transition-colors
                                      {{ $cat->slug === $category->slug ? 'bg-cobalt-50 text-cobalt-800 font-semibold' : 'text-cobalt-600 hover:bg-cobalt-50' }}">
                                <span>{{ $cat->name }}</span>
                                <span class="text-xs bg-slate-100 text-cobalt-500 px-2 py-0.5 rounded-full">
                                    {{ $cat->posts_count }}
                                </span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </aside>
        </div>
    </div>
</section>

@endsection
