<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ShippingOnHoldDetail extends Component
{
    public $branchId;
    public $details = [];

    public function mount($branchId)
    {
        $this->branchId = $branchId;
        $this->fetchDetails();

    }
    public function fetchDetails(){
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->get($url.'/regular/sameday/on-hold/detail',[
            'take' => 4,
            'page' => 1,
            'branchId' => $this->branchId
        ]);

        if ($response->successful()) {
            $this->details = $response->json();
        }
    }
    public function onHoldPickup()
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
            ])->post($url.'regular/sameday/on-hold/pickup', [
                'branchId' => (int) $this->branchId
            ]);
            // dd(json_decode($response));
        if ($response->successful()) {
            return redirect('/shipping-sameday');
        }
    }
    public function render()
    {
        return view('livewire.shipping-on-hold-detail');
    }
}
