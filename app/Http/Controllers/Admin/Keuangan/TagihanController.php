<?php

namespace App\Http\Controllers\Admin\Keuangan;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\PaymentType;
use App\Models\Student;
use App\Models\SchoolClass;
use App\Jobs\SendWhatsAppJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\Admin\Keuangan\SearchTagihanRequest;
use App\Http\Requests\Admin\Keuangan\StoreTagihanRequest;
use App\Http\Requests\Admin\Keuangan\BulkDestroyTagihanRequest;

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

        return view('admin.keuangan.tagihan.index', compact('students'));
    }

    public function student(Student $student)
    {
        $student->load(['unit', 'studentClasses.schoolClass', 'studentClasses.academicYear']);
        $invoices = Invoice::where('student_id', $student->id)->latest()->paginate(20);
        return view('admin.keuangan.tagihan.student', compact('student', 'invoices'));
    }

    public function searchStudent(SearchTagihanRequest $request)
    {
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

        return view('admin.keuangan.tagihan.create', compact('classes', 'paymentTypes'));
    }

    public function store(StoreTagihanRequest $request)
    {
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
                    $q->where('class_id', $request->class_id)
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
        return view('admin.keuangan.tagihan.show', compact('invoice'));
    }

    public function destroy(Invoice $invoice)
    {
        if ($invoice->status === 'paid') {
            return back()->with('error', 'Tagihan yang sudah dibayar tidak dapat dihapus.');
        }
        $invoice->delete();
        return back()->with('success', 'Tagihan berhasil dihapus.');
    }

    public function bulkDestroy(BulkDestroyTagihanRequest $request)
    {
        $invoices = Invoice::whereIn('student_id', $request->ids)
                           ->where('status', 'unpaid')
                           ->get();

        $count = $invoices->count();

        foreach ($invoices as $invoice) {
            $invoice->delete();
        }

        return redirect()->route('admin.tagihan.index')
            ->with('success', "Berhasil menghapus $count tagihan belum lunas dari siswa yang dipilih.");
    }

    public function kirimWa(Invoice $invoice)
    {
        $invoice->load(['student']);
        $nomorWa = $invoice->student->parent_phone;
        
        if (!$nomorWa) {
            return back()->with('error', 'Nomor WA orang tua tidak ditemukan!');
        }
        $pesan = $this->formatPesanWa($invoice);
        
        try {
            $response = Http::withoutVerifying()->timeout(15)->withHeaders([
                'Authorization' => env('FONNTE_API_TOKEN')
            ])->post('https://api.fonnte.com/send', [
                'target' => $nomorWa,
                'message' => $pesan,
                'countryCode' => '62',
            ]);
            
            $responseData = $response->json();
            if ($response->successful() && isset($responseData['status']) && $responseData['status'] === true) {
                $invoice->increment('wa_sent_count');
                $invoice->update(['wa_last_sent_at' => now()]);
                return back()->with('success', 'Tagihan berhasil dikirim ke WA!');
            }
            $errorDetail = isset($responseData['reason']) ? $responseData['reason'] : (isset($responseData['detail']) ? $responseData['detail'] : $response->body());
            return back()->with('error', 'Gagal mengirim WA. Pesan dari server: ' . $errorDetail);
        } catch (\Exception $e) {
            return back()->with('error', 'Koneksi ke server WhatsApp (Fonnte) terputus atau timeout: ' . $e->getMessage());
        }
    }

    public function broadcastWa(Request $request)
    {
        // Hindari PHP timeout (Maximum execution time of 30 seconds exceeded)
        set_time_limit(0);
        
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
        $gagal = 0;
        // Memproses pengiriman pesan secara asinkron (concurrent) dalam kelompok-kelompok kecil (25 sekaligus)
        // Ini akan mempercepat waktu proses secara eksponensial dan mencegah bottleneck API Fonnte
        foreach ($invoices->chunk(25) as $chunk) {
            $chunkInvoices = $chunk->values();
            foreach ($chunkInvoices as $invoice) {
                // Dispatch job to send WhatsApp message
                SendWhatsAppJob::dispatch($invoice->id);
                $berhasil++;
            }
        }
        
        if ($gagal > 0 && $berhasil == 0) {
            return back()->with('error', "Gagal mengirim broadcast ke {$invoices->count()} tagihan. Kemungkinan server WhatsApp sedang gangguan/timeout.");
        } elseif ($gagal > 0) {
            return back()->with('success', "Berhasil mengirim broadcast ke $berhasil tagihan, namun $gagal tagihan gagal dikirim.");
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
