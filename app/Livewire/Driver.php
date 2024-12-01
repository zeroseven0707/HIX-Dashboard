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
    public $dataMotor;
    public $dataMobil;
    public $pagination = [
        'motor' => [
            'currentPage' => 1,
            'totalPages' => 1,
        ],
        'mobil' => [
            'currentPage' => 1,
            'totalPages' => 1,
        ]
    ];

    public function mount()
    {
        $this->fetchDrivers();
        $this->motor();
        $this->mobil();
    }
    public function fetchDrivers($page = 1,)
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->get("{$url}driver/all-driver?page={$page}&take=100");

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

    public function motor($page = 1, $take = 100, $unitKendaraanId = 1)
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->get("{$url}driver/all-driver?page={$page}&take={$take}&unitKendaraanId={$unitKendaraanId}");

        if ($response->successful()) {
            // dd($response->json());
            $data = $response->json();
            $this->dataMotor = $data['driver'];
            $this->pagination['motor']['currentPage'] = $data['meta']['page']; // Asumsi API memberikan informasi halaman saat ini
            $this->pagination['motor']['totalPages'] = $data['meta']['lastPage'];   // Asumsi API memberikan informasi total halaman
        } else {
            // Handle error
            $this->dataMotor = [];
            $this->pagination['motor']['currentPage'] = 1;
            $this->pagination['motor']['totalPages'] = 1;
        }
    }

    public function mobil($page = 1, $take = 100, $unitKendaraanId = 2)
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session()->get('apiKey'),
        ])->get("{$url}driver/all-driver?page={$page}&take={$take}&unitKendaraanId={$unitKendaraanId}");

        if ($response->successful()) {
            // dd($response->json());
            $data = $response->json();
            $this->dataMobil = $data['driver'];
            $this->pagination['mobil']['currentPage'] = $data['meta']['page']; // Asumsi API memberikan informasi halaman saat ini
            $this->pagination['mobil']['totalPages'] = $data['meta']['lastPage'];   // Asumsi API memberikan informasi total halaman
        } else {
            // Handle error
            $this->dataMobil = [];
            $this->pagination['mobil']['currentPage'] = 1;
            $this->pagination['mobil']['totalPages'] = 1;
        }
    }

    public function verif($id)
    {
        $base_url = env('API_BASE_URL');
        $url = $base_url . 'driver/verif/accept?id=' . $id;

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
        ])->get($url . 'driver/driver-detail', [
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
            'dataMotor' => $this->dataMotor,
            'dataMobil' => $this->dataMobil,
            'currentPage' => $this->currentPage,
            'totalPages' => $this->totalPages,
            'pagination' => $this->pagination,
        ]);
    }
    // Jika tombol pagination ditekan
    public function changePage($page)
    {
        $this->fetchDrivers($page);
    }
}
