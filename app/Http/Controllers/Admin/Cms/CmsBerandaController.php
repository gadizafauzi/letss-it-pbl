<?php

namespace App\Http\Controllers\Admin\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CmsHeroSection;
use App\Models\CmsWelcomeMessage;
use App\Models\CmsStatistic;
use App\Models\CmsProgram;
use App\Models\CmsTujuanPendidikan;
use App\Models\CmsTestimonial;
use App\Models\CmsFaq;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\Cms\UpdateCmsHeroRequest;
use App\Http\Requests\Admin\Cms\UpdateCmsWelcomeRequest;
use App\Http\Requests\Admin\Cms\StoreCmsStatisticRequest;
use App\Http\Requests\Admin\Cms\UpdateCmsStatisticRequest;
use App\Http\Requests\Admin\Cms\StoreCmsProgramRequest;
use App\Http\Requests\Admin\Cms\UpdateCmsProgramRequest;
use App\Http\Requests\Admin\Cms\StoreCmsTujuanPendidikanRequest;
use App\Http\Requests\Admin\Cms\UpdateCmsTujuanPendidikanRequest;
use App\Http\Requests\Admin\Cms\StoreCmsTestimoniRequest;
use App\Http\Requests\Admin\Cms\UpdateCmsTestimoniRequest;
use App\Http\Requests\Admin\Cms\StoreCmsFaqRequest;
use App\Http\Requests\Admin\Cms\UpdateCmsFaqRequest;

class CmsBerandaController extends Controller
{
    public function index()
    {
        $hero = CmsHeroSection::firstOrCreate(
            ['page' => 'home'],
            ['title' => 'Judul Hero', 'is_active' => true]
        );
        
        $welcome = CmsWelcomeMessage::firstOrCreate(
            [],
            [
                'title' => 'Judul Sambutan',
                'greeting' => 'Assalamu\'alaikum',
                'paragraphs' => ['Isi sambutan'],
                'kepsek_name' => 'Nama Kepsek',
                'kepsek_title' => 'Jabatan',
                'is_active' => true
            ]
        );
        
        $statistics = CmsStatistic::orderBy('order')->get();
        // Data lain akan di-passing saat diimplementasikan
        $programs = CmsProgram::orderBy('order')->get();
        $tujuanPendidikans = CmsTujuanPendidikan::orderBy('order')->get();
        $testimonials = CmsTestimonial::orderBy('order')->get();
        $faqs = CmsFaq::where('page', 'home')->orderBy('order')->get();

        $jenjang_image = \App\Models\CmsSetting::firstOrCreate(
            ['key' => 'jenjang_pendidikan_image'],
            ['value' => null, 'type' => 'image']
        );

        $statistic_bg_image = \App\Models\CmsSetting::firstOrCreate(
            ['key' => 'statistic_bg_image'],
            ['value' => null, 'type' => 'image']
        );

        return view('admin.cms.beranda.index', compact(
            'hero', 'welcome', 'statistics', 'programs', 'tujuanPendidikans', 'testimonials', 'faqs', 'jenjang_image', 'statistic_bg_image'
        ));
    }

    public function updateHero(UpdateCmsHeroRequest $request, $id)
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

        return redirect()->back()->with('success', 'Hero Section berhasil diperbarui.');
    }

    public function updateWelcome(UpdateCmsWelcomeRequest $request, $id)
    {
        $welcome = CmsWelcomeMessage::findOrFail($id);
        $data = $request->except('kepsek_photo', 'paragraphs');
        $data['is_active'] = $request->has('is_active');
        
        // Ubah isi textarea yang dipisahkan enter menjadi array JSON
        $paragraphsArray = array_filter(array_map('trim', explode("\n", $request->paragraphs)));
        $data['paragraphs'] = $paragraphsArray;

        if ($request->hasFile('kepsek_photo')) {
            if ($welcome->kepsek_photo && !str_starts_with($welcome->kepsek_photo, 'http')) {
                Storage::disk('public')->delete($welcome->kepsek_photo);
            }
            $data['kepsek_photo'] = $request->file('kepsek_photo')->store('cms/welcome', 'public');
        }

        $welcome->update($data);

        return redirect()->back()->with('success', 'Welcome Message berhasil diperbarui.');
    }

    public function storeStatistic(StoreCmsStatisticRequest $request)
    {
        $data = $request->all();
        $data['is_active'] = $request->has('is_active');
        
        CmsStatistic::create($data);

        return redirect()->back()->with('success', 'Statistik berhasil ditambahkan.');
    }

    public function updateStatistic(UpdateCmsStatisticRequest $request, $id)
    {
        $statistic = CmsStatistic::findOrFail($id);
        $data = $request->all();
        $data['is_active'] = $request->has('is_active');
        
        $statistic->update($data);

        return redirect()->back()->with('success', 'Statistik berhasil diperbarui.');
    }

    public function destroyStatistic($id)
    {
        $statistic = CmsStatistic::findOrFail($id);
        $statistic->delete();

        return redirect()->back()->with('success', 'Statistik berhasil dihapus.');
    }

    public function updateStatisticBg(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $setting = \App\Models\CmsSetting::where('key', 'statistic_bg_image')->first();
        if (!$setting) {
            $setting = new \App\Models\CmsSetting();
            $setting->key = 'statistic_bg_image';
            $setting->type = 'image';
        }

        if ($request->hasFile('image')) {
            if ($setting->value && !str_starts_with($setting->value, 'http')) {
                Storage::disk('public')->delete($setting->value);
            }
            $setting->value = $request->file('image')->store('cms/beranda', 'public');
            $setting->save();
        }

        return redirect()->back()->with('success', 'Gambar Latar Statistik berhasil diperbarui.');
    }

    public function storeProgram(StoreCmsProgramRequest $request)
    {
        $data = $request->all();
        $data['is_active'] = $request->has('is_active');
        
        CmsProgram::create($data);

        return redirect()->back()->with('success', 'Program berhasil ditambahkan.');
    }

    public function updateProgram(UpdateCmsProgramRequest $request, $id)
    {
        $program = CmsProgram::findOrFail($id);
        $data = $request->all();
        $data['is_active'] = $request->has('is_active');
        
        $program->update($data);

        return redirect()->back()->with('success', 'Program berhasil diperbarui.');
    }

    public function destroyProgram($id)
    {
        $program = CmsProgram::findOrFail($id);
        $program->delete();

        return redirect()->back()->with('success', 'Program berhasil dihapus.');
    }

    public function storeTujuanPendidikan(StoreCmsTujuanPendidikanRequest $request)
    {
        $data = $request->all();
        $data['is_active'] = $request->has('is_active');
        
        CmsTujuanPendidikan::create($data);

        return redirect()->back()->with('success', 'Tujuan Pendidikan berhasil ditambahkan.');
    }

    public function updateTujuanPendidikan(UpdateCmsTujuanPendidikanRequest $request, $id)
    {
        $tujuanPendidikan = CmsTujuanPendidikan::findOrFail($id);
        $data = $request->all();
        $data['is_active'] = $request->has('is_active');
        
        $tujuanPendidikan->update($data);

        return redirect()->back()->with('success', 'Tujuan Pendidikan berhasil diperbarui.');
    }

    public function destroyTujuanPendidikan($id)
    {
        $tujuanPendidikan = CmsTujuanPendidikan::findOrFail($id);
        $tujuanPendidikan->delete();

        return redirect()->back()->with('success', 'Tujuan Pendidikan berhasil dihapus.');
    }
    public function storeTestimoni(StoreCmsTestimoniRequest $request)
    {
        $data = $request->except('avatar');
        $data['is_active'] = $request->has('is_active');
        
        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('cms/testimoni', 'public');
        }

        CmsTestimonial::create($data);

        return redirect()->back()->with('success', 'Testimoni berhasil ditambahkan.');
    }

    public function updateTestimoni(UpdateCmsTestimoniRequest $request, $id)
    {
        $testimoni = CmsTestimonial::findOrFail($id);
        $data = $request->except('avatar');
        $data['is_active'] = $request->has('is_active');
        
        if ($request->hasFile('avatar')) {
            if ($testimoni->avatar && !str_starts_with($testimoni->avatar, 'http')) {
                Storage::disk('public')->delete($testimoni->avatar);
            }
            $data['avatar'] = $request->file('avatar')->store('cms/testimoni', 'public');
        }

        $testimoni->update($data);

        return redirect()->back()->with('success', 'Testimoni berhasil diperbarui.');
    }

    public function destroyTestimoni($id)
    {
        $testimoni = CmsTestimonial::findOrFail($id);
        if ($testimoni->avatar && !str_starts_with($testimoni->avatar, 'http')) {
            Storage::disk('public')->delete($testimoni->avatar);
        }
        $testimoni->delete();

        return redirect()->back()->with('success', 'Testimoni berhasil dihapus.');
    }

    public function storeFaq(StoreCmsFaqRequest $request)
    {
        $data = $request->all();
        $data['page'] = 'home';
        $data['is_active'] = $request->has('is_active');
        
        CmsFaq::create($data);

        return redirect()->back()->with('success', 'FAQ berhasil ditambahkan.');
    }

    public function updateFaq(UpdateCmsFaqRequest $request, $id)
    {
        $faq = CmsFaq::findOrFail($id);
        $data = $request->all();
        $data['is_active'] = $request->has('is_active');
        
        $faq->update($data);

        return redirect()->back()->with('success', 'FAQ berhasil diperbarui.');
    }

    public function destroyFaq($id)
    {
        $faq = CmsFaq::findOrFail($id);
        $faq->delete();

        return redirect()->back()->with('success', 'FAQ berhasil dihapus.');
    }

    public function updateJenjangImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $setting = \App\Models\CmsSetting::where('key', 'jenjang_pendidikan_image')->first();
        if (!$setting) {
            $setting = new \App\Models\CmsSetting();
            $setting->key = 'jenjang_pendidikan_image';
            $setting->type = 'image';
        }

        if ($request->hasFile('image')) {
            if ($setting->value && !str_starts_with($setting->value, 'http')) {
                Storage::disk('public')->delete($setting->value);
            }
            $setting->value = $request->file('image')->store('cms/beranda', 'public');
            $setting->save();
        }

        return redirect()->back()->with('success', 'Gambar Jenjang Pendidikan berhasil diperbarui.');
    }
}
