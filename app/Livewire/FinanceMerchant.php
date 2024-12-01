<?php

namespace App\Livewire;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class FinanceMerchant extends Component
{
    public $merchants = [];
    public $totalUangSemuaMerchant = 0;
    public $startDate;
    public $endDate;
    public $range = 'today'; // Default range

    public function mount()
    {
        $this->fetchData();
    }

    public function resetDates()
    {
        $this->startDate = null;
        $this->endDate = null;
    }

    public function filter()
    {
        $this->fetchData();
    }
    public function fetchData()
    {
        if (!empty($this->startDate) || !empty($this->endDate)) {
            $this->range = "";
        }

        if (!empty($this->range)) {
            $this->startDate = "";
            $this->endDate = "";
        }


        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session('apiKey'),
        ])->get($url . 'finance/report/merchant', [
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
            'range' => $this->range,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            $this->merchants = $data['merchants'];
            $this->totalUangSemuaMerchant = $data['total_uang_semua_merchant'];
        } else {
            // Handle error
            $this->merchants = [];
            $this->totalUangSemuaMerchant = 0;
        }
    }

    public function exportPdf()
    {
        $data = [
            'merchants' => $this->merchants,
            'totalUangSemuaMerchant' => $this->totalUangSemuaMerchant,
        ];

        $pdf = Pdf::loadView('pdf.finance_merchant_report', $data);
        return response()->streamDownload(
            fn() => print($pdf->output()),
            "finance_merchant_report_" . now()->format('Ymd_His') . ".pdf"
        );
    }

    public function render()
    {
        return view('livewire.finance-merchant');
    }
}
