<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with('category', 'user')
                    ->where('is_published', true)
                    ->where('published_at', '<=', now());

        // Filter by category
        if ($request->has('category') && $request->category) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Search
        if ($request->has('search') && $request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%'.$request->search.'%')
                  ->orWhere('excerpt', 'like', '%'.$request->search.'%')
                  ->orWhere('content', 'like', '%'.$request->search.'%');
            });
        }

        $posts = $query->latest('published_at')->paginate(6);
        $categories = Category::where('is_active', true)->withCount(['posts' => function ($query) {
            $query->where('is_published', true)->where('published_at', '<=', now());
        }])->get();
        
        // Featured posts (latest 3 published posts)
        $featuredPosts = Post::with('category')
                            ->where('is_published', true)
                            ->where('published_at', '<=', now())
                            ->latest('published_at')
                            ->take(3)
                            ->get();

        return view('frontend.news.index', compact('posts', 'categories', 'featuredPosts'));
    }

    public function show($slug)
    {
        $post = Post::with('category', 'user')
                    ->where('slug', $slug)
                    ->where('is_published', true)
                    ->where('published_at', '<=', now())
                    ->firstOrFail();

        // Increment views
        $post->increment('views');

        // Related posts (same category, exclude current post)
        $relatedPosts = Post::with('category')
                            ->where('category_id', $post->category_id)
                            ->where('id', '!=', $post->id)
                            ->where('is_published', true)
                            ->where('published_at', '<=', now())
                            ->latest('published_at')
                            ->take(3)
                            ->get();

        return view('frontend.news.detail', compact('post', 'relatedPosts'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->where('is_active', true)->firstOrFail();
        
        $posts = Post::with('category', 'user')
                    ->where('category_id', $category->id)
                    ->where('is_published', true)
                    ->where('published_at', '<=', now())
                    ->latest('published_at')
                    ->paginate(6);
                    
        $categories = Category::where('is_active', true)->withCount(['posts' => function ($query) {
            $query->where('is_published', true)->where('published_at', '<=', now());
        }])->get();

        return view('frontend.news.category', compact('posts', 'category', 'categories'));
    }
}