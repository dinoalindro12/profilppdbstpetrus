@extends('frontend.layouts.app')

@section('title', 'Hasil Status PPDB - Sekolah Kita')

@section('content')
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800 mb-4">Status Pendaftaran</h1>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-2">Informasi Pendaftaran</h2>
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="font-medium text-gray-600">Nomor Pendaftaran:</span>
                            <p class="text-gray-800">{{ $registration->registration_number }}</p>
                        </div>
                        <div>
                            <span class="font-medium text-gray-600">Nama Calon Siswa:</span>
                            <p class="text-gray-800">{{ $registration->full_name }}</p>
                        </div>
                        <div>
                            <span class="font-medium text-gray-600">Tahun Ajaran:</span>
                            <p class="text-gray-800">{{ $registration->info->academic_year }}</p>
                        </div>
                        <div>
                            <span class="font-medium text-gray-600">Tanggal Pendaftaran:</span>
                            <p class="text-gray-800">{{ $registration->created_at->format('d M Y') }}</p>
                        </div>
                    </div>
                </div>

                <div class="border-t pt-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Status Pendaftaran</h3>
                    
                    @if($registration->status == 'approved')
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 text-2xl mr-3"></i>
                            <div>
                                <h4 class="font-bold text-green-800 text-lg">DITERIMA</h4>
                                <p class="text-green-700">Selamat! Pendaftaran Anda telah diterima.</p>
                            </div>
                        </div>
                    </div>
                    @elseif($registration->status == 'rejected')
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                        <div class="flex items-center">
                            <i class="fas fa-times-circle text-red-500 text-2xl mr-3"></i>
                            <div>
                                <h4 class="font-bold text-red-800 text-lg">DITOLAK</h4>
                                <p class="text-red-700">Maaf, pendaftaran Anda tidak dapat diterima.</p>
                                @if($registration->notes)
                                <p class="text-red-700 mt-2"><strong>Catatan:</strong> {{ $registration->notes }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                        <div class="flex items-center">
                            <i class="fas fa-clock text-yellow-500 text-2xl mr-3"></i>
                            <div>
                                <h4 class="font-bold text-yellow-800 text-lg">MENUNGGU</h4>
                                <p class="text-yellow-700">Pendaftaran Anda sedang dalam proses verifikasi.</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($registration->notes && $registration->status != 'rejected')
                    <div class="mt-4 p-3 bg-blue-50 rounded-lg">
                        <p class="text-blue-700 text-sm"><strong>Catatan:</strong> {{ $registration->notes }}</p>
                    </div>
                    @endif
                </div>

                <div class="mt-6 text-center">
                    <a href="{{ route('ppdb.status') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                        <i class="fas fa-arrow-left mr-2"></i>Cek Status Lain
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection