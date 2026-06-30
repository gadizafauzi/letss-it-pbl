<?php

namespace App\Http\Controllers\Admin\Akademik;

use App\Http\Controllers\Controller;
use App\Models\Position;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Akademik\StoreJabatanRequest;
use App\Http\Requests\Admin\Akademik\UpdateJabatanRequest;
use App\Http\Requests\Admin\Akademik\BulkDestroyJabatanRequest;

class JabatanController extends Controller
{
    public function index(Request $request)
    {
        $query = Position::withCount('teachers');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $perPage = $request->input('per_page', 10);
        $jabatans = $query->latest()->paginate($perPage)->appends(request()->query());

        return view('admin.akademik.jabatan.index', compact('jabatans'));
    }

    public function create()
    {
        return view('admin.akademik.jabatan.create');
    }

    public function store(StoreJabatanRequest $request)
    {
        Position::create(['name' => $request->name]);

        return redirect()
            ->route('admin.jabatan.index')
            ->with('success', 'Jabatan berhasil ditambahkan');
    }

    public function edit(Position $jabatan)
    {
        return view('admin.akademik.jabatan.edit', compact('jabatan'));
    }

    public function update(UpdateJabatanRequest $request, Position $jabatan)
    {
        $jabatan->update(['name' => $request->name]);

        return redirect()
            ->route('admin.jabatan.index')
            ->with('success', 'Jabatan berhasil diperbarui');
    }

    public function destroy(Position $jabatan)
    {
        if ($jabatan->teachers()->exists()) {
            return back()->with('error', 'Jabatan tidak dapat dihapus karena masih digunakan oleh data Guru.');
        }

        $jabatan->delete();

        return redirect()
            ->route('admin.jabatan.index')
            ->with('success', 'Jabatan berhasil dihapus');
    }

    public function bulkDestroy(BulkDestroyJabatanRequest $request)
    {
        $jabatans = Position::whereIn('id', $request->ids)->get();
        $deleted = 0;
        $failed = 0;

        foreach ($jabatans as $jabatan) {
            if ($jabatan->teachers()->exists()) {
                $failed++;
            } else {
                $jabatan->delete();
                $deleted++;
            }
        }

        $message = "Berhasil menghapus $deleted data jabatan.";
        if ($failed > 0) {
            $message .= " Gagal menghapus $failed jabatan karena masih digunakan oleh data Guru.";
        }

        return redirect()
            ->route('admin.jabatan.index')
            ->with($failed > 0 && $deleted == 0 ? 'error' : 'success', $message);
    }
}
