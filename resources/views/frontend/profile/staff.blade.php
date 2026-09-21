@extends('frontend.layouts.app')
@section('title', 'Staf Administrasi — SMAS St. Petrus')
@section('description', 'Daftar staf administrasi dan pendukung SMAS St. Petrus Pontianak.')

@section('content')

{{-- Hero --}}
<section class="bg-cobalt-700 pt-14 pb-10">
    <div class="h-1 bg-gradient-to-r from-gold-600 via-gold-400 to-gold-600 -mt-14 mb-14"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs text-cobalt-300 mb-4">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a>
            <span>/</span>
            <span class="text-white">Staf</span>
        </nav>
        <p class="text-gold-400 text-sm font-semibold tracking-widest uppercase mb-2">Tenaga Kependidikan</p>
        <h1 class="font-display text-display-lg text-white">Staf Administrasi</h1>
        <p class="text-cobalt-200 mt-3 text-base max-w-lg">
            Tim staf yang mendukung kelancaran operasional sekolah setiap harinya.
        </p>
    </div>
</section>

{{-- Grid staf --}}
<section class="py-16 bg-parchment">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        @if($staff->count())
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 md:gap-5">
            @foreach($staff as $person)

            <div class="group bg-white rounded-xl border border-slate-200 shadow-card
                        hover:shadow-card-md hover:-translate-y-0.5 transition-all duration-200
                        overflow-hidden flex flex-col">

                {{-- Foto --}}
                <div class="relative w-full" style="padding-top: 133.33%">
                    <div class="absolute inset-0 bg-slate-100">
                        @if($person->photo)
                        <img src="{{ Storage::url($person->photo) }}"
                             alt="{{ $person->name }}"
                             class="w-full h-full object-cover object-top
                                    group-hover:scale-105 transition-transform duration-500">
                        @else
                        <div class="w-full h-full flex items-center justify-center bg-cobalt-50">
                            <svg class="w-14 h-14 text-cobalt-200" fill="none" stroke="currentColor"
                                 stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        @endif
                        <div class="absolute bottom-0 inset-x-0 h-0.5
                                    bg-gradient-to-r from-gold-600 to-gold-400
                                    scale-x-0 group-hover:scale-x-100
                                    transition-transform duration-300 origin-left"></div>
                    </div>
                </div>

                {{-- Info --}}
                <div class="p-3 text-center flex flex-col gap-0.5">
                    <h3 class="font-display text-xs sm:text-sm font-bold text-cobalt-800 leading-snug">
                        {{ $person->name }}
                    </h3>
                    <p class="text-[0.65rem] sm:text-xs text-cobalt-500 font-semibold">
                        {{ $person->position }}
                    </p>
                    @if($person->nip)
                    <p class="text-[0.6rem] text-cobalt-400 font-mono truncate">
                        {{ $person->nip }}
                    </p>
                    @endif
                    @if($person->description)
                    <p class="text-[0.65rem] sm:text-xs text-cobalt-500 leading-relaxed line-clamp-2 mt-1">
                        {{ $person->description }}
                    </p>
                    @endif
                </div>
            </div>

            @endforeach
        </div>
        @else
        <div class="bg-white rounded-xl border border-slate-200 py-20 text-center">
            <svg class="w-14 h-14 text-cobalt-200 mx-auto mb-3" fill="none" stroke="currentColor"
                 stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857
                         M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857
                         m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <p class="text-cobalt-500 font-medium">Data staf belum tersedia.</p>
        </div>
        @endif

    </div>
</section>

@endsection
