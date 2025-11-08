@extends('admin.layouts.app')

@section('title', 'Manajemen Kontak')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Manajemen Pesan Kontak</h2>
        <div class="flex space-x-4">
            <!-- Rate Limit Settings Button -->
            <button onclick="toggleRateLimitModal()" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg font-medium transition duration-200">
                Pengaturan Rate Limit
            </button>
        </div>
    </div>

    <!-- Rate Limit Info -->
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
        <div class="flex items-center">
            <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="text-blue-800">
                Rate Limit saat ini: <strong>{{ $rateLimit }} pesan</strong> per <strong>{{ $rateLimitHours }} jam</strong> per IP
            </p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full">
            <thead class="bg-gradient-to-r from-gray-50 to-blue-50">
                <tr>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider border-b border-gray-200">Pengirim</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider border-b border-gray-200">Tujuan</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider border-b border-gray-200">Subjek</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider border-b border-gray-200">IP Address</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider border-b border-gray-200">Tanggal</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider border-b border-gray-200">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($kontaks as $kontak)
                <tr class="hover:bg-blue-50 transition-colors duration-200">
                    <td class="px-6 py-4">
                        <div class="text-sm font-semibold text-gray-900">{{ $kontak->name }}</div>
                        <div class="text-sm text-gray-500">{{ $kontak->email }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                            {{ $kontak->tujuan }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm font-medium text-gray-900">{{ Str::limit($kontak->subject, 50) }}</div>
                        <div class="text-sm text-gray-500 mt-1">{{ Str::limit($kontak->message, 70) }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-sm text-gray-700 bg-gray-100 px-3 py-1 rounded-full font-mono">
                            {{ $kontak->ip_address }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-sm text-gray-700">
                            {{ $kontak->created_at->format('d M Y H:i') }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center space-x-3">
                            <a href="{{ route('admin.kontak.show', $kontak->id) }}" 
                               class="text-blue-600 hover:text-blue-800 p-2 rounded-lg transition duration-200"
                               title="Lihat Detail">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </a>
                            <form action="{{ route('admin.kontak.destroy', $kontak->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="text-red-600 hover:text-red-800 p-2 rounded-lg transition duration-200"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')"
                                        title="Hapus">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center">
                        <div class="text-gray-500">
                            <svg class="w-12 h-12 mx-auto mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                            </svg>
                            <p class="text-sm">Tidak ada pesan kontak.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        @if($kontaks->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $kontaks->links() }}
        </div>
        @endif
    </div>
</div>

<!-- Rate Limit Modal -->
<div id="rateLimitModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Pengaturan Rate Limit</h3>
            
            <form action="{{ route('admin.kontak.update-rate-limit') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="rate_limit" class="block text-sm font-medium text-gray-700 mb-2">
                        Jumlah Maksimal Pesan per IP
                    </label>
                    <input type="number" name="rate_limit" id="rate_limit" 
                           value="{{ $rateLimit }}" min="1" max="100"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="mb-6">
                    <label for="rate_limit_hours" class="block text-sm font-medium text-gray-700 mb-2">
                        Jangka Waktu (jam)
                    </label>
                    <input type="number" name="rate_limit_hours" id="rate_limit_hours" 
                           value="{{ $rateLimitHours }}" min="1" max="24"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="toggleRateLimitModal()" 
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md font-medium">
                        Batal
                    </button>
                    <button type="submit" 
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md font-medium">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function toggleRateLimitModal() {
    const modal = document.getElementById('rateLimitModal');
    modal.classList.toggle('hidden');
}

// Close modal when clicking outside
document.getElementById('rateLimitModal').addEventListener('click', function(e) {
    if (e.target.id === 'rateLimitModal') {
        toggleRateLimitModal();
    }
});
</script>
@endsection