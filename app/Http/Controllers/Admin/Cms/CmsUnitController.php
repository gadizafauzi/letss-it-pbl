<?php

namespace App\Http\Controllers\Admin\Cms;

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
use App\Http\Requests\Admin\Cms\UpdateUnitHeroRequest;
use App\Http\Requests\Admin\Cms\UpdateUnitDetailRequest;
use App\Http\Requests\Admin\Cms\StoreUnitFasilitasRequest;
use App\Http\Requests\Admin\Cms\UpdateUnitFasilitasRequest;
use App\Http\Requests\Admin\Cms\StoreUnitEkskulRequest;
use App\Http\Requests\Admin\Cms\UpdateUnitEkskulRequest;
use App\Http\Requests\Admin\Cms\StoreUnitGuruRequest;
use App\Http\Requests\Admin\Cms\UpdateUnitGuruRequest;
use App\Http\Requests\Admin\Cms\StoreUnitPrestasiRequest;
use App\Http\Requests\Admin\Cms\UpdateUnitPrestasiRequest;

class CmsUnitController extends Controller
{
    public function index()
    {
        $units = Unit::all();
        return view('admin.cms.unit.index', compact('units'));
    }

    public function show($id)
    {
        $unit = Unit::findOrFail($id);
        
        // Determine page name for hero section based on unit name
        if (stripos($unit->unit_name, 'tk') !== false) {
            $pageName = 'unit_tk';
        } elseif (stripos($unit->unit_name, 'sd') !== false) {
            $pageName = 'unit_sd';
        } elseif (stripos($unit->unit_name, 'smp') !== false) {
            $pageName = 'unit_smp';
        } elseif (stripos($unit->unit_name, 'sma') !== false) {
            $pageName = 'unit_sma';
        } else {
            $pageName = 'unit_' . strtolower(str_replace(' ', '_', $unit->unit_name));
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

        return view('admin.cms.unit.show', compact(
            'unit', 'hero', 'detail', 'teachers', 'ekskuls', 'facilities', 'achievements', 'availableTeachers', 'availableStudents'
        ));
    }

    public function updateHero(UpdateUnitHeroRequest $request, $id)
    {
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

        return redirect()->back()->with([
            'success' => 'Hero Section unit berhasil diperbarui!',
            'active_tab' => 'hero'
        ]);
    }

    public function updateDetail(UpdateUnitDetailRequest $request, $id)
    {
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

        return redirect()->back()->with([
            'success' => 'Detail unit berhasil diperbarui!',
            'active_tab' => 'detail'
        ]);
    }

    public function storeFasilitas(StoreUnitFasilitasRequest $request, $id)
    {
        CmsUnitFacility::create([
            'unit_id' => $id,
            'icon' => $request->icon,
            'title' => $request->title,
            'order' => $request->order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->back()->with([
            'success' => 'Fasilitas berhasil ditambahkan!',
            'active_tab' => 'fasilitas'
        ]);
    }

    public function updateFasilitas(UpdateUnitFasilitasRequest $request, $id, $facilityId)
    {
        $facility = CmsUnitFacility::findOrFail($facilityId);
        
        $facility->update([
            'icon' => $request->icon,
            'title' => $request->title,
            'order' => $request->order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->back()->with([
            'success' => 'Fasilitas berhasil diperbarui!',
            'active_tab' => 'fasilitas'
        ]);
    }

    public function destroyFasilitas($id, $facilityId)
    {
        CmsUnitFacility::findOrFail($facilityId)->delete();
        return redirect()->back()->with([
            'success' => 'Fasilitas berhasil dihapus!',
            'active_tab' => 'fasilitas'
        ]);
    }

    public function storeEkskul(StoreUnitEkskulRequest $request, $id)
    {
        $data = $request->only(['title', 'icon', 'description', 'order']);
        $data['unit_id'] = $id;
        $data['is_active'] = $request->has('is_active');
        $data['order'] = $data['order'] ?? 0;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('cms/ekskul', 'public');
        }

        CmsUnitEkskul::create($data);

        return redirect()->back()->with([
            'success' => 'Ekstrakurikuler berhasil ditambahkan!',
            'active_tab' => 'ekskul'
        ]);
    }

    public function updateEkskul(UpdateUnitEkskulRequest $request, $id, $ekskulId)
    {
        $ekskul = CmsUnitEkskul::findOrFail($ekskulId);
        
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

        return redirect()->back()->with([
            'success' => 'Ekstrakurikuler berhasil diperbarui!',
            'active_tab' => 'ekskul'
        ]);
    }

    public function destroyEkskul($id, $ekskulId)
    {
        $ekskul = CmsUnitEkskul::findOrFail($ekskulId);
        if ($ekskul->image && !str_starts_with($ekskul->image, 'http')) {
            Storage::disk('public')->delete($ekskul->image);
        }
        $ekskul->delete();
        
        return redirect()->back()->with([
            'success' => 'Ekstrakurikuler berhasil dihapus!',
            'active_tab' => 'ekskul'
        ]);
    }

    public function storeGuru(StoreUnitGuruRequest $request, $id)
    {
        // check if already exists
        if (CmsUnitTeacher::where('unit_id', $id)->where('teacher_id', $request->teacher_id)->exists()) {
            return redirect()->back()->with('error', 'Guru tersebut sudah ditambahkan!');
        }

        // Handle photo upload shortcut for Teacher master data
        if ($request->hasFile('photo')) {
            $teacher = \App\Models\Teacher::find($request->teacher_id);
            if ($teacher) {
                if ($teacher->photo && \Illuminate\Support\Facades\Storage::disk('public')->exists($teacher->photo)) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($teacher->photo);
                }
                $path = $request->file('photo')->store('teachers', 'public');
                $teacher->update(['photo' => $path]);
            }
        }

        CmsUnitTeacher::create([
            'unit_id' => $id,
            'teacher_id' => $request->teacher_id,
            'order' => $request->order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->back()->with([
            'success' => 'Guru pengajar berhasil ditambahkan!',
            'active_tab' => 'guru'
        ]);
    }

    public function updateGuru(UpdateUnitGuruRequest $request, $id, $guruId)
    {
        $guru = CmsUnitTeacher::findOrFail($guruId);
        
        // check if changing to another existing
        if ($request->teacher_id != $guru->teacher_id && CmsUnitTeacher::where('unit_id', $id)->where('teacher_id', $request->teacher_id)->exists()) {
            return redirect()->back()->with('error', 'Guru tersebut sudah ada di daftar!');
        }

        // Handle photo upload shortcut for Teacher master data
        if ($request->hasFile('photo')) {
            $teacher = \App\Models\Teacher::find($request->teacher_id);
            if ($teacher) {
                if ($teacher->photo && \Illuminate\Support\Facades\Storage::disk('public')->exists($teacher->photo)) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($teacher->photo);
                }
                $path = $request->file('photo')->store('teachers', 'public');
                $teacher->update(['photo' => $path]);
            }
        }

        $guru->update([
            'teacher_id' => $request->teacher_id,
            'order' => $request->order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->back()->with([
            'success' => 'Guru pengajar berhasil diperbarui!',
            'active_tab' => 'guru'
        ]);
    }

    public function destroyGuru($id, $guruId)
    {
        CmsUnitTeacher::findOrFail($guruId)->delete();
        return redirect()->back()->with([
            'success' => 'Guru pengajar berhasil dihapus!',
            'active_tab' => 'guru'
        ]);
    }

    public function storePrestasi(StoreUnitPrestasiRequest $request, $id)
    {
        $data = $request->except('_token');
        $data['unit_id'] = $id;
        $data['is_active'] = $request->has('is_active');
        $data['order'] = $data['order'] ?? 0;

        CmsAchievement::create($data);

        return redirect()->back()->with([
            'success' => 'Prestasi berhasil ditambahkan!',
            'active_tab' => 'prestasi'
        ]);
    }

    public function updatePrestasi(UpdateUnitPrestasiRequest $request, $id, $prestasiId)
    {
        $prestasi = CmsAchievement::findOrFail($prestasiId);
        
        $data = $request->except(['_token', '_method']);
        $data['is_active'] = $request->has('is_active');
        $data['order'] = $data['order'] ?? 0;

        $prestasi->update($data);

        return redirect()->back()->with([
            'success' => 'Prestasi berhasil diperbarui!',
            'active_tab' => 'prestasi'
        ]);
    }

    public function destroyPrestasi($id, $prestasiId)
    {
        CmsAchievement::findOrFail($prestasiId)->delete();
        return redirect()->back()->with([
            'success' => 'Prestasi berhasil dihapus!',
            'active_tab' => 'prestasi'
        ]);
    }
}

