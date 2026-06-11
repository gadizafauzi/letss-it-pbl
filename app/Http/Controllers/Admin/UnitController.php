<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;

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

        return view('admin.unit.index', compact('units'));
    }

    public function create()
    {
        return view('admin.unit.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'unit_name' => 'required|unique:units,unit_name',
        ]);

        Unit::create(['unit_name' => $request->unit_name]);

        return redirect()
            ->route('admin.unit.index')
            ->with('success', 'Unit pendidikan berhasil ditambahkan');
    }

    public function edit(Unit $unit)
    {
        return view('admin.unit.edit', compact('unit'));
    }

    public function update(Request $request, Unit $unit)
    {
        $request->validate([
            'unit_name' => 'required|unique:units,unit_name,' . $unit->id,
        ]);

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
}
