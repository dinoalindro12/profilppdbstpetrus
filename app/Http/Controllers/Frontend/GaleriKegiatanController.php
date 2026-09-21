<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\GaleriKegiatan;

class GaleriKegiatanController extends Controller
{
    public function index()
    {
        $kegiatan = GaleriKegiatan::published()
            ->withCount('fotos')
            ->orderByDesc('tanggal')
            ->paginate(12);

        return view('frontend.galeri_kegiatan.index', compact('kegiatan'));
    }

    public function show(GaleriKegiatan $galeriKegiatan)
    {
        abort_unless($galeriKegiatan->is_published, 404);
        $galeriKegiatan->load('fotos');

        // Kegiatan lain (4 terdekat)
        $kegiatanLain = GaleriKegiatan::published()
            ->where('id', '!=', $galeriKegiatan->id)
            ->withCount('fotos')
            ->orderByDesc('tanggal')
            ->take(4)
            ->get();

        return view('frontend.galeri_kegiatan.show', compact('galeriKegiatan', 'kegiatanLain'));
    }
}
