<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\SchoolClass;
use App\Models\TeachingAssignment;
use App\Models\AcademicYear;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profil()
    {
        $teacher = Teacher::with(['user', 'position'])->where('user_id', auth()->id())->firstOrFail();
        $activeYear = AcademicYear::where('status', 'active')->first();

        // Cari tahu apakah guru ini wali kelas
        $homeroomClass = null;
        if ($teacher->position && stripos($teacher->position->name, 'Wali') !== false) {
            $homeroomClass = SchoolClass::where('homeroom_teacher_id', $teacher->id)->first();
        }

        // Cari tahu mata pelajaran apa saja yang diampu guru ini
        $assignments = TeachingAssignment::where('teacher_id', $teacher->id)
            ->where('academic_year_id', $activeYear?->id)
            ->with('subject')
            ->get();
        $subjects = $assignments->pluck('subject')->unique('id');

        return view('teacher.profil', compact('teacher', 'homeroomClass', 'subjects'));
    }

    public function updateProfile(Request $request)
    {
        $teacher = Teacher::where('user_id', auth()->id())->firstOrFail();

        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'last_education' => 'nullable|string|max:100',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'photo.mimes' => 'Foto harus berformat jpeg, png, atau jpg',
            'photo.image' => 'File yang diunggah harus berupa gambar',
            'photo.max' => 'Ukuran foto maksimal 2MB',
            'photo.uploaded' => 'Gagal mengunggah foto. Pastikan ukuran file tidak melebihi batas (maks 2MB).',
            'full_name.required' => 'Nama lengkap wajib diisi',
        ]);

        if ($request->hasFile('photo')) {
            if ($teacher->photo && $teacher->photo !== 'default.png' && $teacher->photo !== 'default.jpg' && $teacher->photo !== 'default_user.png') {
                if (\Illuminate\Support\Facades\Storage::disk('public')->exists('photos/' . $teacher->photo)) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete('photos/' . $teacher->photo);
                }
            }

            $photo = $request->file('photo');
            $filename = time() . '_' . $photo->getClientOriginalName();
            $photo->storeAs('photos', $filename, 'public');
            $teacher->photo = $filename;
        }

        $teacher->full_name = $request->full_name;
        $teacher->phone = $request->phone;
        $teacher->last_education = $request->last_education;
        $teacher->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }
}
