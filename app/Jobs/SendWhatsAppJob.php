<?php

namespace App\Jobs;

use App\Models\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Exception;

class SendWhatsAppJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected int $invoiceId;

    /**
     * Create a new job instance.
     */
    public function __construct(int $invoiceId)
    {
        $this->invoiceId = $invoiceId;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $invoice = Invoice::with('student')->find($this->invoiceId);
        if (! $invoice) {
            return;
        }
        $nomorWa = $invoice->student->parent_phone;
        if (! $nomorWa) {
            return;
        }
        $pesan = $this->formatPesanWa($invoice);
        try {
            $response = Http::withoutVerifying()
                ->timeout(15)
                ->withHeaders([
                    'Authorization' => env('FONNTE_API_TOKEN'),
                ])
                ->post('https://api.fonnte.com/send', [
                    'target' => $nomorWa,
                    'message' => $pesan,
                    'countryCode' => '62',
                ]);
            $responseData = $response->json();
            if ($response->successful() && isset($responseData['status']) && $responseData['status'] === true) {
                $invoice->increment('wa_sent_count');
                $invoice->update(['wa_last_sent_at' => now()]);
            }
        } catch (Exception $e) {
            // Laravel will automatically log failed jobs; no further action required.
        }
    }

    /**
     * Build the WA message body.
     */
    protected function formatPesanWa(Invoice $invoice): string
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
