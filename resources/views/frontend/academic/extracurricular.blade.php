@extends('frontend.layouts.app')

@section('title', 'Ekstrakurikuler - ' . config('app.name'))
@section('description', 'Daftar lengkap ekstrakurikuler yang tersedia di sekolah kami')

@section('content')
<section class="bg-gradient-to-b from-gray-50 to-white py-12">
    <div class="container mx-auto px-4">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Ekstrakurikuler</h1>
            <div class="w-24 h-1 bg-blue-600 mx-auto mb-4"></div>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Temukan berbagai kegiatan ekstrakurikuler yang dapat mengembangkan bakat dan minat siswa
            </p>
        </div>

        <!-- Search and Filter Section -->
        <div class="max-w-4xl mx-auto mb-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <div class="relative">
                            <input type="text" 
                                   id="searchInput" 
                                   placeholder="Cari ekstrakurikuler..." 
                                   class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                            <svg class="absolute left-3 top-3.5 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="md:w-64">
                        <select id="dayFilter" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                            <option value="">Semua Hari</option>
                            <option value="senin">Senin</option>
                            <option value="selasa">Selasa</option>
                            <option value="rabu">Rabu</option>
                            <option value="kamis">Kamis</option>
                            <option value="jumat">Jumat</option>
                            <option value="sabtu">Sabtu</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ekstrakurikuler Grid -->
        <div id="extracurricularsContainer">
            @if($extracurriculars->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                @foreach($extracurriculars as $extracurricular)
                <div class="extracurricular-card bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 overflow-hidden border border-gray-100"
                     data-name="{{ strtolower($extracurricular->name) }}"
                     data-schedule="{{ strtolower($extracurricular->schedule ?? '') }}">
                    <!-- Image -->
                    <div class="relative h-48 bg-gradient-to-br from-blue-500 to-purple-600 overflow-hidden">
                        @if($extracurricular->image)
                            <img src="{{ Storage::url($extracurricular->image) }}" 
                                 alt="{{ $extracurricular->name }}" 
                                 class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="w-16 h-16 text-white opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                        @endif
                        <div class="absolute top-4 right-4">
                            <span class="bg-white bg-opacity-90 text-blue-600 px-3 py-1 rounded-full text-sm font-semibold shadow-sm">
                                {{ $extracurricular->schedule ?? 'TBA' }}
                            </span>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-3 line-clamp-2">{{ $extracurricular->name }}</h3>
                        
                        @if($extracurricular->description)
                        <p class="text-gray-600 mb-4 line-clamp-3">{{ $extracurricular->description }}</p>
                        @endif

                        <!-- Info Badges -->
                        <div class="flex flex-wrap gap-2 mb-4">
                            @if($extracurricular->coach)
                            <div class="flex items-center bg-green-50 text-green-700 px-3 py-1 rounded-full text-sm">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                {{ $extracurricular->coach }}
                            </div>
                            @endif
                            
                            <div class="flex items-center bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-sm">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $extracurricular->schedule ?? 'Jadwal Menyusul' }}
                            </div>
                        </div>

                        <!-- Action Button -->
                        <button onclick="showDetailModal({{ $extracurricular }})" 
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 px-4 rounded-lg font-semibold transition duration-200 flex items-center justify-center">
                            <span>Lihat Detail</span>
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                <h3 class="text-2xl font-semibold text-gray-600 mb-2">Belum ada ekstrakurikuler</h3>
                <p class="text-gray-500 max-w-md mx-auto">
                    Saat ini belum ada ekstrakurikuler yang tersedia. Silakan kembali lagi nanti.
                </p>
            </div>
            @endif
        </div>

        <!-- Statistics Section -->
        @if($extracurriculars->count() > 0)
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8 mb-12">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                <div>
                    <div class="text-3xl font-bold text-blue-600 mb-2">{{ $extracurriculars->count() }}</div>
                    <div class="text-sm text-gray-600">Total Ekstrakurikuler</div>
                </div>
                <div>
                    <div class="text-3xl font-bold text-green-600 mb-2">
                        {{ $extracurriculars->where('coach', '!=', null)->count() }}
                    </div>
                    <div class="text-sm text-gray-600">Dibimbing Guru</div>
                </div>
                <div>
                    <div class="text-3xl font-bold text-purple-600 mb-2">
                        {{ $extracurriculars->where('schedule', '!=', null)->count() }}
                    </div>
                    <div class="text-sm text-gray-600">Jadwal Tetap</div>
                </div>
                <div>
                    <div class="text-3xl font-bold text-orange-600 mb-2">Semua</div>
                    <div class="text-sm text-gray-600">Gratis</div>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>

<!-- Detail Modal -->
<div id="detailModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50 hidden">
    <div class="bg-white rounded-xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <div class="relative">
            <!-- Close Button -->
            <button onclick="closeDetailModal()" 
                    class="absolute top-4 right-4 bg-white bg-opacity-90 hover:bg-opacity-100 rounded-full p-2 z-10 transition duration-200">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <!-- Modal Content -->
            <div id="modalContent">
                <!-- Content will be loaded here by JavaScript -->
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .extracurricular-card:hover {
        transform: translateY(-4px);
    }
</style>
@endpush

@push('scripts')
<script>
    // Filter functionality
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const dayFilter = document.getElementById('dayFilter');
        const cards = document.querySelectorAll('.extracurricular-card');

        function filterCards() {
            const searchTerm = searchInput.value.toLowerCase();
            const dayValue = dayFilter.value.toLowerCase();

            cards.forEach(card => {
                const name = card.getAttribute('data-name');
                const schedule = card.getAttribute('data-schedule');

                const matchesSearch = name.includes(searchTerm) || schedule.includes(searchTerm);
                const matchesDay = !dayValue || schedule.includes(dayValue);

                if (matchesSearch && matchesDay) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        searchInput.addEventListener('input', filterCards);
        dayFilter.addEventListener('change', filterCards);
    });

    // Modal functionality
    function showDetailModal(extracurricular) {
        const modal = document.getElementById('detailModal');
        const modalContent = document.getElementById('modalContent');
        
        // Create modal content
        modalContent.innerHTML = `
            <!-- Image -->
            <div class="h-64 bg-gradient-to-br from-blue-500 to-purple-600 relative">
                ${extracurricular.image ? 
                    `<img src="/storage/${extracurricular.image}" alt="${extracurricular.name}" class="w-full h-full object-cover">` :
                    `<div class="w-full h-full flex items-center justify-center">
                        <svg class="w-20 h-20 text-white opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>`
                }
                <div class="absolute bottom-4 left-6">
                    <span class="bg-white bg-opacity-90 text-blue-600 px-4 py-2 rounded-full text-sm font-semibold shadow-sm">
                        ${extracurricular.schedule || 'Jadwal Menyusul'}
                    </span>
                </div>
            </div>

            <!-- Content -->
            <div class="p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">${extracurricular.name}</h2>
                
                ${extracurricular.description ? 
                    `<div class="prose prose-blue max-w-none mb-6">
                        <p class="text-gray-600 leading-relaxed">${extracurricular.description}</p>
                    </div>` : 
                    '<p class="text-gray-500 italic mb-6">Belum ada deskripsi tersedia.</p>'
                }

                <!-- Info Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    ${extracurricular.coach ? `
                        <div class="flex items-center p-4 bg-green-50 rounded-lg">
                            <svg class="w-8 h-8 text-green-600 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <div>
                                <h4 class="font-semibold text-green-800">Pembina</h4>
                                <p class="text-green-600">${extracurricular.coach}</p>
                            </div>
                        </div>
                    ` : ''}
                    
                    <div class="flex items-center p-4 bg-blue-50 rounded-lg">
                        <svg class="w-8 h-8 text-blue-600 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <h4 class="font-semibold text-blue-800">Jadwal</h4>
                            <p class="text-blue-600">${extracurricular.schedule || 'Akan diumumkan'}</p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-gray-200">
                    <button onclick="closeDetailModal()" 
                            class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-800 py-3 px-6 rounded-lg font-semibold transition duration-200">
                        Tutup
                    </button>
                    <button onclick="shareExtracurricular('${extracurricular.name}')" 
                            class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-3 px-6 rounded-lg font-semibold transition duration-200 flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                        </svg>
                        Bagikan
                    </button>
                </div>
            </div>
        `;

        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeDetailModal() {
        const modal = document.getElementById('detailModal');
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    function shareExtracurricular(name) {
        if (navigator.share) {
            navigator.share({
                title: name,
                text: `Lihat ekstrakurikuler ${name} di ${config('app.name')}`,
                url: window.location.href
            });
        } else {
            // Fallback for browsers that don't support Web Share API
            navigator.clipboard.writeText(window.location.href).then(() => {
                alert('Link berhasil disalin ke clipboard!');
            });
        }
    }

    // Close modal when clicking outside
    document.getElementById('detailModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeDetailModal();
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeDetailModal();
        }
    });
</script>
@endpush