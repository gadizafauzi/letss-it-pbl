<?php

namespace App\Http\Controllers\Admin\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CmsHeroSection;
use App\Models\CmsWelcomeMessage;
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

        $welcomeMessage = CmsWelcomeMessage::firstOrCreate(
            [],
            [
                'title' => 'Bismillahirrahmanirrahim,',
                'greeting' => 'Assalamu\'alaikum Warahmatullahi Wabarakatuh,',
                'paragraphs' => ['Selamat datang di Yayasan Wakaf Mutiara Qur\'an. Sekolah kami berdedikasi mencetak generasi Qur\'ani yang unggul.'],
                'kepsek_name' => 'Ustadz Ahmad Fauzi, S.Pd.I, M.Pd',
                'kepsek_title' => 'Kepala Sekolah SIT Mutiara Qur\'an',
                'is_active' => true
            ]
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
            'hero', 'welcomeMessage', 'visi', 'misi', 'sejarah', 'struktur'
        ));
    }

    public function updateHero(UpdateProfilHeroRequest $request, $id)
    {
        $hero = CmsHeroSection::findOrFail($id);
        $data = $request->except(['image', 'image_2', 'image_3']);
        $data['is_active'] = $request->has('is_active');

        foreach (['image', 'image_2', 'image_3'] as $imgKey) {
            if ($request->hasFile($imgKey)) {
                if ($hero->$imgKey && !str_starts_with($hero->$imgKey, 'http')) {
                    Storage::disk('public')->delete($hero->$imgKey);
                }
                $data[$imgKey] = $request->file($imgKey)->store('cms/hero', 'public');
            }
        }

        $hero->update($data);

        return redirect()->back()->with('success', 'Hero Section Profil berhasil diperbarui.');
    }

    public function updateProfilSingkat(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'greeting' => 'nullable|string|max:255',
            'paragraphs' => 'required|string',
            'kepsek_name' => 'nullable|string|max:255',
            'kepsek_title' => 'nullable|string|max:255',
            'kepsek_photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $welcome = CmsWelcomeMessage::firstOrCreate([]);
        
        $paragraphsArray = array_values(array_filter(array_map('trim', explode("\n", $request->paragraphs))));

        $data = [
            'title' => $request->title,
            'greeting' => $request->greeting,
            'paragraphs' => $paragraphsArray,
            'kepsek_name' => $request->kepsek_name,
            'kepsek_title' => $request->kepsek_title,
            'is_active' => $request->has('is_active'),
        ];

        if ($request->hasFile('kepsek_photo')) {
            if ($welcome->kepsek_photo && !str_starts_with($welcome->kepsek_photo, 'http')) {
                Storage::disk('public')->delete($welcome->kepsek_photo);
            }
            $data['kepsek_photo'] = $request->file('kepsek_photo')->store('cms/welcome', 'public');
        }

        $welcome->update($data);

        return redirect()->back()->with('success', 'Profil Singkat Sekolah berhasil diperbarui.');
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
