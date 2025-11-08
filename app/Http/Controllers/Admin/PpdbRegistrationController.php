<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PpdbRegistration;
use App\Models\PpdbInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PpdbRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // PASTIKAN MENGGUNAKAN paginate() BUKAN get() ATAU all()
        $registrations = PpdbRegistration::with('info')
            ->orderBy('created_at', 'desc')
            ->paginate(10); // <- INI YANG BENAR

        // Hitung statistik terpisah
        $stats = [
            'total' => PpdbRegistration::count(),
            'approved' => PpdbRegistration::where('status', 'approved')->count(),
            'pending' => PpdbRegistration::where('status', 'pending')->count(),
            'rejected' => PpdbRegistration::where('status', 'rejected')->count()
        ];

        return view('admin.ppdb.registration.index', compact('registrations', 'stats'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $registration = PpdbRegistration::with('info')->findOrFail($id);
        
        return view('admin.ppdb.registration.show', compact('registration'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $registration = PpdbRegistration::findOrFail($id);
        $ppdbInfos = PpdbInfo::where('is_active', true)->get();

        return view('admin.ppdb.registration.edit', compact('registration', 'ppdbInfos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $registration = PpdbRegistration::findOrFail($id);

        $validated = $request->validate([
            'ppdb_info_id' => 'required|exists:ppdb_infos,id',
            'full_name' => 'required|string|max:255',
            'birth_place' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|in:L,P',
            'address' => 'required|string',
            'phone' => 'required|string|max:20',
            'previous_school' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'father_phone' => 'nullable|string|max:20',
            'mother_name' => 'required|string|max:255',
            'mother_phone' => 'nullable|string|max:20',
            'status' => 'required|in:pending,approved,rejected',
            'notes' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'birth_certificate' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:2048',
            'family_card' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:2048',
            'report_card' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:2048',
        ]);

        // Handle file uploads
        if ($request->hasFile('photo')) {
            // Delete old file
            if ($registration->photo) {
                Storage::delete($registration->photo);
            }
            $validated['photo'] = $request->file('photo')->store('ppdb/photos', 'public');
        }

        if ($request->hasFile('birth_certificate')) {
            if ($registration->birth_certificate) {
                Storage::delete($registration->birth_certificate);
            }
            $validated['birth_certificate'] = $request->file('birth_certificate')->store('ppdb/birth_certificates', 'public');
        }

        if ($request->hasFile('family_card')) {
            if ($registration->family_card) {
                Storage::delete($registration->family_card);
            }
            $validated['family_card'] = $request->file('family_card')->store('ppdb/family_cards', 'public');
        }

        if ($request->hasFile('report_card')) {
            if ($registration->report_card) {
                Storage::delete($registration->report_card);
            }
            $validated['report_card'] = $request->file('report_card')->store('ppdb/report_cards', 'public');
        }

        $registration->update($validated);

        return redirect()->route('admin.ppdb.registration.index')
            ->with('success', 'Data pendaftaran berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $registration = PpdbRegistration::findOrFail($id);

        // Delete files
        if ($registration->photo) {
            Storage::delete($registration->photo);
        }
        if ($registration->birth_certificate) {
            Storage::delete($registration->birth_certificate);
        }
        if ($registration->family_card) {
            Storage::delete($registration->family_card);
        }
        if ($registration->report_card) {
            Storage::delete($registration->report_card);
        }

        $registration->delete();

        return redirect()->route('admin.ppdb.registration.index')
            ->with('success', 'Data pendaftaran berhasil dihapus.');
    }

    /**
     * Update registration status
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
            'notes' => 'nullable|string'
        ]);

        $registration = PpdbRegistration::findOrFail($id);
        $registration->update([
            'status' => $request->status,
            'notes' => $request->notes
        ]);

        return redirect()->route('admin.ppdb.registration.show', $id)
            ->with('success', 'Status pendaftaran berhasil diperbarui.');
    }

    /**
     * Download document
     */
    public function downloadDocument($id, $documentType)
    {
        $registration = PpdbRegistration::findOrFail($id);
        
        $validDocuments = ['photo', 'birth_certificate', 'family_card', 'report_card'];
        
        if (!in_array($documentType, $validDocuments)) {
            abort(404);
        }

        if (!$registration->$documentType) {
            return redirect()->back()->with('error', 'Dokumen tidak ditemukan.');
        }

        return Storage::disk('public')->download($registration->$documentType);
    }
}