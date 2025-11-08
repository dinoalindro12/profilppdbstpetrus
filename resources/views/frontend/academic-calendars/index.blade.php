@extends('frontend.layouts.app')

@section('title', 'Kalender Akademik')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Kalender Akademik</h1>
        <p class="text-gray-600">Jadwal kegiatan akademik sekolah</p>
    </div>

    <!-- Filter Section -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <div class="w-full md:w-auto">
            <form action="{{ route('academic-calendars.filter') }}" method="GET" class="flex gap-2">
                <select name="year" onchange="this.form.submit()" 
                        class="w-full md:w-64 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Semua Tahun Akademik</option>
                    @foreach($academicYears as $year)
                        <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                            {{ $year }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>
        
        @if($currentCalendar)
            <div class="w-full md:w-auto">
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                        <div>
                            <p class="text-blue-800 font-medium">
                                <span class="font-semibold">Kalender Aktif:</span> {{ $currentCalendar->title }}
                            </p>
                        </div>
                        <a href="{{ route('academic-calendars.download', $currentCalendar) }}" 
                           class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm font-medium transition duration-200">
                            Download
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Kalender List -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($academicCalendars as $calendar)
            <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden hover:shadow-lg transition duration-300">
                <div class="p-6">
                    <!-- Header -->
                    <h3 class="text-xl font-semibold text-gray-800 mb-2 line-clamp-2">{{ $calendar->title }}</h3>
                    
                    <!-- Academic Info -->
                    <div class="flex items-center text-gray-600 mb-3">
                        <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span class="text-sm">{{ $calendar->academic_year }} - {{ $calendar->semester }}</span>
                    </div>
                    
                    <!-- Period -->
                    <div class="flex items-center text-gray-600 mb-4">
                        <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-sm">
                            {{ $calendar->start_date->format('d M Y') }} - {{ $calendar->end_date->format('d M Y') }}
                        </span>
                    </div>
                    
                    <!-- Description -->
                    @if($calendar->description)
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                            {{ Str::limit($calendar->description, 120) }}
                        </p>
                    @endif
                </div>
                
                <!-- Footer -->
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                    <div class="flex items-center justify-between">
                        <!-- File Size -->
                        <div class="flex items-center text-gray-500 text-sm">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            {{ $calendar->formatted_file_size }}
                        </div>
                        
                        <!-- Actions -->
                        <div class="flex gap-2">
                            <!-- Preview -->
                            <a href="{{ route('academic-calendars.preview', $calendar) }}" 
                               target="_blank"
                               class="text-gray-600 hover:text-blue-600 p-2 rounded-full hover:bg-gray-100 transition duration-200"
                               title="Preview">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </a>
                            
                            <!-- Download -->
                            <a href="{{ route('academic-calendars.download', $calendar) }}" 
                               class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm font-medium flex items-center gap-1 transition duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                </svg>
                                Download
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-8 text-center">
                    <svg class="w-12 h-12 mx-auto text-blue-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <h3 class="text-lg font-semibold text-blue-800 mb-2">Tidak ada kalender akademik tersedia</h3>
                    <p class="text-blue-600">Silakan kembali lagi nanti.</p>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($academicCalendars->hasPages())
        <div class="mt-8">
            {{ $academicCalendars->links() }}
        </div>
    @endif
</div>

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
@endsection