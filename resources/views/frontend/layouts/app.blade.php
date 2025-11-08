<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sekolah Kita') - Website Resmi</title>
    <meta name="description" content="@yield('description', 'Website resmi Sekolah Kita - Pendidikan Berkualitas untuk Generasi Unggul')">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <div class="flex items-center space-x-4">
                    <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center">
                        <img src="{{ asset('storage/backgrounds/logo2.png') }}" alt="Logo Sekolah" class="h-8 w-auto">
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-800">SMAS ST. Petrus</h1>
                        <p class="text-xs text-gray-600">Sekolah Unggulan Terpercaya</p>
                    </div>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600 font-medium {{ request()->routeIs('home') ? 'text-blue-600 border-b-2 border-blue-600' : '' }}">Beranda</a>
                    
                    <!-- Profil Dropdown -->
                    <div class="relative group">
                        <button class="text-gray-700 hover:text-blue-600 font-medium flex items-center focus:outline-none">
                            Profil
                            <i class="fas fa-chevron-down ml-1 text-xs"></i>
                        </button>
                        <div class="absolute left-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                            <a href="{{ route('profile.history') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600">Sejarah</a>
                            <a href="{{ route('profile.vision-mission') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600">Visi & Misi</a>
                            <a href="{{ route('profile.teachers') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600">Guru</a>
                            <a href="{{ route('profile.staff') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600">Staf</a>
                            <a href="{{ route('profile.facilities') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600">Fasilitas</a>
                        </div>
                    </div>
                    
                    <!-- Akademik Dropdown -->
                    <div class="relative group">
                        <button class="text-gray-700 hover:text-blue-600 font-medium flex items-center focus:outline-none">
                            Akademik
                            <i class="fas fa-chevron-down ml-1 text-xs"></i>
                        </button>
                        <div class="absolute left-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                            <a href="{{ route('academic.curriculum') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600">Kurikulum</a>
                            <a href="{{ route('academic.extracurricular') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600">Ekstrakurikuler</a>
                            <a href="{{ route('academic.achievement') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600">Prestasi</a>
                            <a href="{{ route('academic-calendars.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600">Kalender Akademik</a>
                        </div>
                    </div>
                    <!-- PPDB Dropdown -->
                    <div class="relative group">
                        <button class="text-gray-700 hover:text-blue-600 font-medium flex items-center focus:outline-none">
                            PPDB
                            <i class="fas fa-chevron-down ml-1 text-xs"></i>
                        </button>
                        <div class="absolute left-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                            <a href="{{ route('ppdb.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600">PPDB</a>
                            <a href="{{ route('ppdb.info') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600">Informasi PPDB</a>
                            <a href="{{ route('ppdb.form') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600">Daftar</a>
                        </div>
                    </div>

                    <div class="relative group">
                        <button class="text-gray-700 hover:text-blue-600 font-medium flex items-center focus:outline-none">
                            Galeri
                            <i class="fas fa-chevron-down ml-1 text-xs"></i>
                        </button>
                        <div class="absolute left-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                            <a href="{{ route('gallery.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600">Galeri Harian</a>
                            <a href="{{ route('ppdb.info') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600">Galeri Alumni</a>
                            <a href="{{ route('ppdb.form') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600">Galeri Guru</a>
                        </div>
                    </div>
                    
                    <!-- Menu Lainnya -->
                    <a href="{{ route('news.index') }}" class="text-gray-700 hover:text-blue-600 font-medium {{ request()->routeIs('news.*') ? 'text-blue-600 border-b-2 border-blue-600' : '' }}">Berita</a>
                    <a href="{{ route('contact.contact') }}" class="text-gray-700 hover:text-blue-600 font-medium {{ request()->routeIs('contact.*') ? 'text-blue-600 border-b-2 border-blue-600' : '' }}">Kontak</a>
                    
                    <!-- Login Button -->
                    <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium">Login Admin</a>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button type="button" id="mobile-menu-button" class="text-gray-700 hover:text-blue-600 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="md:hidden hidden pb-4 border-t border-gray-200 mt-4">
                <div class="flex flex-col space-y-3 mt-4">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600 font-medium py-2 {{ request()->routeIs('home') ? 'text-blue-600' : '' }}">Beranda</a>
                    
                    <!-- Profil Mobile -->
                    <div class="border-l-2 border-blue-100 pl-4">
                        <button type="button" class="mobile-dropdown-toggle text-gray-700 hover:text-blue-600 font-medium py-2 flex items-center justify-between w-full">
                            <span>Profil</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>
                        <div class="mobile-dropdown-content hidden pl-4 mt-2 space-y-2">
                            <a href="{{ route('profile.history') }}" class="block text-gray-700 hover:text-blue-600 font-medium py-1">Sejarah</a>
                            <a href="{{ route('profile.vision-mission') }}" class="block text-gray-700 hover:text-blue-600 font-medium py-1">Visi & Misi</a>
                            <a href="{{ route('profile.teachers') }}" class="block text-gray-700 hover:text-blue-600 font-medium py-1">Guru</a>
                            <a href="{{ route('profile.staff') }}" class="block text-gray-700 hover:text-blue-600 font-medium py-1">Staf</a>
                            <a href="{{ route('profile.facilities') }}" class="block text-gray-700 hover:text-blue-600 font-medium py-1">Fasilitas</a>
                        </div>
                    </div>
                    
                    <!-- Akademik Mobile -->
                    <div class="border-l-2 border-blue-100 pl-4">
                        <button type="button" class="mobile-dropdown-toggle text-gray-700 hover:text-blue-600 font-medium py-2 flex items-center justify-between w-full">
                            <span>Akademik</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>
                        <div class="mobile-dropdown-content hidden pl-4 mt-2 space-y-2">
                            <a href="{{ route('academic.curriculum') }}" class="block text-gray-700 hover:text-blue-600 font-medium py-1">Kurikulum</a>
                            <a href="{{ route('academic.extracurricular') }}" class="block text-gray-700 hover:text-blue-600 font-medium py-1">Ekstrakurikuler</a>
                            <a href="{{ route('academic.achievement') }}" class="block text-gray-700 hover:text-blue-600 font-medium py-1">Prestasi</a>
                            <a href="{{ route('academic-calendars.index') }}" class="block text-gray-700 hover:text-blue-600 font-medium py-1">Prestasi</a>
                        </div>
                    </div>

                    <div class="border-l-2 border-blue-100 pl-4">
                        <button type="button" class="mobile-dropdown-toggle text-gray-700 hover:text-blue-600 font-medium py-2 flex items-center justify-between w-full">
                            <span>Galeri</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>
                        <div class="mobile-dropdown-content hidden pl-4 mt-2 space-y-2">
                            <a href="{{ route('gallery.index') }}" class="block text-gray-700 hover:text-blue-600 font-medium py-1">Galeri Harian</a>
                            <a href="{{ route('academic.extracurricular') }}" class="block text-gray-700 hover:text-blue-600 font-medium py-1">Galeri Alumni</a>
                            <a href="{{ route('academic.achievement') }}" class="block text-gray-700 hover:text-blue-600 font-medium py-1">Galeri Guru</a>
                    </div>
                    
                    <!-- Menu Lainnya Mobile -->
                    <a href="{{ route('ppdb.index') }}" class="text-gray-700 hover:text-blue-600 font-medium py-2 {{ request()->routeIs('ppdb.*') ? 'text-blue-600' : '' }}">PPDB</a>
                    <a href="{{ route('news.index') }}" class="text-gray-700 hover:text-blue-600 font-medium py-2 {{ request()->routeIs('news.*') ? 'text-blue-600' : '' }}">Berita</a>
                    
                    <a href="{{ route('contact.contact') }}" class="text-gray-700 hover:text-blue-600 font-medium py-2 {{ request()->routeIs('contact.*') ? 'text-blue-600' : '' }}">Kontak</a>
                    
                    <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium text-center mt-4">Login Admin</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white pt-12 pb-6">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- About -->
                <div>
                    <h3 class="text-xl font-bold mb-4">Tentang Sekolah</h3>
                    <p class="text-gray-300 mb-4">Sekolah Kita adalah institusi pendidikan yang berkomitmen untuk memberikan pendidikan terbaik bagi generasi penerus bangsa.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-300 hover:text-white transition duration-200">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white transition duration-200">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white transition duration-200">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white transition duration-200">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-xl font-bold mb-4">Menu Cepat</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-white transition duration-200">Beranda</a></li>
                        <li><a href="{{ route('profile.history') }}" class="text-gray-300 hover:text-white transition duration-200">Sejarah</a></li>
                        <li><a href="{{ route('profile.vision-mission') }}" class="text-gray-300 hover:text-white transition duration-200">Visi & Misi</a></li>
                        <li><a href="{{ route('academic.achievement') }}" class="text-gray-300 hover:text-white transition duration-200">Prestasi</a></li>
                        <li><a href="{{ route('contact.contact') }}" class="text-gray-300 hover:text-white transition duration-200">Kontak</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h3 class="text-xl font-bold mb-4">Kontak Kami</h3>
                    <ul class="space-y-3 text-gray-300">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-3 text-blue-400"></i>
                            <span>Jl. Pendidikan No. 123, Jakarta Pusat</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-phone mt-1 mr-3 text-blue-400"></i>
                            <span>(021) 1234-5678</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-envelope mt-1 mr-3 text-blue-400"></i>
                            <span>info@sekolahkita.sch.id</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-clock mt-1 mr-3 text-blue-400"></i>
                            <span>Senin - Jumat: 07:00 - 16:00</span>
                        </li>
                    </ul>
                </div>

                <!-- Newsletter -->
                <div>
                    <h3 class="text-xl font-bold mb-4">Newsletter</h3>
                    <p class="text-gray-300 mb-4">Berlangganan newsletter untuk mendapatkan informasi terbaru.</p>
                    <form class="flex flex-col space-y-3">
                        <input type="email" placeholder="Email Anda" class="px-4 py-2 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg font-medium transition duration-200">
                            <i class="fas fa-paper-plane mr-2"></i>Berlangganan
                        </button>
                    </form>
                </div>
            </div>

            <div class="border-t border-gray-700 mt-8 pt-6 text-center text-gray-300">
                <p>&copy; {{ date('Y') }} Sekolah Kita. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        // Mobile Menu Toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Mobile Dropdown Toggle
        document.querySelectorAll('.mobile-dropdown-toggle').forEach(button => {
            button.addEventListener('click', function() {
                const content = this.nextElementSibling;
                content.classList.toggle('hidden');
                
                // Rotate arrow
                const icon = this.querySelector('i');
                icon.classList.toggle('fa-chevron-down');
                icon.classList.toggle('fa-chevron-up');
            });
        });

        // Simple Slider Functionality
        let currentSlide = 0;
        function showSlide(index) {
            const slides = document.querySelectorAll('.slide');
            const dots = document.querySelectorAll('.dot');
            
            if (index >= slides.length) currentSlide = 0;
            else if (index < 0) currentSlide = slides.length - 1;
            else currentSlide = index;
            
            slides.forEach(slide => slide.classList.add('hidden'));
            dots.forEach(dot => dot.classList.remove('bg-white', 'bg-opacity-100'));
            
            slides[currentSlide].classList.remove('hidden');
            dots[currentSlide].classList.add('bg-white', 'bg-opacity-100');
        }

        function nextSlide() {
            showSlide(currentSlide + 1);
        }

        function prevSlide() {
            showSlide(currentSlide - 1);
        }

        // Auto slide every 5 seconds
        setInterval(nextSlide, 5000);

        // Initialize first slide
        document.addEventListener('DOMContentLoaded', function() {
            showSlide(0);
        });
    </script>

    @stack('scripts')
</body>
</html>