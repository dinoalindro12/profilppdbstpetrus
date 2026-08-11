@extends('admin.layouts.app')
@section('title', 'Detail Pesan')

@section('content')
<div class="max-w-2xl space-y-5">

    <div class="flex items-center gap-3">
        <a href="{{ route('admin.kontak.index') }}"
           class="p-1.5 rounded-lg text-cobalt-500 hover:bg-cobalt-50 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
        </a>
        <h2 class="sp-mark font-display text-xl font-bold text-cobalt-800">Detail Pesan</h2>
    </div>

    <div class="sp-card p-6 space-y-5">

        {{-- Meta pengirim --}}
        <div class="grid sm:grid-cols-2 gap-4 pb-5 border-b border-slate-100">
            <div>
                <p class="text-xs font-semibold text-cobalt-400 uppercase tracking-wider mb-1">Nama Pengirim</p>
                <p class="font-semibold text-cobalt-800">{{ $kontak->name }}</p>
            </div>
            <div>
                <p class="text-xs font-semibold text-cobalt-400 uppercase tracking-wider mb-1">Email</p>
                <a href="mailto:{{ $kontak->email }}" class="text-cobalt-600 hover:text-cobalt-800 underline underline-offset-2 text-sm">
                    {{ $kontak->email }}
                </a>
            </div>
            <div>
                <p class="text-xs font-semibold text-cobalt-400 uppercase tracking-wider mb-1">Tujuan</p>
                <span class="text-xs px-2.5 py-1 rounded-full bg-cobalt-50 text-cobalt-700 font-semibold">
                    {{ $kontak->tujuan }}
                </span>
            </div>
            <div>
                <p class="text-xs font-semibold text-cobalt-400 uppercase tracking-wider mb-1">Dikirim</p>
                <p class="text-sm text-cobalt-700">{{ $kontak->created_at->translatedFormat('d F Y, H:i') }}</p>
            </div>
            <div>
                <p class="text-xs font-semibold text-cobalt-400 uppercase tracking-wider mb-1">IP Address</p>
                <code class="text-xs bg-slate-100 text-cobalt-600 px-2 py-0.5 rounded font-mono">{{ $kontak->ip_address }}</code>
            </div>
            @if($kontak->user_agent)
            <div class="sm:col-span-2">
                <p class="text-xs font-semibold text-cobalt-400 uppercase tracking-wider mb-1">User Agent</p>
                <p class="text-xs font-mono text-cobalt-500 bg-slate-50 p-2 rounded break-all">{{ $kontak->user_agent }}</p>
            </div>
            @endif
        </div>

        {{-- Subjek --}}
        @if($kontak->subject)
        <div>
            <p class="text-xs font-semibold text-cobalt-400 uppercase tracking-wider mb-1">Subjek</p>
            <p class="font-semibold text-cobalt-800 text-base">{{ $kontak->subject }}</p>
        </div>
        @endif

        {{-- Pesan --}}
        <div>
            <p class="text-xs font-semibold text-cobalt-400 uppercase tracking-wider mb-2">Isi Pesan</p>
            <div class="bg-cobalt-50/60 rounded-lg p-4 border border-cobalt-100">
                <p class="text-cobalt-800 text-sm leading-relaxed whitespace-pre-wrap">{{ $kontak->message }}</p>
            </div>
        </div>

        {{-- Aksi --}}
        <div class="flex items-center justify-between pt-4 border-t border-slate-100">
            <a href="mailto:{{ $kontak->email }}?subject=Re: {{ $kontak->subject }}"
               class="btn-secondary text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                Balas via Email
            </a>
            <form method="POST" action="{{ route('admin.kontak.destroy', $kontak->id) }}"
                  onsubmit="return confirm('Hapus pesan ini? Tidak dapat dikembalikan.')">
                @csrf @method('DELETE')
                <button type="submit"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-semibold
                               text-ember hover:bg-red-50 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Hapus Pesan
                </button>
            </form>
        </div>
    </div>

</div>
@endsection
