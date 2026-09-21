<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\GaleriKegiatan;
use App\Models\Post;
use App\Models\Extracurricular;
use App\Models\SambutanKepsek;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        // Berita terbaru yang sudah dipublikasikan
        $news = Post::where('is_published', true)
            ->with('category')
            ->latest('published_at')
            ->take(5)
            ->get()
            ->map(fn($post) => [
                'title'    => $post->title,
                'slug'     => $post->slug,
                'excerpt'  => $post->excerpt,
                'date'     => $post->published_at ?? $post->created_at,
                'image'    => $post->thumbnail ? asset('storage/' . $post->thumbnail) : null,
                'category' => $post->category?->name,
            ])->toArray();

        // Galeri kegiatan — ambil 8 terbaru yang sudah dipublikasikan
        $gallery = GaleriKegiatan::published()
            ->orderByDesc('tanggal')
            ->take(8)
            ->get()
            ->map(fn($k) => [
                'id'    => $k->id,
                'title' => $k->judul,
                'image' => $k->cover ? asset('storage/' . $k->cover) : null,
            ])->toArray();

        // Ekstrakurikuler aktif
        $extracurriculars = Extracurricular::orderBy('name')->get();

        // Sambutan kepala sekolah — ambil yang PALING BARU (latest created_at)
        $sambutan = SambutanKepsek::latest()->first();

        return view('frontend.home', compact('news', 'gallery', 'extracurriculars', 'sambutan'));
    }
}
