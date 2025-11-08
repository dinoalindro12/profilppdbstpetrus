@extends('frontend.layouts.app')

@section('title', 'Kurikulum - ' . config('app.name'))
@section('description', 'Kurikulum pendidikan yang diterapkan di sekolah kami untuk mencapai tujuan pembelajaran terbaik')

@section('content')
<section class="bg-gradient-to-b from-gray-50 to-white py-12">
    <div class="container mx-auto px-4">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Kurikulum Pendidikan</h1>
            <div class="w-24 h-1 bg-blue-600 mx-auto mb-4"></div>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                Kurikulum yang komprehensif dan terstruktur untuk memastikan siswa mendapatkan pendidikan terbaik 
                sesuai dengan perkembangan zaman dan kebutuhan pembelajaran
            </p>
        </div>

        <!-- Curriculum Grid -->
        <div class="max-w-6xl mx-auto">
            @if($curriculums->count() > 0)
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
                @foreach($curriculums as $curriculum)
                <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 overflow-hidden border border-gray-100">
                    <div class="p-6">
                        <!-- Header with Order Badge -->
                        <div class="flex items-start justify-between mb-4">
                            <h3 class="text-xl font-bold text-gray-800 flex-1 pr-4">{{ $curriculum->name }}</h3>
                            <span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-sm font-semibold">
                                #{{ $curriculum->order }}
                            </span>
                        </div>

                        <!-- Description -->
                        @if($curriculum->description)
                        <p class="text-gray-600 mb-6 leading-relaxed">{{ $curriculum->description }}</p>
                        @endif

                        <!-- File Info & Download -->
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <svg class="w-8 h-8 text-red-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Dokumen Kurikulum</p>
                                    <p class="text-xs text-gray-500">PDF Document</p>
                                </div>
                            </div>
                            
                            @if($curriculum->file)
                            <a href="{{ Storage::url($curriculum->file) }}" 
                               target="_blank"
                               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-semibold transition duration-200 flex items-center"
                               onclick="trackDownload('{{ $curriculum->name }}')">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Download
                            </a>
                            @else
                            <span class="text-gray-400 text-sm font-medium">File tidak tersedia</span>
                            @endif
                        </div>

                        <!-- Additional Info -->
                        <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-100">
                            <div class="flex items-center text-sm text-gray-500">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Terakhir update: {{ $curriculum->updated_at->format('d M Y') }}
                            </div>
                            <span class="flex items-center text-sm {{ $curriculum->is_active ? 'text-green-600' : 'text-red-600' }}">
                                <span class="w-2 h-2 rounded-full {{ $curriculum->is_active ? 'bg-green-500' : 'bg-red-500' }} mr-1"></span>
                                {{ $curriculum->is_active ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <h3 class="text-2xl font-semibold text-gray-600 mb-2">Belum ada kurikulum</h3>
                <p class="text-gray-500 max-w-md mx-auto">
                    Saat ini belum ada dokumen kurikulum yang tersedia. Silakan kembali lagi nanti.
                </p>
            </div>
            @endif

            <!-- Information Section -->
            @if($curriculums->count() > 0)
            <div class="bg-blue-50 rounded-xl p-8 border border-blue-200">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-blue-800 mb-2">Tentang Kurikulum Kami</h3>
                        <p class="text-blue-700">
                            Kurikulum kami dirancang untuk mengembangkan potensi siswa secara holistik, 
                            mencakup aspek kognitif, afektif, dan psikomotorik. Setiap dokumen kurikulum 
                            dapat diunduh untuk dipelajari lebih lanjut oleh orang tua dan masyarakat.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Statistics -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-12">
                <div class="text-center p-6 bg-white rounded-xl shadow-sm border border-gray-200">
                    <div class="text-2xl font-bold text-blue-600 mb-2">{{ $curriculums->count() }}</div>
                    <div class="text-sm text-gray-600">Total Kurikulum</div>
                </div>
                <div class="text-center p-6 bg-white rounded-xl shadow-sm border border-gray-200">
                    <div class="text-2xl font-bold text-green-600 mb-2">
                        {{ $curriculums->where('is_active', true)->count() }}
                    </div>
                    <div class="text-sm text-gray-600">Kurikulum Aktif</div>
                </div>
                <div class="text-center p-6 bg-white rounded-xl shadow-sm border border-gray-200">
                    <div class="text-2xl font-bold text-purple-600 mb-2">
                        {{ $curriculums->where('file', '!=', null)->count() }}
                    </div>
                    <div class="text-sm text-gray-600">Dokumen Tersedia</div>
                </div>
                <div class="text-center p-6 bg-white rounded-xl shadow-sm border border-gray-200">
                    <div class="text-2xl font-bold text-orange-600 mb-2">Semua</div>
                    <div class="text-sm text-gray-600">Gratis Diakses</div>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>

<!-- Download Confirmation Modal -->
<div id="downloadModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50 hidden">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full p-6">
        <div class="text-center">
            <svg class="w-16 h-16 text-green-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Download Berhasil</h3>
            <p class="text-gray-600 mb-6" id="downloadMessage">Dokumen kurikulum sedang diunduh...</p>
            <button onclick="closeDownloadModal()" 
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 px-6 rounded-lg font-semibold transition duration-200">
                Tutup
            </button>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .curriculum-card:hover {
        transform: translateY(-4px);
    }
</style>
@endpush

@push('scripts')
<script>
    // Track download function
    function trackDownload(curriculumName) {
        // Show download confirmation modal
        const modal = document.getElementById('downloadModal');
        const message = document.getElementById('downloadMessage');
        message.textContent = `Dokumen "${curriculumName}" sedang diunduh...`;
        modal.classList.remove('hidden');
        
        // Simulate analytics tracking (you can replace this with actual analytics)
        console.log(`Download tracked: ${curriculumName}`);
        
        // You can send this to your analytics service
        // fetch('/api/track-download', {
        //     method: 'POST',
        //     headers: {
        //         'Content-Type': 'application/json',
        //         'X-CSRF-TOKEN': '{{ csrf_token() }}'
        //     },
        //     body: JSON.stringify({
        //         curriculum_name: curriculumName,
        //         downloaded_at: new Date().toISOString()
        //     })
        // });
        
        // Auto close modal after 3 seconds
        setTimeout(() => {
            closeDownloadModal();
        }, 3000);
    }

    function closeDownloadModal() {
        const modal = document.getElementById('downloadModal');
        modal.classList.add('hidden');
    }

    // Close modal when clicking outside
    document.getElementById('downloadModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeDownloadModal();
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeDownloadModal();
        }
    });

    // Add loading state to download buttons
    document.addEventListener('DOMContentLoaded', function() {
        const downloadButtons = document.querySelectorAll('a[target="_blank"]');
        downloadButtons.forEach(button => {
            button.addEventListener('click', function() {
                const originalText = button.innerHTML;
                button.innerHTML = `
                    <svg class="w-4 h-4 mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    Mengunduh...
                `;
                button.classList.add('opacity-75', 'cursor-not-allowed');
                
                // Reset button after 2 seconds
                setTimeout(() => {
                    button.innerHTML = originalText;
                    button.classList.remove('opacity-75', 'cursor-not-allowed');
                }, 2000);
            });
        });
    });
</script>
@endpush