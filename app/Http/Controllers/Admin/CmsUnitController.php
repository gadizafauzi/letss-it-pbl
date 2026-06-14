<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unit;
use App\Models\CmsHeroSection;
use App\Models\CmsUnitDetail;
use App\Models\CmsUnitTeacher;
use App\Models\CmsUnitEkskul;
use App\Models\CmsUnitFacility;
use App\Models\CmsAchievement;
use App\Models\Teacher;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;

class CmsUnitController extends Controller
{
    public function index()
    {
        $units = Unit::all();
        return view('admin.unit-cms.index', compact('units'));
    }

    public function show($id)
    {
        $unit = Unit::findOrFail($id);
        
        // Determine page name for hero section based on unit name
        $pageName = '';
        if (stripos($unit->unit_name, 'tk') !== false) {
            $pageName = 'unit_tk';
        } elseif (stripos($unit->unit_name, 'sd') !== false) {
            $pageName = 'unit_sd';
        } elseif (stripos($unit->unit_name, 'smp') !== false) {
            $pageName = 'unit_smp';
        }

        $hero = CmsHeroSection::firstOrCreate(
            ['page' => $pageName],
            ['is_active' => true]
        );

        $detail = CmsUnitDetail::firstOrCreate(
            ['unit_id' => $unit->id],
            []
        );

        $teachers = CmsUnitTeacher::with('teacher')->where('unit_id', $unit->id)->orderBy('order')->get();
        $ekskuls = CmsUnitEkskul::where('unit_id', $unit->id)->orderBy('order')->get();
        $facilities = CmsUnitFacility::where('unit_id', $unit->id)->orderBy('order')->get();
        $achievements = CmsAchievement::where('unit_id', $unit->id)->orderBy('order')->get();
        
        // For dropdowns
        $availableTeachers = Teacher::where('unit_id', $unit->id)->get();
        $availableStudents = Student::where('unit_id', $unit->id)->get();

        return view('admin.unit-cms.show', compact(
            'unit', 'hero', 'detail', 'teachers', 'ekskuls', 'facilities', 'achievements', 'availableTeachers', 'availableStudents'
        ));
    }

    // --- HERO ---
    public function updateHero(Request $request, $id)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string',
            'button_text' => 'nullable|string|max:50',
            'button_link' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        $unit = Unit::findOrFail($id);
        $pageName = '';
        if (stripos($unit->unit_name, 'tk') !== false) $pageName = 'unit_tk';
        elseif (stripos($unit->unit_name, 'sd') !== false) $pageName = 'unit_sd';
        elseif (stripos($unit->unit_name, 'smp') !== false) $pageName = 'unit_smp';

        $hero = CmsHeroSection::where('page', $pageName)->first();

        if ($request->hasFile('image')) {
            if ($hero->image && !str_starts_with($hero->image, 'http')) {
                Storage::disk('public')->delete($hero->image);
            }
            $hero->image = $request->file('image')->store('cms/hero', 'public');
        }

        $hero->title = $request->title;
        $hero->subtitle = $request->subtitle;
        $hero->button_text = $request->button_text;
        $hero->button_link = $request->button_link;
        $hero->is_active = $request->has('is_active');
        $hero->save();

        return redirect()->back()->with('success', 'Hero Section unit berhasil diperbarui!');
    }

    // --- DETAIL ---
    public function updateDetail(Request $request, $id)
    {
        $request->validate([
            'description_title' => 'nullable|string|max:255',
            'description_body' => 'nullable|string',
            'target_age' => 'nullable|string|max:100',
            'quota' => 'nullable|string|max:100',
            'description_logo' => 'nullable|image|max:2048',
        ]);

        $detail = CmsUnitDetail::where('unit_id', $id)->first();

        if ($request->hasFile('description_logo')) {
            if ($detail->description_logo && !str_starts_with($detail->description_logo, 'http')) {
                Storage::disk('public')->delete($detail->description_logo);
            }
            $detail->description_logo = $request->file('description_logo')->store('cms/unit', 'public');
        }

        $detail->description_title = $request->description_title;
        $detail->description_body = $request->description_body;
        $detail->target_age = $request->target_age;
        $detail->quota = $request->quota;
        $detail->save();

        return redirect()->back()->with('success', 'Detail unit berhasil diperbarui!');
    }

    // --- FASILITAS ---
    public function storeFasilitas(Request $request, $id)
    {
        $request->validate([
            'icon' => 'required|string|max:50',
            'title' => 'required|string|max:255',
            'order' => 'nullable|integer',
        ]);

        CmsUnitFacility::create([
            'unit_id' => $id,
            'icon' => $request->icon,
            'title' => $request->title,
            'order' => $request->order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->back()->with('success', 'Fasilitas berhasil ditambahkan!');
    }

    public function updateFasilitas(Request $request, $id, $facilityId)
    {
        $facility = CmsUnitFacility::findOrFail($facilityId);
        
        $request->validate([
            'icon' => 'required|string|max:50',
            'title' => 'required|string|max:255',
            'order' => 'nullable|integer',
        ]);

        $facility->update([
            'icon' => $request->icon,
            'title' => $request->title,
            'order' => $request->order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->back()->with('success', 'Fasilitas berhasil diperbarui!');
    }

    public function destroyFasilitas($id, $facilityId)
    {
        CmsUnitFacility::findOrFail($facilityId)->delete();
        return redirect()->back()->with('success', 'Fasilitas berhasil dihapus!');
    }

    // --- EKSKUL ---
    public function storeEkskul(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'icon' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'order' => 'nullable|integer',
        ]);

        $data = $request->only(['title', 'icon', 'description', 'order']);
        $data['unit_id'] = $id;
        $data['is_active'] = $request->has('is_active');
        $data['order'] = $data['order'] ?? 0;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('cms/ekskul', 'public');
        }

        CmsUnitEkskul::create($data);

        return redirect()->back()->with('success', 'Ekstrakurikuler berhasil ditambahkan!');
    }

    public function updateEkskul(Request $request, $id, $ekskulId)
    {
        $ekskul = CmsUnitEkskul::findOrFail($ekskulId);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'icon' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'order' => 'nullable|integer',
        ]);

        $data = $request->only(['title', 'icon', 'description', 'order']);
        $data['is_active'] = $request->has('is_active');
        $data['order'] = $data['order'] ?? 0;

        if ($request->hasFile('image')) {
            if ($ekskul->image && !str_starts_with($ekskul->image, 'http')) {
                Storage::disk('public')->delete($ekskul->image);
            }
            $data['image'] = $request->file('image')->store('cms/ekskul', 'public');
        }

        $ekskul->update($data);

        return redirect()->back()->with('success', 'Ekstrakurikuler berhasil diperbarui!');
    }

    public function destroyEkskul($id, $ekskulId)
    {
        $ekskul = CmsUnitEkskul::findOrFail($ekskulId);
        if ($ekskul->image && !str_starts_with($ekskul->image, 'http')) {
            Storage::disk('public')->delete($ekskul->image);
        }
        $ekskul->delete();
        
        return redirect()->back()->with('success', 'Ekstrakurikuler berhasil dihapus!');
    }

    // --- GURU ---
    public function storeGuru(Request $request, $id)
    {
        $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'order' => 'nullable|integer',
        ]);

        // check if already exists
        if (CmsUnitTeacher::where('unit_id', $id)->where('teacher_id', $request->teacher_id)->exists()) {
            return redirect()->back()->with('error', 'Guru tersebut sudah ditambahkan!');
        }

        CmsUnitTeacher::create([
            'unit_id' => $id,
            'teacher_id' => $request->teacher_id,
            'order' => $request->order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->back()->with('success', 'Guru pengajar berhasil ditambahkan!');
    }

    public function updateGuru(Request $request, $id, $guruId)
    {
        $guru = CmsUnitTeacher::findOrFail($guruId);
        
        $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'order' => 'nullable|integer',
        ]);

        // check if changing to another existing
        if ($request->teacher_id != $guru->teacher_id && CmsUnitTeacher::where('unit_id', $id)->where('teacher_id', $request->teacher_id)->exists()) {
            return redirect()->back()->with('error', 'Guru tersebut sudah ada di daftar!');
        }

        $guru->update([
            'teacher_id' => $request->teacher_id,
            'order' => $request->order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->back()->with('success', 'Guru pengajar berhasil diperbarui!');
    }

    public function destroyGuru($id, $guruId)
    {
        CmsUnitTeacher::findOrFail($guruId)->delete();
        return redirect()->back()->with('success', 'Guru pengajar berhasil dihapus!');
    }

    // --- PRESTASI ---
    public function storePrestasi(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|in:school,teacher,student',
            'year' => 'required|integer',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'level' => 'nullable|string|max:100',
            'side' => 'required|in:left,right',
            'order' => 'nullable|integer',
        ]);

        $data = $request->except('_token');
        $data['unit_id'] = $id;
        $data['is_active'] = $request->has('is_active');
        $data['order'] = $data['order'] ?? 0;

        CmsAchievement::create($data);

        return redirect()->back()->with('success', 'Prestasi berhasil ditambahkan!');
    }

    public function updatePrestasi(Request $request, $id, $prestasiId)
    {
        $prestasi = CmsAchievement::findOrFail($prestasiId);
        
        $request->validate([
            'type' => 'required|in:school,teacher,student',
            'year' => 'required|integer',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'level' => 'nullable|string|max:100',
            'side' => 'required|in:left,right',
            'order' => 'nullable|integer',
        ]);

        $data = $request->except(['_token', '_method']);
        $data['is_active'] = $request->has('is_active');
        $data['order'] = $data['order'] ?? 0;

        $prestasi->update($data);

        return redirect()->back()->with('success', 'Prestasi berhasil diperbarui!');
    }

    public function destroyPrestasi($id, $prestasiId)
    {
        CmsAchievement::findOrFail($prestasiId)->delete();
        return redirect()->back()->with('success', 'Prestasi berhasil dihapus!');
    }
}

