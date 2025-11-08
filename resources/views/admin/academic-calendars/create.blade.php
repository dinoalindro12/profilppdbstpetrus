@extends('admin.layouts.app')

@section('title', 'Tambah Kalender Akademik')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Tambah Kalender Akademik</h1>
    <p class="text-gray-600">Upload kalender akademik baru</p>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <form action="{{ route('admin.academic.academic-calendars.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="p-6 space-y-6">
            <!-- Judul -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Judul Kalender *</label>
                <input type="text" name="title" id="title" required
                       value="{{ old('title') }}"
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- File Upload -->
            <div>
                <label for="file" class="block text-sm font-medium text-gray-700">File Kalender *</label>
                <input type="file" name="file" id="file" required
                       accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                <p class="mt-1 text-sm text-gray-500">Format: PDF, DOC, DOCX, JPG, JPEG, PNG (Maks: 10MB)</p>
                @error('file')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Tahun Akademik -->
                <div>
                    <label for="academic_year" class="block text-sm font-medium text-gray-700">Tahun Akademik *</label>
                    <select name="academic_year" id="academic_year" required
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Pilih Tahun Akademik</option>
                        @foreach($academicYears as $year)
                            <option value="{{ $year }}" {{ old('academic_year') == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endforeach
                    </select>
                    @error('academic_year')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Semester -->
                <div>
                    <label for="semester" class="block text-sm font-medium text-gray-700">Semester *</label>
                    <select name="semester" id="semester" required
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Pilih Semester</option>
                        <option value="Ganjil" {{ old('semester') == 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
                        <option value="Genap" {{ old('semester') == 'Genap' ? 'selected' : '' }}>Genap</option>
                        <option value="Antara" {{ old('semester') == 'Antara' ? 'selected' : '' }}>Antara</option>
                    </select>
                    @error('semester')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Tanggal Mulai -->
                <div>
                    <label for="start_date" class="block text-sm font-medium text-gray-700">Tanggal Mulai *</label>
                    <input type="date" name="start_date" id="start_date" required
                           value="{{ old('start_date') }}"
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    @error('start_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tanggal Berakhir -->
                <div>
                    <label for="end_date" class="block text-sm font-medium text-gray-700">Tanggal Berakhir *</label>
                    <input type="date" name="end_date" id="end_date" required
                           value="{{ old('end_date') }}"
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    @error('end_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Deskripsi -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea name="description" id="description" rows="3"
                          class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status Aktif -->
            <div class="flex items-center">
                <input type="checkbox" name="is_active" id="is_active" value="1"
                       {{ old('is_active') ? 'checked' : '' }}
                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <label for="is_active" class="ml-2 block text-sm text-gray-700">
                    Jadikan kalender aktif
                </label>
            </div>
            <p class="text-sm text-gray-500">Jika dicentang, kalender ini akan diaktifkan dan kalender aktif lainnya akan dinonaktifkan</p>
        </div>

        <!-- Form Actions -->
        <div class="bg-gray-50 px-6 py-3 flex justify-end space-x-3">
            <a href="{{ route('admin.academic.academic-calendars.index') }}" 
               class="bg-white border border-gray-300 rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Batal
            </a>
            <button type="submit" 
                    class="bg-blue-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Simpan Kalender
            </button>
        </div>
    </form>
</div>
@endsection