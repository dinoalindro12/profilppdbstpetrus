<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('category', 'user')->latest()->get();
        return view('admin.news.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::active()->get();
        return view('admin.news.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:posts,title',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string'
        ]);

        try {
            $post = new Post();
            $post->title = $request->title;
            $post->slug = $this->generateUniqueSlug($request->title);
            $post->excerpt = $request->excerpt;
            $post->content = $request->content;
            $post->category_id = $request->category_id;
            $post->user_id = auth()->id();
            $post->status = $request->status;
            $post->published_at = $request->published_at ?? ($request->status == 'published' ? now() : null);
            $post->is_featured = $request->has('is_featured');
            $post->meta_description = $request->meta_description;
            $post->meta_keywords = $request->meta_keywords;

            if ($request->hasFile('thumbnail')) {
                $imagePath = $request->file('thumbnail')->store('posts', 'public');
                $post->thumbnail = $imagePath;
            }

            $post->save();

            return redirect()->route('admin.news.posts.index')->with('success', 'Post berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function edit(Post $post)
    {
        $categories = Category::active()->get();
        return view('admin.news.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('posts')->ignore($post->id)
            ],
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string'
        ]);

        try {
            $post->title = $request->title;
            
            // Generate new slug only if title changed
            if ($post->isDirty('title')) {
                $post->slug = $this->generateUniqueSlug($request->title);
            }
            
            $post->excerpt = $request->excerpt;
            $post->content = $request->content;
            $post->category_id = $request->category_id;
            $post->status = $request->status;
            $post->published_at = $request->published_at ?? ($request->status == 'published' ? now() : null);
            $post->is_featured = $request->has('is_featured');
            $post->meta_description = $request->meta_description;
            $post->meta_keywords = $request->meta_keywords;

            if ($request->hasFile('thumbnail')) {
                // Hapus thumbnail lama jika ada
                if ($post->thumbnail) {
                    Storage::disk('public')->delete($post->thumbnail);
                }
                $imagePath = $request->file('thumbnail')->store('posts', 'public');
                $post->thumbnail = $imagePath;
            }

            $post->save();

            return redirect()->route('admin.news.posts.index')->with('success', 'Post berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Post $post)
    {
        try {
            if ($post->thumbnail) {
                Storage::disk('public')->delete($post->thumbnail);
            }
            $post->delete();

            return redirect()->route('admin.news.posts.index')->with('success', 'Post berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.news.posts.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Generate unique slug
     */
    private function generateUniqueSlug($title)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 1;

        while (Post::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }
}