@extends('admin.layouts.app')

@section('title', 'Kalender Akademik')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Kalender Akademik</h1>
    <p class="text-gray-600">Kelola kalender akademik sekolah</p>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Total Kalender</p>
                <p class="text-2xl font-semibold text-gray-900">{{ $academicCalendars->total() }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-100 text-green-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Aktif</p>
                <p class="text-2xl font-semibold text-gray-900"></p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Berjalan</p>
                <p class="text-2xl font-semibold text-gray-900"></p>
            </div>
        </div>
    </div>
</div>

<!-- Action Buttons -->
<div class="flex justify-between items-center mb-6">
    <div class="flex space-x-3">
        <a href="{{ route('admin.academic.academic-calendars.create') }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Kalender
        </a>
        
        <!-- Filter Options -->
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" 
                    class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-lg flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                </svg>
                Filter
            </button>
            
            <div x-show="open" @click.away="open = false" 
                 class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 z-10">
                <div class="p-2">
                    <a href="{{ request()->url() }}" 
                       class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded">Semua Data</a>
                    <a href="{{ request()->url() }}?status=active" 
                       class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded">Aktif Saja</a>
                    <a href="{{ request()->url() }}?status=trashed" 
                       class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded">Tong Sampah</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Table -->
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tahun Akademik</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Periode</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($academicCalendars as $calendar)
                <tr class="{{ $calendar->trashed() ? 'bg-red-50' : '' }}">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">{{ $calendar->title }}</div>
                                <div class="text-sm text-gray-500">{{ $calendar->semester }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $calendar->academic_year }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $calendar->start_date->format('d M Y') }}</div>
                        <div class="text-sm text-gray-500">s/d {{ $calendar->end_date->format('d M Y') }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($calendar->trashed())
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                Terhapus
                            </span>
                        @elseif($calendar->is_active)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Aktif
                            </span>
                        @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                Tidak Aktif
                            </span>
                        @endif
                        
                        @if($calendar->isCurrent() && !$calendar->trashed())
                            <span class="ml-1 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                Berjalan
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            @if($calendar->trashed())
                                <!-- Restore -->
                                <form action="{{ route('admin.academic.academic-calendars.restore', $calendar->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="text-green-600 hover:text-green-900" 
                                            onclick="return confirm('Pulihkan kalender akademik?')">
                                        Pulihkan
                                    </button>
                                </form>
                                
                                <!-- Force Delete -->
                                <form action="{{ route('admin.academic.academic-calendars.force-delete', $calendar->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 ml-2"
                                            onclick="return confirm('Hapus permanen? Tindakan ini tidak dapat dibatalkan!')">
                                        Hapus Permanen
                                    </button>
                                </form>
                            @else
                                <!-- View -->
                                <a href="{{ route('admin.academic.academic-calendars.show', $calendar) }}" 
                                   class="text-blue-600 hover:text-blue-900">
                                    Lihat
                                </a>
                                
                                <!-- Edit -->
                                <a href="{{ route('admin.academic.academic-calendars.edit', $calendar) }}" 
                                   class="text-indigo-600 hover:text-indigo-900 ml-2">
                                    Edit
                                </a>
                                
                                <!-- Download -->
                                <a href="{{ route('admin.academic.academic-calendars.download', $calendar) }}" 
                                   class="text-green-600 hover:text-green-900 ml-2">
                                    Download
                                </a>
                                
                                <!-- Activate -->
                                @if(!$calendar->is_active)
                                <form action="{{ route('admin.academic.academic-calendars.activate', $calendar) }}" method="POST" class="inline">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="text-yellow-600 hover:text-yellow-900 ml-2"
                                            onclick="return confirm('Aktifkan kalender akademik ini?')">
                                        Aktifkan
                                    </button>
                                </form>
                                @endif
                                
                                <!-- Delete -->
                                <form action="{{ route('admin.academic.academic-calendars.destroy', $calendar) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 ml-2"
                                            onclick="return confirm('Hapus kalender akademik?')">
                                        Hapus
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                        Tidak ada data kalender akademik.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    @if($academicCalendars->hasPages())
    <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
        {{ $academicCalendars->links() }}
    </div>
    @endif
</div>
@endsection