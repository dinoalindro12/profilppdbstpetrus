<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GaleriController extends Controller
{
    public function index()
    {
        $galeris = Galeri::latest()->paginate(10);
        return view('admin.galeri.index', compact('galeris'));
    }

    public function create()
    {
        return view('admin.galeri.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = $this->storeImage($request->file('image'));

        Galeri::create([
            'title' => $validated['title'],
            'image' => $imageName,
        ]);

        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil dibuat.');
    }

    public function edit(Galeri $galeri)
    {
        return view('admin.galeri.edit', compact('galeri'));
    }

    public function update(Request $request, Galeri $galeri): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = ['title' => $validated['title']];

        if ($request->hasFile('image')) {
            $this->deleteImage($galeri->image);
            $data['image'] = $this->storeImage($request->file('image'));
        }

        $galeri->update($data);

        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil diperbarui.');
    }

    public function destroy(Galeri $galeri): RedirectResponse
    {
        $this->deleteImage($galeri->image);
        $galeri->delete();

        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil dihapus.');
    }

    /**
     * Simpan file gambar dengan nama unik dan aman.
     */
    protected function storeImage($file): string
    {
        $imageName = Str::uuid() . '.' . $file->extension();
        $file->move(public_path('images/galeri'), $imageName);

        return $imageName;
    }

    /**
     * Hapus file gambar lama jika ada.
     */
    protected function deleteImage(?string $imageName): void
    {
        if (!$imageName) {
            return;
        }

        $path = public_path('images/galeri/' . $imageName);

        if (file_exists($path)) {
            unlink($path);
        }
    }
}