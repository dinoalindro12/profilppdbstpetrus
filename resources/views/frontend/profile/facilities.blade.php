@extends('frontend.layouts.app')

@section('title', 'Fasilitas - Sekolah Kita')
@section('description', 'Fasilitas lengkap dan modern yang tersedia di Sekolah Kita')

@section('content')
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Fasilitas Sekolah</h1>
            <div class="w-24 h-1 bg-blue-600 mx-auto"></div>
            <p class="text-gray-600 max-w-2xl mx-auto mt-4">Berbagai fasilitas lengkap dan modern untuk menunjang proses belajar mengajar.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($facilities as $facility)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                @if($facility->image)
                    <img src="{{ Storage::url($facility->image) }}" alt="{{ $facility->name }}" class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                        <i class="fas fa-image text-gray-400 text-4xl"></i>
                    </div>
                @endif
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-3">{{ $facility->name }}</h3>
                    @if($facility->description)
                        <p class="text-gray-600">{{ $facility->description }}</p>
                    @endif
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <div class="text-gray-400 text-6xl mb-4">
                    <i class="fas fa-building"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum ada data fasilitas</h3>
                <p class="text-gray-500">Data fasilitas akan segera tersedia.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection