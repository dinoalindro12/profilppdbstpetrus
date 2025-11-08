<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Curriculum;
use App\Models\Extracurricular;
use App\Models\Achievement;
use Illuminate\Http\Request;

class AcademicController extends Controller
{
    public function curriculum()
    {
        $curriculums = Curriculum::active()->orderBy('order')->get();
        return view('frontend.academic.curriculum', compact('curriculums'));
    }

    public function extracurricular()
    {
        $extracurriculars = Extracurricular::active()->orderBy('order')->get();
        return view('frontend.academic.extracurricular', compact('extracurriculars'));
    }

    public function achievement()
    {
        $achievements = Achievement::active()->orderBy('year', 'desc')->orderBy('order')->get();
        
        // Group achievements by year for timeline
        $achievementsByYear = $achievements->groupBy('year');
        
        // Get unique categories for filter
        $categories = Achievement::active()->distinct()->pluck('category');
        
        return view('frontend.academic.achievement', compact('achievements', 'achievementsByYear', 'categories'));
    }
}