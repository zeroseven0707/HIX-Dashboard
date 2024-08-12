<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class SameDayRequestDetail extends Component
{
    public $branchId;
    public $details = [];

    public function mount($branchId)
    {
        $this->branchId = $branchId;
        $this->fetchDetails();
    }

    public function fetchDetails()
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->get($url.'regular/sameday/request/detail', [
            'take' => 4,
            'page' => 1,
            'branchId' => (int) $this->branchId
        ]);

        if ($response->successful()) {
            $this->details = $response->json();
        } else {
            // Handle error
            $this->details = [];
        }
    }

    public function requestPickup()
    {
        $url = env('API_BASE_URL');
        $respon = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->post($url.'regular/sameday/request/pickup?branchId='.$this->branchId);
        // dd(json_decode($respon));
        return redirect('/shipping-sameday')->with('message','successfully');
        
    }
    public function render()
    {
        return view('livewire.same-day-request-detail');
    }
}
