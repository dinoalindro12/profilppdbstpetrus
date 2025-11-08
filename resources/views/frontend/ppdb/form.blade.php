@extends('frontend.layouts.app')

@section('title', 'Form Pendaftaran PPDB - Sekolah Kita')

@section('content')
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800 mb-4">Form Pendaftaran PPDB</h1>
                <p class="text-gray-600">Isi form berikut dengan data yang benar dan lengkap.</p>
            </div>

            {{-- Jika ada info PPDB yang aktif, tampilkan form --}}
            @if($activeInfo)
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <div class="flex items-center justify-between p-4 bg-blue-50 rounded-lg">
                    <div>
                        <h3 class="font-semibold text-blue-800">Periode Pendaftaran</h3>
                        <p class="text-blue-600">{{ $activeInfo->registration_start->format('d M Y') }} - {{ $activeInfo->registration_end->format('d M Y') }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-blue-600">Tahun Ajaran: {{ $activeInfo->academic_year }}</p>
                        @if($activeInfo->quota)
                        <p class="text-sm text-blue-600">Kuota: {{ $activeInfo->quota }} siswa</p>
                        @endif
                    </div>
                </div>
            </div>

            <form action="{{ route('ppdb.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-md p-6">
                @csrf

                <div class="mb-8">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2">Data Calon Siswa</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="full_name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap *</label>
                            <input type="text" name="full_name" id="full_name" value="{{ old('full_name') }}" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            @error('full_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="birth_place" class="block text-sm font-medium text-gray-700 mb-2">Tempat Lahir *</label>
                            <input type="text" name="birth_place" id="birth_place" value="{{ old('birth_place') }}" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            @error('birth_place')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="birth_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir *</label>
                            <input type="date" name="birth_date" id="birth_date" value="{{ old('birth_date') }}" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            @error('birth_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="gender" class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin *</label>
                            <select name="gender" id="gender" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L" {{ old('gender') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('gender') == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('gender')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap *</label>
                            <textarea name="address" id="address" rows="3" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">{{ old('address') }}</textarea>
                            @error('address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">No. Telepon/HP *</label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone') }}" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="previous_school" class="block text-sm font-medium text-gray-700 mb-2">Asal Sekolah *</label>
                            <input type="text" name="previous_school" id="previous_school" value="{{ old('previous_school') }}" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            @error('previous_school')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-8">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2">Data Orang Tua</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="father_name" class="block text-sm font-medium text-gray-700 mb-2">Nama Ayah *</label>
                            <input type="text" name="father_name" id="father_name" value="{{ old('father_name') }}" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            @error('father_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="father_phone" class="block text-sm font-medium text-gray-700 mb-2">No. Telepon Ayah</label>
                            <input type="text" name="father_phone" id="father_phone" value="{{ old('father_phone') }}" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            @error('father_phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="mother_name" class="block text-sm font-medium text-gray-700 mb-2">Nama Ibu *</label>
                            <input type="text" name="mother_name" id="mother_name" value="{{ old('mother_name') }}" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            @error('mother_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="mother_phone" class="block text-sm font-medium text-gray-700 mb-2">No. Telepon Ibu</label>
                            <input type="text" name="mother_phone" id="mother_phone" value="{{ old('mother_phone') }}" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            @error('mother_phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-8">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2">Upload Dokumen</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="photo" class="block text-sm font-medium text-gray-700 mb-2">Foto 3x4 *</label>
                            <input type="file" name="photo" id="photo" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <p class="mt-1 text-sm text-gray-500">Format: JPG, PNG (Maks: 2MB)</p>
                            @error('photo')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="birth_certificate" class="block text-sm font-medium text-gray-700 mb-2">Akta Kelahiran *</label>
                            <input type="file" name="birth_certificate" id="birth_certificate" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <p class="mt-1 text-sm text-gray-500">Format: PDF, JPG, PNG (Maks: 2MB)</p>
                            @error('birth_certificate')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="family_card" class="block text-sm font-medium text-gray-700 mb-2">Kartu Keluarga *</label>
                            <input type="file" name="family_card" id="family_card" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <p class="mt-1 text-sm text-gray-500">Format: PDF, JPG, PNG (Maks: 2MB)</p>
                            @error('family_card')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="report_card" class="block text-sm font-medium text-gray-700 mb-2">Rapor Terakhir *</label>
                            <input type="file" name="report_card" id="report_card" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <p class="mt-1 text-sm text-gray-500">Format: PDF, JPG, PNG (Maks: 2MB)</p>
                            @error('report_card')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="flex justify-end space-x-4">
                    <a href="{{ route('ppdb.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-md font-medium transition duration-200">
                        Batal
                    </a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md font-medium transition duration-200">
                        Daftar Sekarang
                    </button>
                </div>
            </form>

            {{-- Jika tidak ada info PPDB yang aktif, tampilkan pesan ini --}}
            @else
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-8 text-center">
                {{-- Anda mungkin perlu menambahkan Font Awesome jika ikon ini tidak muncul --}}
                {{-- <i class="fas fa-exclamation-triangle text-yellow-500 text-5xl mb-4"></i> --}}
                <div class="text-yellow-500 text-5xl mb-4">
                    <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <h2 class="text-2xl font-bold text-yellow-800 mb-4">Pendaftaran Belum Dibuka</h2>
                <p class="text-yellow-700 mb-6">Form pendaftaran PPDB saat ini tidak tersedia atau periode pendaftaran telah berakhir.</p>
                <a href="{{ route('ppdb.index') }}" class="bg-yellow-600 hover:bg-yellow-700 text-white px-6 py-3 rounded-lg font-medium">
                    Kembali ke Info PPDB
                </a>
            </div>
            @endif
        </div>
    </div>
</section>
@endsection