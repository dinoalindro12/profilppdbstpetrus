@extends('admin.layouts.app')

@section('title', 'Edit Info PPDB')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <h2 class="text-2xl font-bold">Edit Info PPDB</h2>
        <p class="text-gray-600 mt-2">Perbarui informasi Penerimaan Peserta Didik Baru</p>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('admin.ppdb.info.update', $info->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Tahun Ajaran -->
                <div>
                    <label for="academic_year" class="block text-sm font-medium text-gray-700 mb-1">
                        Tahun Ajaran <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="academic_year" 
                        name="academic_year" 
                        value="{{ old('academic_year', $info->academic_year) }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('academic_year') border-red-500 @enderror"
                        placeholder="Contoh: 2024/2025"
                        required
                    >
                    @error('academic_year')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Kuota -->
                <div>
                    <label for="quota" class="block text-sm font-medium text-gray-700 mb-1">
                        Kuota
                    </label>
                    <input 
                        type="number" 
                        id="quota" 
                        name="quota" 
                        value="{{ old('quota', $info->quota) }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('quota') border-red-500 @enderror"
                        placeholder="Jumlah kuota"
                        min="0"
                    >
                    @error('quota')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Tanggal Mulai Pendaftaran -->
                <div>
                    <label for="registration_start" class="block text-sm font-medium text-gray-700 mb-1">
                        Tanggal Mulai Pendaftaran <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="date" 
                        id="registration_start" 
                        name="registration_start" 
                        value="{{ old('registration_start', $info->registration_start->format('Y-m-d')) }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('registration_start') border-red-500 @enderror"
                        required
                    >
                    @error('registration_start')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Tanggal Berakhir Pendaftaran -->
                <div>
                    <label for="registration_end" class="block text-sm font-medium text-gray-700 mb-1">
                        Tanggal Berakhir Pendaftaran <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="date" 
                        id="registration_end" 
                        name="registration_end" 
                        value="{{ old('registration_end', $info->registration_end->format('Y-m-d')) }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('registration_end') border-red-500 @enderror"
                        required
                    >
                    @error('registration_end')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Status Aktif -->
                <div class="md:col-span-2">
                    <div class="flex items-center">
                        <input type="hidden" name="is_active" value="0">
                        <input 
                            type="checkbox" 
                            id="is_active" 
                            name="is_active" 
                            value="1"
                            {{ old('is_active', $info->is_active) ? 'checked' : '' }}
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                        >
                        <label for="is_active" class="ml-2 block text-sm text-gray-700">
                            Aktifkan info PPDB ini
                        </label>
                    </div>
                    <p class="mt-1 text-sm text-gray-500">
                        Jika dicentang, info PPDB ini akan ditampilkan sebagai informasi PPDB yang sedang berjalan. Jika tidak dicentang, info PPDB ini akan disimpan sebagai nonaktif.
                    </p>
                </div>
                
                <!-- Deskripsi (Opsional) -->
                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                        Deskripsi / Informasi Tambahan
                    </label>
                    <textarea 
                        id="description" 
                        name="description" 
                        rows="4"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @enderror"
                        placeholder="Tambahkan informasi detail tentang PPDB..."
                    >{{ old('description', $info->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <div class="mt-8 flex justify-end space-x-3">
                <a href="{{ route('admin.ppdb.info.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md font-medium transition duration-150">
                    Batal
                </a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md font-medium transition duration-150">
                    Perbarui Info PPDB
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Validasi client-side untuk memastikan tanggal akhir tidak sebelum tanggal mulai
    document.addEventListener('DOMContentLoaded', function() {
        const startDateInput = document.getElementById('registration_start');
        const endDateInput = document.getElementById('registration_end');
        
        function validateDates() {
            const startDate = new Date(startDateInput.value);
            const endDate = new Date(endDateInput.value);
            
            if (startDate && endDate && endDate < startDate) {
                endDateInput.setCustomValidity('Tanggal berakhir tidak boleh sebelum tanggal mulai');
            } else {
                endDateInput.setCustomValidity('');
            }
        }
        
        startDateInput.addEventListener('change', validateDates);
        endDateInput.addEventListener('change', validateDates);
    });
</script>
@endpush