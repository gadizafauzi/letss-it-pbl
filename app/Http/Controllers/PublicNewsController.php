<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CmsPost;
use App\Models\CmsPostCategory;

class PublicNewsController extends Controller
{
    public function index()
    {
        $posts = CmsPost::with('category')
            ->where('is_active', true)
            ->where('status', 'published')
            ->orderBy('publish_date', 'desc')
            ->paginate(9);

        return view('public.berita.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = CmsPost::with(['category', 'author'])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->where('status', 'published')
            ->firstOrFail();

        // Increment view count
        $post->increment('views_count');

        return view('public.berita.detail', compact('post'));
    }

    public function categories()
    {
        $categories = CmsPostCategory::withCount(['posts' => function($q) {
            $q->where('is_active', true)->where('status', 'published');
        }])->get();

        return view('public.berita.kategori', compact('categories'));
    }

    public function category($slug)
    {
        $category = CmsPostCategory::where('slug', $slug)->firstOrFail();
        
        $posts = CmsPost::with('category')
            ->where('category_id', $category->id)
            ->where('is_active', true)
            ->where('status', 'published')
            ->orderBy('publish_date', 'desc')
            ->paginate(9);

        return view('public.berita.index', compact('posts', 'category'));
    }

    public function search(Request $request)
    {
        $q = $request->input('q');
        $posts = collect();

        if ($q) {
            $posts = CmsPost::with('category')
                ->where('is_active', true)
                ->where('status', 'published')
                ->where(function($query) use ($q) {
                    $query->where('title', 'like', "%{$q}%")
                          ->orWhere('excerpt', 'like', "%{$q}%")
                          ->orWhere('body', 'like', "%{$q}%");
                })
                ->orderBy('publish_date', 'desc')
                ->get();
        }

        return view('public.berita.search', compact('posts', 'q'));
    }
}
