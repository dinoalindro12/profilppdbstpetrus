<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SambutanKepsek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SambutanKepsekController extends Controller
{
    public function index()
    {
        // Tampilkan semua sambutan, terbaru di atas
        $sambutans = SambutanKepsek::latest()->paginate(10);
        return view('admin.sambutan_kepsek.index', compact('sambutans'));
    }

    public function create()
    {
        return view('admin.sambutan_kepsek.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'nama_kepsek' => 'required|string|max:255',
            'content'     => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        $sambutan = new SambutanKepsek();
        $sambutan->title       = $request->title;
        $sambutan->nama_kepsek = $request->nama_kepsek;
        $sambutan->content     = $request->content;

        if ($request->hasFile('image')) {
            $sambutan->image = $request->file('image')->store('sambutan', 'public');
        }

        $sambutan->save();

        return redirect()->route('admin.sambutan.index')
            ->with('success', 'Sambutan kepala sekolah berhasil disimpan.');
    }

    public function edit(SambutanKepsek $sambutan)
    {
        return view('admin.sambutan_kepsek.edit', compact('sambutan'));
    }

    public function update(Request $request, SambutanKepsek $sambutan)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'nama_kepsek' => 'required|string|max:255',
            'content'     => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        $sambutan->title       = $request->title;
        $sambutan->nama_kepsek = $request->nama_kepsek;
        $sambutan->content     = $request->content;

        if ($request->hasFile('image')) {
            if ($sambutan->image) {
                Storage::disk('public')->delete($sambutan->image);
            }
            $sambutan->image = $request->file('image')->store('sambutan', 'public');
        }

        $sambutan->save();

        return redirect()->route('admin.sambutan.index')
            ->with('success', 'Sambutan berhasil diperbarui.');
    }

    public function destroy(SambutanKepsek $sambutan)
    {
        if ($sambutan->image) {
            Storage::disk('public')->delete($sambutan->image);
        }
        $sambutan->delete();

        return redirect()->route('admin.sambutan.index')
            ->with('success', 'Sambutan berhasil dihapus.');
    }
}
