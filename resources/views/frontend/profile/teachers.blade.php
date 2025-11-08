@extends('frontend.layouts.app')

@section('title', 'Guru - Sekolah Kita')
@section('description', 'Daftar guru pengajar di Sekolah Kita')

@section('content')
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Guru Kami</h1>
            <div class="w-24 h-1 bg-blue-600 mx-auto"></div>
            <p class="text-gray-600 max-w-2xl mx-auto mt-4">Para pendidik profesional yang berdedikasi untuk mencerdaskan generasi bangsa.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @forelse($teachers as $teacher)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                @if($teacher->photo)
                    <img src="{{ Storage::url($teacher->photo) }}" alt="{{ $teacher->name }}" class="w-full h-64 object-cover">
                @else
                    <div class="w-full h-64 bg-gray-200 flex items-center justify-center">
                        <i class="fas fa-user text-gray-400 text-6xl"></i>
                    </div>
                @endif
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $teacher->name }}</h3>
                    <p class="text-blue-600 font-medium mb-2">{{ $teacher->position }}</p>
                    @if($teacher->nip)
                        <p class="text-gray-600 text-sm mb-3">NIP: {{ $teacher->nip }}</p>
                    @endif
                    @if($teacher->description)
                        <p class="text-gray-600 text-sm">{{ Str::limit($teacher->description, 100) }}</p>
                    @endif
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <div class="text-gray-400 text-6xl mb-4">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum ada data guru</h3>
                <p class="text-gray-500">Data guru akan segera tersedia.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection