<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class MerchantGetAllPaketInstan extends Component
{
    public $packages;
    public $statuses = ['Requested', 'On Hold', 'On Pickup', 'On Delivery', 'Assigned', 'Done'];
    public $selectedStatus = 'Requested'; // Default filter status

    public function mount()
    {
        $this->loadPackages();
    }

    public function loadPackages()
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session('apiKey')
        ])->get($url . 'merchant/all/instant?take=5&page=1&status=' . $this->selectedStatus);
        $this->packages = $response->json()['data'];
    }

    public function filterByStatus()
    {
        $this->loadPackages();
    }

    public function viewDetail($noResi)
    {
        $this->emit('showDetail', $noResi);
    }

    public function render()
    {
        return view('livewire.merchant-get-all-paket-instan');
    }
}
