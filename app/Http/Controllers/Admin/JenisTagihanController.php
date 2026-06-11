<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentType;
use App\Models\Unit;
use Illuminate\Http\Request;

class JenisTagihanController extends Controller
{
    public function index()
    {
        $perPage = request('per_page', 10);
        $types = PaymentType::with('unit')->paginate($perPage)->appends(request()->query());
        return view('admin.jenis-tagihan.index', compact('types'));
    }

    public function create()
    {
        $units = Unit::all();
        return view('admin.jenis-tagihan.create', compact('units'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'unit_id' => 'nullable|exists:units,id',
            'amount' => 'required|numeric|min:0'
        ]);

        PaymentType::create($request->all());

        return redirect()->route('admin.jenis-tagihan.index')->with('success', 'Jenis tagihan berhasil ditambahkan.');
    }

    public function edit(PaymentType $paymentType)
    {
        $units = Unit::all();
        return view('admin.jenis-tagihan.edit', compact('paymentType', 'units'));
    }

    public function update(Request $request, PaymentType $paymentType)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'unit_id' => 'nullable|exists:units,id',
            'amount' => 'required|numeric|min:0'
        ]);

        $paymentType->update($request->all());

        return redirect()->route('admin.jenis-tagihan.index')->with('success', 'Jenis tagihan berhasil diperbarui.');
    }

    public function destroy(PaymentType $paymentType)
    {
        $paymentType->delete();
        return redirect()->route('admin.jenis-tagihan.index')->with('success', 'Jenis tagihan berhasil dihapus.');
    }
}
