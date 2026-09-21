@extends('admin.layouts.app')
@section('title', 'Fasilitas Sekolah')

@section('content')
<div class="space-y-5">

    <div class="flex items-center justify-between gap-4 flex-wrap">
        <div>
            <h2 class="sp-mark font-display text-xl font-bold text-cobalt-800">Fasilitas Sekolah</h2>
            <p class="text-cobalt-500 text-sm mt-1">
                Kelola foto dan informasi fasilitas yang tampil di halaman publik.
            </p>
        </div>
        <a href="{{ route('admin.profile.facilities.create') }}" class="btn-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Fasilitas
        </a>
    </div>

    @if($facilities->count())

    {{-- Grid kartu — lebih visual dari tabel untuk konten foto --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
        @foreach($facilities as $facility)
        <div class="sp-card overflow-hidden flex flex-col">

            {{-- Foto --}}
            <div class="relative w-full" style="padding-top: 56.25%">{{-- 16:9 --}}
                <div class="absolute inset-0 bg-cobalt-100">
                    @if($facility->image)
                    <img src="{{ Storage::url($facility->image) }}"
                         alt="{{ $facility->name }}"
                         class="w-full h-full object-cover">
                    @else
                    <div class="w-full h-full flex flex-col items-center justify-center gap-2 text-cobalt-300">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5
                                     m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0
                                     011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        <span class="text-xs">Belum ada foto</span>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Info --}}
            <div class="p-4 flex flex-col flex-1">
                <div class="flex items-start justify-between gap-2 mb-2">
                    <h3 class="font-display text-sm font-bold text-cobalt-800 leading-snug">
                        {{ $facility->name }}
                    </h3>
                    <span class="shrink-0 text-xs px-2 py-0.5 rounded-full font-semibold
                        {{ $facility->is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-cobalt-400' }}">
                        {{ $facility->is_active ? 'Tampil' : 'Sembunyi' }}
                    </span>
                </div>

                @if($facility->description)
                <p class="text-xs text-cobalt-500 leading-relaxed line-clamp-2 flex-1">
                    {{ $facility->description }}
                </p>
                @endif

                {{-- Urutan --}}
                <div class="flex items-center justify-between mt-3 pt-3 border-t border-slate-100">
                    <span class="text-xs text-cobalt-400">Urutan: {{ $facility->order }}</span>

                    <div class="flex items-center gap-1.5">
                        <a href="{{ route('admin.profile.facilities.edit', $facility->id) }}"
                           class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg text-xs font-semibold
                                  bg-cobalt-50 text-cobalt-700 hover:bg-cobalt-100 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5
                                         m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit
                        </a>
                        <form method="POST"
                              action="{{ route('admin.profile.facilities.destroy', $facility->id) }}"
                              onsubmit="return confirm('Hapus fasilitas \'{{ $facility->name }}\'?')">
                            @csrf @method('DELETE')
                            <button type="submit"
                                    class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg text-xs font-semibold
                                           bg-red-50 text-ember hover:bg-red-100 transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7
                                             m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @else
    <div class="sp-card py-16 text-center">
        <svg class="w-12 h-12 text-cobalt-200 mx-auto mb-3" fill="none" stroke="currentColor"
             stroke-width="1.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5
                     M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
        </svg>
        <p class="text-cobalt-500 font-medium">Belum ada fasilitas yang ditambahkan.</p>
        <a href="{{ route('admin.profile.facilities.create') }}" class="btn-primary mt-4 inline-flex">
            Tambah fasilitas pertama
        </a>
    </div>
    @endif

</div>
@endsection
