<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $student = Student::where('user_id', auth()->id())
            ->with(['class.academicYear'])
            ->firstOrFail();

        return view('student.profil', compact('student'));
    }

    public function update(Request $request)
    {
        $student = Student::where('user_id', auth()->id())->firstOrFail();

        $request->validate([
            'phone' => 'nullable|string|max:20',
            'address_domicile' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['phone', 'address_domicile']);

        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($student->photo && Storage::exists('public/photos/' . $student->photo)) {
                Storage::delete('public/photos/' . $student->photo);
            }

            $fileName = time() . '_' . $student->nis . '.' . $request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->storeAs('public/photos', $fileName);
            $data['photo'] = $fileName;
        }

        $student->update($data);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }
}
