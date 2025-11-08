<?php

namespace App\Http\Controllers;

use App\Models\Kalender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AcademicCalendarController extends Controller
{
    /**
     * Display a listing of academic calendars for frontend.
     */
    public function index()
    {
        $academicCalendars = Kalender::active()
            ->latest()
            ->paginate(6);

        // Kalender aktif saat ini
        $currentCalendar = Kalender::active()
            ->current()
            ->first();

        // Group by tahun akademik untuk filter
        $academicYears = Kalender::active()
            ->select('academic_year')
            ->distinct()
            ->orderBy('academic_year', 'desc')
            ->pluck('academic_year');

        return view('frontend.academic-calendars.index', compact(
            'academicCalendars',
            'currentCalendar',
            'academicYears'
        ));
    }

    /**
     * Display the specified academic calendar.
     */
    public function show(Kalender $academicCalendar)
    {
        // Pastikan hanya kalender aktif yang bisa dilihat
        if (!$academicCalendar->is_active) {
            abort(404);
        }

        return view('frontend.academic-calendars.show', compact('academicCalendar'));
    }

    /**
     * Download academic calendar file.
     */
    public function download(Kalender $academicCalendar)
    {
        // Pastikan hanya kalender aktif yang bisa didownload
        if (!$academicCalendar->is_active) {
            abort(404);
        }

        if (!Storage::disk('public')->exists($academicCalendar->file_path)) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }

        // Increment download counter jika ada
        if (isset($academicCalendar->download_count)) {
            $academicCalendar->increment('download_count');
        }

        return Storage::disk('public')->download(
            $academicCalendar->file_path,
            $academicCalendar->original_file_name
        );
    }

    /**
     * Filter academic calendars by academic year.
     */
    public function filterByYear(Request $request)
    {
        $year = $request->input('year');
        
        $academicCalendars = Kalender::active()
            ->when($year, function ($query) use ($year) {
                return $query->where('academic_year', $year);
            })
            ->latest()
            ->paginate(6);

        $academicYears = Kalender::active()
            ->select('academic_year')
            ->distinct()
            ->orderBy('academic_year', 'desc')
            ->pluck('academic_year');

        $currentCalendar = Kalender::active()
            ->current()
            ->first();

        return view('frontend.academic-calendars.index', compact(
            'academicCalendars',
            'currentCalendar',
            'academicYears'
        ));
    }

    /**
     * Get current active academic calendar.
     */
    public function current()
    {
        $currentCalendar = Kalender::active()
            ->current()
            ->first();

        if (!$currentCalendar) {
            return redirect()->route('academic-calendars.index')
                ->with('info', 'Tidak ada kalender akademik yang sedang aktif.');
        }

        return view('frontend.academic-calendars.show', compact('currentCalendar'));
    }

    /**
     * Preview academic calendar file in browser.
     */
    public function preview(Kalender $academicCalendar)
    {
        // Pastikan hanya kalender aktif yang bisa dilihat
        if (!$academicCalendar->is_active) {
            abort(404);
        }

        if (!Storage::disk('public')->exists($academicCalendar->file_path)) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }

        $filePath = Storage::disk('public')->path($academicCalendar->file_path);
        $mimeType = Storage::disk('public')->mimeType($academicCalendar->file_path);

        return response()->file($filePath, [
            'Content-Type' => $mimeType,
        ]);
    }
}