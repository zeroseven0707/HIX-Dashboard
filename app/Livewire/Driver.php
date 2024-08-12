<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Driver extends Component
{
    public $driver = [];
    public $showDetailModal = false;
    public $driverDetail = null;
    public $driverId;

    public function mount()
    {
        $this->fetchDataDrivers();
    }
    public function fetchDataDrivers()
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->get($url.'driver/all-driver');
        if ($response->successful()) {
            // dd(json_decode($response));
            $this->driver = $response->json()['driver'];
        } else {
            // Handle error
            $this->driver = [];
        }
    }
    public function verif($id)
    {
        $base_url = env('API_BASE_URL');
        $url = $base_url.'driver/verif/accept?id=' . $id;
    
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->post($url);
    
        if ($response->successful()) {
            $this->showDetailModal = false;
            $this->fetchDataDrivers();
            session()->flash('message', 'Driver berhasil diverifikasi.');
        } else {
            $this->showDetailModal = false;
            session()->flash('error', 'Verifikasi driver gagal.');
        }
    }
    public function fetchDetail($id)
    {
        $url = env('API_BASE_URL');
        $this->driverId = $id;
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->get($url.'driver/driver-detail', [
            'id' => $id
        ]);

        if ($response->successful()) {
            // dd($response->json()); 
            $this->driverDetail = $response->json();
            $this->showDetailModal = true; // Tampilkan modal
        } else {
            $this->driverDetail = null;
            $this->showDetailModal = false;
        }
    }
    public function closeModal()
    {
        $this->showDetailModal = false;
    }
    public function render()
    {
        return view('livewire.driver');
    }
}
