@extends('frontend.layouts.app')

@section('title', 'Staf - Sekolah Kita')
@section('description', 'Daftar staf administrasi dan pendukung di Sekolah Kita')

@section('content')
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Staf Kami</h1>
            <div class="w-24 h-1 bg-blue-600 mx-auto"></div>
            <p class="text-gray-600 max-w-2xl mx-auto mt-4">Tim staf yang handal dan profesional dalam mendukung kegiatan sekolah.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @forelse($staff as $person)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                @if($person->photo)
                    <img src="{{ Storage::url($person->photo) }}" alt="{{ $person->name }}" class="w-full h-64 object-cover">
                @else
                    <div class="w-full h-64 bg-gray-200 flex items-center justify-center">
                        <i class="fas fa-user-tie text-gray-400 text-6xl"></i>
                    </div>
                @endif
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $person->name }}</h3>
                    <p class="text-green-600 font-medium mb-2">{{ $person->position }}</p>
                    @if($person->nip)
                        <p class="text-gray-600 text-sm mb-3">NIP: {{ $person->nip }}</p>
                    @endif
                    @if($person->description)
                        <p class="text-gray-600 text-sm">{{ Str::limit($person->description, 100) }}</p>
                    @endif
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <div class="text-gray-400 text-6xl mb-4">
                    <i class="fas fa-user-tie"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum ada data staf</h3>
                <p class="text-gray-500">Data staf akan segera tersedia.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection