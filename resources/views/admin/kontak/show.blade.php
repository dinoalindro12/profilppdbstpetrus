@extends('admin.layouts.app')

@section('title', 'Detail Pesan Kontak')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Detail Pesan Kontak</h2>
        <a href="{{ route('admin.kontak.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg font-medium transition duration-200">
            Kembali
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <h3 class="text-sm font-medium text-gray-500">Nama Pengirim</h3>
                <p class="mt-1 text-lg font-semibold text-gray-900">{{ $kontak->name }}</p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500">Email</h3>
                <p class="mt-1 text-lg text-gray-900">{{ $kontak->email }}</p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500">Tujuan</h3>
                <p class="mt-1">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-blue-100 text-blue-800">
                        {{ $kontak->tujuan }}
                    </span>
                </p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500">IP Address</h3>
                <p class="mt-1 font-mono text-gray-900">{{ $kontak->ip_address }}</p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500">Tanggal Kirim</h3>
                <p class="mt-1 text-gray-900">{{ $kontak->created_at->format('d M Y H:i:s') }}</p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500">User Agent</h3>
                <p class="mt-1 text-xs text-gray-600 font-mono bg-gray-50 p-2 rounded">{{ $kontak->user_agent }}</p>
            </div>
        </div>

        <div class="mb-6">
            <h3 class="text-sm font-medium text-gray-500 mb-2">Subjek</h3>
            <p class="text-lg font-semibold text-gray-900">{{ $kontak->subject }}</p>
        </div>

        <div>
            <h3 class="text-sm font-medium text-gray-500 mb-2">Pesan</h3>
            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-gray-900 whitespace-pre-wrap">{{ $kontak->message }}</p>
            </div>
        </div>

        <div class="mt-8 flex justify-end space-x-4">
            <form action="{{ route('admin.kontak.destroy', $kontak->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-md font-medium transition duration-200"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')">
                    Hapus Pesan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection