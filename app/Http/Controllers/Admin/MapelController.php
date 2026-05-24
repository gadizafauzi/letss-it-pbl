<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Subject;
use App\Models\Unit;

class MapelController extends Controller
{
    /**
     * LIST DATA MAPEL
     */
    public function index(Request $request)
    {
        $query = Subject::with('unit');

        /**
         * SEARCH
         */
        if ($request->search) {

            $query->where(function ($q) use ($request) {

                $q->where('subject_name', 'like', '%' . $request->search . '%')

                    ->orWhere('subject_code', 'like', '%' . $request->search . '%');
            });
        }

        /**
         * FILTER UNIT
         */
        if ($request->unit_id) {

            $query->where('unit_id', $request->unit_id);
        }

        $subjects = $query
            ->latest()
            ->paginate(10);

        $units = Unit::all();

        return view('admin.mapel.index', compact(
            'subjects',
            'units'
        ));
    }

    /**
     * FORM CREATE
     */
    public function create()
    {
        $units = Unit::all();

        return view('admin.mapel.create', compact(
            'units'
        ));
    }

    /**
     * STORE DATA
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'unit_id' => 'required|exists:units,id',

            'subject_code' => 'required|string|max:20|unique:subjects,subject_code',

            'subject_name' => 'required|string|max:100|unique:subjects,subject_name',

        ]);

        Subject::create($validated);

        return redirect()
            ->route('admin.mapel.index')
            ->with('success', 'Data mata pelajaran berhasil ditambahkan');
    }

    /**
     * DETAIL DATA
     */
    public function show(Subject $mapel)
    {
        $mapel->load('unit');

        return view('admin.mapel.show', [
            'subject' => $mapel
        ]);
    }

    /**
     * FORM EDIT
     */
    public function edit(Subject $mapel)
    {
        $units = Unit::all();

        return view('admin.mapel.edit', [
            'subject' => $mapel,
            'units' => $units,
        ]);
    }

    /**
     * UPDATE DATA
     */
    public function update(Request $request, Subject $mapel)
    {
        $validated = $request->validate([

            'unit_id' => 'required|exists:units,id',

            'subject_code' => 'required|string|max:20|unique:subjects,subject_code,' . $mapel->id,

            'subject_name' => 'required|string|max:100|unique:subjects,subject_name,' . $mapel->id,

        ]);

        $mapel->update($validated);

        return redirect()
            ->route('admin.mapel.index')
            ->with('success', 'Data mata pelajaran berhasil diupdate');
    }

    /**
     * DELETE DATA
     */
    public function destroy(Subject $mapel)
    {
        $mapel->delete();

        return redirect()
            ->route('admin.mapel.index')
            ->with('success', 'Data mata pelajaran berhasil dihapus');
    }
}