<?php

namespace App\Http\Controllers\Admin\Akademik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AcademicYear;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Admin\Akademik\StoreTahunAjaranRequest;
use App\Http\Requests\Admin\Akademik\UpdateTahunAjaranRequest;
use App\Http\Requests\Admin\Akademik\BulkDestroyTahunAjaranRequest;

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
            ->paginate($request->input('per_page', 10))
            ->appends(request()->query());

        return view(
            'admin.akademik.tahun-ajaran.index',
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
        return view('admin.akademik.tahun-ajaran.create');
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(StoreTahunAjaranRequest $request)
    {

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
            'admin.akademik.tahun-ajaran.edit',
            compact('academicYear')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(UpdateTahunAjaranRequest $request, $id)
    {
        $academicYear = AcademicYear::findOrFail($id);

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

        if ($academicYear->studentClasses()->exists()) {
            return back()->with('error', 'Tahun ajaran tidak dapat dihapus karena masih digunakan dalam riwayat kelas siswa.');
        }

        $academicYear->delete();

        return redirect()
            ->route('admin.tahun-ajaran.index')
            ->with('success', 'Tahun ajaran berhasil dihapus');
    }

    /*
    |--------------------------------------------------------------------------
    | BULK DELETE
    |--------------------------------------------------------------------------
    */

    public function bulkDestroy(BulkDestroyTahunAjaranRequest $request)
    {
        $academicYears = AcademicYear::whereIn('id', $request->ids)->get();
        $deleted = 0;
        $failed = 0;

        foreach ($academicYears as $academicYear) {
            if ($academicYear->studentClasses()->exists()) {
                $failed++;
            } else {
                $academicYear->delete();
                $deleted++;
            }
        }

        $message = "Berhasil menghapus $deleted tahun ajaran.";
        if ($failed > 0) {
            $message .= " Gagal menghapus $failed tahun ajaran karena masih digunakan dalam riwayat kelas siswa.";
        }

        return redirect()
            ->route('admin.tahun-ajaran.index')
            ->with($failed > 0 && $deleted == 0 ? 'error' : 'success', $message);
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
