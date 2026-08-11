@extends('admin.layouts.app')
@section('title', 'Kurikulum')

@section('content')
<div class="space-y-5">

    <div class="flex items-center justify-between gap-4 flex-wrap">
        <div>
            <h2 class="sp-mark font-display text-xl font-bold text-cobalt-800">Kurikulum</h2>
            <p class="text-cobalt-500 text-sm mt-1">Kelola dokumen dan informasi kurikulum yang berlaku.</p>
        </div>
        <a href="{{ route('admin.academic.curriculum.create') }}" class="btn-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Kurikulum
        </a>
    </div>

    <div class="sp-card overflow-hidden">
        @if($curriculums->count())
        <div class="overflow-x-auto">
            <table class="sp-table">
                <thead>
                    <tr>
                        <th class="w-10">#</th>
                        <th>Nama Kurikulum</th>
                        <th>Dokumen</th>
                        <th>Urutan</th>
                        <th>Status</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($curriculums as $i => $c)
                    <tr>
                        <td class="text-cobalt-400">{{ $i + 1 }}</td>
                        <td>
                            <p class="font-medium text-cobalt-800">{{ $c->name }}</p>
                            @if($c->description)
                            <p class="text-xs text-cobalt-400 mt-0.5 line-clamp-1">{{ Str::limit($c->description, 80) }}</p>
                            @endif
                        </td>
                        <td>
                            @if($c->file)
                            <a href="{{ Storage::url($c->file) }}" target="_blank"
                               class="inline-flex items-center gap-1.5 text-xs font-semibold text-cobalt-600 hover:text-cobalt-800 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Unduh
                            </a>
                            @else
                            <span class="text-xs text-cobalt-300">—</span>
                            @endif
                        </td>
                        <td class="text-cobalt-500 text-sm">{{ $c->order }}</td>
                        <td>
                            <span class="text-xs px-2.5 py-1 rounded-full font-semibold
                                {{ $c->is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-cobalt-400' }}">
                                {{ $c->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td>
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.academic.curriculum.edit', $c->id) }}"
                                   class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-semibold
                                          bg-cobalt-50 text-cobalt-700 hover:bg-cobalt-100 transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('admin.academic.curriculum.destroy', $c->id) }}"
                                      onsubmit="return confirm('Hapus kurikulum \'{{ $c->name }}\'?')">
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
        <div class="py-14 text-center">
            <svg class="w-12 h-12 text-cobalt-200 mx-auto mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
            </svg>
            <p class="text-cobalt-500 font-medium">Belum ada data kurikulum.</p>
            <a href="{{ route('admin.academic.curriculum.create') }}" class="btn-primary mt-4 inline-flex">Tambah sekarang</a>
        </div>
        @endif
    </div>
</div>
@endsection
