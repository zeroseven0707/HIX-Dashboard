<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class FinanceMerchant extends Component
{
    public $merchants = [];
    public $totalUangSemuaMerchant = 0;
    public $startDate;
    public $endDate;
    public function mount()
    {
        $this->fetchData();
    }

    public function filter()
    {
        $this->fetchData();
    }
    public function fetchData()
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session('apiKey'),
        ])->get($url.'finance/report/merchant', [
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
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
    public function render()
    {
        return view('livewire.finance-merchant');
    }
}
