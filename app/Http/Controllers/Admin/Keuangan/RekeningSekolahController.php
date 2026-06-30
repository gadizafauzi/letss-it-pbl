<?php

namespace App\Http\Controllers\Admin\Keuangan;

use App\Http\Controllers\Controller;
use App\Models\SchoolAccount;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Keuangan\StoreRekeningRequest;
use App\Http\Requests\Admin\Keuangan\UpdateRekeningRequest;

class RekeningSekolahController extends Controller
{
    public function index()
    {
        $accounts = SchoolAccount::orderBy('bank_name')->get();
        return view('admin.keuangan.rekening-sekolah.index', compact('accounts'));
    }

    public function create()
    {
        return view('admin.keuangan.rekening-sekolah.create');
    }

    public function store(StoreRekeningRequest $request)
    {
        SchoolAccount::create($request->all());

        return redirect()->route('admin.rekening-sekolah.index')->with('success', 'Rekening berhasil ditambahkan.');
    }

    public function edit(SchoolAccount $rekening_sekolah)
    {
        $schoolAccount = $rekening_sekolah;
        return view('admin.keuangan.rekening-sekolah.edit', compact('schoolAccount'));
    }

    public function update(UpdateRekeningRequest $request, SchoolAccount $rekening_sekolah)
    {
        $schoolAccount = $rekening_sekolah;
        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        $schoolAccount->update($data);

        return redirect()->route('admin.rekening-sekolah.index')->with('success', 'Rekening berhasil diperbarui.');
    }

    public function destroy(SchoolAccount $rekening_sekolah)
    {
        if (\App\Models\Payment::where('school_account_id', $rekening_sekolah->id)->exists()) {
            return back()->with('error', 'Rekening tidak dapat dihapus karena sudah memiliki riwayat pembayaran.');
        }

        $rekening_sekolah->delete();
        return redirect()->route('admin.rekening-sekolah.index')->with('success', 'Rekening berhasil dihapus.');
    }
}
