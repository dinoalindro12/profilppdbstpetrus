@extends('frontend.layouts.app')

@section('title', 'Galeri - SMAS St. Petrus')

@section('content')
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Galeri Sekolah</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Dokumentasi kegiatan dan momen berharga di SMAS St. Petrus
            </p>
        </div>

        <!-- Filter Kategori -->
        <div class="flex flex-wrap justify-center gap-4 mb-8">
            <button class="filter-btn px-6 py-2 rounded-full bg-blue-600 text-white font-medium transition duration-200" data-filter="all">
                Semua
            </button>
            <button class="filter-btn px-6 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300 font-medium transition duration-200" data-filter="kegiatan">
                Kegiatan Sekolah
            </button>
            <button class="filter-btn px-6 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300 font-medium transition duration-200" data-filter="prestasi">
                Prestasi
            </button>
            <button class="filter-btn px-6 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300 font-medium transition duration-200" data-filter="fasilitas">
                Fasilitas
            </button>
            <button class="filter-btn px-6 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300 font-medium transition duration-200" data-filter="ekstrakurikuler">
                Ekstrakurikuler
            </button>
        </div>

        <!-- Grid Gallery -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="gallery-grid">
            <!-- Data Dummy Gallery Items -->
            @php
                $galleryItems = [
                    [
                        'id' => 1,
                        'image' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80',
                        'title' => 'Upacara Bendera',
                        'category' => 'kegiatan',
                        'date' => '15 Maret 2024',
                        'description' => 'Upacara bendera rutin hari Senin dengan pembina upacara Bapak Kepala Sekolah'
                    ],
                    [
                        'id' => 2,
                        'image' => 'https://images.unsplash.com/photo-1588072432836-4d4ac72f9e2e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80',
                        'title' => 'Laboratorium Komputer',
                        'category' => 'fasilitas',
                        'date' => '10 Maret 2024',
                        'description' => 'Laboratorium komputer dengan spesifikasi terbaru untuk pembelajaran TI'
                    ],
                    [
                        'id' => 3,
                        'image' => 'https://images.unsplash.com/photo-1541336032412-2048a678540d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80',
                        'title' => 'Juara Olimpiade Matematika',
                        'category' => 'prestasi',
                        'date' => '5 Maret 2024',
                        'description' => 'Siswa SMAS St. Petrus meraih juara 1 Olimpiade Matematika Tingkat Kota'
                    ],
                    [
                        'id' => 4,
                        'image' => 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80',
                        'title' => 'Latihan Paskibra',
                        'category' => 'ekstrakurikuler',
                        'date' => '28 Februari 2024',
                        'description' => 'Latihan rutin ekstrakurikuler Paskibra dalam persiapan event nasional'
                    ],
                    [
                        'id' => 5,
                        'image' => 'https://images.unsplash.com/photo-1498243691581-b145c3f54a5a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80',
                        'title' => 'Perpustakaan Digital',
                        'category' => 'fasilitas',
                        'date' => '25 Februari 2024',
                        'description' => 'Perpustakaan digital dengan koleksi buku terkini dan fasilitas membaca yang nyaman'
                    ],
                    [
                        'id' => 6,
                        'image' => 'https://images.unsplash.com/photo-1511632765486-a01980e01a18?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80',
                        'title' => 'Pentas Seni',
                        'category' => 'kegiatan',
                        'date' => '20 Februari 2024',
                        'description' => 'Pentas seni tahunan menampilkan bakat dan kreativitas siswa'
                    ],
                    [
                        'id' => 7,
                        'image' => 'https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80',
                        'title' => 'Latihan Basket',
                        'category' => 'ekstrakurikuler',
                        'date' => '15 Februari 2024',
                        'description' => 'Ekstrakurikuler basket dalam persiapan turnamen antar sekolah'
                    ],
                    [
                        'id' => 8,
                        'image' => 'https://images.unsplash.com/photo-1559028012-481c04fa702d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80',
                        'title' => 'Juara Lomba Debat',
                        'category' => 'prestasi',
                        'date' => '10 Februari 2024',
                        'description' => 'Tim debat bahasa Inggris meraih juara 2 tingkat provinsi'
                    ],
                    [
                        'id' => 9,
                        'image' => 'https://images.unsplash.com/photo-1591123120675-6f7f1aae0e5b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80',
                        'title' => 'Laboratorium Kimia',
                        'category' => 'fasilitas',
                        'date' => '5 Februari 2024',
                        'description' => 'Laboratorium kimia dengan peralatan lengkap untuk praktikum siswa'
                    ],
                    [
                        'id' => 10,
                        'image' => 'https://images.unsplash.com/photo-1541336032412-2048a678540d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80',
                        'title' => 'Kegiatan OSIS',
                        'category' => 'kegiatan',
                        'date' => '1 Februari 2024',
                        'description' => 'Rapat kerja OSIS dalam merencanakan kegiatan sekolah'
                    ],
                    [
                        'id' => 11,
                        'image' => 'https://images.unsplash.com/photo-1511632765486-a01980e01a18?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80',
                        'title' => 'Paduan Suara',
                        'category' => 'ekstrakurikuler',
                        'date' => '28 Januari 2024',
                        'description' => 'Ekstrakurikuler paduan suara dalam latihan untuk kompetisi'
                    ],
                    [
                        'id' => 12,
                        'image' => 'https://images.unsplash.com/photo-1559028012-481c04fa702d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80',
                        'title' => 'Juara Robotik',
                        'category' => 'prestasi',
                        'date' => '25 Januari 2024',
                        'description' => 'Tim robotik sekolah meraih juara inovasi teknologi'
                    ]
                ];
            @endphp

            @foreach($galleryItems as $item)
            <div class="gallery-item group relative bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden transition-all duration-300 hover:shadow-lg" data-category="{{ $item['category'] }}">
                <div class="relative overflow-hidden">
                    <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" 
                         class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105">
                    
                    <!-- Overlay -->
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 flex items-center justify-center">
                        <div class="text-white text-center transform translate-y-4 group-hover:translate-y-0 opacity-0 group-hover:opacity-100 transition-all duration-300">
                            <svg class="w-8 h-8 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"/>
                            </svg>
                            <span class="text-sm font-medium">Lihat Detail</span>
                        </div>
                    </div>

                    <!-- Category Badge -->
                    <div class="absolute top-3 left-3">
                        @php
                            $categoryColors = [
                                'kegiatan' => 'bg-blue-500',
                                'prestasi' => 'bg-green-500', 
                                'fasilitas' => 'bg-purple-500',
                                'ekstrakurikuler' => 'bg-orange-500'
                            ];
                            $categoryLabels = [
                                'kegiatan' => 'Kegiatan',
                                'prestasi' => 'Prestasi',
                                'fasilitas' => 'Fasilitas',
                                'ekstrakurikuler' => 'Ekstrakurikuler'
                            ];
                        @endphp
                        <span class="px-2 py-1 text-xs font-semibold text-white rounded-full {{ $categoryColors[$item['category']] }}">
                            {{ $categoryLabels[$item['category']] }}
                        </span>
                    </div>
                </div>

                <div class="p-4">
                    <h3 class="font-semibold text-gray-800 mb-2 line-clamp-2">{{ $item['title'] }}</h3>
                    <p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ $item['description'] }}</p>
                    <div class="flex justify-between items-center text-xs text-gray-500">
                        <span>{{ $item['date'] }}</span>
                        <button class="view-detail text-blue-600 hover:text-blue-800 font-medium" 
                                data-image="{{ $item['image'] }}"
                                data-title="{{ $item['title'] }}"
                                data-description="{{ $item['description'] }}"
                                data-date="{{ $item['date'] }}"
                                data-category="{{ $categoryLabels[$item['category']] }}">
                            Lihat Detail
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Load More Button -->
        <div class="text-center mt-12">
            <button id="load-more" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-medium transition duration-200 shadow-sm">
                Muat Lebih Banyak
            </button>
        </div>
    </div>
</section>

<!-- Modal untuk Detail Gambar -->
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-xl max-w-4xl w-full mx-4 max-h-[90vh] overflow-hidden">
        <div class="relative">
            <button id="closeModal" class="absolute top-4 right-4 text-white bg-black bg-opacity-50 rounded-full p-2 z-10">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
            
            <img id="modalImage" src="" alt="" class="w-full h-64 md:h-96 object-cover">
            
            <div class="p-6">
                <div class="flex flex-wrap items-center gap-2 mb-4">
                    <span id="modalCategory" class="px-3 py-1 text-sm font-semibold text-white bg-blue-500 rounded-full"></span>
                    <span id="modalDate" class="text-sm text-gray-500"></span>
                </div>
                
                <h3 id="modalTitle" class="text-xl font-bold text-gray-800 mb-3"></h3>
                <p id="modalDescription" class="text-gray-600 leading-relaxed"></p>
            </div>
        </div>
    </div>
</div>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .gallery-item {
        animation: fadeIn 0.5s ease-in;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Filter functionality
    const filterButtons = document.querySelectorAll('.filter-btn');
    const galleryItems = document.querySelectorAll('.gallery-item');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const filter = this.getAttribute('data-filter');
            
            // Update active button
            filterButtons.forEach(btn => {
                btn.classList.remove('bg-blue-600', 'text-white');
                btn.classList.add('bg-gray-200', 'text-gray-700', 'hover:bg-gray-300');
            });
            this.classList.remove('bg-gray-200', 'text-gray-700', 'hover:bg-gray-300');
            this.classList.add('bg-blue-600', 'text-white');
            
            // Filter items
            galleryItems.forEach(item => {
                if (filter === 'all' || item.getAttribute('data-category') === filter) {
                    item.style.display = 'block';
                    item.style.animation = 'fadeIn 0.5s ease-in';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
    
    // Modal functionality
    const modal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    const modalTitle = document.getElementById('modalTitle');
    const modalDescription = document.getElementById('modalDescription');
    const modalDate = document.getElementById('modalDate');
    const modalCategory = document.getElementById('modalCategory');
    const closeModal = document.getElementById('closeModal');
    const viewDetailButtons = document.querySelectorAll('.view-detail');
    
    viewDetailButtons.forEach(button => {
        button.addEventListener('click', function() {
            const image = this.getAttribute('data-image');
            const title = this.getAttribute('data-title');
            const description = this.getAttribute('data-description');
            const date = this.getAttribute('data-date');
            const category = this.getAttribute('data-category');
            
            modalImage.src = image;
            modalImage.alt = title;
            modalTitle.textContent = title;
            modalDescription.textContent = description;
            modalDate.textContent = date;
            modalCategory.textContent = category;
            
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        });
    });
    
    closeModal.addEventListener('click', function() {
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    });
    
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    });
    
    // Load more functionality (dummy)
    const loadMoreBtn = document.getElementById('load-more');
    let currentItems = 12;
    
    loadMoreBtn.addEventListener('click', function() {
        // Simulate loading
        this.textContent = 'Memuat...';
        this.disabled = true;
        
        setTimeout(() => {
            // In real implementation, this would load more data from server
            this.textContent = 'Tidak ada data lagi';
            this.disabled = true;
            this.classList.remove('bg-blue-600', 'hover:bg-blue-700');
            this.classList.add('bg-gray-400', 'cursor-not-allowed');
        }, 1000);
    });
    
    // Keyboard navigation for modal
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    });
});
</script>
@endsection