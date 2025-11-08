@extends('admin.layouts.app')

@section('title', 'Visi & Misi')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold mb-6">Visi & Misi Sekolah</h2>

        <form action="{{ route('admin.profile.vision-mission.update') }}" method="POST">
            @csrf
            @method('POST')

            <div class="mb-6">
                <label for="vision" class="block text-sm font-medium text-gray-700 mb-2">Visi</label>
                <textarea name="vision" id="vision" rows="5" 
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">{{ old('vision', $visionMission->vision ?? '') }}</textarea>
                @error('vision')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="mission" class="block text-sm font-medium text-gray-700 mb-2">Misi</label>
                <textarea name="mission" id="mission" rows="8" 
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">{{ old('mission', $visionMission->mission ?? '') }}</textarea>
                @error('mission')
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