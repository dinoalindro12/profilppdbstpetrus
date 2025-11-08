<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\SchoolHistory;
use App\Models\VisionMission;
use App\Models\Staff;
use App\Models\Facility;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function history()
    {
        $history = SchoolHistory::first();
        return view('frontend.profile.history', compact('history'));
    }

    public function visionMission()
    {
        $visionMission = VisionMission::first();
        return view('frontend.profile.vision-mission', compact('visionMission'));
    }

    public function teachers()
    {
        $teachers = Staff::teachers()->active()->orderBy('order')->get();
        return view('frontend.profile.teachers', compact('teachers'));
    }

    public function staff()
    {
        $staff = Staff::staff()->active()->orderBy('order')->get();
        return view('frontend.profile.staff', compact('staff'));
    }

    public function facilities()
    {
        $facilities = Facility::active()->orderBy('order')->get();
        return view('frontend.profile.facilities', compact('facilities'));
    }
}