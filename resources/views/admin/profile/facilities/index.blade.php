@extends('admin.layouts.app')
@section('title', 'Fasilitas Sekolah')

@section('content')
<div class="space-y-5">

    <div class="flex items-center justify-between gap-4 flex-wrap">
        <div>
            <h2 class="sp-mark font-display text-xl font-bold text-cobalt-800">Fasilitas Sekolah</h2>
            <p class="text-cobalt-500 text-sm mt-1">Kelola informasi fasilitas yang ditampilkan di halaman publik.</p>
        </div>
        <a href="{{ route('admin.profile.facilities.create') }}" class="btn-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Fasilitas
        </a>
    </div>

    <div class="sp-card overflow-hidden">
        @if($facilities->count())
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-0 divide-y sm:divide-y-0 sm:divide-x divide-slate-100">
            {{-- Header tabel untuk layar besar --}}
        </div>
        <div class="overflow-x-auto">
            <table class="sp-table">
                <thead>
                    <tr>
                        <th class="w-10">No</th>
                        <th>Fasilitas</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($facilities as $i => $facility)
                    <tr>
                        <td class="text-cobalt-400">{{ $i + 1 }}</td>
                        <td>
                            <div class="flex items-center gap-3">
                                @if($facility->image)
                                <img src="{{ Storage::url($facility->image) }}" alt="{{ $facility->name }}"
                                     class="w-12 h-10 object-cover rounded-lg border border-slate-200 shrink-0">
                                @else
                                <div class="w-12 h-10 rounded-lg bg-cobalt-100 flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5 text-cobalt-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                </div>
                                @endif
                                <span class="font-medium text-cobalt-800">{{ $facility->name }}</span>
                            </div>
                        </td>
                        <td class="text-cobalt-500 text-sm max-w-xs">
                            {{ Str::limit($facility->description, 80) ?: '—' }}
                        </td>
                        <td>
                            <span class="text-xs px-2.5 py-1 rounded-full font-semibold
                                {{ $facility->is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-cobalt-400' }}">
                                {{ $facility->is_active ? 'Ditampilkan' : 'Disembunyikan' }}
                            </span>
                        </td>
                        <td>
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.profile.facilities.edit', $facility->id) }}"
                                   class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-semibold
                                          bg-cobalt-50 text-cobalt-700 hover:bg-cobalt-100 transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('admin.profile.facilities.destroy', $facility->id) }}"
                                      onsubmit="return confirm('Hapus fasilitas {{ $facility->name }}?')">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-semibold
                                                   bg-red-50 text-ember hover:bg-red-100 transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="py-16 text-center">
            <svg class="w-12 h-12 text-cobalt-200 mx-auto mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
            <p class="text-cobalt-500 font-medium">Belum ada fasilitas yang ditambahkan.</p>
            <a href="{{ route('admin.profile.facilities.create') }}" class="btn-primary mt-4 inline-flex">
                Tambah fasilitas pertama
            </a>
        </div>
        @endif
    </div>

</div>
@endsection
