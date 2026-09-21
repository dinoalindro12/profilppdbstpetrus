{{-- Partial form sambutan kepsek --}}
@php $s = $sambutan ?? null; @endphp

<div class="sp-card p-5 space-y-5">

    {{-- Judul --}}
    <div>
        <label for="title" class="block text-sm font-semibold text-cobalt-700 mb-1.5">
            Judul Sambutan <span class="text-ember">*</span>
        </label>
        <input type="text" name="title" id="title"
               value="{{ old('title', $s?->title) }}"
               placeholder="mis. Sambutan Tahun Ajaran 2025/2026"
               class="w-full rounded-lg border px-4 py-2.5 text-sm text-ink
                      border-slate-300 bg-white placeholder:text-cobalt-300
                      focus:border-cobalt-500 focus:ring-2 focus:ring-cobalt-200
                      @error('title') border-ember ring-2 ring-ember/20 @enderror transition">
        @error('title') <p class="mt-1 text-xs text-ember">{{ $message }}</p> @enderror
    </div>

    {{-- Nama Kepala Sekolah --}}
    <div>
        <label for="nama_kepsek" class="block text-sm font-semibold text-cobalt-700 mb-1.5">
            Nama Kepala Sekolah <span class="text-ember">*</span>
        </label>
        <input type="text" name="nama_kepsek" id="nama_kepsek"
               value="{{ old('nama_kepsek', $s?->nama_kepsek) }}"
               placeholder="mis. Rm. Antonius Widodo, S.Pd., M.M."
               class="w-full rounded-lg border px-4 py-2.5 text-sm text-ink
                      border-slate-300 bg-white placeholder:text-cobalt-300
                      focus:border-cobalt-500 focus:ring-2 focus:ring-cobalt-200
                      @error('nama_kepsek') border-ember ring-2 ring-ember/20 @enderror transition">
        @error('nama_kepsek') <p class="mt-1 text-xs text-ember">{{ $message }}</p> @enderror
    </div>

    {{-- Isi sambutan --}}
    <div>
        <label for="content" class="block text-sm font-semibold text-cobalt-700 mb-1.5">
            Isi Sambutan <span class="text-ember">*</span>
        </label>
        <textarea name="content" id="content" rows="8"
                  placeholder="Tulis isi sambutan di sini..."
                  class="w-full rounded-lg border px-4 py-2.5 text-sm text-ink
                         border-slate-300 bg-white placeholder:text-cobalt-300
                         focus:border-cobalt-500 focus:ring-2 focus:ring-cobalt-200
                         @error('content') border-ember ring-2 ring-ember/20 @enderror transition">{{ old('content', $s?->content) }}</textarea>
        <p class="mt-1 text-xs text-cobalt-400">
            Teks ini tampil di halaman beranda pada bagian kartu sambutan kepala sekolah.
        </p>
        @error('content') <p class="mt-1 text-xs text-ember">{{ $message }}</p> @enderror
    </div>
</div>

{{-- Foto kepala sekolah --}}
<div class="sp-card p-5 space-y-4" x-data="{ preview: null }">
    <h3 class="sp-mark-sm text-sm font-bold text-cobalt-700 uppercase tracking-wider">Foto Kepala Sekolah</h3>

    <div class="flex items-start gap-5">
        {{-- Preview foto saat ini (edit) --}}
        @if($s?->image)
        <div class="shrink-0 text-center">
            <img src="{{ asset('storage/'.$s->image) }}" alt="{{ $s->nama_kepsek }}"
                 class="w-24 h-24 rounded-full object-cover border-2 border-cobalt-200">
            <p class="text-xs text-cobalt-400 mt-1">Foto saat ini</p>
        </div>
        @endif

        <div class="flex-1 space-y-2">
            {{-- Preview foto baru --}}
            <template x-if="preview">
                <div class="flex items-center gap-3 mb-2">
                    <img :src="preview" class="w-20 h-20 rounded-full object-cover border-2 border-gold-300">
                    <p class="text-xs text-cobalt-500">Preview foto baru</p>
                </div>
            </template>

            <input type="file" name="image" accept="image/jpeg,image/png,image/jpg,image/webp"
                   @change="preview = URL.createObjectURL($event.target.files[0])"
                   class="w-full text-sm text-cobalt-600
                          file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0
                          file:text-sm file:font-semibold file:bg-cobalt-50 file:text-cobalt-700
                          hover:file:bg-cobalt-100 focus:outline-none">
            <p class="text-xs text-cobalt-400">JPG, PNG, WebP — maks. 3MB. Foto akan ditampilkan bulat di beranda.</p>
            @error('image') <p class="text-xs text-ember">{{ $message }}</p> @enderror
        </div>
    </div>
</div>
