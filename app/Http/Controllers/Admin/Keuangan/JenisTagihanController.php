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
        if (\App\Models\Invoice::where('payment_type', $jenisTagihan->name)->exists()) {
            return back()->with('error', 'Jenis tagihan tidak dapat dihapus karena sudah digunakan dalam data tagihan siswa.');
        }

        $jenisTagihan->delete();

        return redirect()
            ->route('admin.jenis-tagihan.index')
            ->with('success', 'Jenis tagihan berhasil dihapus');
    }

    public function bulkDestroy(BulkDestroyJenisTagihanRequest $request)
    {
        $jenisTagihans = PaymentType::whereIn('id', $request->ids)->get();
        $deleted = 0;
        $failed = 0;

        foreach ($jenisTagihans as $jenisTagihan) {
            if (\App\Models\Invoice::where('payment_type', $jenisTagihan->name)->exists()) {
                $failed++;
            } else {
                $jenisTagihan->delete();
                $deleted++;
            }
        }

        $message = "Berhasil menghapus $deleted data jenis tagihan.";
        if ($failed > 0) {
            $message .= " Gagal menghapus $failed jenis tagihan karena sudah digunakan dalam data tagihan siswa.";
        }

        return redirect()
            ->route('admin.jenis-tagihan.index')
            ->with($failed > 0 && $deleted == 0 ? 'error' : 'success', $message);
    }
}
