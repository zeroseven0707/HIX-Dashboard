<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class NeedAssignedDetail extends Component
{
    public $kecamatanId;
    public $details = [];
    public $drivers = [];

    public function mount($kecamatanId)
    {
        $this->kecamatanId = $kecamatanId;
        $this->fetchDetails();
        $this->listDriver();

    }
    public function fetchDetails(){
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->get($url.'regular/sameday/pickup-done/detail',[
            'take' => 4,
            'page' => 1,
            'kecamatanId' => $this->kecamatanId
        ]);

        if ($response->successful()) {
            // dd(json_decode($response));
            $this->details = $response->json();
        }else {
            // Handle error
            $this->details = [];
        }
    }
    public function listDriver(){
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->get($url.'driver/all-driver',[
            'take' => 4,
            'page' => 1,
            'unitKendaraanId' => $this->details['paket'][0]['unitKendaraanId']
        ]);
        // dd(json_decode($response));
        if ($response->successful()) {
            $this->drivers = $response->json()['driver'];
        }else {
            // Handle error
            $this->drivers = [];
        }
    }
        // asign driver
        public function assignDriver($driverId)
        {
            $base_url = env('API_BASE_URL');
            $url = $base_url.'regular/sameday/pickup-done/assign?kecamatanId=' . $this->details['kecamatan']['id'] .'&driverId=' .  $driverId;
    
            $response = Http::withHeaders([
                'api-key' => session()->get('apiKey'),
            ])->post($url);
            // dd(json_decode($response));
    
            if ($response->successful()) {
                session()->flash('message', 'Driver assigned successfully!');
                return redirect('/shipping-sameday#need-assigned-tab');
            } else {
                session()->flash('error', 'Failed to assign driver.');
            }
        }
    public function render()
    {
        return view('livewire.need-assigned-detail');
    }
}
