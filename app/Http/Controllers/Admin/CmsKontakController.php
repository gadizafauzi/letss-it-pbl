<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CmsSetting;

class CmsKontakController extends Controller
{
    public function index()
    {
        $settings = CmsSetting::pluck('value', 'key')->all();
        return view('admin.cms.kontak.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'address'            => 'nullable|string',
            'phone'              => 'nullable|string|max:30',
            'whatsapp_number'    => 'nullable|string|max:30',
            'email'              => 'nullable|email|max:100',
            'operational_hours'  => 'nullable|string',
            'maps_embed'         => 'nullable|string',
        ]);

        $keys = ['address', 'phone', 'whatsapp_number', 'email', 'operational_hours', 'maps_embed'];

        foreach ($keys as $key) {
            CmsSetting::updateOrCreate(
                ['key'  => $key],
                ['value' => $request->input($key, ''), 'type' => 'text']
            );
        }

        return redirect()->back()->with('success', 'Informasi kontak berhasil diperbarui.');
    }
}
