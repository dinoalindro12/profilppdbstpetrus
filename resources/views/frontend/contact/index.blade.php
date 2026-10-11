@extends('frontend.layouts.app')

@section('title', 'Kontak - Sekolah Kita')

@section('content')
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-12">
                <h1 class="text-3xl font-bold text-gray-800 mb-4">Hubungi Kami</h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Silakan hubungi kami melalui form berikut atau informasi kontak yang tersedia. 
                    Kami siap membantu menjawab pertanyaan Anda.
                </p>
            </div>

            <!-- Success Message -->
            @if(session('success'))
            <div class="mb-8 bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-lg">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            </div>
            @endif

            <!-- Rate Limit Error -->
            @error('rate_limit')
            <div class="mb-8 bg-red-100 border border-red-400 text-red-700 px-6 py-4 rounded-lg">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <span class="font-medium">{{ $message }}</span>
                </div>
            </div>
            @enderror

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Informasi Kontak -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Card Informasi Sekolah -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Informasi Kontak</h3>
                        
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mt-1">
                                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h4 class="font-semibold text-gray-700">Alamat Sekolah</h4>
                                    <p class="text-gray-600 mt-1">Jl. Nogio VI No. 117, Deli Tua Timur,<br>Kec. Deli Tua, Kab. Deli Serdang,<br>Sumatera Utara</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mt-1">
                                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h4 class="font-semibold text-gray-700">Telepon</h4>
                                    <p class="text-gray-600 mt-1">061-7030117</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mt-1">
                                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h4 class="font-semibold text-gray-700">Email</h4>
                                    <p class="text-gray-600 mt-1">smarkdelimurnidelitua@gmail.com</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mt-1">
                                    <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h4 class="font-semibold text-gray-700">Jam Operasional</h4>
                                    <p class="text-gray-600 mt-1">Senin–Jumat: 07.00–16.00 WIB</p>
                                </div>
                            </div>

                            {{-- Media Sosial --}}
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mt-1">
                                    <div class="w-10 h-10 bg-pink-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-pink-600" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h4 class="font-semibold text-gray-700 mb-3">Ikuti Kami</h4>
                                    <div class="mt-2 flex flex-col gap-2.5">
                                        {{-- Instagram --}}
                                        <a href="https://www.instagram.com/sma_dmdt/" target="_blank" rel="noopener noreferrer"
                                           class="inline-flex items-center gap-3 px-4 py-2.5 rounded-xl
                                                  bg-gradient-to-r from-purple-500 via-pink-500 to-orange-400
                                                  text-white text-sm font-semibold shadow-sm
                                                  hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 w-fit">
                                            <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                            </svg>
                                            @sma_dmdt
                                        </a>
                                        {{-- Facebook --}}
                                        <a href="https://www.facebook.com/delimurni.delitua/" target="_blank" rel="noopener noreferrer"
                                           class="inline-flex items-center gap-3 px-4 py-2.5 rounded-xl
                                                  bg-[#1877F2] text-white text-sm font-semibold shadow-sm
                                                  hover:bg-[#166fe5] hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 w-fit">
                                            <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                            </svg>
                                            Deli Murni Delitua
                                        </a>
                                        {{-- YouTube --}}
                                        <a href="https://www.youtube.com/@sma_dmdt" target="_blank" rel="noopener noreferrer"
                                           class="inline-flex items-center gap-3 px-4 py-2.5 rounded-xl
                                                  bg-[#FF0000] text-white text-sm font-semibold shadow-sm
                                                  hover:bg-[#cc0000] hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 w-fit">
                                            <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                            </svg>
                                            @sma_dmdt
                                        </a>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Card Lokasi -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Lokasi Kami</h3>
                        <!-- Google Maps Embed -->
                        <div class="rounded-lg overflow-hidden shadow-sm border border-gray-200">
                            <iframe 
                                src="https://www.google.com/maps?q=Jl.+Nogio+VI+No.+117,+Deli+Tua+Timur,+Kec.+Deli+Tua,+Kab.+Deli+Serdang,+Sumatera+Utara&output=embed"
                                class="w-full h-64"
                                style="border:0;"
                                allowfullscreen=""
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"
                                title="Lokasi SMA RK Deli Murni Delitua">
                            </iframe>
                        </div>
                        <p class="text-sm text-gray-600 mt-3 text-center">
                            Jl. Nogio VI No. 117, Deli Tua Timur, Kab. Deli Serdang
                        </p>
                    </div>
                </div>
                
                <!-- Form Kontak -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Kirim Pesan</h3>
                        <p class="text-gray-600 mb-6">Isi form berikut untuk mengirim pesan kepada kami.</p>

                        <form action="{{ route('contact.store') }}" method="POST">
                            @csrf
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                        Nama Lengkap <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="name" id="name" value="{{ old('name') }}" 
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                        placeholder="Masukkan nama lengkap">
                                    @error('name')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                        Email <span class="text-red-500">*</span>
                                    </label>
                                    <input type="email" name="email" id="email" value="{{ old('email') }}" 
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                        placeholder="nama@email.com">
                                    @error('email')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="tujuan" class="block text-sm font-medium text-gray-700 mb-2">
                                        Tujuan <span class="text-red-500">*</span>
                                    </label>
                                    <select name="tujuan" id="tujuan" 
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                                        <option value="">Pilih Tujuan Pesan</option>
                                        <option value="Informasi PPDB" {{ old('tujuan') == 'Informasi PPDB' ? 'selected' : '' }}>Informasi PPDB</option>
                                        <option value="Informasi Akademik" {{ old('tujuan') == 'Informasi Akademik' ? 'selected' : '' }}>Informasi Akademik</option>
                                        <option value="Informasi Pendaftaran" {{ old('tujuan') == 'Informasi Pendaftaran' ? 'selected' : '' }}>Informasi Pendaftaran</option>
                                        <option value="Kritik & Saran" {{ old('tujuan') == 'Kritik & Saran' ? 'selected' : '' }}>Kritik & Saran</option>
                                        <option value="Kerjasama" {{ old('tujuan') == 'Kerjasama' ? 'selected' : '' }}>Kerjasama</option>
                                        <option value="Lainnya" {{ old('tujuan') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                    @error('tujuan')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">
                                        Subjek <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="subject" id="subject" value="{{ old('subject') }}" 
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                        placeholder="Subjek pesan">
                                    @error('subject')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="md:col-span-2">
                                    <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                                        Pesan <span class="text-red-500">*</span>
                                    </label>
                                    <textarea name="message" id="message" rows="6" 
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                        placeholder="Tulis pesan Anda di sini...">{{ old('message') }}</textarea>
                                    @error('message')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Informasi Rate Limit -->
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                                <div class="flex items-start">
                                </div>
                            </div>

                            <div class="flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
    <p class="text-sm text-gray-600">
        Field dengan tanda <span class="text-red-500">*</span> wajib diisi
    </p>
    <div class="flex space-x-4">
        <button type="reset" 
                class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-lg font-medium transition duration-200 shadow-sm">
            Reset Form
        </button>
        <button type="submit" 
                class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-medium transition duration-200 shadow-sm flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
            </svg>
            Kirim Pesan
        </button>
    </div>
</div>
                        </form>
                    </div>

                    <!-- FAQ Section -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mt-8">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Pertanyaan Umum</h3>
                        
                        <div class="space-y-4">
                            <div class="border-b border-gray-200 pb-4">
                                <button class="flex justify-between items-center w-full text-left font-medium text-gray-800 hover:text-blue-600 transition duration-200">
                                    <span>Bagaimana cara mendaftar PPDB?</span>
                                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>
                                <p class="mt-2 text-gray-600 text-sm hidden">
                                    Pendaftaran PPDB dapat dilakukan secara online melalui website kami. 
                                    Pastikan Anda memiliki dokumen yang diperlukan sebelum memulai proses pendaftaran.
                                </p>
                            </div>
                            
                            <div class="border-b border-gray-200 pb-4">
                                <button class="flex justify-between items-center w-full text-left font-medium text-gray-800 hover:text-blue-600 transition duration-200">
                                    <span>Kapan jadwal penerimaan siswa baru?</span>
                                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>
                                <p class="mt-2 text-gray-600 text-sm hidden">
                                    Jadwal penerimaan siswa baru biasanya dibuka pada bulan Januari setiap tahunnya. 
                                    Silakan pantau website kami untuk informasi terbaru.
                                </p>
                            </div>
                            
                            <div class="border-b border-gray-200 pb-4">
                                <button class="flex justify-between items-center w-full text-left font-medium text-gray-800 hover:text-blue-600 transition duration-200">
                                    <span>Dokumen apa saja yang diperlukan untuk pendaftaran?</span>
                                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>
                                <p class="mt-2 text-gray-600 text-sm hidden">
                                    Dokumen yang diperlukan antara lain: Akta Kelahiran, Kartu Keluarga, 
                                    Rapor semester terakhir, dan Pas Foto 3x4.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- JavaScript untuk FAQ Accordion -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const faqButtons = document.querySelectorAll('.bg-white.rounded-xl button');
    
    faqButtons.forEach(button => {
        button.addEventListener('click', function() {
            const content = this.nextElementSibling;
            const isHidden = content.classList.contains('hidden');
            
            // Close all other FAQ items
            faqButtons.forEach(otherButton => {
                if (otherButton !== this) {
                    otherButton.nextElementSibling.classList.add('hidden');
                    otherButton.querySelector('svg').style.transform = 'rotate(0deg)';
                }
            });
            
            // Toggle current FAQ item
            if (isHidden) {
                content.classList.remove('hidden');
                this.querySelector('svg').style.transform = 'rotate(180deg)';
            } else {
                content.classList.add('hidden');
                this.querySelector('svg').style.transform = 'rotate(0deg)';
            }
        });
    });
    
    // Auto-fill subject based on tujuan selection
    const tujuanSelect = document.getElementById('tujuan');
    const subjectInput = document.getElementById('subject');
    
    if (tujuanSelect && subjectInput) {
        tujuanSelect.addEventListener('change', function() {
            if (this.value && !subjectInput.value) {
                subjectInput.value = 'Pertanyaan mengenai ' + this.value;
            }
        });
    }
});
</script>

<style>
/* Smooth transition for FAQ accordion */
.bg-white.rounded-xl p {
    transition: all 0.3s ease-in-out;
}

.bg-white.rounded-xl svg {
    transition: transform 0.3s ease-in-out;
}
</style>
@endsection