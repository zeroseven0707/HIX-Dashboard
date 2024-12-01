<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class SameDayOnPickupDetail extends Component
{
    public $branchId;
    public $details = [];

    public function mount($branchId)
    {
        $this->branchId = $branchId;
        $this->fetchDetails();

    }
    public function fetchDetails(){
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->get('https://tedy-dev.my.id/api/regular/sameday/on-hold/detail',[
            'take' => 10,
            'page' => 1,
            'branchId' => $this->branchId
        ]);

        if ($response->successful()) {
            $this->details = $response->json();
        }
    }
    public function onHoldPickup()
    {
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
            ])->post('https://tedy-dev.my.id/api/regular/sameday/on-hold/pickup', [
                'branchId' => (int) $this->branchId
            ]);
            // dd(json_decode($response));
        if ($response->successful()) {
            return redirect('/shipping-sameday');
        }
    }
    public function render()
    {
        return view('livewire.same-day-on-pickup-detail');
    }
}
