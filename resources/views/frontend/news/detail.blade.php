@extends('frontend.layouts.app')

@section('title', $post->title . ' — SMAS St. Petrus')
@section('description', $post->excerpt ?? Str::limit(strip_tags($post->content), 160))

@section('content')

{{-- ── Breadcrumb & hero ──────────────────────────────────────────────────── --}}
<section class="bg-cobalt-700 pt-14 pb-10">
    <div class="h-1 bg-gradient-to-r from-gold-600 via-gold-400 to-gold-600 -mt-14 mb-14"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-xs text-cobalt-300 mb-4" aria-label="breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a>
            <span>/</span>
            <a href="{{ route('news.index') }}" class="hover:text-white transition-colors">Berita</a>
            @if($post->category)
            <span>/</span>
            <a href="{{ route('news.category', $post->category->slug) }}" class="hover:text-white transition-colors">
                {{ $post->category->name }}
            </a>
            @endif
        </nav>

        <div class="flex items-center gap-2 mb-3 flex-wrap">
            @if($post->category)
            <a href="{{ route('news.category', $post->category->slug) }}"
               class="text-xs font-semibold px-3 py-1 rounded-full bg-gold-500 text-cobalt-900 hover:bg-gold-400 transition-colors">
                {{ $post->category->name }}
            </a>
            @endif
        </div>

        <h1 class="font-display text-display-md text-white leading-snug max-w-3xl text-balance">
            {{ $post->title }}
        </h1>

        <div class="flex items-center gap-4 mt-4 text-cobalt-300 text-sm flex-wrap">
            <span class="flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                {{ $post->published_at?->translatedFormat('d F Y') }}
            </span>
            <span class="flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
                {{ number_format($post->views) }} kali dibaca
            </span>
            @if($post->user)
            <span class="flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                {{ $post->user->name }}
            </span>
            @endif
        </div>
    </div>
</section>

{{-- ── Isi artikel ─────────────────────────────────────────────────────────── --}}
<section class="py-14 bg-parchment">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-3 gap-10">

            {{-- Artikel --}}
            <article class="lg:col-span-2">

                {{-- Thumbnail --}}
                @if($post->thumbnail)
                <div class="rounded-xl overflow-hidden mb-8 aspect-video">
                    <img src="{{ asset('storage/' . $post->thumbnail) }}"
                         alt="{{ $post->title }}"
                         class="w-full h-full object-cover">
                </div>
                @endif

                {{-- Excerpt / ringkasan --}}
                @if($post->excerpt)
                <div class="sp-mark mb-6">
                    <p class="font-serif italic text-lg text-cobalt-600 leading-relaxed">
                        {{ $post->excerpt }}
                    </p>
                </div>
                @endif

                {{-- Konten utama --}}
                <div class="prose-petrus max-w-none
                            prose prose-headings:font-display prose-headings:text-cobalt-800
                            prose-a:text-cobalt-600 prose-a:underline prose-a:underline-offset-2
                            prose-strong:text-cobalt-800
                            prose-img:rounded-xl prose-img:shadow-card-md
                            prose-ul:text-cobalt-700 prose-ol:text-cobalt-700">
                    {!! $post->content !!}
                </div>

                {{-- Footer artikel --}}
                <div class="mt-10 pt-6 border-t border-slate-200 flex items-center justify-between gap-4 flex-wrap">
                    <a href="{{ route('news.index') }}"
                       class="inline-flex items-center gap-2 text-sm font-semibold text-cobalt-600 hover:text-cobalt-800 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali ke daftar berita
                    </a>
                    {{-- Share --}}
                    <div class="flex items-center gap-2">
                        <span class="text-xs text-cobalt-400">Bagikan:</span>
                        <a href="https://wa.me/?text={{ urlencode($post->title . ' ' . url()->current()) }}"
                           target="_blank" rel="noopener"
                           class="p-2 rounded-lg bg-emerald-50 text-emerald-700 hover:bg-emerald-100 transition-colors" title="Bagikan ke WhatsApp">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                                <path d="M12 0C5.373 0 0 5.373 0 12c0 2.123.555 4.116 1.524 5.845L.057 23.882l6.2-1.625A11.938 11.938 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.8 9.8 0 01-5.006-1.376l-.359-.214-3.68.965.979-3.585-.234-.369A9.786 9.786 0 012.182 12C2.182 6.57 6.57 2.182 12 2.182c5.43 0 9.818 4.388 9.818 9.818 0 5.43-4.388 9.818-9.818 9.818z"/>
                            </svg>
                        </a>
                        <button onclick="navigator.clipboard.writeText(window.location.href).then(()=>alert('Link disalin!'))"
                                class="p-2 rounded-lg bg-slate-100 text-cobalt-600 hover:bg-slate-200 transition-colors" title="Salin link">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </article>

            {{-- Sidebar --}}
            <aside class="space-y-6">

                {{-- Berita terkait --}}
                @if($relatedPosts->count())
                <div class="sp-card p-5">
                    <h3 class="sp-mark-sm font-display text-sm font-bold text-cobalt-700 uppercase tracking-wider mb-4">
                        Berita Terkait
                    </h3>
                    <div class="space-y-4">
                        @foreach($relatedPosts as $related)
                        <a href="{{ route('news.detail', $related->slug) }}"
                           class="flex gap-3 group">
                            <div class="w-16 h-14 rounded-lg overflow-hidden shrink-0 bg-cobalt-100">
                                @if($related->thumbnail)
                                <img src="{{ asset('storage/' . $related->thumbnail) }}"
                                     alt="{{ $related->title }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-cobalt-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                    </svg>
                                </div>
                                @endif
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs font-bold text-cobalt-800 line-clamp-2 leading-snug group-hover:text-cobalt-600 transition-colors">
                                    {{ $related->title }}
                                </p>
                                <time class="text-xs text-cobalt-400 mt-1 block">
                                    {{ $related->published_at?->translatedFormat('d M Y') }}
                                </time>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- CTA PPDB --}}
                <div class="sp-card p-5 bg-cobalt-700 text-white rounded-xl border-0">
                    <p class="text-gold-400 text-xs font-semibold uppercase tracking-wider mb-2">PPDB 2025/2026</p>
                    <p class="font-display text-base font-bold mb-3 leading-snug">
                        Pendaftaran sedang dibuka
                    </p>
                    <a href="{{ route('ppdb.form') }}" class="btn-gold text-xs w-full justify-center">
                        Daftar sekarang
                    </a>
                </div>

            </aside>
        </div>
    </div>
</section>

@endsection
