<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\PaymentType;
use App\Models\SchoolClass;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TagihanController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::with('unit')
            ->has('invoices')
            ->withCount('invoices as total_invoices')
            ->withCount(['invoices as unpaid_count' => function($q) {
                $q->where('status', 'unpaid');
            }])
            ->withSum(['invoices as total_tunggakan' => function($q) {
                $q->where('status', 'unpaid');
            }], 'amount');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('nis', 'like', "%{$search}%");
            });
        }

        if ($request->has('status') && $request->status != '') {
            if ($request->status == 'unpaid') {
                $query->whereHas('invoices', function($q) {
                    $q->where('status', 'unpaid');
                });
            } elseif ($request->status == 'paid') {
                $query->whereDoesntHave('invoices', function($q) {
                    $q->where('status', 'unpaid');
                });
            }
        }

        $students = $query->paginate(20);

        return view('admin.tagihan.index', compact('students'));
    }

    public function student(Student $student)
    {
        $student->load(['unit', 'studentClasses.schoolClass', 'studentClasses.academicYear']);
        $invoices = Invoice::where('student_id', $student->id)->latest()->paginate(20);
        return view('admin.tagihan.student', compact('student', 'invoices'));
    }

    public function searchStudent(Request $request)
    {
        $request->validate(['nis' => 'required|string']);
        $student = Student::where('nis', $request->nis)->first();

        if ($student) {
            return redirect()->route('admin.tagihan.student', $student->id);
        }

        return back()->with('error', 'Data siswa dengan NIS ' . $request->nis . ' tidak ditemukan.');
    }

    public function create()
    {
        $classes = SchoolClass::with('unit')->get();
        $paymentTypes = PaymentType::with('unit')->get();

        return view('admin.tagihan.create', compact('classes', 'paymentTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'payment_type_id' => 'required|exists:payment_types,id',
            'period' => 'required|string|max:255',
            'due_date' => 'required|date',
            'target' => 'required|in:all,class,student',
            'class_id' => 'required_if:target,class|nullable|exists:classes,id',
        ]);

        $paymentType = PaymentType::find($request->payment_type_id);
        
        $students = collect();

        if ($request->target === 'all') {
            $query = Student::where('status', 'active');
            if ($paymentType->unit_id) {
                $query->where('unit_id', $paymentType->unit_id);
            }
            $students = $query->get();
        } elseif ($request->target === 'class') {
            $students = Student::where('status', 'active')
                ->whereHas('studentClasses', function($q) use ($request) {
                    $q->where('school_class_id', $request->class_id)
                      ->whereHas('academicYear', function($q2) {
                          $q2->where('status', 'active');
                      });
                })->get();
        }

        $count = 0;
        foreach ($students as $student) {
            // Cek duplikasi
            $exists = Invoice::where('student_id', $student->id)
                ->where('payment_type', $paymentType->name) // we store name as per existing migration
                ->where('period', $request->period)
                ->exists();

            if (!$exists) {
                Invoice::create([
                    'student_id' => $student->id,
                    'payment_type' => $paymentType->name,
                    'period' => $request->period,
                    'amount' => $paymentType->amount,
                    'due_date' => $request->due_date,
                    'status' => 'unpaid'
                ]);
                $count++;
            }
        }

        return redirect()->route('admin.tagihan.index')
            ->with('success', "Berhasil men-generate $count tagihan baru.");
    }

    public function show(Invoice $invoice)
    {
        $invoice->load(['student', 'student.unit', 'payment', 'payment.verifier']);
        return view('admin.tagihan.show', compact('invoice'));
    }

    public function destroy(Invoice $invoice)
    {
        if ($invoice->status === 'paid') {
            return back()->with('error', 'Tagihan yang sudah dibayar tidak dapat dihapus.');
        }
        $invoice->delete();
        return back()->with('success', 'Tagihan berhasil dihapus.');
    }

    public function kirimWa(Invoice $invoice)
    {
        $invoice->load(['student']);
        $nomorWa = $invoice->student->parent_phone;
        
        if (!$nomorWa) {
            return back()->with('error', 'Nomor WA orang tua tidak ditemukan!');
        }

        $pesan = $this->formatPesanWa($invoice);

        $response = Http::withoutVerifying()->withHeaders([
            'Authorization' => env('FONNTE_API_TOKEN')
        ])->post('https://api.fonnte.com/send', [
            'target' => $nomorWa,
            'message' => $pesan,
            'countryCode' => '62',
        ]);

        $responseData = $response->json();

        if ($response->successful() && isset($responseData['status']) && $responseData['status'] === true) {
            return back()->with('success', 'Tagihan berhasil dikirim ke WA!');
        }

        $errorDetail = isset($responseData['reason']) ? $responseData['reason'] : (isset($responseData['detail']) ? $responseData['detail'] : $response->body());
        return back()->with('error', 'Gagal mengirim WA. Pesan dari server: ' . $errorDetail);
    }

    public function broadcastWa(Request $request)
    {
        // Ambil semua tagihan yang belum dibayar dan siswa punya nomor WA
        $invoices = Invoice::with('student')
            ->where('status', 'unpaid')
            ->whereHas('student', function ($query) {
                $query->whereNotNull('parent_phone')
                      ->where('parent_phone', '!=', '');
            })
            ->get();

        if ($invoices->isEmpty()) {
            return back()->with('error', 'Tidak ada tagihan tertunggak dengan nomor WA orang tua yang valid.');
        }

        $berhasil = 0;
        foreach ($invoices as $invoice) {
            $pesan = $this->formatPesanWa($invoice);
            
            $response = Http::withoutVerifying()->withHeaders([
                'Authorization' => env('FONNTE_API_TOKEN')
            ])->post('https://api.fonnte.com/send', [
                'target' => $invoice->student->parent_phone,
                'message' => $pesan,
                'countryCode' => '62',
            ]);

            if ($response->successful()) {
                $berhasil++;
            }
        }

        return back()->with('success', "Berhasil mengirim broadcast ke $berhasil dari {$invoices->count()} tagihan.");
    }

    private function formatPesanWa(Invoice $invoice)
    {
        $namaSiswa = $invoice->student->full_name;
        $jenisTagihan = $invoice->payment_type;
        $periode = $invoice->period;
        $nominal = number_format($invoice->amount, 0, ',', '.');
        $jatuhTempo = \Carbon\Carbon::parse($invoice->due_date)->format('d M Y');

        $pesan = "Assalamu'alaikum Warahmatullahi Wabarakatuh.\n\n";
        $pesan .= "Halo Bapak/Ibu Orang Tua/Wali dari Ananda *$namaSiswa* 👋\n\n";
        $pesan .= "Kami ingin mengingatkan terkait tagihan sekolah berikut:\n\n";
        $pesan .= "📌 Tagihan: *$jenisTagihan*\n";
        $pesan .= "📅 Periode: $periode\n";
        $pesan .= "💳 Nominal: *Rp$nominal*\n";
        $pesan .= "⏳ Jatuh Tempo: $jatuhTempo\n\n";
        $pesan .= "Mohon kesediaannya untuk melakukan pembayaran sebelum tanggal jatuh tempo.\n\n";
        $pesan .= "Jika pembayaran telah dilakukan, silakan abaikan pesan ini.\n\n";
        $pesan .= "Terima kasih atas perhatian dan kerja samanya.\n\n";
        $pesan .= "Wassalamu'alaikum Warahmatullahi Wabarakatuh.";

        return $pesan;
    }
}
