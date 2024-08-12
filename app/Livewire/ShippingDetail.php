<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ShippingDetail extends Component
{
    public $DataShipping = [];

    public function mount()
    {
        $this->detail();
    }
    
    public function detail()
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->get($url.'regular/detail/', [
            'take' => 3,
            'page' => 1
        ]);

        if ($response->successful()) {
            // dd(json_decode($response));
            $this->DataShipping = $response->json()['data'];
        } else {
            // Handle error
            $this->DataShipping = [];
        }
    }
    public function render()
    {
        return view('livewire.shipping-detail');
    }
}
