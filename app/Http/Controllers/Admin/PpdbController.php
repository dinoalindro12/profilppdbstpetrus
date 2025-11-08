<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PpdbInfo;
use App\Models\PpdbRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PpdbController extends Controller
{
    // ===== PPDB INFO MANAGEMENT =====
    public function infoIndex()
    {
        $info = PpdbInfo::orderBy('academic_year', 'desc')->get();
        return view('admin.ppdb.info.index', compact('info'));
    }

    public function infoCreate()
    {
        return view('admin.ppdb.info.create');
    }

    public function infoStore(Request $request)
    {
        $request->validate([
            'academic_year' => 'required|string|max:9',
            'registration_start' => 'required|date',
            'registration_end' => 'required|date|after:registration_start',
            'requirements' => 'nullable|string',
            'schedule' => 'nullable|string',
            'quota' => 'nullable|integer'
        ]);

        // Jika menandai sebagai aktif, nonaktifkan yang lain
        if ($request->has('is_active')) {
            PpdbInfo::where('is_active', true)->update(['is_active' => false]);
        }

        PpdbInfo::create($request->all());

        return redirect()->route('admin.ppdb.info.index')->with('success', 'Info PPDB berhasil ditambahkan.');
    }

    public function infoEdit(PpdbInfo $info)
    {
        return view('admin.ppdb.info.edit', compact('info'));
    }

    public function infoUpdate(Request $request, PpdbInfo $info)
    {
        $request->validate([
            'academic_year' => 'required|string|max:9',
            'registration_start' => 'required|date',
            'registration_end' => 'required|date|after:registration_start',
            'requirements' => 'nullable|string',
            'schedule' => 'nullable|string',
            'quota' => 'nullable|integer'
        ]);

        // Jika menandai sebagai aktif, nonaktifkan yang lain
        if ($request->has('is_active')) {
            PpdbInfo::where('is_active', true)->where('id', '!=', $info->id)->update(['is_active' => false]);
        }

        $info->update($request->all());

        return redirect()->route('admin.ppdb.info.index')->with('success', 'Info PPDB berhasil diperbarui.');
    }

    public function infoDestroy(PpdbInfo $info)
    {
        // Hapus jika tidak ada pendaftaran
        if ($info->registrations()->count() > 0) {
            return redirect()->route('admin.ppdb.info.index')->with('error', 'Tidak dapat menghapus info PPDB karena sudah ada pendaftaran.');
        }

        $info->delete();
        return redirect()->route('admin.ppdb.info.index')->with('success', 'Info PPDB berhasil dihapus.');
    }

    // ===== REGISTRATION MANAGEMENT =====
    public function registrationIndex()
    {
        $registrations = PpdbRegistration::with('info')->latest()->get();
        return view('admin.ppdb.registration.index', compact('registrations'));
    }

    public function registrationShow(PpdbRegistration $registration)
    {
        return view('admin.ppdb.registration.show', compact('registration'));
    }

    public function registrationUpdateStatus(Request $request, PpdbRegistration $registration)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
            'notes' => 'nullable|string'
        ]);

        $registration->update([
            'status' => $request->status,
            'notes' => $request->notes
        ]);

        return redirect()->route('admin.ppdb.registration.index')->with('success', 'Status pendaftaran berhasil diperbarui.');
    }

    public function registrationDestroy(PpdbRegistration $registration)
    {
        // Hapus file yang diupload
        $files = ['photo', 'birth_certificate', 'family_card', 'report_card'];
        foreach ($files as $file) {
            if ($registration->$file) {
                Storage::delete($registration->$file);
            }
        }

        $registration->delete();
        return redirect()->route('admin.ppdb.registration.index')->with('success', 'Data pendaftaran berhasil dihapus.');
    }
}