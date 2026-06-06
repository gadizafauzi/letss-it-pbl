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
            ->with(['currentClass.schoolClass', 'currentClass.academicYear'])
            ->firstOrFail();

        return view('student.profil', compact('student'));
    }

    public function update(Request $request)
    {
        $student = Student::where('user_id', auth()->id())->firstOrFail();

        $request->validate([
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'hobby' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['phone', 'address', 'hobby']);

        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($student->photo && Storage::disk('public')->exists('photos/' . $student->photo)) {
                Storage::disk('public')->delete('photos/' . $student->photo);
            }

            $fileName = time() . '_' . $student->nis . '.' . $request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->storeAs('photos', $fileName, 'public');
            $data['photo'] = $fileName;
        }

        $student->update($data);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }

    public function cetakKtm()
    {
        $student = Student::where('user_id', auth()->id())
            ->with(['currentClass.schoolClass', 'currentClass.academicYear'])
            ->firstOrFail();

        return view('student.cetak-ktm', compact('student'));
    }
}
