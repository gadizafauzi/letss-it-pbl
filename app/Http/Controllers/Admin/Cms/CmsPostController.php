<?php

namespace App\Http\Controllers\Admin\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CmsPost;
use App\Models\CmsPostCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\Cms\StorePostRequest;
use App\Http\Requests\Admin\Cms\UpdatePostRequest;

class CmsPostController extends Controller
{
    public function index(Request $request)
    {
        $query = CmsPost::with(['category', 'author'])
            ->orderBy('publish_date', 'desc');

        if ($request->filled('search')) {
            $q = $request->search;
            $query->where(function ($q2) use ($q) {
                $q2->where('title', 'like', "%{$q}%")
                   ->orWhere('excerpt', 'like', "%{$q}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $posts      = $query->paginate($request->get('per_page', 15))->withQueryString();
        $categories = CmsPostCategory::orderBy('name')->get();

        return view('admin.cms.berita.posts.index', compact('posts', 'categories'));
    }

    public function create()
    {
        $categories = CmsPostCategory::orderBy('name')->get();
        return view('admin.cms.berita.posts.create', compact('categories'));
    }

    public function store(StorePostRequest $request)
    {

        $data = $request->except('featured_image');
        $data['author_id']  = auth()->id();
        $data['is_active']  = $request->has('is_active');
        $data['views_count']= 0;

        // Slug
        $data['slug'] = $request->filled('slug')
            ? Str::slug($request->slug)
            : Str::slug($request->title);

        $base = $data['slug'];
        $i    = 1;
        while (CmsPost::where('slug', $data['slug'])->exists()) {
            $data['slug'] = $base . '-' . $i++;
        }

        // Featured Image
        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')
                ->store('cms/berita', 'public');
        }

        CmsPost::create($data);

        return redirect()
            ->route('admin.berita.posts.index')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $post       = CmsPost::findOrFail($id);
        $categories = CmsPostCategory::orderBy('name')->get();
        return view('admin.cms.berita.posts.edit', compact('post', 'categories'));
    }

    public function update(UpdatePostRequest $request, $id)
    {
        $post = CmsPost::findOrFail($id);

        $data = $request->except('featured_image');
        $data['is_active'] = $request->has('is_active');

        // Slug
        $data['slug'] = $request->filled('slug')
            ? Str::slug($request->slug)
            : Str::slug($request->title);

        // Featured Image
        if ($request->hasFile('featured_image')) {
            if ($post->featured_image && !str_starts_with($post->featured_image, 'http')) {
                Storage::disk('public')->delete($post->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')
                ->store('cms/berita', 'public');
        }

        $post->update($data);

        return redirect()
            ->route('admin.berita.posts.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $post = CmsPost::findOrFail($id);

        if ($post->featured_image && !str_starts_with($post->featured_image, 'http')) {
            Storage::disk('public')->delete($post->featured_image);
        }

        $post->delete();

        return redirect()->back()->with('success', 'Berita berhasil dihapus.');
    }

    public function preview($id)
    {
        $post = CmsPost::findOrFail($id);
        return redirect()->route('public.berita.detail', $post->slug);
    }
}
