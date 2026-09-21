@extends('admin.layouts.app')
@section('title', 'Tambah Album Kegiatan')

@section('content')
<div class="max-w-3xl space-y-5">

    <div class="flex items-center gap-3">
        <a href="{{ route('admin.galeri-kegiatan.index') }}"
           class="p-1.5 rounded-lg text-cobalt-500 hover:bg-cobalt-50 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
        </a>
        <h2 class="sp-mark font-display text-xl font-bold text-cobalt-800">Tambah Album Kegiatan</h2>
    </div>

    <form action="{{ route('admin.galeri-kegiatan.store') }}" method="POST"
          enctype="multipart/form-data" class="space-y-5">
        @csrf
        @include('admin.galeri_kegiatan._form')
        <div class="flex justify-end gap-3">
            <a href="{{ route('admin.galeri-kegiatan.index') }}" class="btn-secondary">Batal</a>
            <button type="submit" class="btn-primary">Simpan Album</button>
        </div>
    </form>
</div>
@endsection
