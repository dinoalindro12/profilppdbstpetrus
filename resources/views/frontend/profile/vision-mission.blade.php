@extends('frontend.layouts.app')

@section('title', 'Visi & Misi - Sekolah Kita')
@section('description', 'Visi dan Misi Sekolah Kita')

@section('content')
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Visi & Misi Sekolah</h1>
            <div class="w-24 h-1 bg-blue-600 mx-auto"></div>
        </div>

        <div class="max-w-4xl mx-auto">
            @if($visionMission)
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Visi -->
                <div class="bg-blue-50 rounded-lg p-8">
                    <div class="text-center mb-6">
                        <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-eye text-white text-2xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800">Visi</h2>
                    </div>
                    <div class="prose prose-blue max-w-none">
                        {!! nl2br(e($visionMission->vision)) !!}
                    </div>
                </div>

                <!-- Misi -->
                <div class="bg-green-50 rounded-lg p-8">
                    <div class="text-center mb-6">
                        <div class="w-16 h-16 bg-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-bullseye text-white text-2xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800">Misi</h2>
                    </div>
                    <div class="prose prose-green max-w-none">
                        {!! nl2br(e($visionMission->mission)) !!}
                    </div>
                </div>
            </div>
            @else
            <p class="text-center text-gray-500">Konten visi dan misi sedang dalam proses pengisian.</p>
            @endif
        </div>
    </div>
</section>
@endsection