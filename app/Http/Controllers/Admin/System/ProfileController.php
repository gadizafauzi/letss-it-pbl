<?php

namespace App\Http\Controllers\Admin\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Http\Requests\Admin\System\UpdateProfileRequest;
use App\Http\Requests\Admin\System\UpdatePasswordRequest;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('admin.system.profile.index', compact('user'));
    }

    public function update(UpdateProfileRequest $request)
    {
        $user = auth()->user();

        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.profile.index')->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        auth()->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.profile.index')->with('success', 'Password berhasil diubah.');
    }
}
