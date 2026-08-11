<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Extracurricular;
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

        // Galeri placeholder — kosong jika tabel belum ada
        $gallery = [];

        // Ekstrakurikuler aktif
        $extracurriculars = Extracurricular::orderBy('name')->get();

        return view('frontend.home', compact('news', 'gallery', 'extracurriculars'));
    }
}
