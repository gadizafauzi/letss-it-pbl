<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolAccount;
use Illuminate\Http\Request;

class RekeningSekolahController extends Controller
{
    public function index()
    {
        $accounts = SchoolAccount::orderBy('bank_name')->get();
        return view('admin.rekening-sekolah.index', compact('accounts'));
    }

    public function create()
    {
        return view('admin.rekening-sekolah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            'account_name' => 'required|string|max:255',
            'is_active' => 'boolean'
        ]);

        SchoolAccount::create($request->all());

        return redirect()->route('admin.rekening-sekolah.index')->with('success', 'Rekening berhasil ditambahkan.');
    }

    public function edit(SchoolAccount $schoolAccount)
    {
        return view('admin.rekening-sekolah.edit', compact('schoolAccount'));
    }

    public function update(Request $request, SchoolAccount $schoolAccount)
    {
        $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            'account_name' => 'required|string|max:255',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        $schoolAccount->update($data);

        return redirect()->route('admin.rekening-sekolah.index')->with('success', 'Rekening berhasil diperbarui.');
    }

    public function destroy(SchoolAccount $schoolAccount)
    {
        $schoolAccount->delete();
        return redirect()->route('admin.rekening-sekolah.index')->with('success', 'Rekening berhasil dihapus.');
    }
}
