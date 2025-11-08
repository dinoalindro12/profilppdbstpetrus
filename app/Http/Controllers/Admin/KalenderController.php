<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kalender;
use App\Http\Requests\StoreAcademicCalendarRequest;
use App\Http\Requests\UpdateAcademicCalendarRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laravel\Prompts\Key;

class KalenderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $academicCalendars = Kalender::withTrashed()
            ->latest()
            ->paginate(10);

        return view('admin.academic-calendars.index', compact('academicCalendars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $currentYear = date('Y');
        $nextYear = $currentYear + 1;
        $academicYears = [
            ($currentYear - 1) . '/' . $currentYear,
            $currentYear . '/' . $nextYear,
            $nextYear . '/' . ($nextYear + 1)
        ];

        return view('admin.academic-calendars.create', compact('academicYears'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAcademicCalendarRequest $request)
    {
        try {
            $file = $request->file('file');
            $filePath = $file->store('academic-calendars', 'public');

            $academicCalendar = Kalender::create([
                'title' => $request->title,
                'file_path' => $filePath,
                'original_file_name' => $file->getClientOriginalName(),
                'file_size' => $file->getSize(),
                'academic_year' => $request->academic_year,
                'semester' => $request->semester,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'description' => $request->description,
                'is_active' => $request->has('is_active'),
            ]);

            // Jika dipilih sebagai aktif, aktifkan kalender ini
            if ($academicCalendar->is_active) {
                $academicCalendar->activate();
            }

            return redirect()->route('admin.academic.academic-calendars.index')
                ->with('success', 'Kalender akademik berhasil ditambahkan.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Kalender $academicCalendar)
    {
        return view('admin.academic-calendars.show', compact('academicCalendar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kalender $academicCalendar)
    {
        $currentYear = date('Y');
        $nextYear = $currentYear + 1;
        $academicYears = [
            ($currentYear - 1) . '/' . $currentYear,
            $currentYear . '/' . $nextYear,
            $nextYear . '/' . ($nextYear + 1)
        ];

        return view('admin.academic-calendars.edit', compact('academicCalendar', 'academicYears'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAcademicCalendarRequest $request, Kalender $academicCalendar)
    {
        try {
            $data = [
                'title' => $request->title,
                'academic_year' => $request->academic_year,
                'semester' => $request->semester,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'description' => $request->description,
                'is_active' => $request->has('is_active'),
            ];

            // Jika ada file baru diupload
            if ($request->hasFile('file')) {
                // Hapus file lama
                if (Storage::disk('public')->exists($academicCalendar->file_path)) {
                    Storage::disk('public')->delete($academicCalendar->file_path);
                }

                $file = $request->file('file');
                $filePath = $file->store('academic-calendars', 'public');

                $data['file_path'] = $filePath;
                $data['original_file_name'] = $file->getClientOriginalName();
                $data['file_size'] = $file->getSize();
            }

            $academicCalendar->update($data);

            // Jika dipilih sebagai aktif, aktifkan kalender ini
            if ($academicCalendar->is_active) {
                $academicCalendar->activate();
            }

            return redirect()->route('admin.academic.academic-calendars.index')
                ->with('success', 'Kalender akademik berhasil diperbarui.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kalender $academicCalendar)
    {
        try {
            $academicCalendar->delete();

            return redirect()->route('admin.academic.academic-calendars.index')
                ->with('success', 'Kalender akademik berhasil dihapus.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Force delete the specified resource from storage.
     */
    public function forceDestroy($id)
    {
        try {
            $academicCalendar = Kalender::withTrashed()->findOrFail($id);

            // Hapus file dari storage
            if (Storage::disk('public')->exists($academicCalendar->file_path)) {
                Storage::disk('public')->delete($academicCalendar->file_path);
            }

            $academicCalendar->forceDelete();

            return redirect()->route('admin.academic.academic-calendars.index')
                ->with('success', 'Kalender akademik berhasil dihapus permanen.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Restore the specified resource from trash.
     */
    public function restore($id)
    {
        try {
            $academicCalendar = Kalender::withTrashed()->findOrFail($id);
            $academicCalendar->restore();

            return redirect()->route('admin.academic.academic-calendars.index')
                ->with('success', 'Kalender akademik berhasil dipulihkan.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Set academic calendar as active.
     */
    public function activate(Kalender $academicCalendar)
    {
        try {
            $academicCalendar->activate();

            return redirect()->route('admin.academic.academic-calendars.index')
                ->with('success', 'Kalender akademik berhasil diaktifkan.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Download the academic calendar file.
     */
    public function download(Kalender $academicCalendar)
    {
        if (!Storage::disk('public')->exists($academicCalendar->file_path)) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }

        return Storage::disk('public')->download(
            $academicCalendar->file_path,
            $academicCalendar->original_file_name
        );
    }
}