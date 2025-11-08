<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolHistory;
use App\Models\VisionMission;
use App\Models\Staff;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // Sejarah Sekolah
    public function history()
    {
        $history = SchoolHistory::first();
        return view('admin.profile.history', compact('history'));
    }

    public function historyUpdate(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $history = SchoolHistory::firstOrNew([]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($history->image) {
                Storage::delete($history->image);
            }
            $imagePath = $request->file('image')->store('public/history');
            $history->image = $imagePath;
        }

        $history->content = $request->content;
        $history->save();

        return redirect()->route('admin.profile.history')->with('success', 'Sejarah sekolah berhasil diperbarui.');
    }

    // Visi Misi
    public function visionMission()
    {
        $visionMission = VisionMission::first();
        return view('admin.profile.vision-mission', compact('visionMission'));
    }

    public function visionMissionUpdate(Request $request)
    {
        $request->validate([
            'vision' => 'required',
            'mission' => 'required'
        ]);

        $visionMission = VisionMission::firstOrNew([]);
        $visionMission->vision = $request->vision;
        $visionMission->mission = $request->mission;
        $visionMission->save();

        return redirect()->route('admin.profile.vision-mission')->with('success', 'Visi dan Misi berhasil diperbarui.');
    }

    // Staff Management
    public function staffIndex()
    {
        $staff = Staff::orderBy('order')->get();
        return view('admin.profile.staff.index', compact('staff'));
    }

    public function staffCreate()
    {
        return view('admin.profile.staff.create');
    }

    public function staffStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'position' => 'required',
            'type' => 'required|in:teacher,staff',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nip' => 'nullable|string',
            'description' => 'nullable|string',
            'order' => 'nullable|integer'
        ]);

        $staff = new Staff();
        $staff->name = $request->name;
        $staff->nip = $request->nip;
        $staff->position = $request->position;
        $staff->type = $request->type;
        $staff->description = $request->description;
        $staff->order = $request->order ?? 0;
        $staff->is_active = $request->has('is_active');

        if ($request->hasFile('photo')) {
            $imagePath = $request->file('photo')->store('public/staff');
            $staff->photo = $imagePath;
        }

        $staff->save();

        return redirect()->route('admin.profile.staff.index')->with('success', 'Data staff berhasil ditambahkan.');
    }

    public function staffEdit(Staff $staff)
    {
        return view('admin.profile.staff.edit', compact('staff'));
    }

    public function staffUpdate(Request $request, Staff $staff)
    {
        $request->validate([
            'name' => 'required',
            'position' => 'required',
            'type' => 'required|in:teacher,staff',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nip' => 'nullable|string',
            'description' => 'nullable|string',
            'order' => 'nullable|integer'
        ]);

        $staff->name = $request->name;
        $staff->nip = $request->nip;
        $staff->position = $request->position;
        $staff->type = $request->type;
        $staff->description = $request->description;
        $staff->order = $request->order ?? 0;
        $staff->is_active = $request->has('is_active');

        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($staff->photo) {
                Storage::delete($staff->photo);
            }
            $imagePath = $request->file('photo')->store('public/staff');
            $staff->photo = $imagePath;
        }

        $staff->save();

        return redirect()->route('admin.profile.staff.index')->with('success', 'Data staff berhasil diperbarui.');
    }

    public function staffDestroy(Staff $staff)
    {
        if ($staff->photo) {
            Storage::delete($staff->photo);
        }
        $staff->delete();

        return redirect()->route('admin.profile.staff.index')->with('success', 'Data staff berhasil dihapus.');
    }

    // Facilities Management
    public function facilitiesIndex()
    {
        $facilities = Facility::orderBy('order')->get();
        return view('admin.profile.facilities.index', compact('facilities'));
    }

    public function facilitiesCreate()
    {
        return view('admin.profile.facilities.create');
    }

    public function facilitiesStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer'
        ]);

        $facility = new Facility();
        $facility->name = $request->name;
        $facility->description = $request->description;
        $facility->order = $request->order ?? 0;
        $facility->is_active = $request->has('is_active');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/facilities');
            $facility->image = $imagePath;
        }

        $facility->save();

        return redirect()->route('admin.profile.facilities.index')->with('success', 'Fasilitas berhasil ditambahkan.');
    }

    public function facilitiesEdit(Facility $facility)
    {
        return view('admin.profile.facilities.edit', compact('facility'));
    }

    public function facilitiesUpdate(Request $request, Facility $facility)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer'
        ]);

        $facility->name = $request->name;
        $facility->description = $request->description;
        $facility->order = $request->order ?? 0;
        $facility->is_active = $request->has('is_active');

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($facility->image) {
                Storage::delete($facility->image);
            }
            $imagePath = $request->file('image')->store('public/facilities');
            $facility->image = $imagePath;
        }

        $facility->save();

        return redirect()->route('admin.profile.facilities.index')->with('success', 'Fasilitas berhasil diperbarui.');
    }

    public function facilitiesDestroy(Facility $facility)
    {
        if ($facility->image) {
            Storage::delete($facility->image);
        }
        $facility->delete();

        return redirect()->route('admin.profile.facilities.index')->with('success', 'Fasilitas berhasil dihapus.');
    }
}