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
    public $currentPage;
    public $totalPages;

    public function mount()
    {
        $this->fetchDrivers();
    }
    public function fetchDrivers($page = 1, $take = 10)
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->get("{$url}driver/all-driver?page={$page}&take={$take}");
    
        if ($response->successful()) {
            $data = $response->json();
            $this->driver = $data['driver'];
            $this->currentPage = $data['meta']['page']; // Asumsi API memberikan informasi halaman saat ini
            $this->totalPages = $data['meta']['lastPage'];   // Asumsi API memberikan informasi total halaman
        } else {
            // Handle error
            $this->driver = [];
            $this->currentPage = 1;
            $this->totalPages = 1;
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
            $this->fetchDrivers();
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
        return view('livewire.driver', [
            'driver' => $this->driver,
            'currentPage' => $this->currentPage,
            'totalPages' => $this->totalPages,
        ]);
    }
    // Jika tombol pagination ditekan
public function changePage($page)
{
    $this->fetchDrivers($page);
}
}
