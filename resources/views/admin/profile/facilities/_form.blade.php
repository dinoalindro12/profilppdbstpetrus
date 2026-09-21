{{-- Partial form fasilitas — dipakai create & edit --}}
@php $f = $facility ?? null; @endphp

{{-- Nama --}}
<div>
    <label for="name" class="block text-sm font-semibold text-cobalt-700 mb-1.5">
        Nama Fasilitas <span class="text-ember">*</span>
    </label>
    <input type="text" name="name" id="name"
           value="{{ old('name', $f?->name) }}"
           placeholder="mis. Laboratorium Komputer, Perpustakaan, Lapangan Olahraga"
           class="w-full rounded-lg border px-4 py-2.5 text-sm text-ink
                  border-slate-300 bg-white placeholder:text-cobalt-300
                  focus:border-cobalt-500 focus:ring-2 focus:ring-cobalt-200
                  @error('name') border-ember ring-2 ring-ember/20 @enderror transition">
    @error('name') <p class="mt-1 text-xs text-ember">{{ $message }}</p> @enderror
</div>

{{-- Deskripsi --}}
<div>
    <label for="description" class="block text-sm font-semibold text-cobalt-700 mb-1.5">
        Deskripsi
    </label>
    <textarea name="description" id="description" rows="3"
              placeholder="Jelaskan fasilitas ini: kapasitas, kondisi, kegunaan."
              class="w-full rounded-lg border px-4 py-2.5 text-sm text-ink
                     border-slate-300 bg-white placeholder:text-cobalt-300
                     focus:border-cobalt-500 focus:ring-2 focus:ring-cobalt-200 transition">{{ old('description', $f?->description) }}</textarea>
</div>

{{-- Foto --}}
<div x-data="{ preview: null }">
    <label class="block text-sm font-semibold text-cobalt-700 mb-1.5">
        Foto Fasilitas
    </label>

    {{-- Preview foto yang sudah ada (edit) --}}
    @if($f?->image)
    <div class="mb-3 rounded-lg overflow-hidden border border-slate-200 bg-slate-50">
        <img src="{{ Storage::url($f->image) }}"
             alt="{{ $f->name }}"
             class="w-full h-44 object-cover">
        <p class="text-xs text-cobalt-400 px-3 py-2">
            Foto saat ini. Upload baru di bawah untuk mengganti.
        </p>
    </div>
    @endif

    {{-- Preview foto yang baru dipilih --}}
    <template x-if="preview">
        <div class="mb-3 rounded-lg overflow-hidden border border-gold-300 bg-slate-50">
            <img :src="preview" class="w-full h-44 object-cover">
            <p class="text-xs text-cobalt-400 px-3 py-2">Preview foto baru</p>
        </div>
    </template>

    <input type="file" name="image" id="image"
           accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
           @change="preview = URL.createObjectURL($event.target.files[0])"
           class="w-full text-sm text-cobalt-600
                  file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0
                  file:text-sm file:font-semibold file:bg-cobalt-50 file:text-cobalt-700
                  hover:file:bg-cobalt-100 focus:outline-none cursor-pointer">
    <p class="mt-1.5 text-xs text-cobalt-400">JPG, PNG, GIF, WebP — maks. 2MB</p>
    @error('image') <p class="mt-1 text-xs text-ember">{{ $message }}</p> @enderror
</div>

{{-- Urutan & status --}}
<div class="grid grid-cols-2 gap-5">
    <div>
        <label for="order" class="block text-sm font-semibold text-cobalt-700 mb-1.5">
            Urutan Tampil
        </label>
        <input type="number" name="order" id="order" min="0"
               value="{{ old('order', $f?->order ?? 0) }}"
               class="w-full rounded-lg border px-4 py-2.5 text-sm text-ink
                      border-slate-300 bg-white
                      focus:border-cobalt-500 focus:ring-2 focus:ring-cobalt-200 transition">
        <p class="mt-1 text-xs text-cobalt-400">Angka kecil tampil lebih dulu.</p>
    </div>

    <div class="flex items-end pb-1">
        <label class="inline-flex items-center gap-2.5 cursor-pointer select-none">
            <input type="checkbox" name="is_active" value="1"
                   {{ old('is_active', $f?->is_active ?? true) ? 'checked' : '' }}
                   class="w-4 h-4 rounded border-slate-300 text-cobalt-600 focus:ring-cobalt-400">
            <span class="text-sm font-medium text-cobalt-700">
                Tampilkan di halaman publik
            </span>
        </label>
    </div>
</div>
