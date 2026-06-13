<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CmsHeroSection;
use App\Models\CmsWelcomeMessage;
use App\Models\CmsStatistic;
use App\Models\CmsProgram;
use App\Models\CmsKeunggulan;
use App\Models\CmsTestimonial;
use App\Models\CmsFaq;
use Illuminate\Support\Facades\Storage;

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
        $keunggulans = CmsKeunggulan::orderBy('order')->get();
        $testimonials = CmsTestimonial::orderBy('order')->get();
        $faqs = CmsFaq::where('page', 'home')->orderBy('order')->get();

        return view('admin.cms.beranda.index', compact(
            'hero', 'welcome', 'statistics', 'programs', 'keunggulans', 'testimonials', 'faqs'
        ));
    }

    public function updateHero(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string',
            'button_text' => 'nullable|string|max:50',
            'button_link' => 'nullable|string|max:255',
            'button_secondary_text' => 'nullable|string|max:50',
            'button_secondary_link' => 'nullable|string|max:255',
            'badge_text' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_active' => 'boolean'
        ]);

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

    public function updateWelcome(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'greeting' => 'nullable|string|max:255',
            'paragraphs' => 'required|string',
            'kepsek_name' => 'nullable|string|max:100',
            'kepsek_title' => 'nullable|string|max:100',
            'kepsek_photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_active' => 'boolean'
        ]);

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

    public function storeStatistic(Request $request)
    {
        $request->validate([
            'number' => 'required|string|max:50',
            'label' => 'required|string|max:100',
            'icon' => 'nullable|string|max:50',
            'order' => 'required|integer',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');
        
        CmsStatistic::create($data);

        return redirect()->back()->with('success', 'Statistik berhasil ditambahkan.');
    }

    public function updateStatistic(Request $request, $id)
    {
        $request->validate([
            'number' => 'required|string|max:50',
            'label' => 'required|string|max:100',
            'icon' => 'nullable|string|max:50',
            'order' => 'required|integer',
            'is_active' => 'boolean'
        ]);

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

    public function storeProgram(Request $request)
    {
        $request->validate([
            'icon' => 'required|string|max:50',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'detail' => 'nullable|string',
            'category' => 'required|in:keislaman,akademik,karakter',
            'order' => 'required|integer',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');
        
        CmsProgram::create($data);

        return redirect()->back()->with('success', 'Program berhasil ditambahkan.');
    }

    public function updateProgram(Request $request, $id)
    {
        $request->validate([
            'icon' => 'required|string|max:50',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'detail' => 'nullable|string',
            'category' => 'required|in:keislaman,akademik,karakter',
            'order' => 'required|integer',
            'is_active' => 'boolean'
        ]);

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

    public function storeKeunggulan(Request $request)
    {
        $request->validate([
            'icon' => 'required|string|max:50',
            'bg_color' => 'required|string|max:50',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'order' => 'required|integer',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');
        
        CmsKeunggulan::create($data);

        return redirect()->back()->with('success', 'Keunggulan berhasil ditambahkan.');
    }

    public function updateKeunggulan(Request $request, $id)
    {
        $request->validate([
            'icon' => 'required|string|max:50',
            'bg_color' => 'required|string|max:50',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'order' => 'required|integer',
            'is_active' => 'boolean'
        ]);

        $keunggulan = CmsKeunggulan::findOrFail($id);
        $data = $request->all();
        $data['is_active'] = $request->has('is_active');
        
        $keunggulan->update($data);

        return redirect()->back()->with('success', 'Keunggulan berhasil diperbarui.');
    }

    public function destroyKeunggulan($id)
    {
        $keunggulan = CmsKeunggulan::findOrFail($id);
        $keunggulan->delete();

        return redirect()->back()->with('success', 'Keunggulan berhasil dihapus.');
    }
    public function storeTestimoni(Request $request)
    {
        $request->validate([
            'quote' => 'required|string',
            'name' => 'required|string|max:100',
            'role' => 'nullable|string|max:100',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'order' => 'required|integer',
            'is_active' => 'boolean'
        ]);

        $data = $request->except('avatar');
        $data['is_active'] = $request->has('is_active');
        
        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('cms/testimoni', 'public');
        }

        CmsTestimonial::create($data);

        return redirect()->back()->with('success', 'Testimoni berhasil ditambahkan.');
    }

    public function updateTestimoni(Request $request, $id)
    {
        $request->validate([
            'quote' => 'required|string',
            'name' => 'required|string|max:100',
            'role' => 'nullable|string|max:100',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'order' => 'required|integer',
            'is_active' => 'boolean'
        ]);

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

    public function storeFaq(Request $request)
    {
        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
            'order' => 'required|integer',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();
        $data['page'] = 'home';
        $data['is_active'] = $request->has('is_active');
        
        CmsFaq::create($data);

        return redirect()->back()->with('success', 'FAQ berhasil ditambahkan.');
    }

    public function updateFaq(Request $request, $id)
    {
        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
            'order' => 'required|integer',
            'is_active' => 'boolean'
        ]);

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
}
