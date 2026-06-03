<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Position;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    public function index(Request $request)
    {
        $query = Position::withCount('teachers');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $jabatans = $query->latest()->get();

        return view('admin.jabatan.index', compact('jabatans'));
    }

    public function create()
    {
        return view('admin.jabatan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:positions,name',
        ]);

        Position::create(['name' => $request->name]);

        return redirect()
            ->route('admin.jabatan.index')
            ->with('success', 'Jabatan berhasil ditambahkan');
    }

    public function edit(Position $jabatan)
    {
        return view('admin.jabatan.edit', compact('jabatan'));
    }

    public function update(Request $request, Position $jabatan)
    {
        $request->validate([
            'name' => 'required|unique:positions,name,' . $jabatan->id,
        ]);

        $jabatan->update(['name' => $request->name]);

        return redirect()
            ->route('admin.jabatan.index')
            ->with('success', 'Jabatan berhasil diperbarui');
    }

    public function destroy(Position $jabatan)
    {
        $jabatan->delete();

        return redirect()
            ->route('admin.jabatan.index')
            ->with('success', 'Jabatan berhasil dihapus');
    }
}
