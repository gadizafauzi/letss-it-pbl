<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CmsHeroSection;
use App\Models\CmsPpdbTimeline;
use App\Models\CmsPpdbStep;
use App\Models\CmsPpdbBrochure;
use App\Models\CmsFaq;
use App\Models\CmsSetting;
use Illuminate\Support\Facades\Storage;

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

    public function updateHero(Request $request, $id)
    {
        $request->validate([
            'title'                 => 'required|string|max:255',
            'subtitle'              => 'nullable|string',
            'badge_text'            => 'nullable|string|max:255',
            'button_text'           => 'nullable|string|max:100',
            'button_link'           => 'nullable|string|max:255',
            'button_secondary_text' => 'nullable|string|max:100',
            'button_secondary_link' => 'nullable|string|max:255',
            'image'                 => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_active'             => 'boolean',
        ]);

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

    public function storeTimeline(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_range'  => 'required|string|max:255',
            'status'      => 'required|in:Dibuka,Segera,Menunggu,Selesai',
            'order'       => 'required|integer|min:1',
            'is_active'   => 'boolean',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        CmsPpdbTimeline::create($data);

        return redirect()->back()->with('success', 'Item timeline berhasil ditambahkan.');
    }

    public function updateTimeline(Request $request, $id)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_range'  => 'required|string|max:255',
            'status'      => 'required|in:Dibuka,Segera,Menunggu,Selesai',
            'order'       => 'required|integer|min:1',
            'is_active'   => 'boolean',
        ]);

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

    public function storeStep(Request $request)
    {
        $request->validate([
            'step_number' => 'required|integer|min:1',
            'icon'        => 'nullable|string|max:100',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'order'       => 'required|integer|min:1',
            'is_active'   => 'boolean',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        CmsPpdbStep::create($data);

        return redirect()->back()->with('success', 'Langkah alur berhasil ditambahkan.');
    }

    public function updateStep(Request $request, $id)
    {
        $request->validate([
            'step_number' => 'required|integer|min:1',
            'icon'        => 'nullable|string|max:100',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'order'       => 'required|integer|min:1',
            'is_active'   => 'boolean',
        ]);

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

    public function storeBrochure(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'file_path'   => 'required|file|mimes:pdf,jpeg,jpg,png,webp|max:5120',
            'order'       => 'required|integer|min:1',
            'is_active'   => 'boolean',
        ]);

        $data = $request->except('file_path');
        $data['is_active'] = $request->has('is_active');
        $data['file_path'] = $request->file('file_path')->store('cms/ppdb/brosur', 'public');

        CmsPpdbBrochure::create($data);

        return redirect()->back()->with('success', 'Brosur berhasil diunggah.');
    }

    public function updateBrochure(Request $request, $id)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'file_path'   => 'nullable|file|mimes:pdf,jpeg,jpg,png,webp|max:5120',
            'order'       => 'required|integer|min:1',
            'is_active'   => 'boolean',
        ]);

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

    public function storeFaq(Request $request)
    {
        $request->validate([
            'question'  => 'required|string',
            'answer'    => 'required|string',
            'order'     => 'required|integer|min:1',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();
        $data['page']      = 'ppdb';
        $data['is_active'] = $request->has('is_active');

        CmsFaq::create($data);

        return redirect()->back()->with('success', 'FAQ PPDB berhasil ditambahkan.');
    }

    public function updateFaq(Request $request, $id)
    {
        $request->validate([
            'question'  => 'required|string',
            'answer'    => 'required|string',
            'order'     => 'required|integer|min:1',
            'is_active' => 'boolean',
        ]);

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
