<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Dashboard extends Component
{
    public $data = [];
    public $recent = [];
    public $onHold = [];
    public $driver = [];
    public $DataOnDelivery = [];

    public function mount()
    {
        $this->fetchData();
        $this->fetchDataOnHold();
        $this->fetchDataRecent();
        $this->fetchDataDrivers();
        $this->onDelivery();
    }

    public function onDelivery()
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->get($url.'regular/On Delivery', [
            'take' => 3,
            'page' => 1
        ]);

        if ($response->successful()) {
            $this->DataOnDelivery = $response->json()['data'];
        } else {
            // Handle error
            $this->DataOnDelivery = [];
        }
    }
    
    public function fetchDataDrivers()
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->get($url.'driver/all-driver', [
            'take' => 5,
            'page' => 1
        ]);

        if ($response->successful()) {
            // dd(json_decode($response));
            $this->driver = $response->json()['driver'];
        } else {
            // Handle error
            $this->driver = [];
        }
    }
    public function fetchData()
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->get($url.'regular/Assigned', [
            'take' => 3,
            'page' => 1
        ]);

        if ($response->successful()) {
            // dd($response->json());
            $this->data = $response->json()['data'];
        } else {
            // Handle error
            $this->data = [];
        }
    }
    public function fetchDataOnHold()
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->get($url.'regular/On Hold', [
            'take' => 3,
            'page' => 1
        ]);

        if ($response->successful()) {
            // dd($response->json());
            $this->onHold = $response->json()['data'];
        } else {
            // Handle error
            $this->onHold = [];
        }
    }
    public function fetchDataRecent()
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->get($url.'regular/recent', [
            'take' => 3,
            'page' => 1
        ]);

        if ($response->successful()) {
            $this->recent = $response->json()['data'];
        } else {
            // Handle error
            $this->recent = [];
        }
    }
    public function render()
    {
        return view('livewire.dashboard');
    }
}
