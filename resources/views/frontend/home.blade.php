@extends('frontend.layouts.app')

@section('title', 'Beranda - Sekolah Kita')
@section('description', 'Website resmi Sekolah Kita - Pendidikan berkualitas untuk masa depan yang cerah')

@section('content')
    <!-- Hero Slider -->
    <section class="relative h-96 overflow-hidden">
        <!-- Slide 1 -->
        <div class="slide absolute inset-0 w-full h-full">
            <!-- Jika gambar disimpan di storage/app/public/backgrounds/ppdb-bg.jpg -->
                <div class="bg-cover bg-center h-full" style="background-image: url('{{ asset('storage/backgrounds/ppdb.jpg') }}');">

                <div class="bg-black bg-opacity-40 h-full flex items-center">
                    <div class="container mx-auto px-4 text-white text-center">
                        <h1 class="text-4xl md:text-5xl font-bold mb-4">Selamat Datang di Sekolah Kita</h1>
                        <p class="text-xl mb-6">Mewujudkan Generasi Cerdas, Berkarakter, dan Berakhlak Mulia</p>
                        <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-medium text-lg transition duration-200">Pelajari Lebih Lanjut</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="slide absolute inset-0 w-full h-full hidden">
            <div class="bg-cover bg-center h-full" style="background-image: url('{{ asset('storage/backgrounds/ppdb1.jpg') }}');">
                <div class="bg-black bg-opacity-40 h-full flex items-center">
                    <div class="container mx-auto px-4 text-white text-center">
                        <h1 class="text-4xl md:text-5xl font-bold mb-4">Pendidikan Berkualitas</h1>
                        <p class="text-xl mb-6">Menyediakan lingkungan belajar yang inspiratif dan menyenangkan</p>
                        <a href="#" class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-lg font-medium text-lg transition duration-200">Daftar Sekarang</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="slide absolute inset-0 w-full h-full hidden">
            <div class="bg-cover bg-center h-full" style="background-image: url('{{ asset('storage/backgrounds/ppdb2.jpg') }}');">
                <div class="bg-black bg-opacity-40 h-full flex items-center">
                    <div class="container mx-auto px-4 text-white text-center">
                        <h1 class="text-4xl md:text-5xl font-bold mb-4">Fasilitas Lengkap</h1>
                        <p class="text-xl mb-6">Didukung fasilitas modern untuk proses belajar mengajar yang optimal</p>
                        <a href="#" class="bg-red-600 hover:bg-red-700 text-white px-8 py-3 rounded-lg font-medium text-lg transition duration-200">Lihat Fasilitas</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slider Controls -->
        <button onclick="prevSlide()" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full hover:bg-opacity-70 transition duration-200">
            <i class="fas fa-chevron-left"></i>
        </button>
        <button onclick="nextSlide()" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full hover:bg-opacity-70 transition duration-200">
            <i class="fas fa-chevron-right"></i>
        </button>

        <!-- Slider Dots -->
        <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
            <button onclick="showSlide(0)" class="dot w-3 h-3 rounded-full bg-white bg-opacity-50 hover:bg-opacity-100 transition duration-200"></button>
            <button onclick="showSlide(1)" class="dot w-3 h-3 rounded-full bg-white bg-opacity-50 hover:bg-opacity-100 transition duration-200"></button>
            <button onclick="showSlide(2)" class="dot w-3 h-3 rounded-full bg-white bg-opacity-50 hover:bg-opacity-100 transition duration-200"></button>
        </div>
    </section>

    <!-- Sambutan Kepala Sekolah -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row items-center">
                <div class="lg:w-1/3 mb-8 lg:mb-0">
                    <img src="{{ asset('storage/backgrounds/kepsek.png') }}"  alt="Kepala Sekolah" class="rounded-lg shadow-lg w-full max-w-md mx-auto">
                </div>
                <div class="lg:w-2/3 lg:pl-12">
                    <h2 class="text-3xl font-bold text-gray-800 mb-6">Sambutan Kepala Sekolah</h2>
                    <div class="prose prose-lg text-gray-600 mb-6">
                        <p class="mb-4">
                            <strong>Syalom, Semoga Tuhan Selalu Beserta Kita</strong>
                        </p>
                        <p class="mb-4">
                            Puji syukur kehadirat Tuhan Yang Maha Esa, atas segala rahmat dan karunia-Nya, website Sekolah Kita dapat hadir di tengah-tengah kita. Website ini diharapkan dapat menjadi sarana informasi dan komunikasi antara sekolah, orang tua, dan masyarakat.
                        </p>
                        <p class="mb-4">
                            Kami berkomitmen untuk memberikan pendidikan terbaik guna membentuk generasi yang cerdas, berkarakter, dan berakhlak mulia. Dengan dukungan semua pihak, kami yakin dapat mewujudkan visi dan misi sekolah.
                        </p>
                        <p>
                            <strong>Syalom, Salve Tuhan Memberkati</strong>
                        </p>
                    </div>
                    <div class="border-l-4 border-blue-600 pl-4">
                        <h4 class="font-semibold text-gray-800 text-lg">Dr. Bapa Kepsek, M.Pd</h4>
                        <p class="text-gray-600">Kepala Sekolah</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Berita Terbaru -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Berita Terbaru</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Ikuti informasi terbaru seputar kegiatan, prestasi, dan pengumuman penting dari sekolah kami.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($news as $item)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <span class="text-blue-600 text-sm font-medium">{{ date('d M Y', strtotime($item['date'])) }}</span>
                        <h3 class="text-xl font-bold text-gray-800 mt-2 mb-3 line-clamp-2">{{ $item['title'] }}</h3>
                        <p class="text-gray-600 mb-4 line-clamp-3">{{ $item['excerpt'] }}</p>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-500 text-sm">Baca Selengkapnya</span>
                            <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="text-center mt-8">
                <a href="{{ route('news.index') }}" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition duration-200">
                    Lihat Semua Berita
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Galeri Foto -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Galeri Foto</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Momen-momen berharga dan kegiatan siswa di sekolah kami.</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($gallery as $index => $item)
                <div class="relative group cursor-pointer">
                    <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" class="w-full h-48 object-cover rounded-lg">
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-60 rounded-lg flex items-center justify-center transition duration-300">
                        <div class="text-white opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition duration-300 text-center">
                            <i class="fas fa-search-plus text-2xl mb-2"></i>
                            <p class="text-sm font-medium">{{ $item['title'] }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="text-center mt-8">
                <a href="{{ route('gallery.index') }}" class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-medium transition duration-200">
                    Lihat Semua Galeri
                    <i class="fas fa-images ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Quick Info PPDB -->
    <section class="py-16 bg-blue-600 text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-4">Penerimaan Peserta Didik Baru (PPDB) 2024/2025</h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto">Daftarkan putra-putri Anda sekarang juga! Kuota terbatas.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <div class="bg-white bg-opacity-10 rounded-lg p-6">
                    <div class="text-4xl font-bold mb-2">15 Juni</div>
                    <p>Pendaftaran Dibuka</p>
                </div>
                <div class="bg-white bg-opacity-10 rounded-lg p-6">
                    <div class="text-4xl font-bold mb-2">30 Juli</div>
                    <p>Pendaftaran Ditutup</p>
                </div>
                <div class="bg-white bg-opacity-10 rounded-lg p-6">
                    <div class="text-4xl font-bold mb-2">5 Agustus</div>
                    <p>Pengumuman</p>
                </div>
            </div>

            <div class="space-y-4 md:space-y-0 md:space-x-4">
                <a href="#" class="inline-block bg-white text-blue-600 hover:bg-gray-100 px-8 py-3 rounded-lg font-medium text-lg transition duration-200">
                    <i class="fas fa-user-plus mr-2"></i>Daftar Online
                </a>
                <a href="#" class="inline-block bg-transparent border-2 border-white hover:bg-blue-700 px-8 py-3 rounded-lg font-medium text-lg transition duration-200">
                    <i class="fas fa-info-circle mr-2"></i>Info Selengkapnya
                </a>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-gray-800 text-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="text-4xl font-bold text-blue-400 mb-2">1,250+</div>
                    <p class="text-gray-300">Siswa Aktif</p>
                </div>
                <div>
                    <div class="text-4xl font-bold text-green-400 mb-2">85+</div>
                    <p class="text-gray-300">Guru Berkualitas</p>
                </div>
                <div>
                    <div class="text-4xl font-bold text-yellow-400 mb-2">25+</div>
                    <p class="text-gray-300">Prestasi Nasional</p>
                </div>
                <div>
                    <div class="text-4xl font-bold text-red-400 mb-2">15+</div>
                    <p class="text-gray-300">Tahun Berpengalaman</p>
                </div>
            </div>
        </div>
    </section>
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
</style>
@endpush