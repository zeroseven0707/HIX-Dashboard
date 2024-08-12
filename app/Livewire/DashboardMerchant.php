<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class DashboardMerchant extends Component
{
    public $merchant;
    public $totalPemasukan = 0;
    public $branchs = [];

    public function mount()
    {
        $this->fetchData();
    }

    public function fetchData()
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session('apiKey'),
        ])->get($url.'merchant/laporan/keuangan');

        if ($response->successful()) {
            $data = $response->json();
            $this->merchant = $data['merchant'];
            $this->totalPemasukan = $data['total_pemasukan'];
            $this->branchs = $data['branchs'];
        } else {
            // Handle error
            $this->merchant = [];
            $this->totalPemasukan = 0;
            $this->branchs = [];
        }
    }
    public function render()
    {
        return view('livewire.dashboard-merchant');
    }
}
