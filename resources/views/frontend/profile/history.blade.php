@extends('frontend.layouts.app')

@section('title', 'Sejarah Sekolah - Sekolah Kita')
@section('description', 'Sejarah berdirinya Sekolah Kita')

@section('content')
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Sejarah Sekolah</h1>
            <div class="w-24 h-1 bg-blue-600 mx-auto"></div>
        </div>

        <div class="max-w-4xl mx-auto">
            @if($history && $history->image)
            <div class="mb-8">
                <img src="{{ Storage::url($history->image) }}" alt="Sejarah Sekolah" class="w-full h-64 object-cover rounded-lg shadow-md">
            </div>
            @endif

            <div class="prose prose-lg max-w-none">
                @if($history && $history->content)
                    {!! nl2br(e($history->content)) !!}
                @else
                    <p class="text-center text-gray-500">Konten sejarah sekolah sedang dalam proses pengisian.</p>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection