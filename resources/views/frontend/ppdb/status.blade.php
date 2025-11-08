@extends('frontend.layouts.app')

@section('title', 'Cek Status PPDB - Sekolah Kita')

@section('content')
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800 mb-4">Cek Status Pendaftaran</h1>
                <p class="text-gray-600">Masukkan nomor pendaftaran Anda untuk melihat status.</p>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                @if(session('success'))
                <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
                        <div>
                            <h4 class="font-semibold text-green-800">Pendaftaran Berhasil!</h4>
                            <p class="text-green-700">{{ session('success') }}</p>
                            @if(session('registration_number'))
                            <p class="text-green-700 font-bold mt-2">Nomor Pendaftaran: {{ session('registration_number') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                @endif

                @if(session('error'))
                <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle text-red-500 text-xl mr-3"></i>
                        <div>
                            <h4 class="font-semibold text-red-800">Error</h4>
                            <p class="text-red-700">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
                @endif

                <form action="{{ route('ppdb.check-status') }}" method="POST">
                    @csrf
                    
                    <div class="mb-6">
                        <label for="registration_number" class="block text-sm font-medium text-gray-700 mb-2">
                            Nomor Pendaftaran *
                        </label>
                        <input type="text" name="registration_number" id="registration_number" 
                            value="{{ old('registration_number', session('registration_number')) }}"
                            placeholder="Contoh: PPDB2024010001"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        @error('registration_number')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-md font-medium transition duration-200">
                        <i class="fas fa-search mr-2"></i>Cek Status
                    </button>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-gray-600">Belum mendaftar?</p>
                    <a href="{{ route('ppdb.form') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                        Daftar PPDB Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection