<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Ongkir extends Component
{
    public $data = [];
    public $details = null;
    public $ongkirId;
    public $cost;
    public $additionalCost;

    public function mount()
    {
        $this->fetchOngkirData();
    }

    public function fetchOngkirData()
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session('apiKey')
        ])->get($url.'layanan/merchant/ongkir',[
            'take'=>10,
            'page'=>1
        ]);
        $this->data = $response->json()['data'];
    }

    public function viewDetail($ongkirId)
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session('apiKey')
        ])->get($url.'cost/detail/ongkir?ongkirId=' . $ongkirId);
        $this->details = $response->json();
        $this->ongkirId = $ongkirId;
        $this->cost = $this->details['cost'];
        $this->additionalCost = $this->details['additionalCost'];
    }

    public function updateOngkir()
    {
        $url = env('API_BASE_URL');
         Http::withHeaders([
            'api-key' => session('apiKey')
        ])->post($url.'cost/update/ongkir?ongkirId=' . $this->ongkirId, [
            'ongkir' => (int) $this->cost,
            'additionalCost' => (int) $this->additionalCost,
        ]);
        $this->details = null;
        $this->fetchOngkirData();
    }
    public function render()
    {
        return view('livewire.ongkir');
    }
}
