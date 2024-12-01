<?php

namespace App\Livewire;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Finance extends Component
{
    public $pendapatanKotor;
    public $totalCashback;
    public $totalkomisiDriver;
    public $pendapatanBersih;
    public $totalShippings;
    public $drivers;
    public $TotalPaketCOD;
    public $totalPaketLUNAS;
    public $startDate;
    public $endDate;
    public $range = 'today'; // Default range

    public function mount()
    {
        // Muat data awal
        $this->loadData();
    }

    public function resetDates()
    {
        $this->startDate = null;
        $this->endDate = null;
    }

    public function filter()
    {
        // Panggil ulang loadData untuk memperbarui data berdasarkan filter
        $this->loadData();
    }

    public function loadData()
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
            'api-key' => session()->get('apiKey'),
        ])->get($url . 'finance/report/admin', [
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
            'range' => $this->range,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            $this->pendapatanKotor = $data['pendapatanKotor'];
            $this->totalCashback = $data['totalCashback'];
            $this->totalkomisiDriver = $data['totalkomisiDriver'];
            $this->pendapatanBersih = $data['pendapatanBersih'];
            $this->totalShippings = $data['totalShippings'];
            $this->drivers = $data['drivers'];
            $this->TotalPaketCOD = $data['TotalPaketCOD'];
            $this->totalPaketLUNAS = $data['totalPaketLUNAS'];
        } else {
            // Handle error
            // Anda bisa memberikan feedback kepada user bahwa terjadi error
            $this->pendapatanKotor =  [];
            $this->totalCashback = [];
        }
    }

    public function exportPdf()
    {
        $data = [
            'pendapatanKotor' => $this->pendapatanKotor,
            'totalCashback' => $this->totalCashback,
            'totalkomisiDriver' => $this->totalkomisiDriver,
            'pendapatanBersih' => $this->pendapatanBersih,
            'totalShippings' => $this->totalShippings,
            'drivers' => $this->drivers,
            'TotalPaketCOD' => $this->TotalPaketCOD,
            'totalPaketLUNAS' => $this->totalPaketLUNAS,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
        ];


        $pdf = Pdf::loadView('pdf.finance_report', $data);

        return response()->stream(
            function () use ($pdf) {
                echo $pdf->output();
            },
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="finance_report_' . now()->format('Ymd_His') . '.pdf"',
            ]
        );
    }



    public function render()
    {
        return view('livewire.finance');
    }
}
