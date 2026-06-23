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
        $query = Unit::withCount(['students', 'teachers']);

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
        $unit->delete();

        return redirect()
            ->route('admin.unit.index')
            ->with('success', 'Unit pendidikan berhasil dihapus');
    }

    public function bulkDestroy(BulkDestroyUnitRequest $request)
    {
        $units = Unit::whereIn('id', $request->ids)->get();

        foreach ($units as $unit) {
            $unit->delete();
        }

        return redirect()
            ->route('admin.unit.index')
            ->with('success', count($units) . ' unit pendidikan berhasil dihapus');
    }
}
