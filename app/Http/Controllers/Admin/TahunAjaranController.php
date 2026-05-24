<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AcademicYear;
use Illuminate\Support\Facades\DB;

class TahunAjaranController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $academicYears = AcademicYear::query()

            ->when($request->search, function ($query) use ($request) {

                $query->where(
                    'year',
                    'like',
                    '%' . $request->search . '%'
                );
            })

            ->when($request->status, function ($query) use ($request) {

                $query->where(
                    'status',
                    $request->status
                );
            })

            ->when($request->semester, function ($query) use ($request) {

                $query->where(
                    'active_semester',
                    $request->semester
                );
            })

            ->latest()
            ->get();

        return view(
            'admin.tahun-ajaran.index',
            compact('academicYears')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('admin.tahun-ajaran.create');
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([

            'year' => 'required|string|unique:academic_years,year',

            'active_semester' => 'required|in:odd,even',

            'start_odd' => 'required|date',
            'end_odd' => 'required|date|after:start_odd',

            'start_even' => 'required|date',
            'end_even' => 'required|date|after:start_even',
        ]);

        AcademicYear::create([

            'year' => $request->year,

            'active_semester' => $request->active_semester,

            'status' => 'inactive',

            'start_odd' => $request->start_odd,
            'end_odd' => $request->end_odd,

            'start_even' => $request->start_even,
            'end_even' => $request->end_even,
        ]);

        return redirect()
            ->route('admin.tahun-ajaran.index')
            ->with('success', 'Tahun ajaran berhasil ditambahkan');
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $academicYear = AcademicYear::findOrFail($id);

        return view(
            'admin.tahun-ajaran.edit',
            compact('academicYear')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $academicYear = AcademicYear::findOrFail($id);

        $request->validate([

            'year' => 'required|string|unique:academic_years,year,' . $id,

            'active_semester' => 'required|in:odd,even',

            'start_odd' => 'required|date',
            'end_odd' => 'required|date|after:start_odd',

            'start_even' => 'required|date',
            'end_even' => 'required|date|after:start_even',
        ]);

        $academicYear->update([

            'year' => $request->year,

            'active_semester' => $request->active_semester,

            'start_odd' => $request->start_odd,
            'end_odd' => $request->end_odd,

            'start_even' => $request->start_even,
            'end_even' => $request->end_even,
        ]);

        return redirect()
            ->route('admin.tahun-ajaran.index')
            ->with('success', 'Tahun ajaran berhasil diupdate');
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $academicYear = AcademicYear::findOrFail($id);

        $academicYear->delete();

        return redirect()
            ->route('admin.tahun-ajaran.index')
            ->with('success', 'Tahun ajaran berhasil dihapus');
    }

    /*
    |--------------------------------------------------------------------------
    | SET ACTIVE
    |--------------------------------------------------------------------------
    */

    public function setActive($id)
    {
        DB::transaction(function () use ($id) {

            AcademicYear::where(
                'status',
                'active'
            )->update([
                'status' => 'inactive'
            ]);

            AcademicYear::where(
                'id',
                $id
            )->update([
                'status' => 'active'
            ]);
        });

        return redirect()
            ->route('admin.tahun-ajaran.index')
            ->with('success', 'Tahun ajaran berhasil diaktifkan');
    }
}
