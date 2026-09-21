@extends('frontend.layouts.app')
@section('title', 'Fasilitas — SMAS St. Petrus')
@section('description', 'Fasilitas lengkap SMAS St. Petrus Pontianak untuk menunjang proses belajar mengajar.')

@section('content')

{{-- Hero --}}
<section class="bg-cobalt-700 pt-14 pb-10">
    <div class="h-1 bg-gradient-to-r from-gold-600 via-gold-400 to-gold-600 -mt-14 mb-14"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs text-cobalt-300 mb-4">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a>
            <span>/</span>
            <span class="text-white">Fasilitas</span>
        </nav>
        <p class="text-gold-400 text-sm font-semibold tracking-widest uppercase mb-2">Sarana & Prasarana</p>
        <h1 class="font-display text-display-lg text-white">Fasilitas Sekolah</h1>
        <p class="text-cobalt-200 mt-3 text-base max-w-lg">
            Fasilitas yang kami sediakan untuk mendukung pembelajaran dan pengembangan diri siswa.
        </p>
    </div>
</section>

{{-- Grid fasilitas --}}
<section class="py-16 bg-parchment">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        @if($facilities->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($facilities as $facility)
            <div class="sp-card-hover group overflow-hidden">
                {{-- Gambar --}}
                <div class="aspect-video overflow-hidden bg-cobalt-100 relative">
                    @if($facility->image)
                    <img src="{{ Storage::url($facility->image) }}"
                         alt="{{ $facility->name }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                    <div class="w-full h-full flex items-center justify-center">
                        <svg class="w-12 h-12 text-cobalt-200" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    @endif
                    {{-- Gold overlay pada hover --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-cobalt-900/40 to-transparent
                                opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>

                {{-- Info --}}
                <div class="p-5">
                    <div class="sp-mark-sm mb-2">
                        <h3 class="font-display text-base font-bold text-cobalt-800 leading-snug">
                            {{ $facility->name }}
                        </h3>
                    </div>
                    @if($facility->description)
                    <p class="text-sm text-cobalt-500 leading-relaxed">{{ $facility->description }}</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="sp-card py-20 text-center">
            <svg class="w-16 h-16 text-cobalt-200 mx-auto mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
            <p class="text-cobalt-500 font-medium">Data fasilitas belum tersedia.</p>
        </div>
        @endif

    </div>
</section>

@endsection
