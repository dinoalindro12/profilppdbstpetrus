@extends('admin.layouts.app')

@section('title', 'Tambah Info PPDB')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold mb-6">Tambah Info PPDB</h2>

        <form action="{{ route('admin.ppdb.info.store') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="academic_year" class="block text-sm font-medium text-gray-700 mb-2">Tahun Ajaran *</label>
                    <input type="text" name="academic_year" id="academic_year" value="{{ old('academic_year') }}" 
                        placeholder="2024/2025"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    @error('academic_year')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active') ? 'checked' : '' }} 
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="is_active" class="ml-2 block text-sm text-gray-700">Aktifkan info ini</label>
                </div>

                <div>
                    <label for="registration_start" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai *</label>
                    <input type="date" name="registration_start" id="registration_start" value="{{ old('registration_start') }}" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    @error('registration_start')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="registration_end" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Selesai *</label>
                    <input type="date" name="registration_end" id="registration_end" value="{{ old('registration_end') }}" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    @error('registration_end')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="quota" class="block text-sm font-medium text-gray-700 mb-2">Kuota</label>
                    <input type="number" name="quota" id="quota" value="{{ old('quota') }}" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    @error('quota')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-6">
                <label for="requirements" class="block text-sm font-medium text-gray-700 mb-2">Syarat Pendaftaran</label>
                <textarea name="requirements" id="requirements" rows="4" 
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">{{ old('requirements') }}</textarea>
                @error('requirements')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6">
                <label for="schedule" class="block text-sm font-medium text-gray-700 mb-2">Jadwal Lengkap</label>
                <textarea name="schedule" id="schedule" rows="4" 
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">{{ old('schedule') }}</textarea>
                @error('schedule')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-4 mt-6">
                <a href="{{ route('admin.ppdb.info.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-md font-medium transition duration-200">
                    Batal
                </a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md font-medium transition duration-200">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection