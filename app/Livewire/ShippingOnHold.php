<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class ShippingOnHold extends Component
{
    public $shippingData = [];

    public function mount()
    {
        $url = env('API_BASE_URL');
        $apiKey = Session::get('apiKey');
        if ($apiKey) {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
            ])->get($url.'regular/new?take=3&page=1'); // Sesuaikan dengan endpoint API Anda

            if ($response->successful()) {
                // dd($response);
            } else {
                $this->shippingData = [];
            }
        } else {
            $this->shippingData = [];
        }
    }

    public function render()
    {
        return view('livewire.shipping-on-hold', [
            'shippingData' => $this->shippingData,
        ]);
    }
}
