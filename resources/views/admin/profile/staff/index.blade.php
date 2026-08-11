@extends('admin.layouts.app')
@section('title', 'Guru & Staf')

@section('content')
<div class="space-y-5">

    {{-- Header + tombol tambah --}}
    <div class="flex items-center justify-between gap-4 flex-wrap">
        <div>
            <h2 class="sp-mark font-display text-xl font-bold text-cobalt-800">Guru & Staf</h2>
            <p class="text-cobalt-500 text-sm mt-1">Kelola data tenaga pengajar dan staf administrasi sekolah.</p>
        </div>
        <a href="{{ route('admin.profile.staff.create') }}" class="btn-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Guru/Staf
        </a>
    </div>

    {{-- Filter tab: Semua | Guru | Staf --}}
    <div class="flex gap-1 border-b border-slate-200">
        @foreach([['all','Semua'],['teacher','Guru'],['staff','Staf']] as [$val,$label])
        <a href="{{ request()->fullUrlWithQuery(['type' => $val]) }}"
           class="px-4 py-2.5 text-sm font-medium border-b-2 transition-colors -mb-px
                  {{ (request('type',$val==='all'?null:'x') === ($val==='all'?null:$val)) || (!request('type') && $val==='all')
                     ? 'border-gold-500 text-cobalt-800' : 'border-transparent text-cobalt-500 hover:text-cobalt-700' }}">
            {{ $label }}
            @if($val === 'all')
                <span class="ml-1 text-xs bg-slate-100 text-cobalt-500 px-1.5 py-0.5 rounded-full">{{ $staff->count() }}</span>
            @endif
        </a>
        @endforeach
    </div>

    {{-- Tabel --}}
    <div class="sp-card overflow-hidden">
        @if($staff->count())
        <div class="overflow-x-auto">
            <table class="sp-table">
                <thead>
                    <tr>
                        <th class="w-10">No</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Tipe</th>
                        <th>NIP</th>
                        <th>Status</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($staff as $i => $s)
                    <tr>
                        <td class="text-cobalt-400">{{ $i + 1 }}</td>
                        <td>
                            <div class="flex items-center gap-3">
                                @if($s->photo)
                                <img src="{{ Storage::url($s->photo) }}" alt="{{ $s->name }}"
                                     class="w-9 h-9 rounded-full object-cover border border-slate-200 shrink-0">
                                @else
                                <div class="w-9 h-9 rounded-full bg-cobalt-100 flex items-center justify-center text-cobalt-600 font-bold text-sm shrink-0">
                                    {{ strtoupper(substr($s->name, 0, 1)) }}
                                </div>
                                @endif
                                <span class="font-medium text-cobalt-800">{{ $s->name }}</span>
                            </div>
                        </td>
                        <td class="text-cobalt-600">{{ $s->position }}</td>
                        <td>
                            <span class="text-xs px-2.5 py-1 rounded-full font-semibold
                                {{ $s->type === 'teacher' ? 'bg-cobalt-50 text-cobalt-700' : 'bg-gold-50 text-gold-700' }}">
                                {{ $s->type === 'teacher' ? 'Guru' : 'Staf' }}
                            </span>
                        </td>
                        <td class="font-mono text-xs text-cobalt-500">{{ $s->nip ?: '—' }}</td>
                        <td>
                            <span class="text-xs px-2.5 py-1 rounded-full font-semibold
                                {{ $s->is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-cobalt-400' }}">
                                {{ $s->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td>
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.profile.staff.edit', $s->id) }}"
                                   class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-semibold
                                          bg-cobalt-50 text-cobalt-700 hover:bg-cobalt-100 transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('admin.profile.staff.destroy', $s->id) }}"
                                      onsubmit="return confirm('Hapus {{ $s->name }}? Data tidak bisa dikembalikan.')">
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
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
            <p class="text-cobalt-500 font-medium">Belum ada data guru atau staf.</p>
            <a href="{{ route('admin.profile.staff.create') }}" class="btn-primary mt-4 inline-flex">
                Tambah sekarang
            </a>
        </div>
        @endif
    </div>

</div>
@endsection
