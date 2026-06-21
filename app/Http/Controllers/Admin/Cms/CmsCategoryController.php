<?php

namespace App\Http\Controllers\Admin\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CmsPostCategory;
use Illuminate\Support\Str;
use App\Http\Requests\Admin\Cms\StoreCategoryRequest;
use App\Http\Requests\Admin\Cms\UpdateCategoryRequest;

class CmsCategoryController extends Controller
{
    public function index()
    {
        $categories = CmsPostCategory::withCount('posts')->orderBy('name')->get();
        return view('admin.cms.berita.kategori.index', compact('categories'));
    }

    public function store(StoreCategoryRequest $request)
    {

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

    public function update(UpdateCategoryRequest $request, $id)
    {
        $category = CmsPostCategory::findOrFail($id);

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
