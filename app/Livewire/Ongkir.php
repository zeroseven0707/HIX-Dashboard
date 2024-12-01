<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Ongkir extends Component
{
    public $data = [];
    public $dataInstan = [];
    public $dataSameday = [];
    public $details = null;
    public $ongkirId;
    public $cost;
    public $additionalCost;
    public $currentPage;
    public $totalPages;

    public function mount()
    {
        $this->fetchOngkirData();
        $this->fetchOngkirDataInstan();
        $this->fetchOngkirDataSameday();
    }

    public function fetchOngkirData()
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session('apiKey')
        ])->get($url . 'layanan/merchant/ongkir', [
            'take' => 10,
            'page' => 1,
        ]);

        if ($response->successful()) {
            $this->data = $response->json()['data'];
            $this->currentPage = $response->json()['meta']['page']; // Asumsi API memberikan informasi halaman saat ini
            $this->totalPages = $response->json()['meta']['lastPage'];   // Asumsi API memberikan informasi total halaman
            
        } else {
            $this->data = [];
            $this->currentPage = 1;
            $this->totalPages = 1;
        }
    }

    public function fetchOngkirDataInstan()
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session('apiKey')
        ])->get($url . 'layanan/merchant/ongkir', [
            'take' => 10,
            'page' => 1,
            'serviceId' => 1
        ]);

        if ($response->successful()) {
            $this->dataInstan = $response->json()['data'];
            $this->currentPage = $response->json()['meta']['page']; // Asumsi API memberikan informasi halaman saat ini
            $this->totalPages = $response->json()['meta']['lastPage'];   // Asumsi API memberikan informasi total halaman
            
        } else {
            $this->dataInstan = [];
            $this->currentPage = 1;
            $this->totalPages = 1;
        }
    }

    public function fetchOngkirDataSameday()
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session('apiKey')
        ])->get($url . 'layanan/merchant/ongkir', [
            'take' => 10,
            'page' => 1,
            'serviceId' => 2
        ]);

        if ($response->successful()) {
            $this->dataSameday = $response->json()['data'];
            $this->currentPage = $response->json()['meta']['page']; // Asumsi API memberikan informasi halaman saat ini
            $this->totalPages = $response->json()['meta']['lastPage'];   // Asumsi API memberikan informasi total halaman
            
        } else {
            $this->dataSameday = [];
            $this->currentPage = 1;
            $this->totalPages = 1;
        }
    }

    public function viewDetail($ongkirId)
    {
        $url = env('API_BASE_URL');
        $response = Http::withHeaders([
            'api-key' => session('apiKey')
        ])->get($url . 'cost/detail/ongkir?ongkirId=' . $ongkirId);
        $this->details = $response->json();
        $this->ongkirId = $ongkirId;
        $this->cost = $this->details['cost'];
        $this->additionalCost = $this->details['additionalCost'];
    }

    public function updateOngkir()
    {
        $url = env('API_BASE_URL');
        Http::withHeaders([
            'api-key' => session('apiKey')
        ])->post($url . 'cost/update/ongkir?ongkirId=' . $this->ongkirId, [
            'ongkir' => (int) $this->cost,
            'additionalCost' => (int) $this->additionalCost,
        ]);
        $this->details = null;
        $this->fetchOngkirData();
    }
    public function render()
    {
        return view('livewire.ongkir', [
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
