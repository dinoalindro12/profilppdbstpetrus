@extends('admin.layouts.app')
@section('title', 'Edit — ' . $galeriKegiatan->judul)

@section('content')
<div class="max-w-3xl space-y-5">

    <div class="flex items-center gap-3">
        <a href="{{ route('admin.galeri-kegiatan.index') }}"
           class="p-1.5 rounded-lg text-cobalt-500 hover:bg-cobalt-50 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
        </a>
        <div>
            <h2 class="sp-mark font-display text-xl font-bold text-cobalt-800">Edit Album Kegiatan</h2>
            <p class="text-cobalt-500 text-sm mt-0.5">
                {{ $galeriKegiatan->judul }} — {{ $galeriKegiatan->tanggal->translatedFormat('d F Y') }}
            </p>
        </div>
    </div>

    <form action="{{ route('admin.galeri-kegiatan.update', $galeriKegiatan->id) }}" method="POST"
          enctype="multipart/form-data" class="space-y-5">
        @csrf @method('PUT')
        @include('admin.galeri_kegiatan._form', ['galeriKegiatan' => $galeriKegiatan])

        {{-- Foto yang sudah ada --}}
        @if($galeriKegiatan->fotos->count())
        <div class="sp-card p-5">
            <h3 class="sp-mark-sm text-sm font-bold text-cobalt-700 uppercase tracking-wider mb-4">
                Foto dalam Album ({{ $galeriKegiatan->fotos->count() }})
            </h3>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                @foreach($galeriKegiatan->fotos as $foto)
                <div class="group relative rounded-lg overflow-hidden border border-slate-200 aspect-square bg-slate-100">
                    <img src="{{ asset('storage/'.$foto->foto) }}" alt="{{ $foto->keterangan }}"
                         class="w-full h-full object-cover">
                    @if($foto->keterangan)
                    <div class="absolute bottom-0 inset-x-0 bg-cobalt-900/70 px-2 py-1">
                        <p class="text-white text-xs truncate">{{ $foto->keterangan }}</p>
                    </div>
                    @endif
                    <form method="POST" action="{{ route('admin.galeri-kegiatan.foto.destroy', $foto->id) }}"
                          class="absolute top-1.5 right-1.5 opacity-0 group-hover:opacity-100 transition-opacity"
                          onsubmit="return confirm('Hapus foto ini?')">
                        @csrf @method('DELETE')
                        <button type="submit"
                                class="w-7 h-7 rounded-full bg-white/90 text-ember hover:bg-red-50 flex items-center justify-center shadow">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <div class="flex justify-end gap-3">
            <a href="{{ route('admin.galeri-kegiatan.index') }}" class="btn-secondary">Batal</a>
            <button type="submit" class="btn-primary">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
