<?php

namespace App\Http\Controllers\Admin\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CmsHeroSection;
use App\Models\CmsVisi;
use App\Models\CmsMisiItem;
use App\Models\CmsSejarahItem;
use App\Models\CmsSetting;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\Cms\UpdateProfilHeroRequest;
use App\Http\Requests\Admin\Cms\UpdateProfilVisiRequest;
use App\Http\Requests\Admin\Cms\StoreProfilMisiRequest;
use App\Http\Requests\Admin\Cms\UpdateProfilMisiRequest;
use App\Http\Requests\Admin\Cms\StoreProfilSejarahRequest;
use App\Http\Requests\Admin\Cms\UpdateProfilSejarahRequest;
use App\Http\Requests\Admin\Cms\UpdateProfilStrukturRequest;

class CmsProfilController extends Controller
{
    public function index()
    {
        $hero = CmsHeroSection::firstOrCreate(
            ['page' => 'profil'],
            ['title' => 'Profil Sekolah', 'is_active' => true]
        );
        
        $visi = CmsVisi::firstOrCreate(
            [],
            ['text' => 'Teks visi sekolah...', 'is_active' => true]
        );
        
        $misi = CmsMisiItem::orderBy('order')->get();
        $sejarah = CmsSejarahItem::orderBy('year', 'asc')->orderBy('order', 'asc')->get();
        
        $struktur = CmsSetting::firstOrCreate(
            ['key' => 'struktur_organisasi_image'],
            ['value' => null, 'type' => 'image']
        );

        return view('admin.cms.profil.index', compact(
            'hero', 'visi', 'misi', 'sejarah', 'struktur'
        ));
    }

    public function updateHero(UpdateProfilHeroRequest $request, $id)
    {
        $hero = CmsHeroSection::findOrFail($id);
        $data = $request->except('image');
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            if ($hero->image && !str_starts_with($hero->image, 'http')) {
                Storage::disk('public')->delete($hero->image);
            }
            $data['image'] = $request->file('image')->store('cms/hero', 'public');
        }

        $hero->update($data);

        return redirect()->back()->with('success', 'Hero Section Profil berhasil diperbarui.');
    }

    public function updateVisi(UpdateProfilVisiRequest $request)
    {
        $visi = CmsVisi::first();
        if(!$visi) {
            $visi = new CmsVisi();
        }
        
        $visi->text = $request->text;
        $visi->is_active = $request->has('is_active');
        $visi->save();

        return redirect()->back()->with('success', 'Visi Sekolah berhasil diperbarui.');
    }

    public function storeMisi(StoreProfilMisiRequest $request)
    {
        $data = $request->all();
        $data['is_active'] = $request->has('is_active');
        
        CmsMisiItem::create($data);

        return redirect()->back()->with('success', 'Misi berhasil ditambahkan.');
    }

    public function updateMisi(UpdateProfilMisiRequest $request, $id)
    {
        $misi = CmsMisiItem::findOrFail($id);
        $data = $request->all();
        $data['is_active'] = $request->has('is_active');
        
        $misi->update($data);

        return redirect()->back()->with('success', 'Misi berhasil diperbarui.');
    }

    public function destroyMisi($id)
    {
        $misi = CmsMisiItem::findOrFail($id);
        $misi->delete();

        return redirect()->back()->with('success', 'Misi berhasil dihapus.');
    }

    public function storeSejarah(StoreProfilSejarahRequest $request)
    {
        $data = $request->all();
        $data['is_active'] = $request->has('is_active');
        
        CmsSejarahItem::create($data);

        return redirect()->back()->with('success', 'Sejarah berhasil ditambahkan.');
    }

    public function updateSejarah(UpdateProfilSejarahRequest $request, $id)
    {
        $sejarah = CmsSejarahItem::findOrFail($id);
        $data = $request->all();
        $data['is_active'] = $request->has('is_active');
        
        $sejarah->update($data);

        return redirect()->back()->with('success', 'Sejarah berhasil diperbarui.');
    }

    public function destroySejarah($id)
    {
        $sejarah = CmsSejarahItem::findOrFail($id);
        $sejarah->delete();

        return redirect()->back()->with('success', 'Sejarah berhasil dihapus.');
    }

    public function updateStrukturOrganisasi(UpdateProfilStrukturRequest $request)
    {
        $setting = CmsSetting::where('key', 'struktur_organisasi_image')->first();
        if (!$setting) {
            $setting = new CmsSetting();
            $setting->key = 'struktur_organisasi_image';
            $setting->type = 'image';
        }

        if ($request->hasFile('image')) {
            if ($setting->value && !str_starts_with($setting->value, 'http')) {
                Storage::disk('public')->delete($setting->value);
            }
            $setting->value = $request->file('image')->store('cms/struktur', 'public');
            $setting->save();
        }

        return redirect()->back()->with('success', 'Gambar Struktur Organisasi berhasil diperbarui.');
    }
}
