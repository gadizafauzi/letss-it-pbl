<?php

namespace App\Http\Controllers\Admin\Keuangan;

use App\Http\Controllers\Controller;
use App\Models\PaymentType;
use App\Models\Unit;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Keuangan\StoreJenisTagihanRequest;
use App\Http\Requests\Admin\Keuangan\UpdateJenisTagihanRequest;
use App\Http\Requests\Admin\Keuangan\BulkDestroyJenisTagihanRequest;

class JenisTagihanController extends Controller
{
    public function index()
    {
        $perPage = request('per_page', 10);
        $types = PaymentType::with('unit')->paginate($perPage)->appends(request()->query());
        return view('admin.keuangan.jenis-tagihan.index', compact('types'));
    }

    public function create()
    {
        $units = Unit::all();
        return view('admin.keuangan.jenis-tagihan.create', compact('units'));
    }

    public function store(StoreJenisTagihanRequest $request)
    {
        PaymentType::create($request->all());

        return redirect()->route('admin.jenis-tagihan.index')->with('success', 'Jenis tagihan berhasil ditambahkan.');
    }

    public function edit(PaymentType $paymentType)
    {
        $units = Unit::all();
        return view('admin.keuangan.jenis-tagihan.edit', compact('paymentType', 'units'));
    }

    public function update(UpdateJenisTagihanRequest $request, PaymentType $paymentType)
    {
        $paymentType->update($request->all());

        return redirect()->route('admin.jenis-tagihan.index')->with('success', 'Jenis tagihan berhasil diperbarui.');
    }

    public function destroy(PaymentType $jenisTagihan)
    {
        $jenisTagihan->delete();

        return redirect()
            ->route('admin.jenis-tagihan.index')
            ->with('success', 'Jenis tagihan berhasil dihapus');
    }

    public function bulkDestroy(BulkDestroyJenisTagihanRequest $request)
    {
        $jenisTagihans = PaymentType::whereIn('id', $request->ids)->get();

        foreach ($jenisTagihans as $jenisTagihan) {
            $jenisTagihan->delete();
        }

        return redirect()
            ->route('admin.jenis-tagihan.index')
            ->with('success', count($jenisTagihans) . ' data jenis tagihan berhasil dihapus');
    }
}
