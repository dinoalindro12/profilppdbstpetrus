@extends('admin.layouts.app')
@section('title', 'Edit Pendaftaran')

@section('content')
<div class="max-w-3xl space-y-5">

    <div class="flex items-center gap-3">
        <a href="{{ route('admin.ppdb.registration.show', $registration->id) }}"
           class="p-1.5 rounded-lg text-cobalt-500 hover:bg-cobalt-50 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
        </a>
        <div>
            <h2 class="sp-mark font-display text-xl font-bold text-cobalt-800">Edit Data Pendaftar</h2>
            <p class="text-cobalt-500 text-sm mt-0.5">
                No. <code class="font-mono">{{ $registration->registration_number }}</code>
                — {{ $registration->full_name }}
            </p>
        </div>
    </div>

    <form action="{{ route('admin.ppdb.registration.update', $registration->id) }}" method="POST"
          enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')

        {{-- Status --}}
        <div class="sp-card p-5">
            <h3 class="sp-mark-sm text-sm font-bold text-cobalt-700 uppercase tracking-wider mb-4">Status Pendaftaran</h3>
            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <label for="status" class="block text-sm font-semibold text-cobalt-700 mb-1.5">Status</label>
                    <select name="status" id="status"
                            class="w-full rounded-lg border px-4 py-2.5 text-sm border-slate-300 bg-white
                                   focus:border-cobalt-500 focus:ring-2 focus:ring-cobalt-200 transition">
                        @foreach(['pending' => 'Menunggu Review', 'approved' => 'Diterima', 'rejected' => 'Ditolak'] as $val => $label)
                        <option value="{{ $val }}" {{ old('status', $registration->status) === $val ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="notes" class="block text-sm font-semibold text-cobalt-700 mb-1.5">Catatan Admin</label>
                    <textarea name="notes" id="notes" rows="2"
                              placeholder="Catatan untuk calon siswa (opsional)"
                              class="w-full rounded-lg border px-4 py-2.5 text-sm border-slate-300 bg-white
                                     placeholder:text-cobalt-300 focus:border-cobalt-500 focus:ring-2 focus:ring-cobalt-200 transition">{{ old('notes', $registration->notes) }}</textarea>
                </div>
                <div>
                    <label for="ppdb_info_id" class="block text-sm font-semibold text-cobalt-700 mb-1.5">Tahun Ajaran PPDB</label>
                    <select name="ppdb_info_id" id="ppdb_info_id"
                            class="w-full rounded-lg border px-4 py-2.5 text-sm border-slate-300 bg-white
                                   focus:border-cobalt-500 focus:ring-2 focus:ring-cobalt-200 transition">
                        @foreach($ppdbInfos as $info)
                        <option value="{{ $info->id }}" {{ old('ppdb_info_id', $registration->ppdb_info_id) == $info->id ? 'selected' : '' }}>
                            {{ $info->academic_year }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        {{-- Data calon siswa --}}
        <div class="sp-card p-5">
            <h3 class="sp-mark-sm text-sm font-bold text-cobalt-700 uppercase tracking-wider mb-4">Data Calon Siswa</h3>
            <div class="grid sm:grid-cols-2 gap-4">

                @php
                    $fields = [
                        ['name' => 'full_name',       'label' => 'Nama Lengkap',    'type' => 'text',  'required' => true],
                        ['name' => 'birth_place',     'label' => 'Tempat Lahir',    'type' => 'text',  'required' => true],
                        ['name' => 'birth_date',      'label' => 'Tanggal Lahir',   'type' => 'date',  'required' => true],
                        ['name' => 'phone',           'label' => 'No. Telepon',     'type' => 'text',  'required' => true],
                        ['name' => 'previous_school', 'label' => 'Asal Sekolah',    'type' => 'text',  'required' => true],
                    ];
                @endphp

                @foreach($fields as $f)
                <div>
                    <label for="{{ $f['name'] }}" class="block text-sm font-semibold text-cobalt-700 mb-1.5">
                        {{ $f['label'] }} @if($f['required'])<span class="text-ember">*</span>@endif
                    </label>
                    <input type="{{ $f['type'] }}" name="{{ $f['name'] }}" id="{{ $f['name'] }}"
                           value="{{ old($f['name'], $registration->{$f['name']} instanceof \Carbon\Carbon ? $registration->{$f['name']}->format('Y-m-d') : $registration->{$f['name']}) }}"
                           class="w-full rounded-lg border px-4 py-2.5 text-sm border-slate-300 bg-white
                                  focus:border-cobalt-500 focus:ring-2 focus:ring-cobalt-200 transition">
                </div>
                @endforeach

                <div>
                    <label for="gender" class="block text-sm font-semibold text-cobalt-700 mb-1.5">Jenis Kelamin <span class="text-ember">*</span></label>
                    <select name="gender" id="gender"
                            class="w-full rounded-lg border px-4 py-2.5 text-sm border-slate-300 bg-white
                                   focus:border-cobalt-500 focus:ring-2 focus:ring-cobalt-200 transition">
                        <option value="L" {{ old('gender', $registration->gender) === 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('gender', $registration->gender) === 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <div class="sm:col-span-2">
                    <label for="address" class="block text-sm font-semibold text-cobalt-700 mb-1.5">Alamat Lengkap <span class="text-ember">*</span></label>
                    <textarea name="address" id="address" rows="2"
                              class="w-full rounded-lg border px-4 py-2.5 text-sm border-slate-300 bg-white
                                     focus:border-cobalt-500 focus:ring-2 focus:ring-cobalt-200 transition">{{ old('address', $registration->address) }}</textarea>
                </div>
            </div>
        </div>

        {{-- Data orang tua --}}
        <div class="sp-card p-5">
            <h3 class="sp-mark-sm text-sm font-bold text-cobalt-700 uppercase tracking-wider mb-4">Data Orang Tua</h3>
            <div class="grid sm:grid-cols-2 gap-4">
                @foreach([
                    ['name' => 'father_name',  'label' => 'Nama Ayah',       'required' => true],
                    ['name' => 'father_phone', 'label' => 'No. HP Ayah',     'required' => false],
                    ['name' => 'mother_name',  'label' => 'Nama Ibu',        'required' => true],
                    ['name' => 'mother_phone', 'label' => 'No. HP Ibu',      'required' => false],
                ] as $f)
                <div>
                    <label for="{{ $f['name'] }}" class="block text-sm font-semibold text-cobalt-700 mb-1.5">
                        {{ $f['label'] }} @if($f['required'])<span class="text-ember">*</span>@endif
                    </label>
                    <input type="text" name="{{ $f['name'] }}" id="{{ $f['name'] }}"
                           value="{{ old($f['name'], $registration->{$f['name']}) }}"
                           class="w-full rounded-lg border px-4 py-2.5 text-sm border-slate-300 bg-white
                                  focus:border-cobalt-500 focus:ring-2 focus:ring-cobalt-200 transition">
                </div>
                @endforeach
            </div>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('admin.ppdb.registration.show', $registration->id) }}" class="btn-secondary">Batal</a>
            <button type="submit" class="btn-primary">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
