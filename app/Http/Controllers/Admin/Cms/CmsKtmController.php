<?php

namespace App\Http\Controllers\Admin\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CmsSetting;
use Illuminate\Support\Facades\Storage;

class CmsKtmController extends Controller
{
    public function index()
    {
        $ktmSd = CmsSetting::where('key', 'ktm_template_sd')->first();
        $ktmSmp = CmsSetting::where('key', 'ktm_template_smp')->first();

        return view('admin.cms.ktm.index', compact('ktmSd', 'ktmSmp'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'unit' => 'required|in:sd,smp',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ], [
            'image.required' => 'Pilih file gambar template KTM.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar harus png, jpg, atau jpeg.',
            'image.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        $unit = $request->unit;
        $key = 'ktm_template_' . $unit;

        $setting = CmsSetting::firstOrCreate(
            ['key' => $key],
            ['type' => 'image', 'value' => null]
        );

        if ($request->hasFile('image')) {
            // Delete old custom image if exists
            if ($setting->value && !str_starts_with($setting->value, 'http') && Storage::disk('public')->exists($setting->value)) {
                Storage::disk('public')->delete($setting->value);
            }

            $path = $request->file('image')->store('cms/ktm', 'public');
            $setting->value = $path;
            $setting->save();
        }

        return redirect()->back()->with('success', 'Template KTM Unit ' . strtoupper($unit) . ' berhasil diperbarui.');
    }

    public function reset(Request $request)
    {
        $request->validate([
            'unit' => 'required|in:sd,smp',
        ]);

        $unit = $request->unit;
        $key = 'ktm_template_' . $unit;

        $setting = CmsSetting::where('key', $key)->first();
        if ($setting) {
            if ($setting->value && !str_starts_with($setting->value, 'http') && Storage::disk('public')->exists($setting->value)) {
                Storage::disk('public')->delete($setting->value);
            }
            $setting->delete();
        }

        return redirect()->back()->with('success', 'Template KTM Unit ' . strtoupper($unit) . ' di-reset ke versi default.');
    }
}
