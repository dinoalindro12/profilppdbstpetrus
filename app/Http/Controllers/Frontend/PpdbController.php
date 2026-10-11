<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PpdbInfo;
use App\Models\PpdbRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PpdbController extends Controller
{
    public function index()
    {
        // Only show active PPDB within registration period
        $info = PpdbInfo::where('is_active', true)
            ->where('registration_end', '>=', now()->format('Y-m-d'))
            ->orderBy('academic_year', 'desc')
            ->get();
        
        $activeInfo = PpdbInfo::where('is_active', true)
            ->where('registration_end', '>=', now()->format('Y-m-d'))
            ->first();

        return view('frontend.ppdb.index', compact('info', 'activeInfo'));
    }

    public function form()
    {
        $activeInfo = PpdbInfo::where('is_active', true)
            ->where('registration_end', '>=', now()->format('Y-m-d'))
            ->first();

        if (!$activeInfo) {
            return redirect()->route('ppdb.index')->with('error', 'Pendaftaran PPDB sedang tidak dibuka atau sudah ditutup.');
        }

        return view('frontend.ppdb.form', compact('activeInfo'));
    }

    public function store(Request $request)
    {
        $activeInfo = PpdbInfo::where('is_active', true)
            ->where('registration_end', '>=', now()->format('Y-m-d'))
            ->first();
        
        if (!$activeInfo) {
            return back()->with('error', 'Pendaftaran PPDB sedang tidak dibuka atau sudah ditutup.');
        }

        $request->validate([
            'full_name' => 'required|string|max:255',
            'birth_place' => 'required|string|max:255',
            'birth_date' => [
                'required',
                'date',
                'before_or_equal:' . now()->subYears(14)->format('Y-m-d'), // Minimal 14 tahun
                'after_or_equal:' . now()->subYears(21)->format('Y-m-d'), // Maksimal 21 tahun
            ],
            'gender' => 'required|in:L,P',
            'address' => 'required|string',
            'phone' => 'required|string|max:15',
            'previous_school' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'father_phone' => 'nullable|string|max:15',
            'mother_name' => 'required|string|max:255',
            'mother_phone' => 'nullable|string|max:15',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'birth_certificate' => 'required|file|mimes:pdf,jpeg,png,jpg|max:2048',
            'family_card' => 'required|file|mimes:pdf,jpeg,png,jpg|max:2048',
            'report_card' => 'required|file|mimes:pdf,jpeg,png,jpg|max:2048',
        ], [
            'birth_date.before_or_equal' => 'Usia minimal peserta didik adalah 14 tahun.',
            'birth_date.after_or_equal' => 'Usia maksimal peserta didik adalah 21 tahun saat mendaftar.',
        ]);

        // Generate registration number
        $registrationNumber = PpdbRegistration::generateRegistrationNumber();

        // Upload files
        $photoPath = $request->file('photo')->store('public/ppdb/photos');
        $birthCertificatePath = $request->file('birth_certificate')->store('public/ppdb/documents');
        $familyCardPath = $request->file('family_card')->store('public/ppdb/documents');
        $reportCardPath = $request->file('report_card')->store('public/ppdb/documents');

        // Create registration
        $registration = PpdbRegistration::create([
            'registration_number' => $registrationNumber,
            'ppdb_info_id' => $activeInfo->id,
            'full_name' => $request->full_name,
            'birth_place' => $request->birth_place,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'address' => $request->address,
            'phone' => $request->phone,
            'previous_school' => $request->previous_school,
            'father_name' => $request->father_name,
            'father_phone' => $request->father_phone,
            'mother_name' => $request->mother_name,
            'mother_phone' => $request->mother_phone,
            'photo' => $photoPath,
            'birth_certificate' => $birthCertificatePath,
            'family_card' => $familyCardPath,
            'report_card' => $reportCardPath,
        ]);

        return redirect()->route('ppdb.status')->with([
            'success' => 'Pendaftaran berhasil! Nomor pendaftaran Anda: ' . $registrationNumber,
            'registration_number' => $registrationNumber
        ]);
    }

    public function status()
    {
        return view('frontend.ppdb.status');
    }

    public function checkStatus(Request $request)
    {
        $request->validate([
            'registration_number' => 'required|string'
        ]);

        $registration = PpdbRegistration::where('registration_number', $request->registration_number)->first();

        if (!$registration) {
            return back()->with('error', 'Nomor pendaftaran tidak ditemukan.');
        }

        return view('frontend.ppdb.status-result', compact('registration'));
    }

    public function downloadRegistrationCertificate($registrationNumber)
    {
        $registration = PpdbRegistration::where('registration_number', $registrationNumber)->first();

        if (!$registration) {
            return back()->with('error', 'Nomor pendaftaran tidak ditemukan.');
        }

        $data = [
            'registration' => $registration,
            'schoolName' => 'SMAS RK Delimurni Delitua',
            'academicYear' => $registration->info->academic_year,
            'downloadDate' => now()->format('d M Y H:i:s')
        ];

        $pdf = \PDF::loadView('frontend.ppdb.certificate', $data);
        return $pdf->download('Bukti_Pendaftaran_' . $registrationNumber . '.pdf');
    }
}