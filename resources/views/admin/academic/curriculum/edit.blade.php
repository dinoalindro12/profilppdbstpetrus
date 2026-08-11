@extends('admin.layouts.app')
@section('title', 'Edit Kurikulum')

@section('content')
<div class="max-w-2xl space-y-5">

    <div class="flex items-center gap-3">
        <a href="{{ route('admin.academic.curriculum.index') }}"
           class="p-1.5 rounded-lg text-cobalt-500 hover:bg-cobalt-50 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
        </a>
        <div>
            <h2 class="sp-mark font-display text-xl font-bold text-cobalt-800">Edit Kurikulum</h2>
            <p class="text-cobalt-500 text-sm mt-0.5">{{ $curriculum->name }}</p>
        </div>
    </div>

    <div class="sp-card p-6">
        <form action="{{ route('admin.academic.curriculum.update', $curriculum->id) }}" method="POST"
              enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-semibold text-cobalt-700 mb-1.5">
                    Nama Kurikulum <span class="text-ember">*</span>
                </label>
                <input type="text" name="name" id="name"
                       value="{{ old('name', $curriculum->name) }}"
                       class="w-full rounded-lg border px-4 py-2.5 text-sm text-ink
                              border-slate-300 bg-white focus:border-cobalt-500 focus:ring-2 focus:ring-cobalt-200
                              @error('name') border-ember ring-2 ring-ember/20 @enderror transition">
                @error('name') <p class="mt-1 text-xs text-ember">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-semibold text-cobalt-700 mb-1.5">Deskripsi</label>
                <textarea name="description" id="description" rows="4"
                          class="w-full rounded-lg border px-4 py-2.5 text-sm text-ink
                                 border-slate-300 bg-white focus:border-cobalt-500 focus:ring-2 focus:ring-cobalt-200 transition">{{ old('description', $curriculum->description) }}</textarea>
            </div>

            <div>
                <label for="file" class="block text-sm font-semibold text-cobalt-700 mb-1.5">File Kurikulum</label>
                @if($curriculum->file)
                <div class="mb-2 flex items-center gap-2 text-sm text-cobalt-600 bg-cobalt-50 px-3 py-2 rounded-lg">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    File saat ini tersedia. Upload file baru untuk mengganti.
                </div>
                @endif
                <input type="file" name="file" id="file" accept=".pdf,.doc,.docx"
                       class="w-full text-sm text-cobalt-600 file:mr-3 file:py-2 file:px-4 file:rounded-lg
                              file:border-0 file:text-sm file:font-semibold file:bg-cobalt-50 file:text-cobalt-700
                              hover:file:bg-cobalt-100 focus:outline-none">
                <p class="mt-1 text-xs text-cobalt-400">Format: PDF, DOC, DOCX — maks. 10MB</p>
                @error('file') <p class="mt-1 text-xs text-ember">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-5">
                <div>
                    <label for="order" class="block text-sm font-semibold text-cobalt-700 mb-1.5">Urutan Tampil</label>
                    <input type="number" name="order" id="order" min="0"
                           value="{{ old('order', $curriculum->order ?? 0) }}"
                           class="w-full rounded-lg border px-4 py-2.5 text-sm border-slate-300 bg-white
                                  focus:border-cobalt-500 focus:ring-2 focus:ring-cobalt-200 transition">
                </div>
                <div class="flex items-end pb-1">
                    <label class="inline-flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1"
                               {{ old('is_active', $curriculum->is_active ?? true) ? 'checked' : '' }}
                               class="w-4 h-4 rounded border-slate-300 text-cobalt-600 focus:ring-cobalt-400">
                        <span class="text-sm font-medium text-cobalt-700">Aktif / Tampilkan</span>
                    </label>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-2 border-t border-slate-100">
                <a href="{{ route('admin.academic.curriculum.index') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
