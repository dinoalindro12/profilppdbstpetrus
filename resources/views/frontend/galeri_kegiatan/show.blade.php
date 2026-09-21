@extends('frontend.layouts.app')
@section('title', $galeriKegiatan->judul . ' — Galeri SMAS St. Petrus')

@section('content')

<section class="bg-cobalt-700 pt-14 pb-10">
    <div class="h-1 bg-gradient-to-r from-gold-600 via-gold-400 to-gold-600 -mt-14 mb-14"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs text-cobalt-300 mb-4">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a>
            <span>/</span>
            <a href="{{ route('gallery.index') }}" class="hover:text-white transition-colors">Galeri Kegiatan</a>
        </nav>
        <p class="text-gold-400 text-sm font-semibold tracking-widest uppercase mb-2">Dokumentasi</p>
        <h1 class="font-display text-display-md text-white">{{ $galeriKegiatan->judul }}</h1>
        <div class="flex items-center gap-4 mt-3 text-cobalt-300 text-sm flex-wrap">
            <span class="flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                {{ $galeriKegiatan->tanggal->translatedFormat('d F Y') }}
            </span>
            <span>{{ $galeriKegiatan->fotos->count() }} foto</span>
        </div>
        @if($galeriKegiatan->deskripsi)
        <p class="text-cobalt-200 mt-2 max-w-xl text-sm">{{ $galeriKegiatan->deskripsi }}</p>
        @endif
    </div>
</section>

<section class="py-14 bg-parchment"
         x-data="{
             lightbox: false,
             current: 0,
             fotos: {{ $galeriKegiatan->fotos->map(fn($f) => ['src' => asset('storage/'.$f->foto), 'caption' => $f->keterangan ?? ''])->toJson() }},
             open(i) { this.current = i; this.lightbox = true; },
             prev() { this.current = (this.current - 1 + this.fotos.length) % this.fotos.length; },
             next() { this.current = (this.current + 1) % this.fotos.length; }
         }"
         @keydown.escape.window="lightbox = false"
         @keydown.arrow-left.window="if(lightbox) prev()"
         @keydown.arrow-right.window="if(lightbox) next()">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-4 gap-8">

            {{-- Grid foto --}}
            <div class="lg:col-span-3">
                @if($galeriKegiatan->fotos->count())
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                    @foreach($galeriKegiatan->fotos as $i => $foto)
                    <button type="button" @click="open({{ $i }})"
                            class="group relative aspect-square overflow-hidden rounded-xl bg-cobalt-100 cursor-zoom-in
                                   focus-visible:ring-2 focus-visible:ring-gold-500">
                        <img src="{{ asset('storage/'.$foto->foto) }}"
                             alt="{{ $foto->keterangan ?? 'Foto '.($i+1) }}"
                             loading="lazy"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        <div class="absolute inset-0 bg-cobalt-900/0 group-hover:bg-cobalt-900/30 transition-colors duration-200
                                    flex items-center justify-center">
                            <svg class="w-6 h-6 text-white opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                            </svg>
                        </div>
                        @if($foto->keterangan)
                        <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-cobalt-900/80 to-transparent
                                    px-2 pb-2 pt-6 opacity-0 group-hover:opacity-100 transition-opacity">
                            <p class="text-white text-xs truncate">{{ $foto->keterangan }}</p>
                        </div>
                        @endif
                    </button>
                    @endforeach
                </div>
                @else
                <div class="sp-card py-16 text-center">
                    <p class="text-cobalt-400">Album ini belum memiliki foto.</p>
                </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <aside class="space-y-5">
                <div class="sp-card p-5">
                    <h3 class="sp-mark-sm text-sm font-bold text-cobalt-700 uppercase tracking-wider mb-3">Info Kegiatan</h3>
                    <dl class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <dt class="text-cobalt-500">Tanggal</dt>
                            <dd class="font-semibold text-cobalt-800">{{ $galeriKegiatan->tanggal->translatedFormat('d M Y') }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-cobalt-500">Jumlah foto</dt>
                            <dd class="font-semibold text-cobalt-700">{{ $galeriKegiatan->fotos->count() }}</dd>
                        </div>
                    </dl>
                </div>

                @if($kegiatanLain->count())
                <div class="sp-card p-5">
                    <h3 class="sp-mark-sm text-sm font-bold text-cobalt-700 uppercase tracking-wider mb-3">Kegiatan Lain</h3>
                    <div class="space-y-3">
                        @foreach($kegiatanLain as $lain)
                        <a href="{{ route('gallery.show', $lain->id) }}" class="flex gap-3 group">
                            <div class="w-14 h-12 rounded-lg overflow-hidden bg-cobalt-100 shrink-0">
                                @if($lain->cover)
                                <img src="{{ asset('storage/'.$lain->cover) }}" alt="{{ $lain->judul }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform">
                                @else
                                <div class="w-full h-full flex items-center justify-center text-cobalt-300">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                @endif
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs font-bold text-cobalt-800 line-clamp-2 group-hover:text-cobalt-600 transition-colors">{{ $lain->judul }}</p>
                                <p class="text-xs text-cobalt-400 mt-0.5">{{ $lain->tanggal->translatedFormat('d M Y') }}</p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

                <a href="{{ route('gallery.index') }}" class="btn-secondary w-full justify-center text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Semua Kegiatan
                </a>
            </aside>
        </div>
    </div>

    {{-- Lightbox --}}
    <div x-show="lightbox"
         x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 bg-cobalt-950/95 flex items-center justify-center"
         @click.self="lightbox = false">
        <button @click="prev()" class="absolute left-4 top-1/2 -translate-y-1/2 p-3 rounded-full bg-white/10 hover:bg-white/20 text-white transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <div class="max-w-4xl max-h-[85vh] mx-16 flex flex-col items-center gap-3">
            <template x-if="fotos.length > 0">
                <img :src="fotos[current].src" :alt="fotos[current].caption" class="max-h-[78vh] max-w-full object-contain rounded-lg shadow-2xl">
            </template>
            <div class="text-center">
                <p x-text="fotos[current]?.caption" class="text-cobalt-200 text-sm"></p>
                <p class="text-cobalt-400 text-xs mt-1"><span x-text="current+1"></span> / <span x-text="fotos.length"></span></p>
            </div>
        </div>
        <button @click="next()" class="absolute right-4 top-1/2 -translate-y-1/2 p-3 rounded-full bg-white/10 hover:bg-white/20 text-white transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </button>
        <button @click="lightbox = false" class="absolute top-4 right-4 p-2 rounded-full bg-white/10 hover:bg-white/20 text-white transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>

</section>

@endsection
