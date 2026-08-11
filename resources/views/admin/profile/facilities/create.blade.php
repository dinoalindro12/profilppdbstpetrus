@extends('admin.layouts.app')
@section('title', 'Tambah Fasilitas')

@section('content')
<div class="max-w-2xl space-y-5">

    <div class="flex items-center gap-3">
        <a href="{{ route('admin.profile.facilities.index') }}"
           class="p-1.5 rounded-lg text-cobalt-500 hover:bg-cobalt-50 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
        </a>
        <h2 class="sp-mark font-display text-xl font-bold text-cobalt-800">Tambah Fasilitas</h2>
    </div>

    <div class="sp-card p-6">
        <form action="{{ route('admin.profile.facilities.store') }}" method="POST"
              enctype="multipart/form-data" class="space-y-5">
            @csrf

            @include('admin.profile.facilities._form')

            <div class="flex justify-end gap-3 pt-2 border-t border-slate-100">
                <a href="{{ route('admin.profile.facilities.index') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
