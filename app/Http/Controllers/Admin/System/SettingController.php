<?php

namespace App\Http\Controllers\Admin\System;

use App\Http\Controllers\Controller;
use App\Models\SystemSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Show the settings form.
     */
    public function edit()
    {
        $tokenSetting = SystemSetting::where('key', 'fonnte_api_token')->first();
        $token = $tokenSetting ? $tokenSetting->value : '';
        return view('admin.system.settings', compact('token'));
    }

    /**
     * Update the Fonnte API token.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'fonnte_api_token' => 'required|string',
        ]);

        SystemSetting::updateOrCreate(
            ['key' => 'fonnte_api_token'],
            ['value' => $validated['fonnte_api_token']]
        );

        return back()->with('success', 'Token Fonnte berhasil disimpan.');
    }
}
?>
