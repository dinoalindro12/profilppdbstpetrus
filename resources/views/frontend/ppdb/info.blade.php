@extends('frontend.layouts.app')

@section('title', 'Informasi Pendaftaran PPDB - SMAS St. Petrus Medan')

@section('content')
<section class="py-8 md:py-16 bg-gradient-to-br from-blue-50 to-indigo-100">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <!-- Header Section -->
            <div class="text-center mb-8 md:mb-12">
                <div class="inline-flex items-center px-3 py-1 md:px-4 md:py-2 bg-blue-100 text-blue-800 rounded-full text-xs md:text-sm font-medium mb-3 md:mb-4">
                    <svg class="w-3 h-3 md:w-4 md:h-4 mr-1 md:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Penerimaan Peserta Didik Baru
                </div>
                <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-800 mb-3 md:mb-4">Informasi Pendaftaran PPDB</h1>
                <p class="text-lg md:text-xl text-gray-600">Tahun Ajaran 2024/2025</p>
            </div>

            <!-- Salam Pembuka -->
            <div class="bg-white rounded-xl md:rounded-2xl shadow-sm border border-blue-200 p-4 sm:p-6 md:p-8 mb-6 md:mb-8">
                <div class="flex flex-col lg:flex-row items-start gap-4 sm:gap-6 md:gap-8">
                    <!-- Gambar Orang Mengucapkan Salam -->
                    <div class="flex-shrink-0 w-full lg:w-1/3 mb-4 lg:mb-0">
                        <div class="relative">
                            <img 
                                src="https://images.unsplash.com/photo-1577896851231-70ef18881754?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" 
                                alt="Guru SMAS St. Petrus Medan menyambut calon siswa"
                                class="w-full h-48 sm:h-56 md:h-64 lg:h-72 object-cover rounded-lg md:rounded-xl shadow-sm"
                            >
                            <div class="absolute bottom-2 left-2 md:bottom-4 md:left-4 bg-blue-600 text-white px-2 py-1 md:px-3 md:py-1 rounded-full text-xs md:text-sm font-medium">
                                🎓 Guru Pembimbing
                            </div>
                        </div>
                    </div>

                    <!-- Konten Teks -->
                    <div class="flex-1">
                        <div class="flex items-start mb-4 md:mb-6">
                            <div class="flex-shrink-0 mr-3 md:mr-4">
                                <div class="w-8 h-8 md:w-12 md:h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 md:w-6 md:h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mb-1 md:mb-2">Salam Sejahtera, Calon Siswa SMAS St. Petrus Medan! 🎓</h2>
                                <p class="text-blue-600 font-medium text-sm md:text-base">Selamat datang di keluarga besar kami</p>
                            </div>
                        </div>

                        <div class="prose prose-sm sm:prose-lg text-gray-600 space-y-3 md:space-y-4">
                            <p class="text-base md:text-lg leading-relaxed">
                                Selamat datang di halaman informasi Penerimaan Peserta Didik Baru (PPDB) <strong class="text-blue-700">SMAS St. Petrus Medan</strong>. 
                                Kami mengucapkan terima kasih atas minat dan kepercayaan Anda untuk bergabung menjadi bagian dari keluarga besar sekolah kami.
                            </p>
                            <p class="text-base md:text-lg leading-relaxed">
                                Sebagai langkah awal menuju pendidikan yang berkualitas, kami mengajak Anda untuk mempersiapkan diri dengan baik. 
                                Mari kita wujudkan impian pendidikan terbaik bersama SMAS St. Petrus Medan.
                            </p>
                            
                            <!-- Quote dari Kepala Sekolah -->
                            <div class="bg-blue-50 border-l-4 border-blue-500 pl-4 md:pl-6 py-3 md:py-4 mt-4 md:mt-6 rounded-r-lg">
                                <p class="text-gray-700 italic text-sm md:text-base">
                                    "Pendidikan adalah senjata paling ampuh untuk mengubah dunia. 
                                    Mari bersama-sama kita raih masa depan gemilang di SMAS St. Petrus Medan."
                                </p>
                                <p class="text-xs md:text-sm text-gray-600 mt-1 md:mt-2 font-medium">
                                    — Dr. Maria Sihombing, M.Pd.<br>
                                    <span class="text-blue-600">Kepala Sekolah SMAS St. Petrus Medan</span>
                                </p>
                            </div>
                        </div>

                        <!-- Stats Mini -->
                        <div class="grid grid-cols-3 gap-3 md:gap-4 mt-4 md:mt-6 pt-4 md:pt-6 border-t border-gray-100">
                            <div class="text-center">
                                <div class="text-lg sm:text-xl md:text-2xl font-bold text-blue-600">98%</div>
                                <div class="text-xs md:text-sm text-gray-600">Kelulusan</div>
                            </div>
                            <div class="text-center">
                                <div class="text-lg sm:text-xl md:text-2xl font-bold text-blue-600">25+</div>
                                <div class="text-xs md:text-sm text-gray-600">Program</div>
                            </div>
                            <div class="text-center">
                                <div class="text-lg sm:text-xl md:text-2xl font-bold text-blue-600">50+</div>
                                <div class="text-xs md:text-sm text-gray-600">Guru Berprestasi</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informasi Penting -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 md:gap-8 mb-8 md:mb-12">
                <!-- Card Periode Pendaftaran -->
                <div class="bg-white rounded-lg md:rounded-xl shadow-sm border border-green-100 p-4 sm:p-5 md:p-6">
                    <div class="flex items-center mb-3 md:mb-4">
                        <div class="w-8 h-8 md:w-10 md:h-10 lg:w-12 lg:h-12 bg-green-100 rounded-lg flex items-center justify-center mr-3 md:mr-4">
                            <svg class="w-4 h-4 md:w-5 md:h-5 lg:w-6 lg:h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-base md:text-lg font-semibold text-gray-800">Periode Pendaftaran</h3>
                    </div>
                    <p class="text-gray-600 text-sm md:text-base mb-1 md:mb-2"><strong>Mulai:</strong> 1 Juni 2024</p>
                    <p class="text-gray-600 text-sm md:text-base mb-1 md:mb-2"><strong>Selesai:</strong> 30 Juni 2024</p>
                    <p class="text-xs md:text-sm text-gray-500">Pukul 08.00 - 16.00 WIB</p>
                </div>

                <!-- Card Kuota -->
                <div class="bg-white rounded-lg md:rounded-xl shadow-sm border border-blue-100 p-4 sm:p-5 md:p-6">
                    <div class="flex items-center mb-3 md:mb-4">
                        <div class="w-8 h-8 md:w-10 md:h-10 lg:w-12 lg:h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-3 md:mr-4">
                            <svg class="w-4 h-4 md:w-5 md:h-5 lg:w-6 lg:h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-base md:text-lg font-semibold text-gray-800">Kuota Penerimaan</h3>
                    </div>
                    <p class="text-xl md:text-2xl font-bold text-blue-600 mb-1 md:mb-2">120 Siswa</p>
                    <p class="text-xs md:text-sm text-gray-500">3 Kelas @ 40 Siswa</p>
                </div>

                <!-- Card Kontak -->
                <div class="bg-white rounded-lg md:rounded-xl shadow-sm border border-purple-100 p-4 sm:p-5 md:p-6 md:col-span-2 lg:col-span-1">
                    <div class="flex items-center mb-3 md:mb-4">
                        <div class="w-8 h-8 md:w-10 md:h-10 lg:w-12 lg:h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-3 md:mr-4">
                            <svg class="w-4 h-4 md:w-5 md:h-5 lg:w-6 lg:h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <h3 class="text-base md:text-lg font-semibold text-gray-800">Informasi & Bantuan</h3>
                    </div>
                    <p class="text-gray-600 text-sm md:text-base mb-1 md:mb-2"><strong>Telepon:</strong> (061) 1234567</p>
                    <p class="text-gray-600 text-sm md:text-base mb-1 md:mb-2"><strong>WhatsApp:</strong> 0812-3456-7890</p>
                    <p class="text-xs md:text-sm text-gray-500">Senin - Jumat, 08.00-16.00 WIB</p>
                </div>
            </div>

            <!-- Himbauan Berkas -->
            <div class="bg-white rounded-xl md:rounded-2xl shadow-sm border border-blue-200 overflow-hidden mb-8 md:mb-12">
                <div class="bg-blue-600 px-4 sm:px-6 md:px-8 py-4 md:py-6">
                    <h2 class="text-lg sm:text-xl md:text-2xl font-bold text-white flex items-center">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 md:w-6 md:h-6 mr-2 sm:mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Persiapkan Berkas Berikut Sebelum Mendaftar
                    </h2>
                </div>
                
                <div class="p-4 sm:p-6 md:p-8">
                    <p class="text-base md:text-lg text-gray-700 mb-4 md:mb-6">
                        Untuk kelancaran proses pendaftaran, pastikan Anda telah menyiapkan <strong>dokumen-dokumen berikut</strong> 
                        dalam format asli dan fotokopi yang jelas:
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                        <!-- Kartu Keluarga -->
                        <div class="flex items-start p-4 sm:p-5 md:p-6 bg-white rounded-lg border border-gray-200 hover:border-blue-300 transition duration-200">
                            <div class="flex-shrink-0 mr-3 md:mr-4">
                                <div class="w-8 h-8 md:w-10 md:h-10 lg:w-12 lg:h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 md:w-5 md:h-5 lg:w-6 lg:h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800 mb-1 md:mb-2 text-sm md:text-base">Kartu Keluarga (KK)</h3>
                                <p class="text-gray-600 text-xs md:text-sm mb-2 md:mb-3">Fotokopi yang telah dilegalisir</p>
                                <div class="flex items-center text-xs text-red-600 font-medium">
                                    <svg class="w-3 h-3 md:w-4 md:h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                    </svg>
                                    <span>WAJIB</span>
                                </div>
                            </div>
                        </div>

                        <!-- Akta Kelahiran -->
                        <div class="flex items-start p-4 sm:p-5 md:p-6 bg-white rounded-lg border border-gray-200 hover:border-blue-300 transition duration-200">
                            <div class="flex-shrink-0 mr-3 md:mr-4">
                                <div class="w-8 h-8 md:w-10 md:h-10 lg:w-12 lg:h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 md:w-5 md:h-5 lg:w-6 lg:h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800 mb-1 md:mb-2 text-sm md:text-base">Akta Kelahiran</h3>
                                <p class="text-gray-600 text-xs md:text-sm mb-2 md:mb-3">Fotokopi yang telah dilegalisir</p>
                                <div class="flex items-center text-xs text-red-600 font-medium">
                                    <svg class="w-3 h-3 md:w-4 md:h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                    </svg>
                                    <span>WAJIB</span>
                                </div>
                            </div>
                        </div>

                        <!-- Foto 3x4 -->
                        <div class="flex items-start p-4 sm:p-5 md:p-6 bg-white rounded-lg border border-gray-200 hover:border-blue-300 transition duration-200">
                            <div class="flex-shrink-0 mr-3 md:mr-4">
                                <div class="w-8 h-8 md:w-10 md:h-10 lg:w-12 lg:h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 md:w-5 md:h-5 lg:w-6 lg:h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800 mb-1 md:mb-2 text-sm md:text-base">Foto 3x4</h3>
                                <p class="text-gray-600 text-xs md:text-sm mb-2 md:mb-3">3 lembar, background merah, berpakaian formal</p>
                                <div class="flex items-center text-xs text-red-600 font-medium">
                                    <svg class="w-3 h-3 md:w-4 md:h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                    </svg>
                                    <span>WAJIB</span>
                                </div>
                            </div>
                        </div>

                        <!-- Raport Terakhir -->
                        <div class="flex items-start p-4 sm:p-5 md:p-6 bg-white rounded-lg border border-gray-200 hover:border-blue-300 transition duration-200">
                            <div class="flex-shrink-0 mr-3 md:mr-4">
                                <div class="w-8 h-8 md:w-10 md:h-10 lg:w-12 lg:h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 md:w-5 md:h-5 lg:w-6 lg:h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800 mb-1 md:mb-2 text-sm md:text-base">Raport Terakhir</h3>
                                <p class="text-gray-600 text-xs md:text-sm mb-2 md:mb-3">Fotokopi raport semester 1-5 SMP/MTs</p>
                                <div class="flex items-center text-xs text-red-600 font-medium">
                                    <svg class="w-3 h-3 md:w-4 md:h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                    </svg>
                                    <span>WAJIB</span>
                                </div>
                            </div>
                        </div>

                        <!-- Dokumen Tambahan (Opsional) -->
                        <div class="flex items-start p-4 sm:p-5 md:p-6 bg-white rounded-lg border border-gray-200 hover:border-blue-300 transition duration-200 md:col-span-2">
                            <div class="flex-shrink-0 mr-3 md:mr-4">
                                <div class="w-8 h-8 md:w-10 md:h-10 lg:w-12 lg:h-12 bg-blue-50 rounded-lg flex items-center justify-center border border-blue-200">
                                    <svg class="w-4 h-4 md:w-5 md:h-5 lg:w-6 lg:h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800 mb-1 md:mb-2 text-sm md:text-base">Dokumen Tambahan (Jika Ada)</h3>
                                <ul class="text-gray-600 text-xs md:text-sm list-disc list-inside space-y-1 mb-2 md:mb-3">
                                    <li>Sertifikat prestasi akademik/non-akademik</li>
                                    <li>Surat keterangan tidak mampu (bagi yang berhak)</li>
                                    <li>Dokumen lain yang mendukung</li>
                                </ul>
                                <div class="flex items-center text-xs text-blue-600 font-medium">
                                    <svg class="w-3 h-3 md:w-4 md:h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span>OPSIONAL - Untuk pertimbangan tambahan</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Catatan Penting -->
                    <div class="mt-6 md:mt-8 p-4 md:p-6 bg-blue-50 border border-blue-200 rounded-lg">
                        <div class="flex items-start">
                            <svg class="w-4 h-4 md:w-5 md:h-5 text-blue-600 mt-0.5 mr-2 md:mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                            <div>
                                <h4 class="font-semibold text-blue-800 mb-2 md:mb-3 text-sm md:text-base">Perhatian!</h4>
                                <ul class="text-blue-700 text-xs md:text-sm list-disc list-inside space-y-1 md:space-y-2">
                                    <li>Pastikan semua dokumen dalam kondisi lengkap dan terbaca jelas</li>
                                    <li>Fotokopi harus sudah dilegalisir oleh sekolah asal</li>
                                    <li>Dokumen yang tidak lengkap dapat menghambat proses pendaftaran</li>
                                    <li>Simpan dokumen asli dengan baik untuk keperluan verifikasi</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Timeline Pendaftaran -->
            <div class="bg-white rounded-xl md:rounded-2xl shadow-sm border border-gray-200 p-4 sm:p-6 md:p-8 mb-8 md:mb-12">
                <h2 class="text-xl md:text-2xl font-bold text-gray-800 mb-6 md:mb-8 text-center">Alur Pendaftaran</h2>
                
                <div class="relative">
                    <!-- Timeline Line - Hidden on mobile, visible on md and up -->
                    <div class="hidden md:block absolute left-4 lg:left-8 top-0 bottom-0 w-0.5 bg-blue-200 transform -translate-x-1/2"></div>
                    
                    <!-- Step 1 -->
                    <div class="relative flex items-start mb-6 md:mb-8">
                        <div class="flex-shrink-0 w-10 h-10 md:w-12 md:h-12 lg:w-16 lg:h-16 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-sm md:text-lg z-10">
                            1
                        </div>
                        <div class="ml-3 md:ml-4 lg:ml-6 flex-1">
                            <h3 class="text-lg md:text-xl font-semibold text-gray-800 mb-1 md:mb-2">Persiapan Berkas</h3>
                            <p class="text-gray-600 text-sm md:text-base">Siapkan semua dokumen yang diperlukan sesuai dengan daftar di atas</p>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="relative flex items-start mb-6 md:mb-8">
                        <div class="flex-shrink-0 w-10 h-10 md:w-12 md:h-12 lg:w-16 lg:h-16 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-sm md:text-lg z-10">
                            2
                        </div>
                        <div class="ml-3 md:ml-4 lg:ml-6 flex-1">
                            <h3 class="text-lg md:text-xl font-semibold text-gray-800 mb-1 md:mb-2">Pendaftaran Online</h3>
                            <p class="text-gray-600 text-sm md:text-base">Isi formulir pendaftaran online melalui website resmi sekolah</p>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="relative flex items-start mb-6 md:mb-8">
                        <div class="flex-shrink-0 w-10 h-10 md:w-12 md:h-12 lg:w-16 lg:h-16 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-sm md:text-lg z-10">
                            3
                        </div>
                        <div class="ml-3 md:ml-4 lg:ml-6 flex-1">
                            <h3 class="text-lg md:text-xl font-semibold text-gray-800 mb-1 md:mb-2">Verifikasi Berkas</h3>
                            <p class="text-gray-600 text-sm md:text-base">Tim PPDB akan memverifikasi kelengkapan dan keabsahan dokumen</p>
                        </div>
                    </div>

                    <!-- Step 4 -->
                    <div class="relative flex items-start mb-6 md:mb-8">
                        <div class="flex-shrink-0 w-10 h-10 md:w-12 md:h-12 lg:w-16 lg:h-16 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-sm md:text-lg z-10">
                            4
                        </div>
                        <div class="ml-3 md:ml-4 lg:ml-6 flex-1">
                            <h3 class="text-lg md:text-xl font-semibold text-gray-800 mb-1 md:mb-2">Pengumuman Hasil</h3>
                            <p class="text-gray-600 text-sm md:text-base">Hasil seleksi akan diumumkan melalui website dan pengumuman di sekolah</p>
                        </div>
                    </div>

                    <!-- Step 5 -->
                    <div class="relative flex items-start">
                        <div class="flex-shrink-0 w-10 h-10 md:w-12 md:h-12 lg:w-16 lg:h-16 bg-green-600 rounded-full flex items-center justify-center text-white font-bold text-sm md:text-lg z-10">
                            5
                        </div>
                        <div class="ml-3 md:ml-4 lg:ml-6 flex-1">
                            <h3 class="text-lg md:text-xl font-semibold text-gray-800 mb-1 md:mb-2">Daftar Ulang</h3>
                            <p class="text-gray-600 text-sm md:text-base">Siswa yang diterima melakukan daftar ulang dengan melengkapi administrasi</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Call to Action -->
            <div class="text-center">
                <div class="bg-white border-2 border-blue-200 rounded-xl md:rounded-2xl p-6 md:p-8 shadow-sm">
                    <h2 class="text-xl md:text-2xl font-bold text-gray-800 mb-3 md:mb-4">Siap Bergabung dengan SMAS St. Petrus Medan?</h2>
                    <p class="text-gray-600 mb-4 md:mb-6 text-base md:text-lg">Mari wujudkan impian pendidikan terbaik Anda bersama kami</p>
                    <div class="flex flex-col sm:flex-row justify-center gap-3 md:gap-4">
                        <a href="{{ route('ppdb.form') }}" class="bg-blue-600 text-white px-6 md:px-8 py-2 md:py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-200 shadow-sm text-sm md:text-base">
                            Daftar Sekarang
                        </a>
                        <a href="{{ route('contact.contact') }}" class="border-2 border-blue-600 text-blue-600 px-6 md:px-8 py-2 md:py-3 rounded-lg font-semibold hover:bg-blue-600 hover:text-white transition duration-200 text-sm md:text-base">
                            Tanya Informasi
                        </a>
                    </div>
                </div>
            </div>

            <!-- Informasi Tambahan -->
            <div class="mt-8 md:mt-12 text-center">
                <p class="text-gray-600 text-sm md:text-base">
                    Untuk informasi lebih lanjut, silakan hubungi kami di <strong>(061) 1234567</strong> atau 
                    kunjungi <strong>SMAS St. Petrus Medan, Jl. Pendidikan No. 123, Medan</strong>
                </p>
            </div>
        </div>
    </div>
</section>
@endsection