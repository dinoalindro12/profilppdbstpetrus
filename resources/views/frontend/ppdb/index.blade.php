@extends('frontend.layouts.app')

@section('title', 'Informasi PPDB SMA SRK Deli Murni Delitua')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header Section -->
    <div class="text-center mb-12">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Informasi Penerimaan Peserta Didik Baru SMAS RK Deli Murni Delitua</h1>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto">Berikut adalah informasi lengkap mengenai PPDB SMAS RK Deli Murni Delitua tahun ajaran terbaru. Pastikan untuk membaca semua informasi dengan teliti sebelum melakukan pendaftaran.</p>
    </div>

    <!-- Info Alert -->
    @if($activeInfo)
    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-8 rounded-r-lg">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fas fa-info-circle text-blue-500 text-xl"></i>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-blue-800">Pendaftaran Sedang Berlangsung!</h3>
                <div class="mt-1 text-sm text-blue-700">
                    <p>Periode pendaftaran PPDB SMA SRK Deli Murni Delitua {{ $activeInfo->academic_year }} sedang berlangsung hingga {{ $activeInfo->registration_end->format('d F Y') }}. Segera lakukan pendaftaran sebelum kuota penuh.</p>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Info PPDB Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
        @forelse($info as $item)
        <div class="bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-lg">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold text-gray-800">PPDB SMA SRK Deli Murni Delitua {{ $item->academic_year }}</h3>
                    <span class="px-3 py-1 text-xs font-semibold rounded-full 
                        {{ $item->is_active ? 'bg-green-100 text-green-800' : 
                          (now()->between($item->registration_start, $item->registration_end) ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800') }}">
                        @if($item->is_active)
                            Aktif
                        @elseif(now()->between($item->registration_start, $item->registration_end))
                            Berlangsung
                        @elseif(now()->lt($item->registration_start))
                            Akan Datang
                        @else
                            Selesai
                        @endif
                    </span>
                </div>
                <div class="space-y-3">
                    <div class="flex items-start">
                        <i class="fas fa-calendar-alt text-blue-500 mt-1 mr-3"></i>
                        <div>
                            <p class="text-sm text-gray-600">Periode Pendaftaran</p>
                            <p class="font-medium">{{ $item->registration_start->format('d M Y') }} - {{ $item->registration_end->format('d M Y') }}</p>
                        </div>
                    </div>
                    @if($item->quota)
                    <div class="flex items-start">
                        <i class="fas fa-users text-blue-500 mt-1 mr-3"></i>
                        <div>
                            <p class="text-sm text-gray-600">Kuota Tersedia</p>
                            <p class="font-medium">{{ $item->quota }} Siswa</p>
                        </div>
                    </div>
                    @endif
                    <div class="flex items-start">
                        <i class="fas fa-clock text-blue-500 mt-1 mr-3"></i>
                        <div>
                            <p class="text-sm text-gray-600">Status</p>
                            <p class="font-medium 
                                @if($item->is_active) text-green-600
                                @elseif(now()->between($item->registration_start, $item->registration_end)) text-blue-600
                                @elseif(now()->lt($item->registration_start)) text-yellow-600
                                @else text-gray-600 @endif">
                                @if($item->is_active)
                                    Pendaftaran Aktif
                                @elseif(now()->between($item->registration_start, $item->registration_end))
                                    Pendaftaran Sedang Berlangsung
                                @elseif(now()->lt($item->registration_start))
                                    Pendaftaran Akan Dibuka
                                @else
                                    Pendaftaran Telah Berakhir
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mt-6 pt-4 border-t border-gray-100">
                    @if(now()->between($item->registration_start, $item->registration_end))
                    <a href="{{ route('ppdb.form') }}" class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-2 rounded-lg font-medium transition-colors">
                        Daftar Sekarang
                    </a>
                    @elseif(now()->lt($item->registration_start))
                    <button class="w-full bg-gray-200 text-gray-500 py-2 rounded-lg font-medium cursor-not-allowed" disabled>
                        Pendaftaran Belum Dibuka
                    </button>
                    @else
                    <button class="w-full bg-gray-400 text-white py-2 rounded-lg font-medium cursor-not-allowed" disabled>
                        Pendaftaran Telah Ditutup
                    </button>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12">
            <i class="fas fa-calendar-times text-gray-400 text-5xl mb-4"></i>
            <h3 class="text-xl font-medium text-gray-700 mb-2">Tidak Ada Informasi PPDB SMA SRK Deli Murni Delitua</h3>
            <p class="text-gray-500">Saat ini tidak ada informasi PPDB SMA SRK Deli Murni Delitua yang tersedia.</p>
        </div>
        @endforelse
    </div>

    <!-- Additional Information Section -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-8">
        <h3 class="text-xl font-bold text-gray-800 mb-6">Informasi Tambahan</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <h4 class="font-bold text-gray-800 mb-3 flex items-center">
                    <i class="fas fa-file-alt text-blue-500 mr-2"></i>
                    Persyaratan Pendaftaran
                </h4>
                <ul class="list-disc pl-5 text-gray-600 space-y-2">
                    <li>Fotokopi akta kelahiran</li>
                    <li>Fotokopi kartu keluarga</li>
                    <li>Pas foto 3x4 (2 lembar)</li>
                    <li>Fotokopi rapor semester terakhir</li>
                    <li>Surat keterangan sehat dari dokter</li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-gray-800 mb-3 flex items-center">
                    <i class="fas fa-question-circle text-blue-500 mr-2"></i>
                    Pertanyaan Umum
                </h4>
                <ul class="list-disc pl-5 text-gray-600 space-y-2">
                    <li>Bagaimana cara mendaftar secara online?</li>
                    <li>Kapan pengumuman hasil seleksi?</li>
                    <li>Berapa biaya pendaftaran?</li>
                    <li>Apakah ada tes masuk atau seleksi?</li>
                    <li>Bagaimana jika melewati batas waktu pendaftaran?</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Timeline Section -->
    
</div>

<!-- Font Awesome for Icons -->
<style>
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');
</style>
@endsection