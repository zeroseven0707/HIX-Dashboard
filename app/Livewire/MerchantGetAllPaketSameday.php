<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class MerchantGetAllPaketSameday extends Component
{
    public $packages;

    public function mount()
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session('apiKey')
        ])->get($url.'merchant/all/sameday?take=5&page=1&status=Requested');
        $this->packages = $response->json();
    }

    public function viewDetail($noResi)
    {
        $this->emit('showDetail', $noResi);
    }
    public function render()
    {
        return view('livewire.merchant-get-all-paket-sameday');
    }
}
