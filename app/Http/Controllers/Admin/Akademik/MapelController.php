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
        if (\App\Models\TeachingAssignment::where('subject_id', $mapel->id)->exists()) {
            return back()->with('error', 'Mata pelajaran tidak dapat dihapus karena sudah memiliki jadwal mengajar.');
        }

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
        $deleted = 0;
        $failed = 0;

        foreach ($subjects as $subject) {
            if (\App\Models\TeachingAssignment::where('subject_id', $subject->id)->exists()) {
                $failed++;
            } else {
                $subject->delete();
                $deleted++;
            }
        }

        $message = "Berhasil menghapus $deleted data mata pelajaran.";
        if ($failed > 0) {
            $message .= " Gagal menghapus $failed mata pelajaran karena sudah memiliki jadwal mengajar.";
        }

        return redirect()
            ->route('admin.mapel.index')
            ->with($failed > 0 && $deleted == 0 ? 'error' : 'success', $message);
    }
}
