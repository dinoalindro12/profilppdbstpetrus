@extends('admin.layouts.app')

@section('title', 'Detail Pendaftaran PPDB')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Detail Pendaftaran PPDB</h2>
        <div class="flex space-x-4">
            <a href="{{ route('admin.ppdb.registration.index') }}" 
               class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg font-medium transition duration-200">
                Kembali
            </a>
            <a href="{{ route('admin.ppdb.registration.edit', $registration->id) }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition duration-200">
                Edit Data
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Information -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Status Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Status Pendaftaran</h3>
                    @php
                        $statusColors = [
                            'pending' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                            'approved' => 'bg-green-100 text-green-800 border-green-200',
                            'rejected' => 'bg-red-100 text-red-800 border-red-200'
                        ];
                        $statusLabels = [
                            'pending' => 'Menunggu Review',
                            'approved' => 'Disetujui',
                            'rejected' => 'Ditolak'
                        ];
                    @endphp
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold border {{ $statusColors[$registration->status] }}">
                        <span class="w-2 h-2 rounded-full 
                            {{ $registration->status == 'approved' ? 'bg-green-500' : 
                               ($registration->status == 'pending' ? 'bg-yellow-500' : 'bg-red-500') }} 
                            mr-2"></span>
                        {{ $statusLabels[$registration->status] }}
                    </span>
                </div>
                
                <form action="/admin/ppdb/registration/{{ $registration->id }}/status" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Ubah Status</label>
                            <select name="status" id="status" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="pending" {{ $registration->status == 'pending' ? 'selected' : '' }}>Menunggu</option>
                                <option value="approved" {{ $registration->status == 'approved' ? 'selected' : '' }}>Disetujui</option>
                                <option value="rejected" {{ $registration->status == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </div>
                        <div>
                            <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Catatan</label>
                            <textarea name="notes" id="notes" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Opsional">{{ $registration->notes }}</textarea>
                        </div>
                    </div>
                    <button type="submit" class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md font-medium">
                        Update Status
                    </button>
                </form>
            </div>

            <!-- Data Calon Siswa -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Data Calon Siswa</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-500">No. Pendaftaran</label>
                        <p class="mt-1 text-lg font-semibold text-gray-900 font-mono">{{ $registration->registration_number }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Nama Lengkap</label>
                        <p class="mt-1 text-lg font-semibold text-gray-900">{{ $registration->full_name }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Tempat, Tanggal Lahir</label>
                        <p class="mt-1 text-gray-900">{{ $registration->birth_place }}, {{ $registration->birth_date->format('d F Y') }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Jenis Kelamin</label>
                        <p class="mt-1 text-gray-900">{{ $registration->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-500">Alamat Lengkap</label>
                        <p class="mt-1 text-gray-900">{{ $registration->address }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500">No. Telepon/HP</label>
                        <p class="mt-1 text-gray-900">{{ $registration->phone }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Asal Sekolah</label>
                        <p class="mt-1 text-gray-900">{{ $registration->previous_school }}</p>
                    </div>
                </div>
            </div>

            <!-- Data Orang Tua -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Data Orang Tua</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Nama Ayah</label>
                        <p class="mt-1 text-gray-900">{{ $registration->father_name }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500">No. Telepon Ayah</label>
                        <p class="mt-1 text-gray-900">{{ $registration->father_phone ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Nama Ibu</label>
                        <p class="mt-1 text-gray-900">{{ $registration->mother_name }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500">No. Telepon Ibu</label>
                        <p class="mt-1 text-gray-900">{{ $registration->mother_phone ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Dokumen -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Dokumen</h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center p-3 border border-gray-200 rounded-lg">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span class="text-sm text-gray-700">Foto 3x4</span>
                        </div>
                        @if($registration->photo)
                            {{-- {{ route('admin.ppdb.registration.show', ['id' => $registration->id, 'documentType' => 'photo']) }} --}}
                        <a href="#" 
                               class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                Download
                            </a>
                        @else
                            <span class="text-red-500 text-sm">Tidak ada</span>
                        @endif
                    </div>

                    <div class="flex justify-between items-center p-3 border border-gray-200 rounded-lg">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <span class="text-sm text-gray-700">Akta Kelahiran</span>
                        </div>
                        @if($registration->birth_certificate)
                            {{-- {{ route('admin.ppdb.registration.download', ['id' => $registration->id, 'documentType' => 'birth_certificate']) }} --}}
                        <a href="#" 
                               class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                Download
                            </a>
                        @else
                            <span class="text-red-500 text-sm">Tidak ada</span>
                        @endif
                    </div>

                    <div class="flex justify-between items-center p-3 border border-gray-200 rounded-lg">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <span class="text-sm text-gray-700">Kartu Keluarga</span>
                        </div>
                        @if($registration->family_card)
                            {{-- {{ route('admin.ppdb.registration.show', ['id' => $registration->id, 'documentType' => 'family_card']) }} --}}
                        <a href="" 
                               class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                Download
                            </a>
                        @else
                            <span class="text-red-500 text-sm">Tidak ada</span>
                        @endif
                    </div>

                    <div class="flex justify-between items-center p-3 border border-gray-200 rounded-lg">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <span class="text-sm text-gray-700">Rapor Terakhir</span>
                        </div>
                        @if($registration->report_card)
                            {{-- {{ route('admin.ppdb.registration.show', ['id' => $registration->id, 'documentType' => 'report_card']) }} --}}
                        <a href="#" 
                               class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                Download
                            </a>
                        @else
                            <span class="text-red-500 text-sm">Tidak ada</span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Informasi Pendaftaran -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Pendaftaran</h3>
                <div class="space-y-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Tahun Ajaran</label>
                        <p class="mt-1 text-gray-900">
                            @if($registration->info)
                                {{ $registration->info->academic_year }}
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Tanggal Daftar</label>
                        <p class="mt-1 text-gray-900">{{ $registration->created_at->format('d F Y H:i') }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Terakhir Diupdate</label>
                        <p class="mt-1 text-gray-900">{{ $registration->updated_at->format('d F Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection