<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class DriverCommission extends Component
{
    public $details = [];
    public function mount()
    {
        $this->fetchBranches();
    }

    public function fetchBranches()
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session('apiKey')
        ])->get($url.'driver/all/komisi');
        $this->details = $response->json()['data'];
    }
    public function render()
    {
        return view('livewire.driver-commission');
    }
}
