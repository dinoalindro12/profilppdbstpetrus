@extends('frontend.layouts.app')

@section('title', 'Galeri Alumni — SMAS St. Petrus')
@section('description', 'Kumpulan foto wisuda dan kegiatan alumni SMAS St. Petrus Pontianak per angkatan.')

@section('content')

{{-- ── Hero ──────────────────────────────────────────────────────────────── --}}
<section class="bg-cobalt-700 pt-14 pb-10">
    <div class="h-1 bg-gradient-to-r from-gold-600 via-gold-400 to-gold-600 -mt-14 mb-14"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <p class="text-gold-400 text-sm font-semibold tracking-widest uppercase mb-2">Kenangan Bersama</p>
        <h1 class="font-display text-display-lg text-white">Galeri Alumni</h1>
        <p class="text-cobalt-200 mt-3 text-base max-w-lg">
            Momen wisuda dan kegiatan para alumni SMAS St. Petrus dari setiap angkatan.
        </p>
    </div>
</section>

{{-- ── Konten ───────────────────────────────────────────────────────────── --}}
<section class="py-14 bg-parchment">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Filter angkatan --}}
        @if($angkatanList->count())
        <div class="flex flex-wrap gap-2 mb-8">
            <a href="{{ route('alumni.galeri.index') }}"
               class="px-4 py-2 rounded-full text-sm font-semibold transition-colors
                      {{ !request('angkatan') ? 'bg-cobalt-700 text-white' : 'bg-white border border-slate-300 text-cobalt-600 hover:border-cobalt-400' }}">
                Semua Angkatan
            </a>
            @foreach($angkatanList as $tahun)
            <a href="{{ route('alumni.galeri.index', ['angkatan' => $tahun]) }}"
               class="px-4 py-2 rounded-full text-sm font-semibold transition-colors
                      {{ request('angkatan') == $tahun ? 'bg-cobalt-700 text-white' : 'bg-white border border-slate-300 text-cobalt-600 hover:border-cobalt-400' }}">
                Angkatan {{ $tahun }}
            </a>
            @endforeach
        </div>
        @endif

        {{-- Grid album --}}
        @if($galeris->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
            @foreach($galeris as $galeri)
            <a href="{{ route('alumni.galeri.show', $galeri->slug) }}"
               class="sp-card-hover group overflow-hidden flex flex-col">

                {{-- Cover foto --}}
                <div class="aspect-[4/3] overflow-hidden bg-cobalt-100 relative">
                    @if($galeri->cover_image)
                    <img src="{{ asset('storage/' . $galeri->cover_image) }}"
                         alt="{{ $galeri->title }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                    <div class="w-full h-full flex flex-col items-center justify-center gap-2 text-cobalt-300">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span class="text-xs">Belum ada cover</span>
                    </div>
                    @endif

                    {{-- Badge angkatan --}}
                    <div class="absolute top-3 left-3">
                        <span class="bg-cobalt-700/90 text-white text-xs font-bold px-2.5 py-1 rounded-full backdrop-blur-sm">
                            {{ $galeri->angkatan }}
                        </span>
                    </div>

                    {{-- Overlay jumlah foto --}}
                    <div class="absolute inset-0 bg-cobalt-900/0 group-hover:bg-cobalt-900/30 transition-colors duration-300 flex items-center justify-center">
                        <span class="opacity-0 group-hover:opacity-100 transition-opacity text-white font-semibold text-sm bg-cobalt-900/60 px-3 py-1.5 rounded-full">
                            Lihat {{ $galeri->fotos_count }} foto
                        </span>
                    </div>
                </div>

                {{-- Info album --}}
                <div class="p-4 flex-1 flex flex-col justify-between">
                    <div>
                        <h3 class="font-display text-sm font-bold text-cobalt-800 leading-snug
                                   group-hover:text-cobalt-600 transition-colors">
                            {{ $galeri->title }}
                        </h3>
                        @if($galeri->deskripsi)
                        <p class="text-xs text-cobalt-500 mt-1 line-clamp-2">{{ $galeri->deskripsi }}</p>
                        @endif
                    </div>
                    <div class="flex items-center justify-between mt-3 pt-3 border-t border-slate-100">
                        <span class="text-xs text-cobalt-400 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ $galeri->fotos_count }} foto
                        </span>
                        <span class="text-xs font-semibold text-cobalt-600 group-hover:text-cobalt-800 transition-colors flex items-center gap-1">
                            Buka album
                            <svg class="w-3.5 h-3.5 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($galeris->hasPages())
        <div class="mt-8">{{ $galeris->links() }}</div>
        @endif

        @else
        <div class="sp-card py-16 text-center">
            <svg class="w-12 h-12 text-cobalt-200 mx-auto mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <p class="text-cobalt-500 font-medium">
                @if(request('angkatan'))
                    Belum ada album untuk angkatan {{ request('angkatan') }}.
                @else
                    Belum ada album galeri alumni.
                @endif
            </p>
            @if(request('angkatan'))
            <a href="{{ route('alumni.galeri.index') }}" class="btn-secondary mt-4 inline-flex text-sm">
                Lihat semua angkatan
            </a>
            @endif
        </div>
        @endif

    </div>
</section>

@endsection
