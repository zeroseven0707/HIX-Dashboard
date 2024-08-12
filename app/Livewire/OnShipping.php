<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

use function Laravel\Prompts\alert;

class OnShipping extends Component
{   
    public $DataRequest = [];
    public $DataOnPickup = [];
    public $DataOnDelivery = [];
    public $DataOnHold = [];
    public $DataDone = [];
    public $drivers = null;
    public $shippingDetail = null; 
    public $showDetailModal = false;
    public $showBody = false;
    public $noResi;

    public function mount()
    {
        $this->request();
        $this->onDelivery();
        $this->onPickup();
        $this->done();
    }
    
    public function request()
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->get($url.'regular/Requested');

        if ($response->successful()) {
            // dd(json_decode($response));
            $this->DataRequest = $response->json()['data'];
        } else {
            // Handle error
            $this->DataRequest = [];
        }
    }
    public function onPickup()
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->get($url.'regular/On Pickup', [
            'take' => 10,
            'page' => 1
        ]);

        if ($response->successful()) {
            $this->DataOnPickup = $response->json()['data'];
        } else {
            // Handle error
            $this->DataOnPickup = [];
        }
    }
    public function onHold()
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->get($url.'regular/On Hold', [
            'take' => 10,
            'page' => 1
        ]);

        if ($response->successful()) {
            $this->DataOnHold = $response->json()['data'];
        } else {
            // Handle error
            $this->DataOnHold = [];
        }
    }
    public function onDelivery()
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->get($url.'regular/On Delivery', [
            'take' => 10,
            'page' => 1
        ]);

        if ($response->successful()) {
            $this->DataOnDelivery = $response->json()['data'];
        } else {
            // Handle error
            $this->DataOnDelivery = [];
        }
    }
    public function Done()
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->get($url.'regular/Done', [
            'take' => 10,
            'page' => 1
        ]);

        if ($response->successful()) {
            $this->DataDone = $response->json()['data'];
        } else {
            // Handle error
            $this->DataDone = [];
        }
    }

    // Fetch data detail shipping
    public function fetchDetail($noResi)
    {
        $url = env('API_BASE_URL');
        $this->noResi = $noResi;
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->get($url.'regular/detail/' . $noResi);
        $driver = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->get($url.'driver/all-driver', [
            'take' => 3,
            'verifStatus' => 'Accepted',
            'page' => 1
        ]);


        if ($response->successful()  && $driver->successful()) {
            // dd($response->json());  
            $this->shippingDetail = $response->json()['shippingDetail'];
            $this->drivers = $driver->json()['driver'];
            $this->showDetailModal = true; // Tampilkan modal
        } else {
            $this->shippingDetail = null;
            $this->drivers = null;
            $this->showDetailModal = false;
        }
    }
    // asign driver
    public function assignDriver($driverId)
    {
        $base_url = env('API_BASE_URL');
        $url = $base_url.'assign/regular/instant/' . $this->noResi . '?driverId=' . (int) $driverId;

        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->post($url);
        // dd(json_decode($response));

        if ($response->successful()) {
            $this->showDetailModal = false;
            session()->flash('message', 'Driver assigned successfully!');
        } else {
            dd(json_decode($response));
            session()->flash('error', 'Failed to assign driver.');
        }
    }
    public function closeModal()
    {
        $this->showDetailModal = false;
    }
    public function toggleBody()
    {
        $this->showBody = !$this->showBody;
    }
    public function render()
    {
        return view('livewire.on-shipping');
    }
}
