@extends('admin.layouts.app')

@section('title', 'Sejarah Sekolah')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold mb-6">Sejarah Sekolah</h2>

        <form action="{{ route('admin.profile.history.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <div class="mb-6">
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Konten Sejarah</label>
                <textarea name="content" id="content" rows="10" 
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">{{ old('content', $history->content ?? '') }}</textarea>
                @error('content')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Gambar (Opsional)</label>
                @if(isset($history) && $history->image)
                    <div class="mb-4">
                        <img src="{{ Storage::url($history->image) }}" alt="Sejarah Sekolah" class="w-64 h-auto rounded-lg">
                    </div>
                @endif
                <input type="file" name="image" id="image" 
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                @error('image')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md font-medium transition duration-200">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection