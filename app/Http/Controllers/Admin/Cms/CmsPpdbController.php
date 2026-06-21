<?php

namespace App\Http\Controllers\Admin\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CmsHeroSection;
use App\Models\CmsPpdbTimeline;
use App\Models\CmsPpdbStep;
use App\Models\CmsPpdbBrochure;
use App\Models\CmsFaq;
use App\Models\CmsSetting;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\Cms\UpdatePpdbHeroRequest;
use App\Http\Requests\Admin\Cms\StorePpdbTimelineRequest;
use App\Http\Requests\Admin\Cms\UpdatePpdbTimelineRequest;
use App\Http\Requests\Admin\Cms\StorePpdbStepRequest;
use App\Http\Requests\Admin\Cms\UpdatePpdbStepRequest;
use App\Http\Requests\Admin\Cms\StorePpdbBrochureRequest;
use App\Http\Requests\Admin\Cms\UpdatePpdbBrochureRequest;
use App\Http\Requests\Admin\Cms\StorePpdbFaqRequest;
use App\Http\Requests\Admin\Cms\UpdatePpdbFaqRequest;

class CmsPpdbController extends Controller
{
    public function index()
    {
        $hero = CmsHeroSection::firstOrCreate(
            ['page' => 'ppdb'],
            [
                'title'                  => 'Penerimaan Peserta Didik Baru',
                'subtitle'               => "Bergabunglah bersama SIT Mutiara Qur'an untuk masa depan putra-putri Anda yang lebih baik.",
                'badge_text'             => 'Pendaftaran Dibuka',
                'button_text'            => 'Lihat Informasi PPDB',
                'button_link'            => '#informasi',
                'button_secondary_text'  => 'Download Brosur',
                'button_secondary_link'  => '#brosur',
                'is_active'              => true,
            ]
        );

        $timelines  = CmsPpdbTimeline::orderBy('order')->get();
        $steps      = CmsPpdbStep::orderBy('order')->get();
        $brochures  = CmsPpdbBrochure::orderBy('order')->get();
        $faqs       = CmsFaq::where('page', 'ppdb')->orderBy('order')->get();
        $settings   = CmsSetting::pluck('value', 'key')->all();

        return view('admin.cms.ppdb.index', compact(
            'hero', 'timelines', 'steps', 'brochures', 'faqs', 'settings'
        ));
    }

    // ─── HERO ────────────────────────────────────────────────────────────────

    public function updateHero(UpdatePpdbHeroRequest $request, $id)
    {
        $hero = CmsHeroSection::findOrFail($id);
        $data = $request->except('image');
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            if ($hero->image && !str_starts_with($hero->image, 'http')) {
                Storage::disk('public')->delete($hero->image);
            }
            $data['image'] = $request->file('image')->store('cms/ppdb/hero', 'public');
        }

        $hero->update($data);

        return redirect()->back()->with('success', 'Hero PPDB berhasil diperbarui.');
    }

    // ─── TIMELINE ────────────────────────────────────────────────────────────

    public function storeTimeline(StorePpdbTimelineRequest $request)
    {
        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        CmsPpdbTimeline::create($data);

        return redirect()->back()->with('success', 'Item timeline berhasil ditambahkan.');
    }

    public function updateTimeline(UpdatePpdbTimelineRequest $request, $id)
    {
        $timeline = CmsPpdbTimeline::findOrFail($id);
        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        $timeline->update($data);

        return redirect()->back()->with('success', 'Item timeline berhasil diperbarui.');
    }

    public function destroyTimeline($id)
    {
        CmsPpdbTimeline::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Item timeline berhasil dihapus.');
    }

    // ─── ALUR / STEP ─────────────────────────────────────────────────────────

    public function storeStep(StorePpdbStepRequest $request)
    {
        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        CmsPpdbStep::create($data);

        return redirect()->back()->with('success', 'Langkah alur berhasil ditambahkan.');
    }

    public function updateStep(UpdatePpdbStepRequest $request, $id)
    {
        $step = CmsPpdbStep::findOrFail($id);
        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        $step->update($data);

        return redirect()->back()->with('success', 'Langkah alur berhasil diperbarui.');
    }

    public function destroyStep($id)
    {
        CmsPpdbStep::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Langkah alur berhasil dihapus.');
    }

    // ─── BROSUR ──────────────────────────────────────────────────────────────

    public function storeBrochure(StorePpdbBrochureRequest $request)
    {
        $data = $request->except('file_path');
        $data['is_active'] = $request->has('is_active');
        $data['file_path'] = $request->file('file_path')->store('cms/ppdb/brosur', 'public');

        CmsPpdbBrochure::create($data);

        return redirect()->back()->with('success', 'Brosur berhasil diunggah.');
    }

    public function updateBrochure(UpdatePpdbBrochureRequest $request, $id)
    {
        $brochure = CmsPpdbBrochure::findOrFail($id);
        $data = $request->except('file_path');
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('file_path')) {
            if ($brochure->file_path && !str_starts_with($brochure->file_path, 'http')) {
                Storage::disk('public')->delete($brochure->file_path);
            }
            $data['file_path'] = $request->file('file_path')->store('cms/ppdb/brosur', 'public');
        }

        $brochure->update($data);

        return redirect()->back()->with('success', 'Brosur berhasil diperbarui.');
    }

    public function destroyBrochure($id)
    {
        $brochure = CmsPpdbBrochure::findOrFail($id);
        if ($brochure->file_path && !str_starts_with($brochure->file_path, 'http')) {
            Storage::disk('public')->delete($brochure->file_path);
        }
        $brochure->delete();
        return redirect()->back()->with('success', 'Brosur berhasil dihapus.');
    }

    // ─── FAQ PPDB ─────────────────────────────────────────────────────────────

    public function storeFaq(StorePpdbFaqRequest $request)
    {
        $data = $request->all();
        $data['page']      = 'ppdb';
        $data['is_active'] = $request->has('is_active');

        CmsFaq::create($data);

        return redirect()->back()->with('success', 'FAQ PPDB berhasil ditambahkan.');
    }

    public function updateFaq(UpdatePpdbFaqRequest $request, $id)
    {
        $faq = CmsFaq::findOrFail($id);
        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        $faq->update($data);

        return redirect()->back()->with('success', 'FAQ PPDB berhasil diperbarui.');
    }

    public function destroyFaq($id)
    {
        CmsFaq::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'FAQ PPDB berhasil dihapus.');
    }
}
