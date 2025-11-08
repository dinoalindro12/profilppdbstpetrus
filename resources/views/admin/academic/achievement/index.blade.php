@extends('admin.layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 text-gray-800 font-bold text-lg sm:text-xl">Manajemen Prestasi</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:text-blue-800">Dashboard</a></li>
        <li class="breadcrumb-item active text-gray-600">Prestasi</li>
    </ol>

    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-header bg-white border-b px-4 py-3 sm:px-6">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3">
                <h5 class="font-semibold text-gray-800 text-base sm:text-lg">Data Prestasi</h5>
                <a href="{{ route('admin.academic.achievement.create') }}" class="inline-flex items-center justify-center px-3 py-2 sm:px-4 sm:py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition duration-150 ease-in-out w-full sm:w-auto">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Prestasi
                </a>
            </div>
        </div>
        <div class="card-body bg-gray-50 p-3 sm:p-6">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show bg-green-100 border border-green-200 text-green-800 rounded-lg p-4 mb-4" role="alert">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close absolute top-3 right-3" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="overflow-x-auto rounded-lg border border-gray-200">
                <table class="min-w-full bg-white divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-blue-50 to-indigo-50">
                        <tr>
                            <th class="w-12 px-2 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">No</th>
                            <th class="w-16 px-2 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider hidden sm:table-cell">Gambar</th>
                            <th class="px-3 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Judul Prestasi</th>
                            <th class="w-24 px-2 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider hidden md:table-cell">Kategori</th>
                            <th class="w-20 px-2 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Tahun</th>
                            <th class="w-24 px-2 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider hidden lg:table-cell">Level</th>
                            <th class="w-20 px-2 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                            <th class="w-16 px-2 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider hidden xl:table-cell">Urutan</th>
                            <th class="w-24 px-2 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($achievements as $achievement)
                        <tr class="hover:bg-blue-50 transition-colors duration-200">
                            <td class="px-2 py-3 whitespace-nowrap text-sm text-center text-gray-600 font-medium">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-2 py-3 whitespace-nowrap text-center hidden sm:table-cell">
                                @if ($achievement->image)
                                    <img src="{{ Storage::url($achievement->image) }}" 
                                         alt="{{ $achievement->title }}" 
                                         class="rounded-lg shadow-sm mx-auto w-10 h-10 sm:w-12 sm:h-12 object-cover">
                                @else
                                    <div class="bg-gradient-to-br from-yellow-100 to-orange-100 rounded-lg shadow-sm flex items-center justify-center mx-auto w-10 h-10 sm:w-12 sm:h-12">
                                        <svg class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M18 3a1 1 0 00-1.196-.98l-10 2A1 1 0 006 5v9.114A4.369 4.369 0 005 14c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V7.82l8-1.6v5.894A4.37 4.37 0 0015 12c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V3z"/>
                                        </svg>
                                    </div>
                                @endif
                            </td>
                            <td class="px-3 py-3">
                                <div class="flex flex-col">
                                    <div class="font-semibold text-gray-800 text-sm line-clamp-2">{{ $achievement->title }}</div>
                                    @if ($achievement->description)
                                    <div class="text-xs text-gray-500 mt-1 line-clamp-1 hidden sm:block">{{ Str::limit($achievement->description, 50) }}</div>
                                    @endif
                                    <div class="flex flex-wrap gap-1 mt-1 sm:hidden">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ $achievement->category }}
                                        </span>
                                        @if ($achievement->level)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-indigo-100 text-indigo-800">
                                            {{ $achievement->level }}
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-2 py-3 whitespace-nowrap text-center hidden md:table-cell">
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $achievement->category }}
                                </span>
                            </td>
                            <td class="px-2 py-3 whitespace-nowrap text-center">
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800 font-bold">
                                    {{ $achievement->year }}
                                </span>
                            </td>
                            <td class="px-2 py-3 whitespace-nowrap text-center hidden lg:table-cell">
                                @if ($achievement->level)
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-indigo-100 text-indigo-800">
                                    {{ $achievement->level }}
                                </span>
                                @else
                                <span class="text-gray-400 text-xs">-</span>
                                @endif
                            </td>
                            <td class="px-2 py-3 whitespace-nowrap text-center">
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $achievement->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $achievement->is_active ? 'bg-green-400' : 'bg-red-400' }} mr-1"></span>
                                    <span class="hidden sm:inline">{{ $achievement->is_active ? 'Aktif' : 'Nonaktif' }}</span>
                                    <span class="sm:hidden">{{ $achievement->is_active ? 'A' : 'N' }}</span>
                                </span>
                            </td>
                            <td class="px-2 py-3 whitespace-nowrap text-center hidden xl:table-cell">
                                <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-gray-100 text-gray-700 font-bold text-xs">
                                    {{ $achievement->order }}
                                </span>
                            </td>
                            <td class="px-2 py-3 whitespace-nowrap text-center">
                                <div class="flex justify-center space-x-1">
                                    <a href="{{ route('admin.academic.achievement.edit', $achievement) }}" 
                                       class="bg-yellow-500 hover:bg-yellow-600 text-white p-1.5 sm:p-2 rounded transition duration-200 flex items-center justify-center"
                                       title="Edit">
                                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.academic.achievement.destroy', $achievement) }}" 
                                          method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="bg-red-500 hover:bg-red-600 text-white p-1.5 sm:p-2 rounded transition duration-200 flex items-center justify-center"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus prestasi ini?')"
                                                title="Hapus">
                                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="px-4 py-8 text-center">
                                <div class="text-gray-500">
                                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M18 3a1 1 0 00-1.196-.98l-10 2A1 1 0 006 5v9.114A4.369 4.369 0 005 14c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V7.82l8-1.6v5.894A4.37 4.37 0 0015 12c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V3z"/>
                                    </svg>
                                    <h5 class="font-semibold text-gray-600 mb-2 text-sm sm:text-base">Belum ada data prestasi</h5>
                                    <p class="text-xs sm:text-sm mb-4">Mulai dengan menambahkan prestasi pertama Anda</p>
                                    <a href="{{ route('admin.academic.achievement.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition duration-150 ease-in-out">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                        </svg>
                                        Tambah Prestasi
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            {{-- @if($achievements->hasPages())
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mt-4 gap-3">
                <div class="text-sm text-gray-700 text-center sm:text-left">
                    Menampilkan {{ $achievements->firstItem() ?? 0 }} - {{ $achievements->lastItem() ?? 0 }} dari {{ $achievements->total() }} prestasi
                </div>
                <div class="flex justify-center">
                    {{ $achievements->links() }}
                </div>
            </div>
            @endif --}}
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .line-clamp-1 {
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    /* Custom responsive table styles */
    @media (max-width: 640px) {
        .table-responsive table {
            font-size: 0.875rem;
        }
    }
</style>
@endpush