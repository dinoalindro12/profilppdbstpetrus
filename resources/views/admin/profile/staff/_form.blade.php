{{-- Partial form: dipakai oleh create.blade.php dan edit.blade.php --}}
{{-- Variable $staff tersedia saat edit, undefined saat create --}}

@php $s = $staff ?? null; @endphp

<div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

    {{-- Nama --}}
    <div class="sm:col-span-2">
        <label for="name" class="block text-sm font-semibold text-cobalt-700 mb-1.5">
            Nama Lengkap <span class="text-ember">*</span>
        </label>
        <input type="text" name="name" id="name"
               value="{{ old('name', $s?->name) }}"
               placeholder="mis. Sr. Maria Goretti, S.Pd."
               class="w-full rounded-lg border px-4 py-2.5 text-sm text-ink
                      border-slate-300 bg-white placeholder:text-cobalt-300
                      focus:border-cobalt-500 focus:ring-2 focus:ring-cobalt-200
                      @error('name') border-ember ring-2 ring-ember/20 @enderror transition">
        @error('name')
            <p class="mt-1 text-xs text-ember">{{ $message }}</p>
        @enderror
    </div>

    {{-- Jabatan --}}
    <div>
        <label for="position" class="block text-sm font-semibold text-cobalt-700 mb-1.5">
            Jabatan <span class="text-ember">*</span>
        </label>
        <input type="text" name="position" id="position"
               value="{{ old('position', $s?->position) }}"
               placeholder="mis. Guru Matematika"
               class="w-full rounded-lg border px-4 py-2.5 text-sm text-ink
                      border-slate-300 bg-white placeholder:text-cobalt-300
                      focus:border-cobalt-500 focus:ring-2 focus:ring-cobalt-200
                      @error('position') border-ember ring-2 ring-ember/20 @enderror transition">
        @error('position')
            <p class="mt-1 text-xs text-ember">{{ $message }}</p>
        @enderror
    </div>

    {{-- Tipe --}}
    <div>
        <label for="type" class="block text-sm font-semibold text-cobalt-700 mb-1.5">
            Tipe <span class="text-ember">*</span>
        </label>
        <select name="type" id="type"
                class="w-full rounded-lg border px-4 py-2.5 text-sm text-ink
                       border-slate-300 bg-white
                       focus:border-cobalt-500 focus:ring-2 focus:ring-cobalt-200
                       @error('type') border-ember ring-2 ring-ember/20 @enderror transition">
            <option value="teacher" {{ old('type', $s?->type) === 'teacher' ? 'selected' : '' }}>Guru</option>
            <option value="staff"   {{ old('type', $s?->type) === 'staff'   ? 'selected' : '' }}>Staf Administrasi</option>
        </select>
        @error('type')
            <p class="mt-1 text-xs text-ember">{{ $message }}</p>
        @enderror
    </div>

    {{-- NIP --}}
    <div>
        <label for="nip" class="block text-sm font-semibold text-cobalt-700 mb-1.5">NIP</label>
        <input type="text" name="nip" id="nip"
               value="{{ old('nip', $s?->nip) }}"
               placeholder="Nomor Induk Pegawai"
               class="w-full rounded-lg border px-4 py-2.5 text-sm text-ink font-mono
                      border-slate-300 bg-white placeholder:text-cobalt-300
                      focus:border-cobalt-500 focus:ring-2 focus:ring-cobalt-200 transition">
    </div>

    {{-- Urutan tampil --}}
    <div>
        <label for="order" class="block text-sm font-semibold text-cobalt-700 mb-1.5">
            Urutan Tampil
        </label>
        <input type="number" name="order" id="order" min="0"
               value="{{ old('order', $s?->order ?? 0) }}"
               class="w-full rounded-lg border px-4 py-2.5 text-sm text-ink
                      border-slate-300 bg-white
                      focus:border-cobalt-500 focus:ring-2 focus:ring-cobalt-200 transition">
        <p class="mt-1 text-xs text-cobalt-400">Angka kecil tampil lebih dulu.</p>
    </div>

    {{-- Foto --}}
    <div class="sm:col-span-2" x-data="{ preview: null }">
        <label class="block text-sm font-semibold text-cobalt-700 mb-1.5">Foto</label>
        <div class="flex items-start gap-4">
            {{-- Preview foto lama (saat edit) --}}
            @if($s?->photo)
            <div class="shrink-0">
                <img src="{{ Storage::url($s->photo) }}" alt="{{ $s->name }}"
                     class="w-16 h-16 rounded-full object-cover border-2 border-slate-200">
                <p class="text-xs text-cobalt-400 mt-1 text-center">Saat ini</p>
            </div>
            @endif
            <div class="flex-1">
                <input type="file" name="photo" id="photo" accept="image/*"
                       @change="preview = URL.createObjectURL($event.target.files[0])"
                       class="w-full text-sm text-cobalt-600 file:mr-3 file:py-2 file:px-4
                              file:rounded-lg file:border-0 file:text-sm file:font-semibold
                              file:bg-cobalt-50 file:text-cobalt-700 hover:file:bg-cobalt-100
                              focus:outline-none">
                <p class="text-xs text-cobalt-400 mt-1">JPG, PNG, GIF — maks. 2MB</p>
                {{-- Preview foto baru --}}
                <template x-if="preview">
                    <img :src="preview" class="mt-2 w-16 h-16 rounded-full object-cover border-2 border-gold-300">
                </template>
            </div>
        </div>
        @error('photo')
            <p class="mt-1 text-xs text-ember">{{ $message }}</p>
        @enderror
    </div>

    {{-- Deskripsi --}}
    <div class="sm:col-span-2">
        <label for="description" class="block text-sm font-semibold text-cobalt-700 mb-1.5">
            Deskripsi / Bidang Studi
        </label>
        <textarea name="description" id="description" rows="3"
                  placeholder="Pendidikan terakhir, bidang studi, atau catatan singkat."
                  class="w-full rounded-lg border px-4 py-2.5 text-sm text-ink
                         border-slate-300 bg-white placeholder:text-cobalt-300
                         focus:border-cobalt-500 focus:ring-2 focus:ring-cobalt-200 transition">{{ old('description', $s?->description) }}</textarea>
    </div>

    {{-- Status aktif --}}
    <div class="sm:col-span-2">
        <label class="inline-flex items-center gap-2.5 cursor-pointer select-none">
            <input type="checkbox" name="is_active" value="1"
                   {{ old('is_active', $s?->is_active ?? true) ? 'checked' : '' }}
                   class="w-4 h-4 rounded border-slate-300 text-cobalt-600 focus:ring-cobalt-400">
            <span class="text-sm font-medium text-cobalt-700">Tampilkan di halaman publik (status aktif)</span>
        </label>
    </div>

</div>
