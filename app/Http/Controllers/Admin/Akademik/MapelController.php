<?php

namespace App\Http\Controllers\Admin\Akademik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Subject;
use App\Models\Unit;
use App\Http\Requests\Admin\Akademik\StoreMapelRequest;
use App\Http\Requests\Admin\Akademik\UpdateMapelRequest;
use App\Http\Requests\Admin\Akademik\BulkDestroyMapelRequest;

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
            ->paginate($request->get('per_page', 10));

        $units = Unit::all();

        return view('admin.akademik.mapel.index', compact(
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

        return view('admin.akademik.mapel.create', compact(
            'units'
        ));
    }

    /**
     * STORE DATA
     */
    public function store(StoreMapelRequest $request)
    {
        Subject::create($request->validated());

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

        return view('admin.akademik.mapel.show', [
            'subject' => $mapel
        ]);
    }

    /**
     * FORM EDIT
     */
    public function edit(Subject $mapel)
    {
        $units = Unit::all();

        return view('admin.akademik.mapel.edit', [
            'subject' => $mapel,
            'units' => $units,
        ]);
    }

    /**
     * UPDATE DATA
     */
    public function update(UpdateMapelRequest $request, Subject $mapel)
    {
        $mapel->update($request->validated());

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

    /**
     * DELETE MASSAL DATA MAPEL
     */
    public function bulkDestroy(BulkDestroyMapelRequest $request)
    {
        $subjects = Subject::whereIn('id', $request->ids)->get();

        foreach ($subjects as $subject) {
            $subject->delete();
        }

        return redirect()
            ->route('admin.mapel.index')
            ->with('success', count($subjects) . ' data mata pelajaran berhasil dihapus');
    }
}
