@extends('admin.layouts.app')

@section('title', 'Tambah Ekstrakurikuler')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-4 sm:mb-0">Tambah Ekstrakurikuler</h1>
        
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2 bg-white rounded-lg shadow-sm px-4 py-2 border border-gray-200">
                <li>
                    <a href="{{ route('admin.dashboard') }}" 
                       class="inline-flex items-center px-3 py-1 text-sm font-medium text-blue-600 bg-blue-50 rounded-md hover:bg-blue-100 hover:text-blue-700 transition duration-150 ease-in-out">
                        Dashboard
                    </a>
                </li>
                <li class="flex items-center">
                    <svg class="w-4 h-4 text-gray-400 mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </li>
                <li>
                    <a href="{{ route('admin.academic.extracurricular.index') }}" 
                       class="inline-flex items-center px-3 py-1 text-sm font-medium text-blue-600 bg-blue-50 rounded-md hover:bg-blue-100 hover:text-blue-700 transition duration-150 ease-in-out">
                        Ekstrakurikuler
                    </a>
                </li>
                <li class="flex items-center">
                    <svg class="w-4 h-4 text-gray-400 mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </li>
                <li>
                    <span class="inline-flex items-center px-3 py-1 text-sm font-medium text-gray-500 bg-gray-100 rounded-md cursor-default">
                        Tambah
                    </span>
                </li>
            </ol>
        </nav>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-gray-50 to-blue-50 px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800">Form Tambah Ekstrakurikuler</h2>
        </div>
        
        <div class="p-6">
            <form action="{{ route('admin.academic.extracurricular.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Left Column - Form Inputs -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Nama Ekstrakurikuler -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Ekstrakurikuler <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                   placeholder="Masukkan nama ekstrakurikuler"
                                   required>
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                Deskripsi
                            </label>
                            <textarea id="description" 
                                      name="description" 
                                      rows="5"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                      placeholder="Masukkan deskripsi ekstrakurikuler">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jadwal dan Pembina -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="schedule" class="block text-sm font-medium text-gray-700 mb-2">
                                    Jadwal
                                </label>
                                <input type="text" 
                                       id="schedule" 
                                       name="schedule" 
                                       value="{{ old('schedule') }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                       placeholder="Contoh: Senin, 14:00-16:00">
                                @error('schedule')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="coach" class="block text-sm font-medium text-gray-700 mb-2">
                                    Pembina
                                </label>
                                <input type="text" 
                                       id="coach" 
                                       name="coach" 
                                       value="{{ old('coach') }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                       placeholder="Masukkan nama pembina">
                                @error('coach')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Informasi Tambahan -->
                        <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-blue-800">
                                        Tips Pengisian
                                    </h3>
                                    <div class="mt-2 text-sm text-blue-700">
                                        <ul class="list-disc list-inside space-y-1">
                                            <li>Gunakan nama yang jelas dan mudah dipahami</li>
                                            <li>Jadwal bisa berupa hari dan waktu (contoh: Senin, 14:00-16:00)</li>
                                            <li>Deskripsi membantu peserta memahami kegiatan</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column - Image Upload & Status -->
                    <div class="space-y-6">
                        <!-- Upload Gambar -->
                        <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                            <label for="image" class="block text-sm font-medium text-gray-700 mb-3">
                                Gambar Ekstrakurikuler
                            </label>
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center transition duration-200 hover:border-blue-400 cursor-pointer"
                                 onclick="document.getElementById('image').click()">
                                <input type="file" 
                                       id="image" 
                                       name="image" 
                                       accept="image/*"
                                       class="hidden"
                                       onchange="previewImage(this)">
                                <div id="image-placeholder">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <p class="mt-2 text-sm text-gray-600">
                                        <span class="text-blue-600 font-medium">Klik untuk upload</span> atau drag and drop
                                    </p>
                                    <p class="text-xs text-gray-500 mt-1">PNG, JPG, GIF max 2MB</p>
                                </div>
                                <img id="image-preview" class="mt-4 mx-auto max-w-full h-48 object-cover rounded-lg hidden">
                            </div>
                            @error('image')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                            <label class="block text-sm font-medium text-gray-700 mb-3">
                                Status
                            </label>
                            <div class="flex items-center mb-2">
                                <input type="checkbox" 
                                       id="is_active" 
                                       name="is_active" 
                                       value="1"
                                       {{ old('is_active', true) ? 'checked' : '' }}
                                       class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="is_active" class="ml-3 text-sm text-gray-700">
                                    Aktif (tampilkan di halaman depan)
                                </label>
                            </div>
                            <p class="text-xs text-gray-500">
                                Jika nonaktif, ekstrakurikuler tidak akan ditampilkan di website
                            </p>
                        </div>

                        <!-- Quick Stats -->
                        <div class="bg-green-50 p-4 rounded-lg border border-green-200">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-green-800">
                                        Data akan segera ditampilkan
                                    </p>
                                    <p class="text-xs text-green-600 mt-1">
                                        Setelah disimpan, ekstrakurikuler akan muncul di daftar
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4 pt-8 mt-8 border-t border-gray-200">
                    <a href="{{ route('admin.academic.extracurricular.index') }}" 
                       class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200 order-2 sm:order-1">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali ke Daftar
                    </a>
                    <button type="submit" 
                            class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-3 border border-transparent rounded-lg text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200 order-1 sm:order-2">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Ekstrakurikuler
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function previewImage(input) {
        const placeholder = document.getElementById('image-placeholder');
        const preview = document.getElementById('image-preview');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
            }
            
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.classList.add('hidden');
            placeholder.classList.remove('hidden');
        }
    }

    // Drag and drop functionality
    const dropArea = document.querySelector('.border-dashed');
    
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, preventDefaults, false);
    });
    
    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }
    
    ['dragenter', 'dragover'].forEach(eventName => {
        dropArea.addEventListener(eventName, highlight, false);
    });
    
    ['dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, unhighlight, false);
    });
    
    function highlight() {
        dropArea.classList.add('border-blue-400', 'bg-blue-50');
    }
    
    function unhighlight() {
        dropArea.classList.remove('border-blue-400', 'bg-blue-50');
    }
    
    dropArea.addEventListener('drop', handleDrop, false);
    
    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        const input = document.getElementById('image');
        
        if (files.length) {
            input.files = files;
            previewImage(input);
        }
    }
</script>
@endpush