@extends('frontend.layouts.app')

@section('title', 'Berita - Sekolah Kita')
@section('description', 'Berita terbaru dan informasi terkini dari Sekolah Kita')

@section('content')
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Berita Sekolah</h1>
            <div class="w-24 h-1 bg-blue-600 mx-auto"></div>
            <p class="text-gray-600 max-w-2xl mx-auto mt-4">Informasi terbaru seputar kegiatan, prestasi, dan pengumuman penting dari sekolah kami.</p>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Main Content -->
            <div class="lg:w-2/3">
                <!-- Search and Filter -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                    <div class="flex flex-col md:flex-row gap-4">
                        <div class="flex-1">
                            <form action="{{ route('news.index') }}" method="GET">
                                <div class="relative">
                                    <input type="text" name="search" value="{{ request('search') }}" 
                                        placeholder="Cari berita..." 
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <button type="submit" class="absolute right-3 top-2 text-gray-400 hover:text-gray-600">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="md:w-64">
                            <select onchange="window.location.href = this.value" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="{{ route('news.index') }}">Semua Kategori</option>
                                @foreach($categories as $category)
                                <option value="{{ route('news.index', ['category' => $category->slug]) }}" 
                                    {{ request('category') == $category->slug ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Featured Posts -->
                @if($featuredPosts->count() > 0)
                <div class="mb-12">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Berita Utama</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach($featuredPosts as $post)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                            @if($post->thumbnail)
                            <img src="{{ Storage::url($post->thumbnail) }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                            @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                <i class="fas fa-newspaper text-gray-400 text-4xl"></i>
                            </div>
                            @endif
                            <div class="p-6">
                                <span class="inline-block px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium mb-3">
                                    {{ $post->category->name }}
                                </span>
                                <h3 class="text-xl font-bold text-gray-800 mb-3 line-clamp-2">
                                    <a href="{{ route('news.show', $post->slug) }}" class="hover:text-blue-600 transition duration-200">
                                        {{ $post->title }}
                                    </a>
                                </h3>
                                <p class="text-gray-600 mb-4 line-clamp-3">{{ $post->excerpt ?: Str::limit(strip_tags($post->content), 120) }}</p>
                                <div class="flex items-center justify-between text-sm text-gray-500">
                                    <span>{{ $post->published_at->format('d M Y') }}</span>
                                    <span>{{ $post->views }} views</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- All Posts -->
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Semua Berita</h2>
                    
                    @if($posts->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        @foreach($posts as $post)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                            @if($post->thumbnail)
                            <img src="{{ Storage::url($post->thumbnail) }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                            @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                <i class="fas fa-newspaper text-gray-400 text-4xl"></i>
                            </div>
                            @endif
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-3">
                                    <span class="inline-block px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                                        {{ $post->category->name }}
                                    </span>
                                    {{-- Remove featured badge since we don't have is_featured column --}}
                                </div>
                                <h3 class="text-xl font-bold text-gray-800 mb-3 line-clamp-2">
                                    <a href="{{ route('news.show', $post->slug) }}" class="hover:text-blue-600 transition duration-200">
                                        {{ $post->title }}
                                    </a>
                                </h3>
                                <p class="text-gray-600 mb-4 line-clamp-3">{{ $post->excerpt ?: Str::limit(strip_tags($post->content), 120) }}</p>
                                <div class="flex items-center justify-between text-sm text-gray-500">
                                    <div class="flex items-center space-x-4">
                                        <span>{{ $post->published_at->format('d M Y') }}</span>
                                        <span>{{ $post->views }} views</span>
                                    </div>
                                    <a href="{{ route('news.show', $post->slug) }}" class="text-blue-600 hover:text-blue-800 font-medium">
                                        Baca Selengkapnya →
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-8">
                        {{ $posts->links() }}
                    </div>
                    @else
                    <div class="text-center py-12">
                        <i class="fas fa-newspaper text-gray-400 text-6xl mb-4"></i>
                        <h3 class="text-xl font-semibold text-gray-600 mb-2">Tidak ada berita</h3>
                        <p class="text-gray-500">Berita akan segera tersedia.</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:w-1/3">
                <!-- Categories -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Kategori Berita</h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('news.index') }}" class="flex justify-between items-center py-2 px-3 rounded-lg hover:bg-blue-50 text-gray-700 hover:text-blue-600 transition duration-200 {{ !request('category') ? 'bg-blue-50 text-blue-600' : '' }}">
                                <span>Semua Kategori</span>
                                <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded-full text-xs">
                                    {{-- {{ $totalPosts }} --}}
                                </span>
                            </a>
                        </li>
                        @foreach($categories as $category)
                        <li>
                            <a href="{{ route('news.index', ['category' => $category->slug]) }}" class="flex justify-between items-center py-2 px-3 rounded-lg hover:bg-blue-50 text-gray-700 hover:text-blue-600 transition duration-200 {{ request('category') == $category->slug ? 'bg-blue-50 text-blue-600' : '' }}">
                                <span>{{ $category->name }}</span>
                                <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded-full text-xs">
                                    {{ $category->posts_count }}
                                </span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Popular Posts -->
                {{-- <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Berita Populer</h3>
                    <div class="space-y-4">
                        @foreach($popularPosts as $post)
                        <a href="{{ route('news.show', $post->slug) }}" class="flex items-start space-x-3 group">
                            @if($post->thumbnail)
                            <img src="{{ Storage::url($post->thumbnail) }}" alt="{{ $post->title }}" class="w-16 h-16 object-cover rounded flex-shrink-0">
                            @else
                            <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-newspaper text-gray-400"></i>
                            </div>
                            @endif
                            <div class="flex-1">
                                <h4 class="font-medium text-gray-800 group-hover:text-blue-600 transition duration-200 line-clamp-2">
                                    {{ $post->title }}
                                </h4>
                                <p class="text-sm text-gray-500 mt-1">{{ $post->published_at->format('d M Y') }}</p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush