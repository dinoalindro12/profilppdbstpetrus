<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title', 'Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-blue-800 text-white">
            <div class="p-4">
                <h1 class="text-2xl font-bold">SMAS St. Petrus</h1>
                <p class="text-blue-200 text-sm">Admin Panel</p>
            </div>
            
            <nav class="mt-6">
                <div class="px-4 space-y-2">
                    <!-- Dashboard -->
                    <a href="{{ route('admin.dashboard') }}" 
                       class="flex items-center py-2 px-4 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-blue-700' : 'hover:bg-blue-700' }}">
                       <span class="mr-3">📊</span>
                       <span>Dashboard</span>
                    </a>

                    <!-- Profil Sekolah Dropdown -->
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" 
                                class="flex items-center justify-between w-full py-2 px-4 rounded-lg {{ request()->routeIs('admin.profile.*') ? 'bg-blue-700' : 'hover:bg-blue-700' }}">
                            <div class="flex items-center">
                                <span class="mr-3">🏫</span>
                                <span>Profil Sekolah</span>
                            </div>
                            <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" 
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div x-show="open" @click.away="open = false" 
                             class="mt-1 ml-4 space-y-1 overflow-hidden transition-all duration-300">
                            <a href="#" 
                               class="flex items-center py-2 px-4 rounded-lg text-sm {{ request()->routeIs('admin.profile.history') ? 'bg-blue-600' : 'hover:bg-blue-700' }}">
                                <span class="mr-2">📖</span>
                                Sejarah
                            </a>
                            <a href="{{ route('admin.profile.vision-mission') }}" 
                               class="flex items-center py-2 px-4 rounded-lg text-sm {{ request()->routeIs('admin.profile.vision-mission') ? 'bg-blue-600' : 'hover:bg-blue-700' }}">
                                <span class="mr-2">🎯</span>
                                Visi & Misi
                            </a>
                            <a href="#" 
                               class="flex items-center py-2 px-4 rounded-lg text-sm {{ request()->routeIs('admin.profile.staff.*') ? 'bg-blue-600' : 'hover:bg-blue-700' }}">
                                <span class="mr-2">👨‍🏫</span>
                                Staff & Guru
                            </a>
                            <a href="#" 
                               class="flex items-center py-2 px-4 rounded-lg text-sm {{ request()->routeIs('admin.profile.facilities.*') ? 'bg-blue-600' : 'hover:bg-blue-700' }}">
                                <span class="mr-2">🏢</span>
                                Fasilitas
                            </a>
                        </div>
                    </div>

                    <!-- Akademik Dropdown -->
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" 
                                class="flex items-center justify-between w-full py-2 px-4 rounded-lg {{ request()->routeIs('admin.academic.*') ? 'bg-blue-700' : 'hover:bg-blue-700' }}">
                            <div class="flex items-center">
                                <span class="mr-3">📚</span>
                                <span>Akademik</span>
                            </div>
                            <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" 
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        
                        <div x-show="open" @click.away="open = false" 
                             class="mt-1 ml-4 space-y-1 overflow-hidden transition-all duration-300">
                            <a href="{{ route('admin.academic.curriculum.index') }}" 
                               class="flex items-center py-2 px-4 rounded-lg text-sm {{ request()->routeIs('admin.academic.curriculum.*') ? 'bg-blue-600' : 'hover:bg-blue-700' }}">
                                <span class="mr-2">📝</span>
                                Kurikulum
                            </a>
                            <a href="{{ route('admin.academic.extracurricular.index') }}" 
                               class="flex items-center py-2 px-4 rounded-lg text-sm {{ request()->routeIs('admin.academic.extracurricular.*') ? 'bg-blue-600' : 'hover:bg-blue-700' }}">
                                <span class="mr-2">⚽</span>
                                Ekstrakurikuler
                            </a>
                            <a href="{{ route('admin.academic.achievement.index') }}" 
                               class="flex items-center py-2 px-4 rounded-lg text-sm {{ request()->routeIs('admin.academic.achievement.*') ? 'bg-blue-600' : 'hover:bg-blue-700' }}">
                                <span class="mr-2">🏆</span>
                                Prestasi
                            </a>
                            <a href="{{ route('admin.academic.academic-calendars.index') }}" 
                               class="flex items-center py-2 px-4 rounded-lg text-sm {{ request()->routeIs('admin.academic.achievement.*') ? 'bg-blue-600' : 'hover:bg-blue-700' }}">
                                <span class="mr-2">🏆</span>
                                Kalender Akademik
                            </a>
                        </div>
                    </div>

                    <!-- PPDB Dropdown -->
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" 
                                class="flex items-center justify-between w-full py-2 px-4 rounded-lg {{ request()->routeIs('admin.ppdb.*') ? 'bg-blue-700' : 'hover:bg-blue-700' }}">
                            <div class="flex items-center">
                                <span class="mr-3">🎓</span>
                                <span>PPDB</span>
                            </div>
                            <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" 
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        
                        <div x-show="open" @click.away="open = false" 
                             class="mt-1 ml-4 space-y-1 overflow-hidden transition-all duration-300">
                            <a href="{{ route('admin.ppdb.info.index') }}" 
                               class="flex items-center py-2 px-4 rounded-lg text-sm {{ request()->routeIs('admin.ppdb.info.index') ? 'bg-blue-600' : 'hover:bg-blue-700' }}">
                                <span class="mr-2">ℹ️</span>
                                Info PPDB
                            </a>
                            <a href="{{ route('admin.ppdb.registration.index') }}" 
                               class="flex items-center py-2 px-4 rounded-lg text-sm {{ request()->routeIs('admin.ppdb.registration.index') ? 'bg-blue-600' : 'hover:bg-blue-700' }}">
                                <span class="mr-2">📋</span>
                                Pendaftaran
                            </a>
                        </div>
                    </div>

                    <!-- Berita Dropdown -->
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" 
                                class="flex items-center justify-between w-full py-2 px-4 rounded-lg {{ request()->routeIs('admin.news.*') ? 'bg-blue-700' : 'hover:bg-blue-700' }}">
                            <div class="flex items-center">
                                <span class="mr-3">📰</span>
                                <span>Berita</span>
                            </div>
                            <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" 
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        
                        <div x-show="open" @click.away="open = false" 
                             class="mt-1 ml-4 space-y-1 overflow-hidden transition-all duration-300">
                            <a href="" 
                               class="flex items-center py-2 px-4 rounded-lg text-sm {{ request()-> routeIs('admin.news.posts.index') ? 'bg-blue-600' : 'hover:bg-blue-700' }}">
                                <span class="mr-2">📄</span>
                                Semua Berita
                            </a>
                            <a href="#" 
                               class="flex items-center py-2 px-4 rounded-lg text-sm {{ request()->routeIs('admin.news.posts.create') ? 'bg-blue-600' : 'hover:bg-blue-700' }}">
                                <span class="mr-2">✏️</span>
                                Tambah Berita
                            </a>
                            <a href="#" 
                               class="flex items-center py-2 px-4 rounded-lg text-sm {{ request()->routeIs('admin.news.categories.*') ? 'bg-blue-600' : 'hover:bg-blue-700' }}">
                                <span class="mr-2">📑</span>
                                Kategori
                            </a>
                        </div>
                    </div>

                    <!-- Galeri -->
                    <a href="#" 
                       class="flex items-center py-2 px-4 rounded-lg {{ request()->routeIs('admin.gallery.*') ? 'bg-blue-700' : 'hover:bg-blue-700' }}">
                       <span class="mr-3">🖼️</span>
                       <span>Galeri</span>
                    </a>

                    <!-- Kontak Dropdown -->
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" 
                                class="flex items-center justify-between w-full py-2 px-4 rounded-lg {{ request()->routeIs('admin.kontak.*') ? 'bg-blue-700' : 'hover:bg-blue-700' }}">
                            <div class="flex items-center">
                                <span class="mr-3">📧</span>
                                <span>Kontak</span>
                            </div>
                            <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" 
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        
                        <div x-show="open" @click.away="open = false" 
                             class="mt-1 ml-4 space-y-1 overflow-hidden transition-all duration-300">
                            <a href="{{ route('admin.kontak.index') }}" 
                               class="flex items-center py-2 px-4 rounded-lg text-sm {{ request()->routeIs('admin.kontak.index') ? 'bg-blue-600' : 'hover:bg-blue-700' }}">
                                <span class="mr-2">📨</span>
                                Semua Pesan
                            </a>
                            <a href="{{ route('admin.kontak.index') }}#settings" 
                               class="flex items-center py-2 px-4 rounded-lg text-sm {{ request()->routeIs('admin.kontak.settings') ? 'bg-blue-600' : 'hover:bg-blue-700' }}">
                                <span class="mr-2">⚙️</span>
                                Pengaturan
                            </a>
                        </div>
                    </div>

                    <!-- Settings Dropdown -->
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" 
                                class="flex items-center justify-between w-full py-2 px-4 rounded-lg {{ request()->routeIs('admin.settings.*') ? 'bg-blue-700' : 'hover:bg-blue-700' }}">
                            <div class="flex items-center">
                                <span class="mr-3">⚙️</span>
                                <span>Pengaturan</span>
                            </div>
                            <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" 
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        
                        <div x-show="open" @click.away="open = false" 
                             class="mt-1 ml-4 space-y-1 overflow-hidden transition-all duration-300">
                            <a href="#" 
                               class="flex items-center py-2 px-4 rounded-lg text-sm {{ request()->routeIs('admin.settings.general') ? 'bg-blue-600' : 'hover:bg-blue-700' }}">
                                <span class="mr-2">🌐</span>
                                Pengaturan Umum
                            </a>
                            <a href="#" 
                               class="flex items-center py-2 px-4 rounded-lg text-sm {{ request()->routeIs('admin.settings.seo') ? 'bg-blue-600' : 'hover:bg-blue-700' }}">
                                <span class="mr-2">🔍</span>
                                SEO
                            </a>
                            <a href="#" 
                               class="flex items-center py-2 px-4 rounded-lg text-sm {{ request()->routeIs('admin.profile.edit') ? 'bg-blue-600' : 'hover:bg-blue-700' }}">
                                <span class="mr-2">👤</span>
                                Profile User
                            </a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Header -->
            <header class="bg-white shadow">
                <div class="flex justify-between items-center px-6 py-4">
                    <h2 class="text-xl font-semibold">@yield('title', 'Dashboard')</h2>
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-700">{{ Auth::user()->name }}</span>
                        
                        <!-- User Profile Dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" 
                                    class="flex items-center text-sm text-gray-700 hover:text-gray-900 focus:outline-none">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </button>

                            <!-- Dropdown menu -->
                            <div x-show="open" @click.away="open = false" 
                                 class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 border border-gray-200">
                                <a href="#" 
                                   class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <span class="mr-2">👤</span>
                                    Edit Profile
                                </a>
                                <div class="border-t border-gray-100"></div>
                                <!-- Logout Form -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" 
                                            class="flex items-center w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        <span class="mr-2">🚪</span>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto p-6">
                <!-- Flash Messages -->
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- Alpine.js for dropdown functionality -->
    <script src="//unpkg.com/alpinejs" defer></script>

    <style>
        /* Smooth transitions for dropdowns */
        [x-show] {
            transition: all 0.3s ease-in-out;
        }
        
        /* Custom scrollbar for sidebar */
        .sidebar-scroll {
            scrollbar-width: thin;
            scrollbar-color: #4B5563 #1E40AF;
        }
        
        .sidebar-scroll::-webkit-scrollbar {
            width: 6px;
        }
        
        .sidebar-scroll::-webkit-scrollbar-track {
            background: #1E40AF;
        }
        
        .sidebar-scroll::-webkit-scrollbar-thumb {
            background: #4B5563;
            border-radius: 3px;
        }
        
        .sidebar-scroll::-webkit-scrollbar-thumb:hover {
            background: #6B7280;
        }
    </style>
</body>
</html>