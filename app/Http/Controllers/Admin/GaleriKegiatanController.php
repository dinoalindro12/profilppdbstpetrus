<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GaleriKegiatan;
use App\Models\GaleriKegiatanFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriKegiatanController extends Controller
{
    public function index()
    {
        $kegiatan = GaleriKegiatan::withCount('fotos')
            ->orderByDesc('tanggal')
            ->paginate(15);

        return view('admin.galeri_kegiatan.index', compact('kegiatan'));
    }

    public function create()
    {
        return view('admin.galeri_kegiatan.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'judul'       => 'required|string|max:255',
            'tanggal'     => 'required|date',
            'deskripsi'   => 'nullable|string',
            'cover'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'fotos'       => 'nullable|array',
            'fotos.*'     => 'image|mimes:jpeg,png,jpg,webp|max:3072',
            'keterangan'  => 'nullable|array',
        ]);

        $kegiatan = new GaleriKegiatan();
        $kegiatan->judul        = $request->judul;
        $kegiatan->tanggal      = $request->tanggal;
        $kegiatan->deskripsi    = $request->deskripsi;
        $kegiatan->is_published = $request->boolean('is_published', true);

        if ($request->hasFile('cover')) {
            $kegiatan->cover = $request->file('cover')->store('galeri/kegiatan/cover', 'public');
        }

        $kegiatan->save();

        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $i => $foto) {
                $kegiatan->fotos()->create([
                    'foto'       => $foto->store('galeri/kegiatan', 'public'),
                    'keterangan' => $request->keterangan[$i] ?? null,
                    'urutan'     => $i,
                ]);
            }
        }

        return redirect()->route('admin.galeri-kegiatan.index')
            ->with('success', "Album kegiatan \"{$kegiatan->judul}\" berhasil disimpan.");
    }
    public function show ($id)
    {
        $galeriKegiatan = GaleriKegiatan::with('fotos')->findOrFail($id);
        return view('admin.galeri_kegiatan.show', compact('galeriKegiatan'));
    }
    public function edit(GaleriKegiatan $galeriKegiatan)
    {
        $galeriKegiatan->load('fotos');
        return view('admin.galeri_kegiatan.edit', compact('galeriKegiatan'));
    }

    public function update(Request $request, GaleriKegiatan $galeriKegiatan)
    {
        $request->validate([
            'judul'       => 'required|string|max:255',
            'tanggal'     => 'required|date',
            'deskripsi'   => 'nullable|string',
            'cover'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'fotos'       => 'nullable|array',
            'fotos.*'     => 'image|mimes:jpeg,png,jpg,webp|max:3072',
            'keterangan'  => 'nullable|array',
        ]);

        $galeriKegiatan->judul        = $request->judul;
        $galeriKegiatan->tanggal      = $request->tanggal;
        $galeriKegiatan->deskripsi    = $request->deskripsi;
        $galeriKegiatan->is_published = $request->boolean('is_published', true);

        if ($request->hasFile('cover')) {
            if ($galeriKegiatan->cover) {
                Storage::disk('public')->delete($galeriKegiatan->cover);
            }
            $galeriKegiatan->cover = $request->file('cover')->store('galeri/kegiatan/cover', 'public');
        }

        $galeriKegiatan->save();

        // Foto baru yang ditambahkan
        if ($request->hasFile('fotos')) {
            $existingCount = $galeriKegiatan->fotos()->count();
            foreach ($request->file('fotos') as $i => $foto) {
                $galeriKegiatan->fotos()->create([
                    'foto'       => $foto->store('galeri/kegiatan', 'public'),
                    'keterangan' => $request->keterangan[$i] ?? null,
                    'urutan'     => $existingCount + $i,
                ]);
            }
        }

        return redirect()->route('admin.galeri-kegiatan.index')
            ->with('success', 'Album kegiatan berhasil diperbarui.');
    }

    public function destroyFoto(GaleriKegiatanFoto $foto)
    {
        Storage::disk('public')->delete($foto->foto);
        $foto->delete();
        return back()->with('success', 'Foto berhasil dihapus.');
    }

    public function destroy(GaleriKegiatan $galeriKegiatan)
    {
        foreach ($galeriKegiatan->fotos as $foto) {
            Storage::disk('public')->delete($foto->foto);
        }
        if ($galeriKegiatan->cover) {
            Storage::disk('public')->delete($galeriKegiatan->cover);
        }
        $galeriKegiatan->delete();

        return redirect()->route('admin.galeri-kegiatan.index')
            ->with('success', 'Album kegiatan berhasil dihapus.');
    }
}
