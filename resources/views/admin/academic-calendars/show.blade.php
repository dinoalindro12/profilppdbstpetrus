@extends('admin.layouts.app')

@section('title', 'Detail Kalender Akademik')

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Detail Kalender Akademik</h1>
            <p class="text-gray-600">Informasi lengkap kalender akademik</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('admin.academic.academic-calendars.edit', $academicCalendar) }}" 
               class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit
            </a>
            <a href="{{ route('admin.academic.academic-calendars.index') }}" 
               class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Main Information -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Informasi Kalender</h2>
                
                <dl class="grid grid-cols-1 gap-4">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Judul Kalender</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $academicCalendar->title }}</dd>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Tahun Akademik</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $academicCalendar->academic_year }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Semester</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $academicCalendar->semester }}</dd>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Tanggal Mulai</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $academicCalendar->start_date->format('d F Y') }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Tanggal Berakhir</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $academicCalendar->end_date->format('d F Y') }}</dd>
                        </div>
                    </div>
                    
                    @if($academicCalendar->description)
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Deskripsi</dt>
                        <dd class="mt-1 text-sm text-gray-900 whitespace-pre-line">{{ $academicCalendar->description }}</dd>
                    </div>
                    @endif
                </dl>
            </div>
        </div>
        
        <!-- File Information -->
        <div class="bg-white rounded-lg shadow overflow-hidden mt-6">
            <div class="p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">File Kalender</h2>
                
                <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-12 w-12 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-900">{{ $academicCalendar->original_file_name }}</div>
                            <div class="text-sm text-gray-500">{{ $academicCalendar->formatted_file_size }}</div>
                        </div>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('admin.academic.academic-calendars.download', $academicCalendar) }}" 
                           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center text-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                            Download
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Status -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Status</h3>
                
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Status Aktif:</span>
                        @if($academicCalendar->is_active)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Aktif
                            </span>
                        @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                Tidak Aktif
                            </span>
                        @endif
                    </div>
                    
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Status Periode:</span>
                        @if($academicCalendar->isCurrent())
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                Sedang Berjalan
                            </span>
                        @elseif($academicCalendar->start_date->isFuture())
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Akan Datang
                            </span>
                        @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                Telah Berakhir
                            </span>
                        @endif
                    </div>
                    
                    @if(!$academicCalendar->is_active)
                    <form action="{{ route('admin.academic.academic-calendars.activate', $academicCalendar) }}" method="POST">
                        @csrf
                        @method('POST')
                        <button type="submit" 
                                class="w-full bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg text-sm">
                            Aktifkan Kalender Ini
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Informasi Tambahan -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Tambahan</h3>
                
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Dibuat:</span>
                        <span class="text-gray-900">{{ $academicCalendar->created_at->format('d M Y H:i') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Diupdate:</span>
                        <span class="text-gray-900">{{ $academicCalendar->updated_at->format('d M Y H:i') }}</span>
                    </div>
                    
                    @if($academicCalendar->trashed())
                    <div class="flex justify-between">
                        <span class="text-gray-600">Dihapus:</span>
                        <span class="text-gray-900">{{ $academicCalendar->deleted_at->format('d M Y H:i') }}</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Actions -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Aksi</h3>
                
                <div class="space-y-2">
                    <a href="{{ route('admin.academic.academic-calendars.edit', $academicCalendar) }}" 
                       class="w-full bg-yellow-600 hover:bg-yellow-700 text-white py-2 px-4 rounded-lg text-sm flex items-center justify-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit Kalender
                    </a>
                    
                    <a href="{{ route('admin.academic.academic-calendars.download', $academicCalendar) }}" 
                       class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg text-sm flex items-center justify-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        Download File
                    </a>
                    
                    @if(!$academicCalendar->trashed())
                    <form action="{{ route('admin.academic.academic-calendars.destroy', $academicCalendar) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                onclick="return confirm('Hapus kalender akademik?')"
                                class="w-full bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg text-sm">
                            Hapus Kalender
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection