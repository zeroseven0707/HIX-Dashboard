<?php

namespace App\Livewire;

use Barryvdh\DomPDF\Facade\Pdf; // Import PDF facade
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithFileUploads; // Import the WithFileUploads trait

class FinanceMerchantDetail extends Component
{
    use WithFileUploads; // Use the WithFileUploads trait
    public $merchantId;
    public $details = [];
    public $bukti_transfer;

    public function mount($merchantId)
    {
        $this->merchantId = $merchantId;
        $this->fethDetails();
    }

    public function fethDetails()
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->get($url . 'finance/transfer/merchant', [
            'merchantId' => $this->merchantId
        ]);

        if ($response->successful()) {
            $this->details = $response->json();
        } else {
            $this->details = [];
        }
    }

    public function uploadBuktiTransfer()
    {
        $this->validate([
            'bukti_transfer' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048', // Validasi file
        ]);

        // Simpan file ke storage
        $filePath = $this->bukti_transfer->store('uploads/bukti_transfer'); // Path untuk menyimpan file

        // Kirim file ke API jika diperlukan
        $url = env('API_BASE_URL') . 'finance/transfer/done?merchantId=' . $this->merchantId;
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->patch($url);

        // dd($response->json());

        if ($response->successful()) {
            session()->flash('message', 'Bukti transfer berhasil diupload.'); // Pesan sukses
        } else {
            session()->flash('error', 'Gagal mengupload bukti transfer.'); // Pesan error
        }

        // Reset file upload setelah berhasil
        $this->bukti_transfer = null;
    }


    // Method to export PDF
    public function exportPdf()
    {
        $data = [
            'details' => $this->details,
        ];

        $pdf = Pdf::loadView('pdf.merchant-report', $data);

        // Stream to browser as PDF download
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'merchant_report_' . $this->merchantId . '.pdf');
    }

    public function render()
    {
        return view('livewire.finance-merchant-detail');
    }
}
