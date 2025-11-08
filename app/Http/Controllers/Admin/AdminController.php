<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PpdbRegistration;
use App\Models\PpdbInfo;
use App\Models\Staff;
use App\Models\Facility;
use App\Models\Curriculum;
use App\Models\Extracurricular;
use App\Models\Achievement;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function dashboard(): View
    {
        // Statistics for dashboard
        $stats = [
            'total_registrations' => PpdbRegistration::count(),
            'pending_registrations' => PpdbRegistration::where('status', 'pending')->count(),
            'approved_registrations' => PpdbRegistration::where('status', 'approved')->count(),
            'total_staff' => Staff::count(),
            'total_facilities' => Facility::count(),
            'total_curriculums' => Curriculum::count(),
            'total_extracurriculars' => Extracurricular::count(),
            'total_achievements' => Achievement::count(),
        ];

        // Recent activities
        $recentRegistrations = PpdbRegistration::with('info')
            ->latest()
            ->take(5)
            ->get();

        $activePpdbInfo = PpdbInfo::active()->first();

        return view('admin.dashboard', compact('stats', 'recentRegistrations', 'activePpdbInfo'));
    }
}