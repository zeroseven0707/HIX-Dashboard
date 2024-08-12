<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class SameDayOnDeliveryDetail extends Component
{
    public $kecamatanId;
    public $details = [];

    public function mount($kecamatanId)
    {
        $this->kecamatanId = $kecamatanId;
        $this->fetchDetails();
    }

    public function fetchDetails()
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->get($url.'regular/sameday/delivery/detail', [
            'take' => 4,
            'page' => 1,
            'kecamatanId' => $this->kecamatanId
        ]);
        if ($response->successful()) {
            // dd(json_decode($response));
            $this->details = $response->json();
        } else {
            // Handle error
            $this->details = [];
        }
    }
    public function back()
    {
        return redirect('/shipping-sameday#on-delivery-tab');
    }
    public function render()
    {
        return view('livewire.same-day-on-delivery-detail');
    }
}
