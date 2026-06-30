<?php

namespace App\Http\Controllers\Admin\Akademik;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Akademik\StoreUnitRequest;
use App\Http\Requests\Admin\Akademik\UpdateUnitRequest;
use App\Http\Requests\Admin\Akademik\BulkDestroyUnitRequest;

class UnitController extends Controller
{
    public function index(Request $request)
    {
        $query = Unit::withCount(['students', 'teachers', 'schoolClasses', 'subjects']);

        if ($request->filled('search')) {
            $query->where('unit_name', 'like', '%' . $request->search . '%');
        }

        $perPage = $request->input('per_page', 10);
        $units = $query->latest()->paginate($perPage)->appends(request()->query());

        return view('admin.akademik.unit.index', compact('units'));
    }

    public function create()
    {
        return view('admin.akademik.unit.create');
    }

    public function store(StoreUnitRequest $request)
    {
        Unit::create(['unit_name' => $request->unit_name]);

        return redirect()
            ->route('admin.unit.index')
            ->with('success', 'Unit pendidikan berhasil ditambahkan');
    }

    public function edit(Unit $unit)
    {
        return view('admin.akademik.unit.edit', compact('unit'));
    }

    public function update(UpdateUnitRequest $request, Unit $unit)
    {
        $unit->update(['unit_name' => $request->unit_name]);

        return redirect()
            ->route('admin.unit.index')
            ->with('success', 'Unit pendidikan berhasil diperbarui');
    }

    public function destroy(Unit $unit)
    {
        if ($unit->students()->exists() || $unit->schoolClasses()->exists() || $unit->teachers()->exists() || $unit->subjects()->exists()) {
            return back()->with('error', 'Unit tidak dapat dihapus karena masih digunakan oleh data Siswa, Kelas, Guru, atau Mapel.');
        }

        $unit->delete();

        return redirect()
            ->route('admin.unit.index')
            ->with('success', 'Unit pendidikan berhasil dihapus');
    }

    public function bulkDestroy(BulkDestroyUnitRequest $request)
    {
        $units = Unit::whereIn('id', $request->ids)->get();
        $deleted = 0;
        $failed = 0;

        foreach ($units as $unit) {
            if ($unit->students()->exists() || $unit->schoolClasses()->exists() || $unit->teachers()->exists() || $unit->subjects()->exists()) {
                $failed++;
            } else {
                $unit->delete();
                $deleted++;
            }
        }

        $message = "Berhasil menghapus $deleted unit pendidikan.";
        if ($failed > 0) {
            $message .= " Gagal menghapus $failed unit karena masih digunakan oleh data terkait.";
        }

        return redirect()
            ->route('admin.unit.index')
            ->with($failed > 0 && $deleted == 0 ? 'error' : 'success', $message);
    }
}
