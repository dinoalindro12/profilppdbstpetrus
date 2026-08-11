@extends('admin.layouts.app')
@section('title', 'Pesan Masuk')

@section('content')
<div class="space-y-5" x-data="{ modalOpen: false }">

    <div class="flex items-center justify-between gap-4 flex-wrap">
        <div>
            <h2 class="sp-mark font-display text-xl font-bold text-cobalt-800">Pesan Masuk</h2>
            <p class="text-cobalt-500 text-sm mt-1">Pesan dari formulir kontak halaman publik.</p>
        </div>
        <button @click="modalOpen = true" class="btn-secondary text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            Rate Limit
        </button>
    </div>

    {{-- Info rate limit --}}
    <div class="sp-alert-info flex items-center gap-2">
        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        Rate Limit aktif: <strong class="mx-1">{{ $rateLimit }} pesan</strong> per <strong class="mx-1">{{ $rateLimitHours }} jam</strong> per IP address.
    </div>

    <div class="sp-card overflow-hidden">
        @if($kontaks->count())
        <div class="overflow-x-auto">
            <table class="sp-table">
                <thead>
                    <tr>
                        <th>Pengirim</th>
                        <th>Tujuan</th>
                        <th>Pesan</th>
                        <th>IP</th>
                        <th>Waktu</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kontaks as $k)
                    <tr>
                        <td>
                            <p class="font-medium text-cobalt-800">{{ $k->name }}</p>
                            <p class="text-xs text-cobalt-400">{{ $k->email }}</p>
                        </td>
                        <td>
                            <span class="text-xs px-2.5 py-1 rounded-full bg-cobalt-50 text-cobalt-700 font-semibold">
                                {{ $k->tujuan }}
                            </span>
                        </td>
                        <td class="max-w-xs">
                            <p class="text-sm font-medium text-cobalt-800 truncate">{{ $k->subject }}</p>
                            <p class="text-xs text-cobalt-400 truncate mt-0.5">{{ Str::limit($k->message, 70) }}</p>
                        </td>
                        <td>
                            <code class="text-xs bg-slate-100 text-cobalt-600 px-2 py-0.5 rounded font-mono">
                                {{ $k->ip_address }}
                            </code>
                        </td>
                        <td class="text-xs text-cobalt-500 whitespace-nowrap">
                            {{ $k->created_at->translatedFormat('d M Y') }}<br>
                            <span class="text-cobalt-400">{{ $k->created_at->format('H:i') }}</span>
                        </td>
                        <td>
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.kontak.show', $k->id) }}"
                                   class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-semibold
                                          bg-cobalt-50 text-cobalt-700 hover:bg-cobalt-100 transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    Baca
                                </a>
                                <form method="POST" action="{{ route('admin.kontak.destroy', $k->id) }}"
                                      onsubmit="return confirm('Hapus pesan dari {{ $k->name }}?')">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                            class="p-1.5 text-cobalt-300 hover:text-ember hover:bg-red-50 rounded-lg transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if($kontaks->hasPages())
        <div class="px-5 py-3 border-t border-slate-100">
            {{ $kontaks->links() }}
        </div>
        @endif
        @else
        <div class="py-14 text-center">
            <svg class="w-12 h-12 text-cobalt-200 mx-auto mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
            <p class="text-cobalt-500 font-medium">Belum ada pesan masuk.</p>
        </div>
        @endif
    </div>

    {{-- Modal Rate Limit --}}
    <div x-show="modalOpen"
         x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 flex items-center justify-center bg-cobalt-900/60"
         @click.self="modalOpen = false">
        <div class="bg-white rounded-xl shadow-card-lg w-full max-w-sm mx-4 p-6">
            <div class="flex items-center justify-between mb-5">
                <h3 class="font-display text-base font-bold text-cobalt-800">Pengaturan Rate Limit</h3>
                <button @click="modalOpen = false" class="text-cobalt-400 hover:text-cobalt-700 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <form action="{{ route('admin.kontak.update-rate-limit') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-cobalt-700 mb-1.5">
                        Maks. pesan per IP
                    </label>
                    <input type="number" name="rate_limit" value="{{ $rateLimit }}" min="1" max="100"
                           class="w-full rounded-lg border px-4 py-2.5 text-sm border-slate-300 bg-white
                                  focus:border-cobalt-500 focus:ring-2 focus:ring-cobalt-200 transition">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-cobalt-700 mb-1.5">
                        Jangka waktu (jam)
                    </label>
                    <input type="number" name="rate_limit_hours" value="{{ $rateLimitHours }}" min="1" max="24"
                           class="w-full rounded-lg border px-4 py-2.5 text-sm border-slate-300 bg-white
                                  focus:border-cobalt-500 focus:ring-2 focus:ring-cobalt-200 transition">
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="button" @click="modalOpen = false" class="btn-secondary flex-1 justify-center">Batal</button>
                    <button type="submit" class="btn-primary flex-1 justify-center">Simpan</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
