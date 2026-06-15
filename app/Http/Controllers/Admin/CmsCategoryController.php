<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CmsPostCategory;
use Illuminate\Support\Str;

class CmsCategoryController extends Controller
{
    public function index()
    {
        $categories = CmsPostCategory::withCount('posts')->orderBy('name')->get();
        return view('admin.cms.berita.kategori.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:100',
            'slug'  => 'nullable|string|max:120|unique:cms_post_categories,slug',
            'icon'  => 'nullable|string|max:50',
            'color' => 'nullable|string|max:30',
        ]);

        $data = $request->only(['name', 'icon', 'color']);
        $data['slug'] = $request->filled('slug')
            ? Str::slug($request->slug)
            : Str::slug($request->name);

        // Pastikan slug unik
        $base = $data['slug'];
        $i    = 1;
        while (CmsPostCategory::where('slug', $data['slug'])->exists()) {
            $data['slug'] = $base . '-' . $i++;
        }

        CmsPostCategory::create($data);

        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $category = CmsPostCategory::findOrFail($id);

        $request->validate([
            'name'  => 'required|string|max:100',
            'slug'  => 'nullable|string|max:120|unique:cms_post_categories,slug,' . $id,
            'icon'  => 'nullable|string|max:50',
            'color' => 'nullable|string|max:30',
        ]);

        $data = $request->only(['name', 'icon', 'color']);
        $data['slug'] = $request->filled('slug')
            ? Str::slug($request->slug)
            : Str::slug($request->name);

        $category->update($data);

        return redirect()->back()->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $category = CmsPostCategory::findOrFail($id);

        if ($category->posts()->count() > 0) {
            return redirect()->back()->with('error', 'Kategori tidak dapat dihapus karena masih memiliki berita.');
        }

        $category->delete();

        return redirect()->back()->with('success', 'Kategori berhasil dihapus.');
    }
}
