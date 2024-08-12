<?php
namespace App\Livewire;

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

    public function mount()
    {
        // Muat data awal
        $this->loadData();
    }

    public function filter()
    {
        // Panggil ulang loadData untuk memperbarui data berdasarkan filter
        $this->loadData();
    }

    public function loadData()
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->get($url . 'finance/report/admin', [
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
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
        }
    }

    public function render()
    {
        return view('livewire.finance');
    }
}
