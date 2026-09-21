<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Curriculum;
use App\Models\Extracurricular;
use App\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AcademicController extends Controller
{
    // ===== CURRICULUM MANAGEMENT =====
    public function curriculumIndex()
    {
        $curriculums = Curriculum::orderBy('order')->get();
        return view('admin.academic.curriculum.index', compact('curriculums'));
    }

    public function curriculumCreate()
    {
        return view('admin.academic.curriculum.create');
    }

    public function curriculumStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:10240', // Max 10MB
            'order' => 'nullable|integer'
        ]);

        $curriculum = new Curriculum();
        $curriculum->name = $request->name;
        $curriculum->description = $request->description;
        $curriculum->order = $request->order ?? 0;
        $curriculum->is_active = $request->has('is_active');

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('public/curriculums');
            $curriculum->file = $filePath;
        }

        $curriculum->save();

        return redirect()->route('admin.academic.curriculum.index')->with('success', 'Kurikulum berhasil ditambahkan.');
    }

    public function curriculumEdit(Curriculum $curriculum)
    {
        return view('admin.academic.curriculum.edit', compact('curriculum'));
    }

    public function curriculumUpdate(Request $request, Curriculum $curriculum)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'order' => 'nullable|integer'
        ]);

        $curriculum->name = $request->name;
        $curriculum->description = $request->description;
        $curriculum->order = $request->order ?? 0;
        $curriculum->is_active = $request->has('is_active');

        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($curriculum->file) {
                Storage::delete($curriculum->file);
            }
            $filePath = $request->file('file')->store('public/curriculums');
            $curriculum->file = $filePath;
        }

        $curriculum->save();

        return redirect()->route('admin.academic.curriculum.index')->with('success', 'Kurikulum berhasil diperbarui.');
    }

    public function curriculumDestroy(Curriculum $curriculum)
    {
        if ($curriculum->file) {
            Storage::delete($curriculum->file);
        }
        $curriculum->delete();

        return redirect()->route('admin.academic.curriculum.index')->with('success', 'Kurikulum berhasil dihapus.');
    }

    // ===== EXTRACURRICULAR MANAGEMENT =====
    public function extracurricularIndex()
    {
        $extracurriculars = Extracurricular::orderBy('order')->get();
        return view('admin.academic.extracurricular.index', compact('extracurriculars'));
    }

    public function extracurricularCreate()
    {
        return view('admin.academic.extracurricular.create');
    }

    public function extracurricularStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'schedule' => 'nullable|string|max:255',
            'coach' => 'nullable|string|max:255',
            'order' => 'nullable|integer'
        ]);

        $extracurricular = new Extracurricular();
        $extracurricular->name = $request->name;
        $extracurricular->description = $request->description;
        $extracurricular->schedule = $request->schedule;
        $extracurricular->coach = $request->coach;
        $extracurricular->order = $request->order ?? 0;
        $extracurricular->is_active = $request->has('is_active');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('extracurriculars', 'public');
            $extracurricular->image = $imagePath;
        }

        $extracurricular->save();

        return redirect()->route('admin.academic.extracurricular.index')->with('success', 'Ekstrakurikuler berhasil ditambahkan.');
    }

    public function extracurricularEdit(Extracurricular $extracurricular)
    {
        return view('admin.academic.extracurricular.edit', compact('extracurricular'));
    }

   public function extracurricularUpdate(Request $request, Extracurricular $extracurricular)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'schedule' => 'nullable|string|max:255',
            'coach' => 'nullable|string|max:255',
            'order' => 'nullable|integer'
        ]);

        $extracurricular->name = $request->name;
        $extracurricular->description = $request->description;
        $extracurricular->schedule = $request->schedule;
        $extracurricular->coach = $request->coach;
        $extracurricular->order = $request->order ?? 0;
        $extracurricular->is_active = $request->has('is_active');

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($extracurricular->image) {
                Storage::disk('public')->delete($extracurricular->image);
            }
            $imagePath = $request->file('image')->store('extracurriculars', 'public');
            $extracurricular->image = $imagePath;
        }

        $extracurricular->save();

        return redirect()->route('admin.academic.extracurricular.index')->with('success', 'Ekstrakurikuler berhasil diperbarui.');
    }

    public function extracurricularDestroy(Extracurricular $extracurricular)
    {
        if ($extracurricular->image) {
            Storage::delete($extracurricular->image);
        }
        $extracurricular->delete();

        return redirect()->route('admin.academic.extracurricular.index')->with('success', 'Ekstrakurikuler berhasil dihapus.');
    }

    // ===== ACHIEVEMENT MANAGEMENT =====
    public function achievementIndex()
    {
        $achievements = Achievement::orderBy('year', 'desc')->orderBy('order')->get();
        return view('admin.academic.achievement.index', compact('achievements'));
    }

    public function achievementCreate()
    {
        return view('admin.academic.achievement.create');
    }

    public function achievementStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required|string|max:255',
            'year' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'level' => 'nullable|string|max:255',
            'order' => 'nullable|integer'
        ]);

        $achievement = new Achievement();
        $achievement->title = $request->title;
        $achievement->description = $request->description;
        $achievement->category = $request->category;
        $achievement->year = $request->year;
        $achievement->level = $request->level;
        $achievement->order = $request->order ?? 0;
        $achievement->is_active = $request->has('is_active');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/achievements');
            $achievement->image = $imagePath;
        }

        $achievement->save();

        return redirect()->route('admin.academic.achievement.index')->with('success', 'Prestasi berhasil ditambahkan.');
    }

    public function achievementEdit(Achievement $achievement)
    {
        return view('admin.academic.achievement.edit', compact('achievement'));
    }

    public function achievementUpdate(Request $request, Achievement $achievement)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required|string|max:255',
            'year' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'level' => 'nullable|string|max:255',
            'order' => 'nullable|integer'
        ]);

        $achievement->title = $request->title;
        $achievement->description = $request->description;
        $achievement->category = $request->category;
        $achievement->year = $request->year;
        $achievement->level = $request->level;
        $achievement->order = $request->order ?? 0;
        $achievement->is_active = $request->has('is_active');

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($achievement->image) {
                Storage::delete($achievement->image);
            }
            $imagePath = $request->file('image')->store('public/achievements');
            $achievement->image = $imagePath;
        }

        $achievement->save();

        return redirect()->route('admin.academic.achievement.index')->with('success', 'Prestasi berhasil diperbarui.');
    }

    public function achievementDestroy(Achievement $achievement)
    {
        if ($achievement->image) {
            Storage::delete($achievement->image);
        }
        $achievement->delete();

        return redirect()->route('admin.academic.achievement.index')->with('success', 'Prestasi berhasil dihapus.');
    }
}