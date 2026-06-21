<?php

namespace App\Http\Controllers\Admin\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CmsSetting;
use App\Http\Requests\Admin\Cms\UpdateCmsKontakRequest;

class CmsKontakController extends Controller
{
    public function index()
    {
        $settings = CmsSetting::pluck('value', 'key')->all();
        return view('admin.cms.kontak.index', compact('settings'));
    }

    public function update(UpdateCmsKontakRequest $request)
    {
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
