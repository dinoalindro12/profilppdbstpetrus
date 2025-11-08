@extends('frontend.layouts.app')

@section('title', 'Prestasi - Sekolah Kita')
@section('description', 'Prestasi yang telah diraih oleh siswa-siswi Sekolah Kita')

@section('content')
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Prestasi</h1>
            <div class="w-24 h-1 bg-blue-600 mx-auto"></div>
            <p class="text-gray-600 max-w-2xl mx-auto mt-4">Berbagai prestasi membanggakan yang telah diraih oleh siswa-siswi kami.</p>
        </div>

        <!-- Achievement Timeline -->
        <div class="max-w-4xl mx-auto">
            @forelse($achievementsByYear as $year => $yearAchievements)
            <div class="mb-12">
                <div class="flex items-center mb-8">
                    <div class="bg-blue-600 text-white px-6 py-3 rounded-lg">
                        <h2 class="text-2xl font-bold">{{ $year }}</h2>
                    </div>
                    <div class="flex-1 h-1 bg-gray-300 ml-4"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($yearAchievements as $achievement)
                    <div class="bg-gray-50 rounded-lg p-6 border border-gray-200 hover:shadow-md transition duration-300">
                        @if($achievement->image)
                        <img src="{{ Storage::url($achievement->image) }}" alt="{{ $achievement->title }}" 
                             class="w-full h-48 object-cover rounded-lg mb-4">
                        @endif
                        
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-xl font-bold text-gray-800">{{ $achievement->title }}</h3>
                            @if($achievement->level)
                            <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                {{ $achievement->level }}
                            </span>
                            @endif
                        </div>
                        
                        <div class="flex items-center text-sm text-gray-600 mb-3">
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded mr-2">
                                {{ $achievement->category }}
                            </span>
                        </div>
                        
                        @if($achievement->description)
                        <p class="text-gray-600 mb-4">{{ $achievement->description }}</p>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
            @empty
            <div class="text-center py-12">
                <div class="text-gray-400 text-6xl mb-4">
                    <i class="fas fa-trophy"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum ada prestasi</h3>
                <p class="text-gray-500">Prestasi akan ditampilkan di sini.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection