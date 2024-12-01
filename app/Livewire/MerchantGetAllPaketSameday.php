<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class MerchantGetAllPaketSameday extends Component
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
        ])->get($url.'merchant/all/sameday?take=5&page=1&status=' . $this->selectedStatus);
        $this->packages = $response->json();
    }

    public function filterByStatus()
    {
        $this->loadPackages();
    }

    public function render()
    {
        return view('livewire.merchant-get-all-paket-sameday');
    }
}
