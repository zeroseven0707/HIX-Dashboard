<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Cashback extends Component
{
    public $cashbacks = [];
    public $detail = null;
    public $cashbackAmount = 0;

    public function mount()
    {
        $this->fetchCashbacks();
    }

    public function fetchCashbacks()
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session('apiKey')
        ])->get($url.'layanan/merchant/cashback?take=4&page=1');
        $this->cashbacks = $response->json()['data'];
    }

    public function viewDetail($id)
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session('apiKey')
        ])->get($url.'cost/detail/cashback?ongkirId=' . $id);
        $this->detail = $response->json();
        $this->cashbackAmount = $this->detail['cashback'];
    }

    public function updateCashback()
    {
        $url = env('API_BASE_URL');
        Http::withHeaders([
            'api-key' => session('apiKey')
        ])->post($url.'cost/update/cashback?ongkirId=' . $this->detail['id'], [
            'cashback' => (int) $this->cashbackAmount
        ]);

        $this->fetchCashbacks();
        $this->detail = null;
    }
    public function render()
    {
        return view('livewire.cashback');
    }
}
