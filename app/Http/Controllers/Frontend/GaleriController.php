<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        // Semua tahun angkatan yang tersedia (untuk filter)
        $angkatanList = Galeri::published()
            ->select('angkatan')
            ->distinct()
            ->orderByDesc('angkatan')
            ->pluck('angkatan');

        // Query utama — filter per angkatan jika dipilih
        $query = Galeri::published()
            ->withCount('fotos')
            ->orderByDesc('angkatan');

        if ($request->filled('angkatan')) {
            $query->where('angkatan', $request->angkatan);
        }

        $galeris = $query->paginate(12)->withQueryString();

        return view('frontend.galeri.index', compact('galeris', 'angkatanList'));
    }

    public function show(Galeri $galeri)
    {
        // Hanya tampilkan album yang dipublikasikan
        abort_unless($galeri->is_published, 404);

        $galeri->load('fotos');

        // Album lain dari angkatan yang sama (sidebar)
        $albumLain = Galeri::published()
            ->where('id', '!=', $galeri->id)
            ->where('angkatan', $galeri->angkatan)
            ->withCount('fotos')
            ->get();

        return view('frontend.galeri.show', compact('galeri', 'albumLain'));
    }
}
