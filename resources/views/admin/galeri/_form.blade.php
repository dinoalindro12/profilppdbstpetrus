{{-- Partial form galeri — dipakai create & edit --}}
@php $g = $galeri ?? null; @endphp

<div class="sp-card p-5 space-y-5">
    <h3 class="sp-mark-sm text-sm font-bold text-cobalt-700 uppercase tracking-wider">Info Album</h3>

    <div class="grid sm:grid-cols-2 gap-5">

        {{-- Judul album --}}
        <div class="sm:col-span-2">
            <label for="title" class="block text-sm font-semibold text-cobalt-700 mb-1.5">
                Judul Album <span class="text-ember">*</span>
            </label>
            <input type="text" name="title" id="title"
                   value="{{ old('title', $g?->title) }}"
                   placeholder="mis. Wisuda Angkatan 2024"
                   class="w-full rounded-lg border px-4 py-2.5 text-sm text-ink
                          border-slate-300 bg-white placeholder:text-cobalt-300
                          focus:border-cobalt-500 focus:ring-2 focus:ring-cobalt-200
                          @error('title') border-ember ring-2 ring-ember/20 @enderror transition">
            @error('title') <p class="mt-1 text-xs text-ember">{{ $message }}</p> @enderror
        </div>

        {{-- Tahun angkatan --}}
        <div>
            <label for="angkatan" class="block text-sm font-semibold text-cobalt-700 mb-1.5">
                Tahun Angkatan <span class="text-ember">*</span>
            </label>
            <input type="number" name="angkatan" id="angkatan"
                   value="{{ old('angkatan', $g?->angkatan ?? date('Y')) }}"
                   min="1975" max="{{ date('Y') + 1 }}"
                   class="w-full rounded-lg border px-4 py-2.5 text-sm text-ink font-mono
                          border-slate-300 bg-white
                          focus:border-cobalt-500 focus:ring-2 focus:ring-cobalt-200
                          @error('angkatan') border-ember ring-2 ring-ember/20 @enderror transition">
            @error('angkatan') <p class="mt-1 text-xs text-ember">{{ $message }}</p> @enderror
            <p class="mt-1 text-xs text-cobalt-400">Tahun kelulusan angkatan ini.</p>
        </div>

        {{-- Status --}}
        <div class="flex items-end pb-1">
            <label class="inline-flex items-center gap-2.5 cursor-pointer select-none">
                <input type="checkbox" name="is_published" value="1"
                       {{ old('is_published', $g?->is_published ?? true) ? 'checked' : '' }}
                       class="w-4 h-4 rounded border-slate-300 text-cobalt-600 focus:ring-cobalt-400">
                <span class="text-sm font-medium text-cobalt-700">Tampilkan di halaman publik</span>
            </label>
        </div>

        {{-- Deskripsi --}}
        <div class="sm:col-span-2">
            <label for="deskripsi" class="block text-sm font-semibold text-cobalt-700 mb-1.5">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="2"
                      placeholder="Catatan singkat tentang angkatan ini (opsional)."
                      class="w-full rounded-lg border px-4 py-2.5 text-sm text-ink
                             border-slate-300 bg-white placeholder:text-cobalt-300
                             focus:border-cobalt-500 focus:ring-2 focus:ring-cobalt-200 transition">{{ old('deskripsi', $g?->deskripsi) }}</textarea>
        </div>
    </div>
</div>

{{-- Cover image --}}
<div class="sp-card p-5 space-y-3" x-data="{ preview: null }">
    <h3 class="sp-mark-sm text-sm font-bold text-cobalt-700 uppercase tracking-wider">Foto Cover Album</h3>

    @if($g?->cover_image)
    <div>
        <img src="{{ asset('storage/' . $g->cover_image) }}" alt="Cover saat ini"
             class="w-full max-h-48 object-cover rounded-lg border border-slate-200">
        <p class="text-xs text-cobalt-400 mt-1">Cover saat ini. Upload baru untuk mengganti.</p>
    </div>
    @endif

    <template x-if="preview">
        <img :src="preview" class="w-full max-h-48 object-cover rounded-lg">
    </template>

    <input type="file" name="cover_image" accept="image/jpeg,image/png,image/webp"
           @change="preview = URL.createObjectURL($event.target.files[0])"
           class="w-full text-sm text-cobalt-600
                  file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0
                  file:text-sm file:font-semibold file:bg-cobalt-50 file:text-cobalt-700
                  hover:file:bg-cobalt-100 focus:outline-none">
    <p class="text-xs text-cobalt-400">JPG, PNG, WebP — maks. 3MB. Tampil sebagai thumbnail album.</p>
    @error('cover_image') <p class="text-xs text-ember">{{ $message }}</p> @enderror
</div>

{{-- Upload foto-foto --}}
<div class="sp-card p-5 space-y-4" x-data="{ previews: [] }">
    <h3 class="sp-mark-sm text-sm font-bold text-cobalt-700 uppercase tracking-wider">
        Upload Foto
        <span class="text-cobalt-400 font-normal normal-case ml-1">(bisa pilih banyak sekaligus)</span>
    </h3>

    <input type="file" name="fotos[]" accept="image/jpeg,image/png,image/webp"
           multiple
           @change="previews = Array.from($event.target.files).map(f => URL.createObjectURL(f))"
           class="w-full text-sm text-cobalt-600
                  file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0
                  file:text-sm file:font-semibold file:bg-cobalt-50 file:text-cobalt-700
                  hover:file:bg-cobalt-100 focus:outline-none">
    <p class="text-xs text-cobalt-400">JPG, PNG, WebP — maks. 3MB per foto.</p>
    @error('fotos') <p class="text-xs text-ember">{{ $message }}</p> @enderror
    @error('fotos.*') <p class="text-xs text-ember">{{ $message }}</p> @enderror

    {{-- Preview grid foto yang dipilih --}}
    <template x-if="previews.length > 0">
        <div>
            <p class="text-xs font-semibold text-cobalt-500 uppercase tracking-wider mb-2">
                Preview (<span x-text="previews.length"></span> foto dipilih)
            </p>
            <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-2">
                <template x-for="(src, i) in previews" :key="i">
                    <div class="aspect-square rounded-lg overflow-hidden border border-slate-200 bg-slate-100">
                        <img :src="src" class="w-full h-full object-cover">
                    </div>
                </template>
            </div>
        </div>
    </template>
</div>
