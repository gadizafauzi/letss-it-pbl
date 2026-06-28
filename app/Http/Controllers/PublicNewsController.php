<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CmsPost;
use App\Models\CmsPostCategory;

class PublicNewsController extends Controller
{
    public function index(Request $request)
    {
        $categorySlug = $request->query('category');
        $search = $request->query('q');
        $sort = $request->query('sort', 'newest');
        $category = null;

        $query = CmsPost::with(['category', 'author'])
            ->where('is_active', true)
            ->where('status', 'published');

        if ($categorySlug) {
            $category = CmsPostCategory::where('slug', $categorySlug)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%")
                    ->orWhere('body', 'like', "%{$search}%")
                    ->orWhereHas('category', function ($catQuery) use ($search) {
                        $catQuery->where('name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('author', function ($authorQuery) use ($search) {
                        $authorQuery->where('name', 'like', "%{$search}%");
                    });
            });
        }

        // Sorting options
        switch ($sort) {
            case 'oldest':
                $query->orderBy('publish_date', 'asc');
                break;
            case 'most_viewed':
                $query->orderBy('views_count', 'desc');
                break;
            case 'newest_added':
                $query->orderBy('created_at', 'desc');
                break;
            case 'newest':
            default:
                $query->orderBy('publish_date', 'desc');
                break;
        }

        $posts = $query->paginate(9)->withQueryString();
        $categories = CmsPostCategory::all();

        // Pass additional variables for filter, search and sort
        return view('public.berita.index', compact('posts', 'categories', 'category', 'search', 'sort'));
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

        // Fetch 3 related posts from the same category, excluding current post
        $relatedPosts = CmsPost::with('category')
            ->where('is_active', true)
            ->where('status', 'published')
            ->where('id', '!=', $post->id)
            ->where('category_id', $post->category_id)
            ->latest('publish_date')
            ->take(3)
            ->get();

        // If not enough related posts in the same category, fill with latest posts
        if ($relatedPosts->count() < 3) {
            $extraPosts = CmsPost::with('category')
                ->where('is_active', true)
                ->where('status', 'published')
                ->where('id', '!=', $post->id)
                ->whereNotIn('id', $relatedPosts->pluck('id'))
                ->latest('publish_date')
                ->take(3 - $relatedPosts->count())
                ->get();
            $relatedPosts = $relatedPosts->concat($extraPosts);
        }

        return view('public.berita.detail', compact('post', 'relatedPosts'));
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
