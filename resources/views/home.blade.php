@extends('frontend.layouts.app')

@section('title', 'Beranda - Sekolah Kita')
@section('description', 'Website Resmi Sekolah Kita - Beranda')

@section('content')
    <!-- Hero Slider -->
    <section class="relative">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <!-- Slide 1 -->
                <div class="swiper-slide">
                    <div class="bg-cover bg-center h-96" style="background-image: url('https://via.placeholder.com/1920x600');">
                        <div class="bg-black bg-opacity-50 h-full flex items-center">
                            <div class="container mx-auto px-4 text-white">
                                <h1 class="text-4xl md:text-5xl font-bold mb-4">Selamat Datang di Sekolah Kita</h1>
                                <p class="text-xl mb-6">Mewujudkan Generasi Cerdas dan Berkarakter</p>
                                <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium">Lihat Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Slide 2 -->
                <div class="swiper-slide">
                    <div class="bg-cover bg-center h-96" style="background-image: url('https://via.placeholder.com/1920x600/2');">
                        <div class="bg-black bg-opacity-50 h-full flex items-center">
                            <div class="container mx-auto px-4 text-white">
                                <h1 class="text-4xl md:text-5xl font-bold mb-4">Pendidikan Berkualitas</h1>
                                <p class="text-xl mb-6">Menyediakan lingkungan belajar yang inspiratif</p>
                                <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium">Daftar Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
            <!-- Navigation -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </section>

    <!-- Sambutan Kepala Sekolah -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/3 mb-8 md:mb-0">
                    <img src="https://via.placeholder.com/300x300" alt="Kepala Sekolah" class="rounded-full w-64 h-64 object-cover mx-auto shadow-lg">
                </div>
                <div class="md:w-2/3 md:pl-12">
                    <h2 class="text-3xl font-bold text-gray-800 mb-6">Sambutan Kepala Sekolah</h2>
                    <p class="text-gray-600 mb-4">
                        Assalamu'alaikum Warahmatullahi Wabarakatuh
                    </p>
                    <p class="text-gray-600 mb-4">
                        Puji syukur kehadirat Allah SWT, atas segala rahmat dan karunia-Nya, website Sekolah Kita dapat hadir di tengah-tengah kita. Website ini diharapkan dapat menjadi sarana informasi dan komunikasi antara sekolah, orang tua, dan masyarakat.
                    </p>
                    <p class="text-gray-600 mb-4">
                        Kami berkomitmen untuk memberikan pendidikan terbaik guna membentuk generasi yang cerdas, berkarakter, dan berakhlak mulia.
                    </p>
                    <p class="text-gray-600">
                        Wassalamu'alaikum Warahmatullahi Wabarakatuh
                    </p>
                    <div class="mt-6">
                        <h4 class="font-semibold text-gray-800">Dr. John Doe, M.Pd</h4>
                        <p class="text-gray-600">Kepala Sekolah</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Berita Terbaru -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Berita Terbaru</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Ikuti informasi terbaru seputar kegiatan dan prestasi sekolah kami.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Berita 1 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <img src="https://via.placeholder.com/400x250" alt="Berita 1" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <span class="text-blue-600 text-sm font-medium">Kegiatan</span>
                        <h3 class="text-xl font-bold text-gray-800 mt-2 mb-3">Upacara Bendera Memperingati HUT RI</h3>
                        <p class="text-gray-600 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore.</p>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-500 text-sm">15 Agustus 2023</span>
                            <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">Baca Selengkapnya →</a>
                        </div>
                    </div>
                </div>

                <!-- Berita 2 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <img src="https://via.placeholder.com/400x250" alt="Berita 2" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <span class="text-green-600 text-sm font-medium">Prestasi</span>
                        <h3 class="text-xl font-bold text-gray-800 mt-2 mb-3">Siswa Kita Juara Olimpiade Matematika</h3>
                        <p class="text-gray-600 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore.</p>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-500 text-sm">10 Agustus 2023</span>
                            <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">Baca Selengkapnya →</a>
                        </div>
                    </div>
                </div>

                <!-- Berita 3 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <img src="https://via.placeholder.com/400x250" alt="Berita 3" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <span class="text-purple-600 text-sm font-medium">Pengumuman</span>
                        <h3 class="text-xl font-bold text-gray-800 mt-2 mb-3">Jadwal Pembagian Rapor Semester Ganjil</h3>
                        <p class="text-gray-600 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore.</p>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-500 text-sm">5 Agustus 2023</span>
                            <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">Baca Selengkapnya →</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-8">
                <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium">Lihat Semua Berita</a>
            </div>
        </div>
    </section>

    <!-- Galeri Foto -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Galeri Foto</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Momen-momen berharga di sekolah kami.</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="relative group">
                    <img src="https://via.placeholder.com/300x200" alt="Galeri 1" class="w-full h-48 object-cover rounded-lg">
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 rounded-lg flex items-center justify-center transition duration-300">
                        <button class="text-white opacity-0 group-hover:opacity-100 transform scale-0 group-hover:scale-100 transition duration-300">
                            <i class="fas fa-search-plus text-2xl"></i>
                        </button>
                    </div>
                </div>
                <div class="relative group">
                    <img src="https://via.placeholder.com/300x200" alt="Galeri 2" class="w-full h-48 object-cover rounded-lg">
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 rounded-lg flex items-center justify-center transition duration-300">
                        <button class="text-white opacity-0 group-hover:opacity-100 transform scale-0 group-hover:scale-100 transition duration-300">
                            <i class="fas fa-search-plus text-2xl"></i>
                        </button>
                    </div>
                </div>
                <div class="relative group">
                    <img src="https://via.placeholder.com/300x200" alt="Galeri 3" class="w-full h-48 object-cover rounded-lg">
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 rounded-lg flex items-center justify-center transition duration-300">
                        <button class="text-white opacity-0 group-hover:opacity-100 transform scale-0 group-hover:scale-100 transition duration-300">
                            <i class="fas fa-search-plus text-2xl"></i>
                        </button>
                    </div>
                </div>
                <div class="relative group">
                    <img src="https://via.placeholder.com/300x200" alt="Galeri 4" class="w-full h-48 object-cover rounded-lg">
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 rounded-lg flex items-center justify-center transition duration-300">
                        <button class="text-white opacity-0 group-hover:opacity-100 transform scale-0 group-hover:scale-100 transition duration-300">
                            <i class="fas fa-search-plus text-2xl"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="text-center mt-8">
                <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium">Lihat Semua Galeri</a>
            </div>
        </div>
    </section>

    <!-- Quick Info PPDB -->
    <section class="py-16 bg-blue-600 text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-4">Penerimaan Peserta Didik Baru (PPDB) 2023/2024</h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto">Daftarkan putra-putri Anda sekarang juga! Kuota terbatas.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <div>
                    <div class="text-4xl font-bold mb-2">15 Juni</div>
                    <p>Pendaftaran Dibuka</p>
                </div>
                <div>
                    <div class="text-4xl font-bold mb-2">30 Juli</div>
                    <p>Pendaftaran Ditutup</p>
                </div>
                <div>
                    <div class="text-4xl font-bold mb-2">5 Agustus</div>
                    <p>Pengumuman</p>
                </div>
            </div>

            <div class="space-x-4">
                <a href="#" class="bg-white text-blue-600 hover:bg-gray-100 px-6 py-3 rounded-lg font-medium">Daftar Online</a>
                <a href="#" class="bg-transparent border-2 border-white hover:bg-blue-700 px-6 py-3 rounded-lg font-medium">Info Selengkapnya</a>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <!-- Swiper JS untuk slider -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var swiper = new Swiper('.swiper-container', {
                loop: true,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                autoplay: {
                    delay: 5000,
                },
            });
        });
    </script>
@endpush