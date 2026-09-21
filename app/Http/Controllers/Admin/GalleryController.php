<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use App\Models\GaleriFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    // ── Index ─────────────────────────────────────────────────────────────
    public function index()
    {
        $galeris = Galeri::withCount('fotos')
            ->orderByDesc('angkatan')
            ->paginate(15);

        return view('admin.galeri.index', compact('galeris'));
    }

    // ── Create ────────────────────────────────────────────────────────────
    public function create()
    {
        return view('admin.galeri.create');
    }

    // ── Store ─────────────────────────────────────────────────────────────
    public function store(Request $request)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'angkatan'     => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'deskripsi'    => 'nullable|string',
            'cover_image'  => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'fotos'        => 'nullable|array',
            'fotos.*'      => 'image|mimes:jpeg,png,jpg,webp|max:3072',
            'captions'     => 'nullable|array',
        ]);

        $galeri = new Galeri();
        $galeri->title        = $request->title;
        $galeri->angkatan     = $request->angkatan;
        $galeri->deskripsi    = $request->deskripsi;
        $galeri->is_published = $request->boolean('is_published', true);

        if ($request->hasFile('cover_image')) {
            $galeri->cover_image = $request->file('cover_image')->store('galeri/cover', 'public');
        }

        $galeri->save();

        // Simpan foto-foto individual
        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $i => $foto) {
                $path = $foto->store('galeri/' . $galeri->angkatan, 'public');
                $galeri->fotos()->create([
                    'image'   => $path,
                    'caption' => $request->captions[$i] ?? null,
                    'urutan'  => $i,
                ]);
            }
        }

        return redirect()->route('admin.galeri.index')
            ->with('success', "Album angkatan {$galeri->angkatan} berhasil dibuat.");
    }

    // ── Edit ──────────────────────────────────────────────────────────────
    public function edit(Galeri $galeri)
    {
        $galeri->load('fotos');
        return view('admin.galeri.edit', compact('galeri'));
    }

    // ── Update ────────────────────────────────────────────────────────────
    public function update(Request $request, Galeri $galeri)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'angkatan'     => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'deskripsi'    => 'nullable|string',
            'cover_image'  => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'fotos'        => 'nullable|array',
            'fotos.*'      => 'image|mimes:jpeg,png,jpg,webp|max:3072',
            'captions'     => 'nullable|array',
        ]);

        $galeri->title        = $request->title;
        $galeri->angkatan     = $request->angkatan;
        $galeri->deskripsi    = $request->deskripsi;
        $galeri->is_published = $request->boolean('is_published', true);

        if ($request->hasFile('cover_image')) {
            if ($galeri->cover_image) {
                Storage::disk('public')->delete($galeri->cover_image);
            }
            $galeri->cover_image = $request->file('cover_image')->store('galeri/cover', 'public');
        }

        $galeri->save();

        // Tambah foto baru
        $existingCount = $galeri->fotos()->count();
        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $i => $foto) {
                $path = $foto->store('galeri/' . $galeri->angkatan, 'public');
                $galeri->fotos()->create([
                    'image'   => $path,
                    'caption' => $request->captions[$i] ?? null,
                    'urutan'  => $existingCount + $i,
                ]);
            }
        }

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Album galeri berhasil diperbarui.');
    }

    // ── Hapus satu foto ────────────────────────────────────────────────────
    public function destroyFoto(GaleriFoto $foto)
    {
        Storage::disk('public')->delete($foto->image);
        $foto->delete();

        return back()->with('success', 'Foto berhasil dihapus.');
    }

    // ── Hapus album ────────────────────────────────────────────────────────
    public function destroy(Galeri $galeri)
    {
        // Hapus semua foto dari storage
        foreach ($galeri->fotos as $foto) {
            Storage::disk('public')->delete($foto->image);
        }
        if ($galeri->cover_image) {
            Storage::disk('public')->delete($galeri->cover_image);
        }

        $galeri->delete();

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Album galeri berhasil dihapus.');
    }
}
