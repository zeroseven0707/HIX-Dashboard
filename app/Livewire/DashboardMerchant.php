<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class DashboardMerchant extends Component
{
    public $merchant;
    public $totalPemasukan = ['transferred' => 0, 'notTransferred' => 0];
    public $branchs = [];
    public $range = 'last30days'; // Default range

    public function mount()
    {
        $this->fetchData();
    }

    public function updatedRange()
    {
        $this->fetchData();
    }

    public function fetchData()
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session('apiKey'),
        ])->get($url . 'merchant/laporan/keuangan', [
            'range' => $this->range, // Gunakan range dalam API call
        ]);

        if ($response->successful()) {
            $data = $response->json();
            $this->merchant = $data['merchant'];
            $this->totalPemasukan = $data['total_pemasukan'];
            $this->branchs = $data['branchs'];
        } else {
            // Tangani kesalahan
            $this->merchant = [];
            $this->totalPemasukan = ['transferred' => 0, 'notTransferred' => 0];
            $this->branchs = [];
        }
    }

    public function render()
    {
        return view('livewire.dashboard-merchant');
    }
}
